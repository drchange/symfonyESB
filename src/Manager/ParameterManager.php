<?php

namespace App\Manager;

use App\Entity\Parameter;
use Doctrine\ORM\EntityManagerInterface;

class ParameterManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Parameter $parameter)
    {
        $this->entityManager->persist($parameter);
        $this->entityManager->flush();
        return $parameter;
    }

    public function find($ids)
    {
        $parameter = $this->entityManager->getRepository(Parameter::class)->find($ids);
        return $parameter;
    }

    public function findOneBy($criteria) : ?Parameter
    {
        $parameter = $this->entityManager->getRepository(Parameter::class)->findOneBy($criteria);
        return $parameter;
    }

    public function findBy($criteria)
    {
        $parameter = $this->entityManager->getRepository(Parameter::class)->findBy($criteria);
        return $parameter;
    }

    public function delete($ids)
    {

        $parameter = $this->entityManager->getRepository(Parameter::class)->find($ids);
        if ($parameter != null) {
            $this->entityManager->rentityManagerove($parameter);
            $this->entityManager->flush();
        }
        return $parameter;
    }

}
