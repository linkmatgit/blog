<?php

namespace App\Entity\Blog;

use App\Entity\Core\Content;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Blog\PostRepository")
 * @ORM\Table("blog_post")
 *
 */
class Post extends Content
{
    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="Post")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private ?Category $category = null;

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
