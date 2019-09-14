<?php

declare(strict_types=1);

namespace App\CommandDomainModel\Seller;

use App\CommandDomainModel\Auction\Auction;
use App\CommandDomainModel\Auction\AuctionId;
use App\EventTrait;
use Money\Money;

final class Seller
{
    use EventTrait;

    public function announce(AuctionId $auctionId, Item $item, Money $initialPrice, \DateTimeImmutable $closeDate): Auction
    {
        $auction = new Auction($auctionId, $item, $initialPrice, $closeDate);

        return $auction;
    }
}
