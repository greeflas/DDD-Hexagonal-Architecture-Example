<?php

declare(strict_types=1);

namespace App\Command\Handler;

use App\Query\AllExpiredActiveAuctionsQuery;

final class CloseAuctionsHandler
{
    private $expiredActiveAuctionsQuery;

    public function __construct(AllExpiredActiveAuctionsQuery $expiredActiveAuctionsQuery)
    {
        $this->expiredActiveAuctionsQuery = $expiredActiveAuctionsQuery;
    }

    public function handle(): void
    {
        $auctionIds = $this->expiredActiveAuctionsQuery->execute();

        foreach ($auctionIds as $id) {
            // push auction id to queue
        }
    }
}
