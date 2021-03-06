<?php

namespace AppBundle\Builder;

use AppBundle\Entity\EntityInterface;
use AppBundle\Entity\Zipcode as ZipcodeEntity;

class Zipcode implements BuilderInterface
{
    /**
     * This function builds the request zipcode
     *
     * @param array $parameters
     * @return ZipcodeEntity
     */
    public static function build(array $parameters): EntityInterface
    {
        $attributes = [];
        $attributes['id'] = $parameters['id'] ?? null;
        $attributes['city'] = $parameters['city'] ?? null;
        $attributes['code'] = $parameters['code'] ?? null;

        return new ZipcodeEntity($attributes['id'], $attributes['city'], $attributes['code']);
    }
}