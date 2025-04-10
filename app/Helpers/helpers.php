<?php

if (!function_exists('renderOracleText')) {
    function renderOracleText($text)
    {
        $escaped = e($text);

        $rendered = preg_replace_callback(
            '/\{([^}]+)\}/',
            function ($matches) {
                $symbol = strtoupper($matches[1]);
                $src = asset("images/costs/{$symbol}.svg");
                return "<img src=\"{$src}\" alt=\"{$symbol}\" class=\"symbol-img\">";
            },
            $escaped,
        );

        return nl2br($rendered);
    }
}