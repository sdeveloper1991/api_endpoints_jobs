<?php

namespace AppBundle\Controller;

use AppBundle\Builder\Job as JobBuilder;
use AppBundle\Services\Job;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class JobController extends AbstractController
{
    public function __construct()
    {
        $this->serviceName = Job::class;
        $this->builder = JobBuilder::class;
    }

    /**
     * @Rest\Get("/job")
     *
     * This function get all filtering for route get job
     *
     * @param Request $request
     * @return View
     */
    public function getAllFilteringAction(Request $request): View
    {
        return new View(
            $this->container->get($this->serviceName)->findAll($request->query->all()),
            Response::HTTP_OK
        );
    }

    /**
     * @Rest\Get("/job/{id}")
     *
     * We extend the getAction()
     *
     * @param id
     * @throws NotFoundHttpException
     * @return View
     */
    public function getAction($id): View
    {
        return parent::getAction($id);
    }

    /**
     * @Rest\Post("/job")
     *
     * This function create the job entity here we shouldn't extend the PostAction() 
     * because we use the the zipcodeId and serviceId
     *
     * @param Request $request
     * @return View
     */
    public function postAction(Request $request): View
    {
        $parameters = $request->request->all();
        $entity = $this->builder::build($parameters);

        if (isset($parameters['zipcodeId'])) {
           $entity->setZipcode($this->container->get('AppBundle\Services\Zipcode')
            ->find($parameters['zipcodeId']));
        }

        if (isset($parameters['serviceId'])){
           $entity->setService($this->container->get('AppBundle\Services\Service')
            ->find($parameters['serviceId']));  
        }
        $persistedEntity = $this->container->get($this->serviceName)->create($entity);

        return new View(
            $persistedEntity,
            Response::HTTP_CREATED
        );
    }

    /**
     * @Rest\Put("/job/{id}")
     *
    * This function update the job entity here we shouldn't extend the PostAction() 
     * because we use the the zipcodeId and serviceId
     * 
     * @param id
     * @param Request $request
     * @return View
     */
    public function putAction(string $id, Request $request): View
    {
        $params = $request->request->all();
        $params['id'] = $id;
        $entity = $this->builder::build($params);
        $entity->setZipcode($this->container->get('AppBundle\Services\Zipcode')
            ->find($params['zipcodeId']));
        $entity->setService($this->container->get('AppBundle\Services\Service')
            ->find($params['serviceId']));
        $persistedEntity = $this->container->get($this->serviceName)->update($entity);
       
        return new View(
            $persistedEntity,
            Response::HTTP_OK
        );
    }

    /**
     * @Rest\Delete("/job/{id}")
     *
     * We extend the deleteAction()
     *
     * @param id
     * @return View
     */
    public function deleteAction(String $id): View
    {   
         return parent::deleteAction($id);
    }


}
