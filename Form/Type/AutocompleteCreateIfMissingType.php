<?php

namespace PUGX\AutocompleterBundle\Form\Type;

use Doctrine\Common\Persistence\ObjectManager;
use PUGX\AutocompleterBundle\Form\Transformer\ObjectToIdCreateIfMissingTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\InvalidConfigurationException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AutocompleteCreateIfMissingType extends AutocompleteType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (empty($options['class'])) {
            throw new InvalidConfigurationException('Option "class" must be set.');
        }

        if (strpos($options['class'], ':') !== false || strpos($options['class'], '\\') === false) {
            throw new InvalidConfigurationException('Option "class" must contain the full class name (including namespace) of the entity. E.g. Acme\DemoBundle\Entity\Book)');
        }

        $transformer = new ObjectToIdCreateIfMissingTransformer($this->om, $options['class']);
        $builder->addModelTransformer($transformer);
    }

    public function getName()
    {
        return 'autocomplete_create_if_missing';
    }

}
