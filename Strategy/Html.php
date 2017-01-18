<?php

namespace ODC\Strategy;

class Html extends AbstractStrategy
{
    const CMD = 'pdftohtml -c -p "%s"';

    public function getCommand($documentPath)
    {
        return sprintf(
            self::CMD,
            $documentPath
        );
    }

    public function getFormat()
    {
        return 'html';
    }
}
