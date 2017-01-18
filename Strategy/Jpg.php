<?php

namespace ODC\Strategy;

class Jpg extends AbstractImageStrategy
{
    public function getCommand()
    {
        return parent::getCommand().' -dJPEGQ=100';
    }

    public function getFormat()
    {
        return 'jpeg';
    }
}
