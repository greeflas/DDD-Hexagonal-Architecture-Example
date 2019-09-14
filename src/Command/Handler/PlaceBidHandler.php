<?php

declare(strict_types=1);

namespace App\Command\Handler;

use App\Command\PlaceBid;
use App\CommandDomainModel\Auction\AuctionRepositoryInterface;
use App\CommandDomainModel\Bid\BidRepositoryInterface;

final class PlaceBidHandler
{
    private $auctionRepository;
    private $bidRepository;

    public function __construct(AuctionRepositoryInterface $auctionRepository, BidRepositoryInterface $bidRepository)
    {
        $this->auctionRepository = $auctionRepository;
        $this->bidRepository = $bidRepository;
    }

    public function handle(PlaceBid $placeBid): void
    {
        $auction = $this->auctionRepository->getById($placeBid->auctionId);

        $bidId = $this->bidRepository->nextId();
        $bid = $auction->placeBid($bidId, $placeBid->buyerId, $placeBid->price);

        $this->bidRepository->save($bid);
    }
}
