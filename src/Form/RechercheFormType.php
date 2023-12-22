<?php

namespace App\Form;

use App\Repository\CategorieRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Repository\HotelRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheFormType extends AbstractType
{

    private $hotelRepository;

    private $categorieRepository;


    public function __construct(HotelRepository $hotelRepository, CategorieRepository $categorieRepository)
    {
        $this->hotelRepository = $hotelRepository;
        $this->categorieRepository = $categorieRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $hotels = $this->hotelRepository->findAll();
        $categories = $this->categorieRepository->findAll();


        $choicesLieu = [];
        foreach ($hotels as $hotel) {
            $choicesLieu[$hotel->getLieu()] = $hotel->getLieu();
        }

        $choicesLibelleCat = [];
        foreach ($categories as $categorie) {
            $choicesLibelleCat[$categorie->getLibelle()] = $categorie->getLibelle();
        }

$builder

->setAction($options['form_action']) 
->setMethod('POST')
            ->add('lieu', ChoiceType::class, [
                'label' => "Choisir une location",
                'multiple' => false,
                'expanded' => false,
                'choices' => $choicesLieu,
            ])
            ->add('libelle', ChoiceType::class, [
                'label' => "Catégorie",
                'multiple' => false,
                'expanded' => false,
                'choices' => $choicesLibelleCat,
            ])
            ->add('dateArrivee', DateType::class, [
                'label' => 'Date d\'arrivée',
                'widget' => 'single_text',
            ])
            ->add('dateDepart', DateType::class, [
                'label' => 'Date de départ',
                'widget' => 'single_text',
            ]);
    

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'form_action' => '/search',
            'data_class' => null,
            'lieu' => null,
            'libelle' => null,
            'dateArrivee' => null,
            'dateDepart' => null,
        ]);
    }
}
