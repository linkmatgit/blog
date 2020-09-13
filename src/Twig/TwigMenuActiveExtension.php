<?php

namespace App\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigMenuActiveExtension extends AbstractExtension
{

    public function getFunctions():array
    {
        return [
            new TwigFunction('menu_active', [$this, 'menuActive'], ['is_safe' => ['html'], 'needs_context' => true]),        ];
    }

    public function menuActive(array $context, string $name): string
    {
        if (($context['menu'] ?? null) === $name) {
            return ' aria-current="page"';
        }

        return '';
    }
}