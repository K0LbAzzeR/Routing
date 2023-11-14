<?php

declare(strict_types=1);

namespace App\RMVC\View;

class View
{
    /**
     * Path to the content file
     *
     * @var string
     */
    private static string $path;

    /**
     * Data content array
     *
     * @var array|null
     */
    private static ?array $data;

    /**
     * View content
     *
     * @param string $string
     * @param array $data
     * @return string|false
     */
    public static function view(string $string, array $data = []): string|false
    {
        self::$data = $data;
        self::$path = __DIR__ . '/' . str_replace('.', '/', $string) . '.php';

        return self::getContent();
    }

    /**
     * Ob get content
     *
     * @return string|false
     */
    private static function getContent(): string|false
    {
        extract(self::$data);

        ob_start();
        include self::$path;
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
}
