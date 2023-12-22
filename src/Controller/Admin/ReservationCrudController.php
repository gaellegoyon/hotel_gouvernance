<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom_client'),
            IntegerField::new('nombre_client'),
            TextField::new('tel_client'),
            EmailField::new('email_client'),
            AssociationField::new('chambre'),
            AssociationField::new('service'),
            TextField::new('hotel')->hideWhenCreating()->hideWhenUpdating(),
        ];
    }
}
