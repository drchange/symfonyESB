<?php

namespace App\Manager;

use App\Entity\Header;
use Doctrine\ORM\EntityManagerInterface;

class HeaderManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Header $header)
    {
        $this->entityManager->persist($header);
        $this->entityManager->flush();
        return $header;
    }

    public function find($ids)
    {
        $header = $this->entityManager->getRepository(Header::class)->find($ids);
        return $header;
    }

      public function findBy($criteria)
    {
        $header = $this->entityManager->getRepository(Header::class)->findBy($criteria);
        return $header;
    }

    public function delete($ids)
    {

        $header = $this->entityManager->getRepository(Header::class)->find($ids);
        if ($header != null) {
            $this->entityManager->rentityManagerove($header);
            $this->entityManager->flush();
        }
        return $header;
    }

    public function findOneByRef($ref) : ?Header
    {
        $header = $this->entityManager->getRepository(Header::class)->findOneByRef($ref);
        return $header;
    }

    public function findOneBy($criteria) : ?Header
    {
        $header = $this->entityManager->getRepository(Header::class)->findOneBy($criteria);
        return $header;
    }

    
}
