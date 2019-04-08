<?php

namespace AppBundle\Controller;

use AppBundle\Builder\Zipcode as ZipcodeBuilder;
use AppBundle\Services\Zipcode;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class ZipcodeController extends AbstractController
{
    public function __construct()
    {
        $this->serviceName = Zipcode::class;
        $this->builder = ZipcodeBuilder::class;
    }

    /**
     * @Rest\Get("/zipcode")
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
     * @Rest\Get("/zipcode/{id}")
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
     * @Rest\Post("/zipcode")
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
     * @Rest\Put("/zipcode/{id}")
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
     * @Rest\Delete("/zipcode/{id}")
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
