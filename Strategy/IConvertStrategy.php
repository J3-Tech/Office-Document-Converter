<?php

namespace ODC\Strategy;

interface IConvertStrategy
{
    public function convert($documentPath);
    public function getFormat();
    public function getCommand($documentPath);
}
