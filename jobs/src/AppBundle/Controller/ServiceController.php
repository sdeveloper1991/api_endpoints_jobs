<?php

namespace AppBundle\Controller;

use AppBundle\Builder\Service as ServiceBuilder;
use AppBundle\Services\Service;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class ServiceController extends AbstractController
{
    public function __construct()
    {
        $this->serviceName = Service::class;
        $this->builder = ServiceBuilder::class;
    }

    /**
     * @Rest\Get("/service")
     *
     * We extend the getAllAction()
     *
     * @return View
     */
    public function getAllAction(): View
    {
        return parent::getAllAction();
    }

    /**
     * @Rest\Get("/service/{id}")
     *
     * We extend the getAction()
     *
     * @param int id
     * @throws NotFoundHttpException
     * @return View
     */
    public function getAction($id): View
    {    
        return parent::getAction($id);
    }

    /**
     * @Rest\Post("/service")
     *
     * We extend the postAction()
     *
     * @param Request $request
     * @return View
     */
    public function postAction(Request $request): View
    {
        return parent::postAction($request);
    }

    /**
     * @Rest\Put("/service/{id}")
     *
     * We extend the putAction()
     *
     * @param id
     * @param Request $request
     * @return View
     */
    public function putAction(String $id, Request $request): View
    {
        return parent::putAction($id, $request);
    }
    
    /**
     * @Rest\Delete("/service/{id}")
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
