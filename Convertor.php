<?php

namespace ODC;

use ODC\Factory\Strategy;

class Convertor
{
    /**
     * Convertor instance
     * @var Convertor
     */
    protected static $instance;

    /**
     * output directory of converted document
     * @var string
     */
    protected $outputDir;

    /**
     * width
     * @var integer
     */
    protected $width;

    /**
     * height
     * @var integer
     */
    protected $height;

    private function __construct() { }

    private function __clone() { }

    /**
     * convert document
     * @param  string $documentPath
     * @param  string $type
     */
    public function convert($documentPath, $type)
    {
        Strategy::create($type)
            ->setOutputDir($this->outputDir)
            ->setResolution("{$this->height}x{$this->width}")
            ->setDocumentPath($documentPath)
            ->convert();
    }

    /**
     * get Convertor instance
     * @return Convertor
     */
    public static function instance()
    {
        if(!self::$instance){
            self::$instance = new Self();
        }

        return self::$instance;
    }

    /**
     * Get the value of output directory of converted document
     *
     * @return string
     */
    public function getOutputDir()
    {
        return $this->outputDir;
    }

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
     * Get the value of width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @param integer width
     *
     * @return self
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get the value of height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the value of height
     *
     * @param integer height
     *
     * @return self
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }
}
