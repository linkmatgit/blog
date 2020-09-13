<?php

namespace App\Http\Admin\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends CrudController
{
    protected string $templatePath = 'user';
    protected string $menuItem = 'user';
    protected string $entity = User::class;
    protected string $routePrefix = 'admin_user';
    protected string $searchField = 'username';
    protected array $events = [];

    /**
     * @Route("/users/search/{q?}", name="user_autocomplete")
     * @param string $q
     * @return JsonResponse
     */
    public function search(string $q): JsonResponse
    {
        /** @var UserRepository $repository */
        $repository = $this->em->getRepository(User::class);
        $q = strtolower($q);
        if ('moi' === $q) {
            return new JsonResponse([[
                'id' => $this->getUser()->getId(),
                'username' => $this->getUser()->getUsername(),
            ]]);
        }
        $users = $repository
            ->createQueryBuilder('u')
            ->select('u.id', 'u.username')
            ->where('LOWER(u.username) LIKE :username')
            ->setParameter('username', "%$q%")
            ->setMaxResults(25)
            ->getQuery()
            ->getResult();

        return new JsonResponse($users);
    }
}


