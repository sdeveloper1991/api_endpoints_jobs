<?php

namespace AppBundle\Services;

use AppBundle\Entity\EntityInterface;
use AppBundle\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Job as JobEntity;

class Job extends AbstractService
{
    /**
     * @var Service
     */
    private $service;

    /**
     * @var Zipcode
     */
    private $zipcode;

    /**
     * Job constructor.
     * @param JobRepository $repository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        JobRepository $repository,
        Service $service,
        Zipcode $zipcode,
        EntityManagerInterface $entityManager
    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->zipcode = $zipcode;
        $this->entityManager = $entityManager;
    }

    /**
     * This method creates the job entity
     *
     * @param EntityInterface $entity
     * @return EntityInterface
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $this->basicValidation($entity);
        $this->validateForeignKeys($entity);

        return $this->save_entity($entity);
    }

    /**
     * This method updates the job entity
     *
     * @param EntityInterface $entity
     * @throws NotFoundHttpException
     * @return EntityInterface
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        $this->basicValidation($entity);
        $this->validateForeignKeys($entity);
        $this->checkResource($entity->getId());

        return $this->update_entity($entity);
    }

    /**
     * This method check if the foreignkeys service and job was found or not
     *
     * @param JobEntity $entity
     */
    private function validateForeignKeys(JobEntity $entity): void
    {
        if (!empty($entity->getServiceId()) && !$this->service->find($entity->getServiceId())) {
            throw new BadRequestHttpException(sprintf(
                'Service entity \'%s\' was not found',
                $entity->getServiceId()
            ));
        }

        if (!empty($entity->getZipcodeId()) && !$this->zipcode->find($entity->getZipcodeId())) {
            throw new BadRequestHttpException(sprintf(
                'Zipcode entity \'%s\' was not found',
                $entity->getZipcodeId()
            ));
        } 
    }

}
