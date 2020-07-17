<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;


class CommentCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
			return Comment::class;
	}
		
	public function configureCrud(Crud $crud): Crud
	{
			return $crud
					// the labels used to refer to this entity in titles, buttons, etc.
					->setEntityLabelInSingular('Comment')
					->setEntityLabelInPlural('Comments')

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
				AssociationField::new('conference'),
				TextField::new('author'),
				TextEditorField::new('text'),
				EmailField::new('email'),
				DateTimeField::new('createdAt'),
				ImageField::new('photoFile')->onlyOnForms()->setTextAlign('left'),
				ImageField::new('photoName')->setBasePath('upload/images')->hideOnForm(),
				IntegerField::new('imageSize')
		];
	}
		
}
