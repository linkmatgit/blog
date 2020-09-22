<?php declare(strict_types=1);

namespace App\Http\Admin\Data;

use App\Entity\Blog\Category;
use App\Entity\User;
use App\Form\AutomaticForm;
use Doctrine\ORM\EntityManagerInterface;

final class CategoryCrudData implements CrudDataInterface {


    protected Category $entity;
    public ?string $title = null;
    public ?string $slug = null;
    public ?\DateTimeInterface $createdAt = null;
    public ?User $author = null;
    public ?string  $color = null;
    public ?bool $isOnline = false;
    public ?string  $content = null;
    private ?EntityManagerInterface $em;


    public function __construct(Category $category)
    {
        $this->entity = $category;
        $this->title = $category->getTitle();
        $this->slug = $category->getSlug();
        $this->isOnline = $category->getIsOnline();
        $this->content = $category->getContent();
        $this->createdAt = $category->getCreatedAt();
        $this->author = $category->getAuthor();
        $this->color = $category->getColor();

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
            ->setColor($this->color)
            ->setSlug($this->slug);

    }
    public function setEntityManager(EntityManagerInterface $em): self
    {
        $this->em = $em;
        return $this;
    }

}