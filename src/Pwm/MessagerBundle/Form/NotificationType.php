<?php

namespace Pwm\MessagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\ImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class NotificationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titre')
        ->add('text')->add('sousTitre')
        ->add('session', EntityType::class,
             array('class' => 'AppBundle:Session', 
                   'choice_label' => 'getNomConcours', 
                   'empty_data' => null,
                   'label'=>'Groupe')
             )
        ->add('includeMail')
        ->add('sendDate')
        ->add('sendNow');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pwm\MessagerBundle\Entity\Notification'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pwm_messagerbundle_notification';
    }


}
