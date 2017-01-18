<?php

namespace ODC\Strategy;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

abstract class AbstractStrategy implements IConvertStrategy
{
    /**
     * document path
     * @var string
     */
    protected $documentPath;

    /**
     * output directory of converted document
     * @var string
     */
    protected $outputDir;

    /**
     * resolution
     * @var string
     */
    protected $resolution;

    /**
     * Set the value of output directory of converted document
     *
     * @param string outputDir
     *
     * @return self
     */
    public function setOutputDir($outputDir)
    {
        $this->outputDir = $outputDir;

        return $this;
    }

    /**
     * Get the value of resolution
     *
     * @return string
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * Set the value of resolution
     *
     * @param string resolution
     *
     * @return self
     */
    public function setResolution($resolution)
    {
        $this->resolution = $resolution;

        return $this;
    }

    public function convert($documentPath)
    {
        echo $this->getCommand($documentPath);
        die();
        $process = new Process($this->getCommand($documentPath));
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    public function getCommand($documentPath)
    {
        return sprintf(
            self::GS,
            $this->getFormat(),
            $this->outputDir,
            'test',
            'test',
            $this->resolution,
            $documentPath
        );
    }
}
