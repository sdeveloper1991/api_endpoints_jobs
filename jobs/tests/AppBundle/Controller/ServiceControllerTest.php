<?php

namespace Tests\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * @group functional
 */
class ServiceControllerTest extends AbstractControllerTest
{
    /**
     * Set-up the fixture test for service
    */
    public function setUp()
    {
        parent::setUp();
        $this->loadServiceFixtures();
        $this->defaultService = [
            'name' => 'Service1'
        ];
    }
    
    /**
     * This function test if get all services is ok 
    */
    public function testGetAllServices()
    {
        $this->client->request('GET', '/service');
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
    
    /**
     * This function test if created service is valid 
    */
    public function testPostValidServiceReturnsCreated()
    {
        $this->client->request(
            'POST',
            '/service',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->defaultService)
        );

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }
    
    /**
     * This function test if put service is valid 
    */
    public function testPutValidServiceReturnsCreated()
    {
        $id = $this->getFirstServiceId();

        $this->client->request(
            'PUT',
            '/service/'. $id,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->defaultService)
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    /**
     * This function test if delet service is valid 
    */
    public function testDeleteValidServiceReturnsOK()
    {
        $id = $this->getFirstServiceId();

        $this->client->request(
            'DELETE',
            '/service/'. $id,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->defaultService)
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
   
    /**
     * This function test Post Service if not valid
    */
    public function testPostInvalidServiceReturnsBadRequest()
    {

        $this->defaultService['name'] = '';
        $this->client->request(
            'POST',
            '/service',
            [],
            [],
            ['CONTENT-TYPE' => 'application/json'],
            json_encode($this->defaultService)
        );

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
    }

    /**
     * This function gets first service
     * @return String
     */
    private function getFirstServiceId()
    {
        $this->client->request('GET', '/service');
        $allService = json_decode($this->client->getResponse()->getContent(), true);
        $id = $allService[0]['id'];

        return $id;
    }

   
}
