<?php

namespace App\Controller\Admin;

use App\Entity\Conference;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class ConferenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Conference::class;
    }
		
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInSingular('Conference')
            ->setEntityLabelInPlural('Conferences')

            // the Symfony Security permission needed to manage the entity
            // (none by default, so you can manage all instances of the entity)
            ->setEntityPermission('ROLE_ADMIN')
            // the visible title at the top of the page and the content of the <title> element
            // it can include these placeholders: %entity_id%, %entity_label_singular%, %entity_label_plural%
            ->setPageTitle('index', '%entity_label_plural% listing')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('city'),
            TextField::new('year'),
            BooleanField::new('is_international')
        ];
    }
}
