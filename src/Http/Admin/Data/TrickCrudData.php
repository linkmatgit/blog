<?php

namespace App\Http\Admin\Data;


use App\Entity\Blog\Category;
use App\Entity\Blog\Post;
use App\Entity\Trick\Trick;
use App\Entity\User;
use App\Form\AutomaticForm;
use Doctrine\ORM\EntityManagerInterface;

final class TrickCrudData implements CrudDataInterface {


    protected Trick $entity;
    public ?string $title = null;
    public ?string $slug = null;
    public ?\DateTimeInterface $createdAt;
    public ?User $author = null;
    public ?bool $isOnline = false;
    public ?string  $content = null;
    public ?string  $youtubeId = null;
    private ?EntityManagerInterface $em;

    public function __construct(Trick $row)
    {
        $this->entity = $row;
        $this->title = $row->getTitle();
        $this->slug = $row->getSlug();
        $this->isOnline = $row->getIsOnline();
        $this->content = $row->getContent();
        $this->createdAt = $row->getCreatedAt();
        $this->author = $row->getAuthor();
        $this->youtubeId = $row->getYoutubeId();

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
            ->setYoutubeId($this->youtubeId)
            ->setSlug($this->slug);



    }
    public function setEntityManager(EntityManagerInterface $em): self
    {
        $this->em = $em;

        return $this;
    }
}