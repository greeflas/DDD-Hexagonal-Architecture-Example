<?php

declare(strict_types=1);

namespace App\CommandDomainModel\Auction;

use App\CommandDomainModel\Bid\Bid;
use App\CommandDomainModel\Bid\BidId;
use App\CommandDomainModel\Seller\Item;
use App\EventTrait;
use Money\Money;

final class Auction
{
    use EventTrait;

    private const STATUS_ACTIVE = 1;
    private const STATUS_CLOSED = 2;

    private $id;
    private $initialPrice;
    private $closeDate;
    /** @var HighestBid */
    private $highestBid;
    private $status;
    private $itemId;

    public function __construct(AuctionId $id, Item $item, Money $initialPrice, \DateTimeImmutable $closeDate)
    {
        $this->id = $id;
        $this->initialPrice = $initialPrice;
        $this->closeDate = $closeDate;
        $this->ensureItemNotLocked($item);
        $this->status = self::STATUS_ACTIVE;

        $this->ensureItemNotLocked($item);
        $this->itemId = $item->getId();

        $this->recordEvent(new AuctionAnnouncedEvent($id));
    }

    private function ensureItemNotLocked(Item $item): void
    {
        if ($item->isLocked()) {
            throw new \DomainException();
        }
    }

    public function updateHighestBid(HighestBid $bid): void
    {
        $this->highestBid = $bid;

        $this->recordEvent(new HighestBidUpdatedEvent());
    }

    public function placeBid(BidId $bidId, $buyerId, Money $price): Bid
    {
        if ($this->isClosed()) {
            throw new \DomainException();
        }

        if ($this->highestBid->isHighestThan($price)) {
            throw new \DomainException();
        }

        $bid = new Bid($bidId, $this->id, $buyerId, $price);

        return $bid;
    }

    public function close(): void
    {
        $this->status = self::STATUS_CLOSED;

        $this->recordEvent(new AuctionClosedEvent($this->id));
    }

    private function isClosed(): bool
    {
        return self::STATUS_CLOSED === $this->status;
    }
}
