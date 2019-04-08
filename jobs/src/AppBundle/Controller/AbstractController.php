<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractController extends FOSRestController
{
    /**
     * @var String
     */
    protected $serviceName;

    /**
     * @var String
     */
    protected $builder;

    /**
     * This function get all data's entity
     *
     * @return View
     */
    public function getAllAction(): View
    {
        return new View(
            $this->container->get($this->serviceName)->findAll(),
            Response::HTTP_OK
        );
    }

    /**
     * This function get one row data's entity
     *
     * @param $id
     * @return View
     */
    public function getAction($id): View
    {
        $this->container->get($this->serviceName)->checkResource($id);
        $entity = $this->container->get($this->serviceName)->find($id);
        
        return new View(
            $entity,
            Response::HTTP_OK
        );
    }

    /**
     * This function create new entity is available for all entities
     *
     * @param Request $request
     * @return View
     */
    public function postAction(Request $request): View
    {
        $parameters = $request->request->all();
        $entity = $this->builder::build($parameters);
        $persistedEntity = $this->container->get($this->serviceName)->create($entity);

        return new View(
            $persistedEntity,
            Response::HTTP_CREATED
        );
    }

    /**
     * This function update entity is available for all entities
     *
     * @param String $id
     * @param Request $request
     * @return View
     */
    public function putAction(String $id, Request $request): View
    {
        $this->container->get($this->serviceName)->checkResource($id);
        $params = $request->request->all();
        $params['id'] = $id;
        $entity = $this->builder::build($params);
        $persistedEntity = $this->container->get($this->serviceName)->update($entity);

        return new View(
            $persistedEntity,
            Response::HTTP_OK
        );
    }

    /**
     * This function delete entity is available for all entities
     *
     * @param id
     * @return View
     */
    public function deleteAction(String $id): View
    {
        $this->container->get($this->serviceName)->checkResource($id);
        $entity = $this->container->get($this->serviceName)->find($id);
        $persistedEntity = $this->container->get($this->serviceName)->delete($entity);

        return new View(
            $persistedEntity,
            Response::HTTP_OK
        );
    }

}
