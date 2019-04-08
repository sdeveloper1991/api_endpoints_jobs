<?php

namespace AppBundle\Builder;

use AppBundle\Entity\EntityInterface;
use AppBundle\Entity\Job as JobEntity;
use AppBundle\Entity\Service as ServiceEntity;
use AppBundle\Entity\Zipcode as ZipcodeEntity;
use DateTime;

class Job implements BuilderInterface
{
    /**
     * This function builds the request job
     *
     * @param array $parameters
     * @return JobEntity
     */
    public static function build(array $parameters): EntityInterface
    {
        $attributes = [];
        $attributes['id'] = $parameters['id'] ?? null;
        $attributes['serviceId'] = $parameters['serviceId'] ?? null;
        $attributes['zipcodeId'] = $parameters['zipcodeId'] ?? null;
        $attributes['title'] = $parameters['title'] ?? null;
        $attributes['description'] = $parameters['description'] ?? null;
        $attributes['dateToBeDone'] = isset($parameters['dateToBeDone'])
            ? new DateTime($parameters['dateToBeDone'])
            : null;
       
        return new JobEntity(
            $attributes['id'],
            $attributes['serviceId'],
            $attributes['zipcodeId'],
            $attributes['title'],
            $attributes['description'],
            $attributes['dateToBeDone']
        );
    }
}
