<?php

namespace App\Http\Admin\Controller;

use App\Repository\Blog\CategoryRepository;
use App\Repository\Blog\PostRepository;
use App\Repository\Comments\CommentRepository;
use App\Repository\Trick\TrickRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DashboardAdmin extends BaseController
{
    /**
     * @Route("", name="app_dashboard")
     * @param PostRepository $postRepository
     * @param CategoryRepository $categoryRepository
     * @param UserRepository $userRepository
     * @param TrickRepository $trickRepository
     * @return Response
     */
    public function index(PostRepository $postRepository, CategoryRepository $categoryRepository, UserRepository $userRepository, TrickRepository  $trickRepository, CommentRepository $r): Response
    {

        $countPost = $postRepository->countPost();
        $countCat =  $categoryRepository->countCategory();
        $countUser =  $userRepository->countUser();
        $countTrick = $trickRepository->countTrick();
        return $this->render('admin/index.html.twig', [
            'countPost' => $countPost,
            'countCat' => $countCat,
            'countUser' => $countUser,
            'countTrick' => $countTrick
        ]);
    }
}
