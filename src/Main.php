<?php

declare(strict_types=1);

namespace App;

require_once 'vendor/autoload.php';

const SHIFT_X = 290;
const SHIFT_Y = 130;

$drawer = new PixelDrawer();

$image = ImageReader::readImage(Configuration::getPathToPicture(Configuration::PNG__GUYBRUSH), true);
shuffle($image['pixels']);

$drawer->drawPixels($image['pixels']);

echo "Done.\n";
