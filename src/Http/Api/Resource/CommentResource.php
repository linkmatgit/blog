<?php declare(strict_types=1);


namespace App\Http\Api\Resource;


use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Comment\Comment;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     shortName="Comment",
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     itemOperations={
 *         "get"={
 *             "controller"=NotFoundAction::class,
 *             "read"=false,
 *             "output"=false,
 *         },
 *     "delete"
 *
 *     }
 * )
 */
class CommentResource {

    /**
     * @Groups({"read"})
     * @ApiProperty(identifier=true)
     */
    public ?int $id = null;

    /**
     * @Groups({"read", "write"})
     * @Assert\NotBlank(groups={"anonymous"})
     */
    public ?string $username = null;

    /**
     * @Assert\NotBlank()
     * @Groups({"read", "write"})
     * @Assert\Length(min="4")
     */
    public string $content;

    /**
     * @Groups({"read"})
     */
    public ?string $avatar = null;

    /**
     * @Groups({"write"})
     */
    public ?int $target = null;

    /**
     * @Assert\NotBlank(groups={"anonymous"})
     * @Groups({"write"})
     * @Assert\Email(groups={"anonymous"})
     */
    public ?string $email = null;

    /**
     * @Groups({"read"})
     */
    public int $createdAt = 0;

    /**
     * @Groups({"read", "write"})
     */
    public ?int $parent = 0;

    /**
     * Garde une trace de l'entité qui a servi à créer la resource.
     */
    public ?Comment $entity = null;

    /**
     * @Groups({"read"})
     */
    public ?int $userId = null;

    public static function fromComment(Comment $comment): CommentResource
    {
        $resource = new self();
        $author = $comment->getAuthor();
        $resource->id = $comment->getId();
        $resource->content = $comment->getContent();
        $resource->username = $comment->getUsername();
        $resource->createdAt = $comment->getCreatedAt()->getTimestamp();
        $resource->parent = null !== $comment->getParent() ? $comment->getParent()->getId() : null;
        $gravatar = md5($comment->getEmail());
        $resource->avatar = "https://1.gravatar.com/avatar/{$gravatar}?s=200&r=pg&d=mp";
        $resource->entity = $comment;
        $resource->userId = $author ? $author->getId() : null;

        return $resource;
    }
}

