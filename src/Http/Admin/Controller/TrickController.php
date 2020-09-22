<?php declare(strict_types=1);

namespace App\Http\Admin\Controller;



use App\Entity\Trick\Trick;
use App\Http\Admin\Data\PostCrudData;
use App\Http\Admin\Data\TrickCrudData;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/trick", name="trick_")
 */

final class TrickController extends CrudController {

    protected string $templatePath = 'trick';
    protected string $menuItem = 'trick';
    protected string $entity = Trick::class;
    protected string $routePrefix = 'admin_trick';
    protected array $events = [
        'update' => null,
        'delete' => null,
        'create' => null,
    ];

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->crudIndex();
    }

    /**
     * @Route("/new", name="new", methods={"POST", "GET"})
     */
    public function new(): Response
    {
        $entity = (new Trick())->setAuthor($this->getUser())->setCreatedAt(new \DateTime());
        $data = new TrickCrudData($entity);
        return $this->crudNew($data);
    }

    /**
     * @Route("/{id}", name="edit", methods={"POST", "GET"})
     * @param Trick $trick
     * @return Response
     */
    public function edit(Trick $trick): Response
    {
        $data = (new TrickCrudData($trick))->setEntityManager($this->em);
        return $this->crudEdit($data);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     * @param Trick $trick
     * @return Response
     */
    public function delete(Trick $trick): Response
    {
        return $this->crudDelete($trick);
    }


}