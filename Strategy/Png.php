<?php

namespace ODC\Strategy;

class Png extends AbstractImageStrategy
{
    public function getFormat()
    {
        return 'png256';
    }
}
