<?php

namespace App\Entity\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Symfony\Component\Uid\Uuid;

class UuidV7Generator extends AbstractIdGenerator
{
    public function generateId(EntityManagerInterface $em, ?object $entity): Uuid
    {
        return $entity?->id !== null ? $entity->id : Uuid::v7();
    }
}
