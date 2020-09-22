<?php declare(strict_types=1);

namespace App\Entity\Profil;


use Doctrine\ORM\Mapping as ORM;

trait GoogleTrait {

    /**
     * @ORM\Column(type="string", length=180, unique=true, nullable=true)
     */
    private ?string $youtubeId = null;

    /**
     * @return string|null
     */
    public function getYoutubeId(): ?string
    {
        return $this->youtubeId;
    }

    /**
     * @param string|null $youtubeId
     * @return $this
     */
    public function setYoutubeId(?string $youtubeId): self
    {
        $this->youtubeId = $youtubeId;
    }


}