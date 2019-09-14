<?php

declare(strict_types=1);

namespace App\CommandDomainModel\Bid;

use App\CommandDomainModel\Auction\AuctionId;
use App\CommandDomainModel\Auction\BidPlacedEvent;
use App\EventTrait;
use Money\Money;

final class Bid
{
    use EventTrait;

    private const STATUS_REVOKED = 1;

    private $id;
    private $auctionId;
    private $buyerId;
    private $price;
    private $status;

    public function __construct(BidId $id, AuctionId $auctionId, $buyerId, Money $price)
    {
        $this->id = $id;
        $this->auctionId = $auctionId;
        $this->buyerId = $buyerId;
        $this->price = $price;

        $this->recordEvent(new BidPlacedEvent($id, $auctionId));
    }

    public function getId(): BidId
    {
        return $this->id;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function revoke(): void
    {
        $this->status = self::STATUS_REVOKED;

        $this->recordEvent(new BidRevokedEvent($this->id, $this->auctionId));
    }
}
