<?php

namespace App\Controller\Admin;

use App\Entity\Flash;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

use function Symfony\Component\Clock\now;

class FlashCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Flash::class;
    }

    public function createEntity(string $entityFqcn): Flash
    {
        $flash = new Flash();
        $flash->setFlashDate(now());
        return $flash;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDateTimeFormat('medium', 'medium');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('flashUser')->autocomplete(),
            AssociationField::new('spaceInvader')->autocomplete(),
            DateTimeField::new('flashDate')->setFormTypeOption('with_seconds', true),
        ];
    }

}
