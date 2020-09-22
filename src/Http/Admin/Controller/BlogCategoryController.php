<?php

namespace App\Http\Admin\Controller;

use App\Entity\Blog\Category;
use App\Http\Admin\Data\CategoryCrudData;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post/category", name="category_")
 */

final class BlogCategoryController extends CrudController
{
        protected string $templatePath = 'category';
        protected string $menuItem = 'category';
        protected string $entity = Category::class;
        protected string $routePrefix = 'admin_category';
        protected array $events = [
            'update' => null,
            'delete' => null,
            'create' => null,
        ];

/**
 * @Route("/", name="index")
 */
public function index(): Response
{
    return $this->crudIndex();
}

/**
 * @Route("/new", name="new", methods={"POST", "GET"})
 */
public function new(): Response
    {
     $entity = (new Category())->setAuthor($this->getUser())->setCreatedAt(new \DateTime());
     $data = new CategoryCrudData($entity);
     return $this->crudNew($data);
    }

    /**
     * @Route("/{id}", name="edit", methods={"POST", "GET"})
     * @param Category $row
     * @return Response
     */
    public function edit(Category $row): Response
{
    $data = (new CategoryCrudData($row))->setEntityManager($this->em);
       return $this->crudEdit($data);
}

    /**
     * @Route("/{id}", methods={"DELETE"}, name="delete")
     * @param Category $row
     * @return Response
     */
    public function delete(Category $row): Response
{
    return $this->crudDelete($row);
}
}