<?php

namespace Tests\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * @group functional
 */
class ZipcodeControllerTest extends AbstractControllerTest
{
    /**
    * Set-up the fixture test for zipcode
    */
    public function setUp()
    {
        parent::setUp();
        $this->loadZipcodeFixtures();
        $this->defaultZipcode = [
            'city' => 'berlin',
            'code' => 12345
        ];
    }

    /**
     * This function test if get all zipcode is ok 
    */
    public function testGetAllZipcodes()
    {
        $this->client->request('GET', '/zipcode');
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    /**
     * This function test if created zipcode is valid 
    */
    public function testPostValidZipcodeReturnsCreated()
    {
        $this->client->request(
            'POST',
            '/zipcode',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->defaultZipcode)
        );

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }
    
    /**
     * This function test if put zipcode is valid 
    */
    public function testPutValidZipcodeReturnsOK()
    {
        $id = $this->getFirstZipCodeId();

        $this->client->request(
            'PUT',
            '/zipcode/'. $id,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->defaultZipcode)
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
    
    /**
     * This function test if delet zipcode is valid 
    */
    public function testDeleteValidZipcodeReturnsOK()
    {
        $id = $this->getFirstZipCodeId();

        $this->client->request(
            'DELETE',
            '/zipcode/'. $id,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->defaultZipcode)
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
    
    /**
     * This function test Post Zipcode if not valid
    */
    public function testPostInvalidZipcodeReturnsBadRequest()
    {
        $this->defaultZipcode['city'] = '';
        $this->client->request(
            'POST',
            '/zipcode',
            [],
            [],
            ['CONTENT-TYPE' => 'application/json'],
            json_encode($this->defaultZipcode)
        );

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
    }

    /**
     * This function gets first zipcode
     * @return String
     */
    private function getFirstZipCodeId()
    {
        $this->client->request('GET', '/zipcode');
        $allzipCode = json_decode($this->client->getResponse()->getContent(), true);
        $id = $allzipCode[0]['id'];

        return $id;
    }
}
