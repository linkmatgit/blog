<?php

namespace App\Repository\Blog;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Response;
use App\Entity\Blog\Category;
use App\Entity\Blog\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function queryAll(?Category $category = null): Query
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.isOnline = true')
            ->orderBy('p.createdAt', 'DESC');

        if ($category) {
            $query = $query
                ->andWhere('p.category = :category')
                ->setParameter('category', $category);
        }

        return $query->getQuery();
    }

    public function countPost(){
        return $this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->getQuery()
            ->getSingleScalarResult();


        
    }
}
