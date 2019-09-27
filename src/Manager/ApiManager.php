<?php

namespace App\Manager;

use App\Entity\Api;
use Doctrine\ORM\EntityManagerInterface;

class ApiManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Api $api)
    {
        $this->entityManager->persist($api);
        $this->entityManager->flush();
        return $api;
    }

    public function find($ids)
    {
        $api = $this->entityManager->getRepository(Api::class)->find($ids);
        return $api;
    }

    public function delete($ids)
    {

        $api = $this->entityManager->getRepository(Api::class)->find($ids);
        if ($api != null) {
            $this->entityManager->rentityManagerove($api);
            $this->entityManager->flush();
        }
        return $api;
    }

    public function findOneByRef($ref) : ?Api
    {
        $api = $this->entityManager->getRepository(Api::class)->findOneByRef($ref);
        return $api;
    }

    public function findOneBy($criteria) : ?Api
    {
        $api = $this->entityManager->getRepository(Api::class)->findOneBy($criteria);
        return $api;
    }

    
}
