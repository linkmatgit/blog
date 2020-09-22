<?php

namespace App\Entity\Trick;

use App\Entity\Core\Content;
use App\Entity\User;
use App\Repository\Trick\TrickRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrickRepository::class)
 */
class Trick extends Content
{

      /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $youtubeId = '';


    public function getYoutubeId(): ?string
    {
        return $this->youtubeId;
    }

    public function setYoutubeId(?string $youtubeId): self
    {
        $this->youtubeId = $youtubeId;

        return $this;
    }
}
