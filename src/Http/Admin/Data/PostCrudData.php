<?php declare(strict_types=1);

namespace App\Http\Admin\Data;


use App\Entity\Blog\Category;
use App\Entity\Blog\Post;
use App\Entity\User;
use App\Form\AutomaticForm;
use Doctrine\ORM\EntityManagerInterface;

final class PostCrudData implements CrudDataInterface {


    protected Post $entity;
    public ?string $title = null;
    public ?string $slug = null;
    public ?\DateTimeInterface $createdAt;
    public ?User $author = null;
    public ?bool $isOnline = false;
    public ?string  $content = null;
    public ?Category $category = null;
    private ?EntityManagerInterface $em;

    public function __construct(Post $post)
    {
        $this->entity = $post;
        $this->title = $post->getTitle();
        $this->slug = $post->getSlug();
        $this->isOnline = $post->getIsOnline();
        $this->content = $post->getContent();
        $this->createdAt = $post->getCreatedAt();
        $this->author = $post->getAuthor();
        $this->category = $post->getCategory();

    }

    public function getEntity(): object
    {
        return  $this->entity;
    }

    public function getFormClass(): string
    {
        return AutomaticForm::class;
    }

    public function hydrate(): void
    {
        $this->entity
            ->setTitle($this->title)
            ->setCreatedAt($this->createdAt)
            ->setContent($this->content)
            ->setisOnline($this->isOnline)
            ->setUpdatedAt(new \DateTime())
            ->setAuthor($this->author)
            ->setCategory($this->category)
            ->setSlug($this->slug);



    }
    public function setEntityManager(EntityManagerInterface $em): self
    {
        $this->em = $em;

        return $this;
    }
}