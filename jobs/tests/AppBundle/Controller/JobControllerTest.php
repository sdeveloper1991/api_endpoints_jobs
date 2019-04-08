<?php

namespace Tests\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * @group functional
 */
class JobControllerTest extends AbstractControllerTest
{
    /**
     * @var array
     */
    private $defaultJob;

    /**
     * Set-up the fixture test for job
    */
    public function setUp()
    {
        parent::setUp();
        $this->loadServiceFixtures();
        $this->loadZipcodeFixtures();
        $this->loadJobFixtures();
        $idService = $this->getFirstServiceId();
        $idZipCode = $this->getFirstZipCodeId();

        $this->defaultJob = [
            'id' => 'ac905bc9-43eb-11e9-a346-0242ac130005',
            'serviceId' => $idService,
            'zipcodeId' => $idZipCode,
            'title' => 'title',
            'description' => 'decription',
            'dateToBeDone' => '01-01-2019'
        ];
    }
    
    /**
     * This function test if get all jobs is ok 
    */
    public function testGetAllJobs()
    {
        $this->client->request('GET', '/job');
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    /**
     * This function test invalid job return badrequest 
    */
    public function testPostInvalidJobReturnsBadRequest()
    {
        $this->defaultJob['title'] = '';

        $this->client->request(
            'POST',
            '/job',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->defaultJob)
        );

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
    }

    /**
     * This function test Post Job if Service Not Found ReturnsBadRequest  
    */
    public function testPostJobWithServiceNotFoundReturnsBadRequest()
    {
        $this->defaultJob['serviceId'] = 'd353a8d6-43ed-11e9-a346-css';

        $this->client->request(
            'POST',
            '/job',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->defaultJob)
        );

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
    }
    
    /**
     * This function test Post Job if Zipcode Not Found ReturnsBadRequest  
    */
    public function testPostJobWithZipcodeNotFoundReturnsBadRequest()
    {
        $this->defaultJob['zipcodeId'] = 'd357a196-43ed-11e9-a346-0242ac130005';

        $this->client->request(
            'POST',
            '/job',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->defaultJob)
        );

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
    }
  
    /**
     * This function test if created job is valid 
    */
    public function testPostValidJobNewJobIsCreated()
    {
        $this->client->request(
            'POST',
            '/job',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->defaultJob)
        );

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
    }

    /**
     * This function test if put job is valid 
    */
    public function testPutWithNotFoundJobReturnsNotFound()
    {
        $this->client->request(
            'PUT',
            '/job/ac905bc9-43eb-11e9-a346-0242ac130005',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->defaultJob)
        );

        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
    }
    
    /**
     * This function test if put job is not valid 
    */
    public function testPutWithValidJobReturnsNotFound()
    {
        $id = $this->getFirstJobId();
        $this->client->request(
            'PUT',
            '/job/' . $id,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->defaultJob)
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
    
    /**
     * This function test if delete job is valid 
    */
    public function testDeleteWithValidJobReturnsNotFound()
    {
        $id = $this->getFirstJobId();
        $this->client->request(
            'DELETE',
            '/job/' . $id,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($this->defaultJob)
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    /**
     * This function gets first job
     * @return String
     */
    private function getFirstJobId()
    {
        $this->client->request('GET', '/job');
        $allJobs = json_decode($this->client->getResponse()->getContent(), true);
        $id = $allJobs[0]['id'];

        return $id;
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

    /**
     * This function gets zipcode service
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
