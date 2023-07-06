<?php

namespace App\Controller\Admin;

use App\Entity\Area;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AreaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Area::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('code'),
        ];
    }

}
