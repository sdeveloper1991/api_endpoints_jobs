<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Job;
use AppBundle\Entity\Service;
use AppBundle\Entity\Zipcode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;

class JobFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $service = new Service(null, 'Kellersanierung');
        $zipcode = new Zipcode(null, 'Diesbar-Seußlitz', 01612);
        $manager->persist($service);
        $manager->flush();
        $manager->persist($zipcode);
        $manager->flush();
        $job = new Job(
            null,
            null,
            null,
            'title',
            'decription',
            new DateTime('2018-11-11')
        );
        $job->setZipcode($zipcode);
        $job->setService($service);
        $manager->persist($job);
        $manager->flush();
    }
}
