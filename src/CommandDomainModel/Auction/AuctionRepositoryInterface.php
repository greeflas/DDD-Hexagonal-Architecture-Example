<?php

declare(strict_types=1);

namespace App\CommandDomainModel\Auction;

interface AuctionRepositoryInterface
{
    public function getById(AuctionId $id): Auction;

    public function save(Auction $auction): void;

    public function nextId(): AuctionId;
}
