<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as AbstractController1;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;


abstract class AbstractController extends AbstractController1
{

    /**
     * Affiche la liste de erreurs sous forme de message flash
     * @param FormInterface $form
     */
    protected function flashErrors(FormInterface $form): void
    {
        /** @var FormError[] $errors */
        $errors = $form->getErrors();
        $messages = [];
        foreach ($errors as $error) {
            $messages[] = $error->getMessage();
        }
        $this->addFlash('error', implode("\n", $messages));
    }
}