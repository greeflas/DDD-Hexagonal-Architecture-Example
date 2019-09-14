<?php

declare(strict_types=1);

namespace App\Command\Handler;

use App\Command\CloseAuction;
use App\CommandDomainModel\Auction\AuctionRepositoryInterface;

final class CloseAuctionHandler
{
    private $auctionRepository;

    public function __construct(AuctionRepositoryInterface $auctionRepository)
    {
        $this->auctionRepository = $auctionRepository;
    }

    public function handle(CloseAuction $closeAuction): void
    {
        $auction = $this->auctionRepository->getById($closeAuction->auctionId);

        $auction->close();

        $this->auctionRepository->save($auction);
    }
}
