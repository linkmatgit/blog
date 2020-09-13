<?php

namespace App\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigIconExtension extends AbstractExtension
{

    public function getFunctions():array
    {
        return [
            new TwigFunction('icon', [$this, 'svgIcon'], ['is_safe' => ['html']])
        ];
    }

    public function svgIcon(string $name, ?int $size = null): string {
        $attrs = '';

        if ($size) {
            $attrs = " width=\"{$size}px\" height=\"{$size}px\"";
        }
        return <<<HTML
    <svg class="icon icon-{$name}"$attrs>
          <use xlink:href="/sprite.svg#{$name}"></use>
        </svg>
HTML;

    }
}