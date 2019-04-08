<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $service1 = new Service('8269e70a-4423-11e9-a346-0242ac130005', 'Sonstige Umzugsleistungen');
        $service2 = new Service(null, 'Abtransport, Entsorgung und Entrümpelung');
        $service3 = new Service(null, 'Fensterreinigung');
        $service4 = new Service(null, 'Holzdielen schleifen');
        $service5 = new Service(null, 'Kellersanierung');
        $manager->persist($service1);
        $manager->persist($service2);
        $manager->persist($service3);
        $manager->persist($service4);
        $manager->persist($service5);
        $manager->flush();
    }
}