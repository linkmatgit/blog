<?php

namespace App\Http\Admin\Controller;

use App\Entity\Blog\Post;
use App\Http\Admin\Data\PostCrudData;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post", name="blog_")
 */

final class PostController extends CrudController
{
        protected string $templatePath = 'blog';
        protected string $menuItem = 'blog';
        protected string $entity = Post::class;
        protected string $routePrefix = 'admin_blog';
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
     $entity = (new Post())->setAuthor($this->getUser())->setCreatedAt(new \DateTime());
     $data = new PostCrudData($entity);
     return $this->crudNew($data);
    }

    /**
     * @Route("/{id}", name="edit", methods={"POST", "GET"})
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post): Response
{
    $data = (new PostCrudData($post))->setEntityManager($this->em);
       return $this->crudEdit($data);
}

    /**
     * @Route("/{id}", methods={"DELETE"})
     * @param Post $post
     * @return Response
     */
    public function delete(Post $post): Response
{
    return $this->crudDelete($post);
}
}