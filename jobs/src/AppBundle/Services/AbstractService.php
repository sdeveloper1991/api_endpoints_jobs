<?php

namespace AppBundle\Services;

use AppBundle\Entity\EntityInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\RecursiveValidator;

abstract class AbstractService
{
    /**
     * @var ServiceEntityRepositoryInterface
     */
    protected $repository;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * This function Finds all entities 
     *
     * @return array
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
    * This function Finds entity by id 
     *
     * @param $id
     * @return null|EntityInterface
     */
    public function find($id): ?EntityInterface
    {
        try {
            $entity = $this->repository->find($id);
        } catch (\Exception $exception) {
            $entity = null;
        }

        return $entity;
    }

    /**
     * This function updates entity by id and request 
     *
     * @param EntityInterface $entity
     * @throws NotFoundHttpException
     * @return EntityInterface
     */
    public function update(EntityInterface $entity): EntityInterface
    {
        $this->basicValidation($entity);
       
        return $this->update_entity($entity);
    }

    /**
     * This function deletes  entity by id
     *
     * @param EntityInterface $entity
     * @throws BadRequestHttpException
     * @return EntityInterface
     */
    public function delete(EntityInterface $entity): EntityInterface
    {
        $this->basicValidation($entity);
       
        return $this->remove_entity($entity);
    }

    /**
     * This function creates entity by request
     *
     * @param EntityInterface $entity
     * @throws BadRequestHttpException
     * @return EntityInterface
     */
    public function create(EntityInterface $entity): EntityInterface
    {
        $this->basicValidation($entity);

        if ($this->find($entity->getId())) {
            throw new BadRequestHttpException(sprintf(
                'Resource \'%s\' already exists',
                $entity->getId()
            ));
        }

        return $this->save_entity($entity);
    }

    /**
     * This function extract the message into BadRequestHttpException()
     *
     * @param EntityInterface $entity
     * @throws BadRequestHttpException
     * @todo extractToAnotherClass
     */
    protected function basicValidation(EntityInterface $entity): void
    {
        /** @var RecursiveValidator $validator */
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
        /** @var ConstraintViolationList $errors */
        $errors = $validator->validate($entity);
        if (count($errors)) {
            /** @todo Create an errorMessageHandler */
            $errorMessages = $this->getErrorMessages($errors);

            throw new BadRequestHttpException(implode($errorMessages, ', '));
        }
    }

    /**
     * This function verify if the resource exist or not 
     *
     * @param EntityInterface $entity
     * @throws NotFoundHttpException
     */
    public function checkResource($id): void
    {
        /** @var EntityInterface $persistedEntity */
        $persistedEntity = $this->find($id);
        if (is_null($persistedEntity)) {
            throw new NotFoundHttpException(sprintf(
                'The resource \'%s\' was not found.',
                 $id
            ));
        }
    }

    /**
     * This function get the error messages
     * 
     * @param $errors
     * @return array
     */
    private function getErrorMessages($errors): array
    {
        $errorMessages = [];
        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $errorMessages[] = sprintf(
                '%s: %s',
                $error->getPropertyPath(),
                $error->getMessage()
            );
        }

        return $errorMessages;
    }

    /**
     * This function saves entity into the ORM
     *
     * @param EntityInterface $entity
     * @return EntityInterface
     */
    protected function save_entity(EntityInterface $entity): EntityInterface
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * This function updates entity into the ORM
     *
     * @param EntityInterface $entity
     * @return EntityInterface
     */
    protected function update_entity(EntityInterface $entity): EntityInterface
    {
        $this->entityManager->merge($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * This function deletes entity into the ORM
     *
     * @param EntityInterface $entity
     * @return EntityInterface
     */
    protected function remove_entity(EntityInterface $entity): EntityInterface
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();

        return $entity;
    }
}
