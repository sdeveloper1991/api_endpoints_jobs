<?php

namespace Tests\AppBundle\Controller;

use AppBundle\DataFixtures\JobFixtures;
use AppBundle\DataFixtures\ServiceFixtures;
use AppBundle\DataFixtures\ZipcodeFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractControllerTest extends WebTestCase
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Set-up the fixture test 
    */
    public function setUp()
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();

        $schemaTool->dropSchema($metadata);
        $schemaTool->createSchema($metadata);
        $this->client = self::createClient();
    }

    /**
     * this function loads service Fixtures
    */
    protected function loadServiceFixtures()
    {
        $this->load(new ServiceFixtures());
    }
    
    /**
     * this function loads zipcode Fixtures
    */
    protected function loadZipcodeFixtures()
    {
        $this->load(new ZipcodeFixtures());
    }

    /**
     * this function loads job Fixtures
    */
    protected function loadJobFixtures()
    {
        $this->load(new JobFixtures());
    }

    private function load(Fixture $fixture){
        $fixture->load($this->entityManager);
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
