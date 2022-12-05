<?php

declare(strict_types=1);

namespace Astahov\DrawingBot;

require_once 'vendor/autoload.php';

const PAUSE_ON_SUCCESS_IN_SECONDS = 0;
const FILE_NAME = 'guybrush.png';
const TRANSPARENT_COLOR = '#00ff00';

const SHIFT_X = 80;
const SHIFT_Y = 130;

list($width, $height, $pixels) = readImage();
shuffle($pixels);

$client = new \GuzzleHttp\Client();

while(true) {
    foreach ($pixels as $pixel) {
        $color = $pixel[2];
        if ($color !== TRANSPARENT_COLOR) {
            while(true) {
                $opSucceeded = putPixel($pixel[0], $pixel[1], $color, SHIFT_X, SHIFT_Y);
                if ($opSucceeded) {
                    sleep(PAUSE_ON_SUCCESS_IN_SECONDS);
                    break;
                } else {
                    sleep(1);
                    echo "Retry...\n";
                }
            }
        }
    }
    die();
}

function readImage(): array
{
    $im = imagecreatefrompng(__DIR__ . '/' . FILE_NAME);
    $width = imagesx ($im);
    $height = imagesy ($im);

    $pixels = [];
    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            $rgb = imagecolorat($im, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $pixels[] = [$x + 1, $y + 1, getColor($r, $g, $b)];
        }
    }

    return [$width, $height, $pixels];
}

function getColor($r, $g, $b): string
{
    return '#' . prefixWithZeroIfNeeded(dechex($r)) . prefixWithZeroIfNeeded(dechex($g)) . prefixWithZeroIfNeeded(dechex($b));
}

function prefixWithZeroIfNeeded(string $s): string
{
    if (strlen($s) === 2) {
        return $s;
    }

    if (!is_numeric($s)) {
        return $s;
    }

    if ((int)$s < 10) {
        return '0' . $s;
    }

    return $s;
}

function putPixel(int $x, int $y, string $color, int $shiftX, int $shiftY): bool
{
    global $client;

    echo "$x $y $color\n";

    $x += $shiftX;
    $y += $shiftY;

    try {
        $res = $client->request(
            'PUT',
            'https://pixel-art-api.stage-travel.com/pixel/draw',
            [
                'json' => ['x' => $x, 'y' => $y, 'color' => $color],
            ]
        );
        echo $res->getStatusCode() . "\n";
    } catch (\Throwable $ex) {
        echo 'Request failed. Error: ' . $ex->getMessage() . "\n";
        return false;
    }

    return true;
}
