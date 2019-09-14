<?php

declare(strict_types=1);

namespace App\CommandDomainModel\Auction;

use App\CommandDomainModel\Bid\BidId;

final class BidPlacedEvent
{
    public $bidId;
    public $auctionId;

    public function __construct(BidId $bidId, AuctionId $auctionId)
    {
        $this->bidId = $bidId;
        $this->auctionId = $auctionId;
    }
}
