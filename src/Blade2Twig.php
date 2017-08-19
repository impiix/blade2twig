<?php

namespace Blade2Twig;

/**
 * Date: 5/27/16
 * Time: 7:32 PM
 */
class Blade2Twig
{
    public function convert($blade)
    {
        $blade = str_replace(
            [
                '@else',
                '@endif',
                '@endforeach',
                '@stop',
                '@if ($index == 0)',
                '@endfor'
            ],
            [
                '{% else %}',
                '{% endif %}',
                '{% endfor %}',
                '{% endblock %}',
                '{% if loop.first %}',
                '{% endfor %}',
            ],
            $blade
        );

        $blade = preg_replace(
            [
                "/@extends\('([\w.]+)'\)/i",
                "/@section\('([\w.]+)'\)/i",
                "/@foreach\s*\(\s*[$]?([^\s]+) as [$]+([\w => $]+)\s*\)/i",
                "/@money\(([^)]+)/i",
                "/{{ [$]+([^\s]+) }}/i",
                "/@for \([$]+(\w)+.+\)/i",
                "/@if\s*\(\$*(.*)\)/i"
            ],
            [
                "{% extends '$1.html.twig' %}",
                "{% block $1 %}",
                "{% for $2 in $1 %}",
                "$1",
                "{{ $1 }}",
                "{% for $1 in 0..10 %}",
                "{% if $1 %}"
            ],
            $blade
        );

        return $blade;
    }
}
