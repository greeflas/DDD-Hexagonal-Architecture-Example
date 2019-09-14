<?php

declare(strict_types=1);

namespace App\Command\EventHandler;

use App\CommandDomainModel\Auction\AuctionRepositoryInterface as AuctionRepositoryInterfaceAlias;
use App\CommandDomainModel\Auction\HighestBidCalculator;
use App\CommandDomainModel\Bid\BidRevokedEvent;

final class BidRevokedHandler
{
    private $highestBidCalculator;
    private $auctionRepository;

    public function __construct(
        HighestBidCalculator $highestBidCalculator,
        AuctionRepositoryInterfaceAlias $auctionRepository)
    {
        $this->highestBidCalculator = $highestBidCalculator;
        $this->auctionRepository = $auctionRepository;
    }

    public function handle(BidRevokedEvent $event): void
    {
        $maxBid = $this->highestBidCalculator->recalculate($event->bidId, $event->auctionId);

        $auction = $this->auctionRepository->getById($event->auctionId);
        $auction->updateHighestBid($maxBid);

        $this->auctionRepository->save($auction);
    }
}
