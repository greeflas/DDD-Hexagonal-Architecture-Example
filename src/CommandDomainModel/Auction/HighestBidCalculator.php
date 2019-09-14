<?php

declare(strict_types=1);

namespace App\CommandDomainModel\Auction;

use App\CommandDomainModel\Bid\BidId;
use App\CommandDomainModel\Bid\BidRepositoryInterface;

final class HighestBidCalculator
{
    private $bidRepository;

    public function __construct(BidRepositoryInterface $bidRepository)
    {
        $this->bidRepository = $bidRepository;
    }

    public function recalculate(BidId $bidId, AuctionId $auctionId): HighestBid
    {
        $bids = $this->bidRepository->findAllByAuction($auctionId);
        $maxBid = \array_shift($bids);

        foreach ($bids as $bid) {
            if ($bid->getPrice() > $maxBid->getPrice()) {
                $maxBid = $bid;
            }
        }

        return new HighestBid($maxBid->getId(), $maxBid->getPrice());
    }
}
