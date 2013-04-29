<?php

namespace Siriru\AntBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', array(
            'attr' => array('placeholder' => 'Username'),
        ));
        $builder->add('email', 'repeated', array(
            'first_name' => 'email',
            'second_name' => 'confirm',
            'first_options'  => array(
                'label' => 'Email',
                'attr' => array('placeholder' => 'Email')
            ),
            'second_options' => array(
                'label' => 'Confirm email',
                'attr' => array('placeholder' => 'Confirm email')
            ),
            'type' => 'email',
        ));
        $builder->add('password', 'repeated', array(
            'first_name' => 'password',
            'second_name' => 'confirm',
            'first_options'  => array(
                'label' => 'Password',
                'attr' => array('placeholder' => 'Password')
            ),
            'second_options' => array(
                'label' => 'Confirm password',
                'attr' => array('placeholder' => 'Confirm password')
            ),
            'type' => 'password',
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Siriru\AntBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'user';
    }
}