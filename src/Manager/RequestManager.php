<?php

namespace App\Manager;

use App\Entity\Request;
use Doctrine\ORM\EntityManagerInterface;

class RequestManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Request $request)
    {
        $this->entityManager->persist($request);
        $this->entityManager->flush();
        return $request;
    }

    public function find($ids)
    {
        $request = $this->entityManager->getRepository(Request::class)->find($ids);
        return $request;
    }

    public function findOneBy($criteria) : Request
    {
        $request = $this->entityManager->getRepository(Request::class)->findOneBy($criteria);
        return $request;
    }

    public function findBy($criteria)
    {
        $request = $this->entityManager->getRepository(Request::class)->findBy($criteria);
        return $request;
    }

    public function delete($ids)
    {

        $request = $this->entityManager->getRepository(Request::class)->find($ids);
        if ($request != null) {
            $this->entityManager->rentityManagerove($request);
            $this->entityManager->flush();
        }
        return $request;
    }

    public function findOneByRef($ref) : Request
    {
        $request = $this->entityManager->getRepository(Request::class)->findOneByRef($ref);
        return $request;
    }

    
}
