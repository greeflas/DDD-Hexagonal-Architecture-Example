<?php

declare(strict_types=1);

namespace App\CommandDomainModel\Seller;

interface SellerRepositoryInterface
{
    public function getById(SellerId $id): Seller;
}
