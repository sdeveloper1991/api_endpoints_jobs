<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Zipcode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ZipcodeFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $zipcode1 = new Zipcode(null, 'Berlin', 10115);
        $zipcode2 = new Zipcode(null, 'Porta Westfalica', 32457);
        $zipcode3 = new Zipcode(null, 'Lommatzsch', 01623);
        $zipcode4 = new Zipcode(null, 'Hamburg', 21521);
        $zipcode5 = new Zipcode(null, 'Bülzig', 96895);
        $zipcode6 = new Zipcode(null, 'Diesbar-Seußlitz', 01612);
        $manager->persist($zipcode1);
        $manager->persist($zipcode2);
        $manager->persist($zipcode3);
        $manager->persist($zipcode4);
        $manager->persist($zipcode5);
        $manager->persist($zipcode6);
        $manager->flush();
    }
}