<?php

require_once 'vendor/autoload.php';

use ODC\Convertor;

Convertor::instance()
    ->setOutputDir('out')
    ->setWidth(100)
    ->setHeight(100)
    ->convert('test.pdf', 'bmp');
