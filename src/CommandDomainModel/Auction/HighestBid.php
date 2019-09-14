<?php

declare(strict_types=1);

namespace App\CommandDomainModel\Auction;

use App\CommandDomainModel\Bid\BidId;
use Money\Money;

final class HighestBid
{
    private $bidId;
    private $price;

    public function __construct(BidId $bidId, Money $price)
    {
        $this->bidId = $bidId;
        $this->price = $price;
    }

    public function isHighestThan(Money $price): bool
    {
        return $this->price->greaterThan($price);
    }
}
