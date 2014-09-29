<?php

namespace PUGX\AutocompleterBundle\Form\Transformer;

use Doctrine\Common\Persistence\ObjectManager;

class ObjectToIdCreateIfMissingTransformer extends ObjectToIdTransformer
{
    /**
     * Transforms a string (id) to an object (object). Creates the object if it does not exist.
     *
     * @param  string                        $id
     * @return Object|null
     * @throws TransformationFailedException if object (object) is not found.
     */
    public function reverseTransform($value)
    {
        if (empty($value)) {
            return null;
        }

        if (is_numeric($value)) {
            $object = $this->om
                ->getRepository($this->class)
                ->find($value)
            ;
        } else {
            $object = new $this->class($value);
            $this->om->persist($object);
            $this->om->flush();
        }

        return $object;
    }
}
