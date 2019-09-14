<?php

declare(strict_types=1);

namespace App\CommandDomainModel\Bid;

use App\CommandDomainModel\Auction\AuctionId;

interface BidRepositoryInterface
{
    public function getById(BidId $id): Bid;

    /**
     * @param AuctionId $id
     *
     * @return Bid[]
     */
    public function findAllByAuction(AuctionId $id): iterable;

    public function save(Bid $bid): void;

    public function nextId(): BidId;
}
