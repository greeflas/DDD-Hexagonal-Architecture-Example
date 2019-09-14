<?php

declare(strict_types=1);

namespace App\Command\EventHandler;

use App\CommandDomainModel\Auction\AuctionRepositoryInterface;
use App\CommandDomainModel\Auction\BidPlacedEvent;
use App\CommandDomainModel\Auction\HighestBid;
use App\CommandDomainModel\Bid\BidRepositoryInterface;

final class UpdateHighestBidHandler
{
    private $bidRepository;
    private $auctionRepository;

    public function __construct(BidRepositoryInterface $bidRepository, AuctionRepositoryInterface $auctionRepository)
    {
        $this->bidRepository = $bidRepository;
        $this->auctionRepository = $auctionRepository;
    }

    public function handle(BidPlacedEvent $event): void
    {
        $bid = $this->bidRepository->getById($event->bidId);
        $auction = $this->auctionRepository->getById($event->auctionId);

        $highestBid = new HighestBid($bid->getId(), $bid->getPrice());
        $auction->updateHighestBid($highestBid);

        $this->auctionRepository->save($auction);
    }
}
