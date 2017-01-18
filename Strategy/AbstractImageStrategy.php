<?php

namespace ODC\Strategy;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

abstract class AbstractImageStrategy extends AbstractStrategy
{
    const CMD = 'gs -dNOPAUSE -sDEVICE=%s -dFirstPage=1 -sOutputFile="%s/%%d-%s.%s" -r"%s" -q "%s" -c quit';

    public function getCommand($documentPath)
    {
        $extension = pathinfo($documentPath, PATHINFO_EXTENSION);

        return sprintf(
            self::CMD,
            $this->getFormat(),
            $this->outputDir,
            basename($documentPath, '.'.$extension),
            $this->getExtension(),
            $this->resolution,
            $documentPath
        );
    }

    private function getExtension()
    {
        $class = get_class($this);
        $items = preg_split('/\\\/', $class);

        return strtolower(end($items));
    }
}
