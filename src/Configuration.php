<?php

declare(strict_types=1);

namespace App;

class Configuration
{
    public const PATH_TO_PICS = __DIR__ . '/../pics/';

    public const PNG__2X2 = '2x2.png';
    public const PNG__2X2_MODIFIED = '2x2-modified.png';
    public const PNG__CANVAS_10X10_WITH_2X2_MODIFIED_SHIFTED_BY_8 = 'canvas-10x10-with-2x2-modified-shifted-by-8.png';
    public const PNG__GUYBRUSH = 'guybrush.png';

    const TRANSPARENT_COLOR = '#00ff00';

    public static function getPathToPicture(string $fileName): string
    {
        return self::PATH_TO_PICS . $fileName;
    }
}
