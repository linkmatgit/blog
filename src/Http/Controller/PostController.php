<?php declare(strict_types=1);

namespace App\Http\Controller;


use App\Entity\Blog\Post;
use App\Helper\Paginator\PaginatorInterface;
use App\Repository\Blog\PostRepository;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends  AbstractController {


    /**
     * @Route("/blog", name="app_blog")
     * @param PostRepository $em
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PostRepository  $em, PaginatorInterface $paginator, Request $request):Response{

            $title = 'blog';
           $posts = $em->queryAll();
        return $this->renderListing($title, $posts, $paginator, $request);
    }
    /**
     * @Route("/blog/{slug<[a-z0-9\-]+>}-{id<\d+>}", name="app_blog_show")
     * @param Post $post
     * @return Response
     */
    public function show(Post $post): Response{

        return $this->render('blog/show.html.twig',[
            'post' => $post
        ]);
    }

    private function renderListing(string $title, Query $query, PaginatorInterface $paginator, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $posts = $paginator->paginate(
            $query,
            $page,
            5
        );
        if ($page > 1) {
            $title .= ", page $page";
        }
        if (0 === $posts->count()) {
            throw new NotFoundHttpException('Aucun articles ne correspond à cette page');
        }

        return $this->render('blog/index.html.twig', [
            'posts' => $posts,
            'page' => $page,
            'title' => $title,
            'menu' => 'blog',
        ]);
    }
}