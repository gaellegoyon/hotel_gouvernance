<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Hotel;
use App\Repository\HotelRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheFormType extends AbstractType
{

    private $hotelRepository;

    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $hotels = $this->hotelRepository->findAll();

        $choices = [];
        foreach ($hotels as $hotel) {
            $choices[$hotel->getLieu()] = $hotel->getLieu();
        }


        $builder 
        ->add('lieu', ChoiceType::class, [
            'label' => "Choisir une location",
            'multiple' => false, 
            'expanded' => false,
            'choices' => $choices,
        ])
        ->add('nombrePersonnes', IntegerType::class, [
            'label' => 'Nombre de personnes',
            'attr' => ['min' => 1, 'max' => 20],
        ])
        ->add('dateArrivee', DateType::class, [
            'label' => 'Date d\'arrivée',
            'widget' => 'single_text',
        ])
        ->add('dateDepart', DateType::class, [
            'label' => 'Date de départ',
            'widget' => 'single_text',
        ])

        ->setAction($options['form_action'])  // Ajouter l'action du formulaire
        ->setMethod('GET');  // Définir la méthode HTTP
    }

    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        'data_class' => null,
        'form_action' => '/',  // Définir l'action par défaut
        ]);
    }
}
