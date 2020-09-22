<?php declare(strict_types=1);

namespace App\Entity\Profil;


use Doctrine\ORM\Mapping as ORM;

trait FacebookTrait {

    /**
     * @ORM\Column(type="string", length=180, unique=true, nullable=true)
     */
    private ?string $facebookId = null;

    /**
     * @return string|null
     */
    public function getFacebookId(): ?string
    {
        return $this->facebookId;
    }

    /**
     * @param string|null $facebookId
     * @return FacebookTrait
     */
    public function setFacebookId(?string $facebookId): self
    {
        $this->facebookId = $facebookId;
        return $this;
    }


}