<?php

namespace Ross\SlimApi\Services;

use Doctrine\ORM\EntityManager;
use Ross\SlimApi\Enums\InvoiceStatus;

readonly class InvoiceService
{

    public function __construct(private EntityManager $em)
    {

    }

    public function getPaidInvoices(): array
    {
        return $this->em->createQueryBuilder()
            ->select('i')
            ->from(Invoice::class,i)
            ->where('i.status = := status')
            ->setParameter('status', InvoiceStatus::Paid)
            ->getQuery()
            ->getArrayResult();
    }
}