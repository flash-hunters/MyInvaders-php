<?php

namespace App\Controller\Admin;

use App\Entity\SpaceInvader;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SpaceInvaderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SpaceInvader::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInSingular('Space Invader')
            ->setEntityLabelInPlural('Space Invaders')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('area')->autocomplete(),
            NumberField::new('number'),
            TextField::new('status'),
            TextField::new('position'),
            TextareaField::new('comments'),
            // TextField::new('imgSrc'),
            ImageField::new('imgSrc')
                ->setBasePath('uploads/images/si/')
                ->setUploadDir('public/uploads/images/si/'),
        ];
    }
    
}
