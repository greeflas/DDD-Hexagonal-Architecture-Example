<?php

declare(strict_types=1);

namespace App\CommandDomainModel\Auction;

final class AuctionClosedEvent
{
    public $id;

    public function __construct(AuctionId $id)
    {
        $this->id = $id;
    }
}
