<?php

namespace ODC\Strategy;

class Html extends AbstractStrategy
{
    const CMD = 'pdftohtml -c -p "%s"';

    public function getCommand()
    {
        return sprintf(
            self::CMD,
            $this->documentPath
        );
    }

    public function getFormat()
    {
        return 'html';
    }
}
