<?php

declare(strict_types=1);

namespace App\Command\Handler;

use App\Command\RevokeBid;
use App\CommandDomainModel\Bid\BidRepositoryInterface;

final class RevokeBidHandler
{
    private $bidRepository;

    public function __construct(BidRepositoryInterface $bidRepository)
    {
        $this->bidRepository = $bidRepository;
    }

    public function handle(RevokeBid $revokeBid): void
    {
        $bid = $this->bidRepository->getById($revokeBid->bidId);

        $bid->revoke();

        $this->bidRepository->save($bid);
    }
}
