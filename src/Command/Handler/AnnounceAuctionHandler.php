<?php

declare(strict_types=1);

namespace App\Command\Handler;

use App\Command\AnnounceAuction;
use App\CommandDomainModel\Auction\AuctionRepositoryInterface;
use App\CommandDomainModel\Seller\ItemRepositoryInterface;
use App\CommandDomainModel\Seller\SellerRepositoryInterface;

final class AnnounceAuctionHandler
{
    private $sellerRepository;
    private $auctionRepository;
    private $itemRepository;

    public function __construct(
        SellerRepositoryInterface $sellerRepository,
        AuctionRepositoryInterface $auctionRepository,
        ItemRepositoryInterface $itemRepository
    ) {
        $this->sellerRepository = $sellerRepository;
        $this->auctionRepository = $auctionRepository;
        $this->itemRepository = $itemRepository;
    }

    public function handle(AnnounceAuction $announceAuction): void
    {
        $seller = $this->sellerRepository->getById($announceAuction->sellerId);
        $item = $this->itemRepository->getById($announceAuction->itemId);

        $auction = $seller->announce(
            $this->auctionRepository->nextId(),
            $item,
            $announceAuction->initialPrice,
            $announceAuction->closeDate
        );

        $this->auctionRepository->save($auction);
    }
}
