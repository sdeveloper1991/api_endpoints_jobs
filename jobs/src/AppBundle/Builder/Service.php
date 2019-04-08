<?php

namespace AppBundle\Builder;

use AppBundle\Entity\EntityInterface;
use AppBundle\Entity\Service as ServiceEntity;

class Service implements BuilderInterface
{
	/**
     * This function builds the request service
     *
     * @param array $parameters
     * @return ServiceEntity
     */
    public static function build(array $parameters): EntityInterface
    {
        $attributes = [];
        $attributes['id'] = $parameters['id'] ?? null;
        $attributes['name'] = $parameters['name'] ?? null;

        return new ServiceEntity($attributes['id'], $attributes['name']);
    }
}
