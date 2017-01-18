<?php

namespace ODC\Strategy;

interface IConvertStrategy
{
    public function convert();
    public function getFormat();
    public function getCommand();
}
