<?php

namespace ODC\Strategy;

class Jpg extends AbstractImageStrategy
{
    public function getCommand($documentPath)
    {
        return parent::getCommand($documentPath).' -dJPEGQ=100';
    }

    public function getFormat()
    {
        return 'jpeg';
    }
}
