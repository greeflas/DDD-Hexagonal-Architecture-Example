<?php

declare(strict_types=1);

namespace App\CommandDomainModel\Auction;

final class AuctionAnnouncedEvent
{
    public $id;

    public function __construct(AuctionId $id)
    {
        $this->id = $id;
    }
}
