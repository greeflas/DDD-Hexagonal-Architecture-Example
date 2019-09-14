<?php

declare(strict_types=1);

namespace App\CommandDomainModel\Bid;

use App\CommandDomainModel\Auction\AuctionId;

final class BidRevokedEvent
{
    public $bidId;
    public $auctionId;

    public function __construct(BidId $bidId, AuctionId $auctionId)
    {
        $this->bidId = $bidId;
        $this->auctionId = $auctionId;
    }
}
