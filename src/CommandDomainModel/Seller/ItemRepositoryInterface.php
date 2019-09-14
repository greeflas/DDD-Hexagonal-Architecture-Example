<?php

declare(strict_types=1);

namespace App\CommandDomainModel\Seller;

interface ItemRepositoryInterface
{
    public function getById($id);
}
