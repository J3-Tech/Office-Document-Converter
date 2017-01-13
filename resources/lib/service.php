<?php

/**
 * Service - deal with SoapClient
 * 		  - create instance of convertor class
 *		  - do the actual conversion.
 */
class service implements ServiceInterface
{
    /**
     * create an instance of Soap Server
     * register functions for web service.
     *
     *
     * @return object Value.
     */
    public function create()
    {
        $this->updateWsdl();
        $soap = new SoapServer('service.wsdl', array('soap_version' => SOAP_1_2));
        $soap->setClass('Service');
        $soap->addFunction('convert2Image');
        $soap->addFunction('convert2Pdf');
        $soap->addFunction('convert2Html');
        $soap->handle();

        return $this;
    }

    /**
     * convert2Image.
     *
     * @param string $file        Base64 encoded file content or url
     * @param string $ext         Current file extension
     * @param string $imageType   Output image extension (jpg,png,bmp)
     * @param string $compression Compression format (zip,gz)
     * @param int    $height      Output image height
     * @param int    $width       Output image width
     *
     * @return array Output
     */
    public function convert2Image($file, $ext, $imageType = null, $compression = null, $height = null, $width = null)
    {
        $imageType = ($imageType) ? $imageType : 'jpg';
        $imageType = ($imageType == 'jpeg') ? 'jpg' : $imageType;
        if ($this->validation($ext, $compression, $imageType, $height, $width)) {
            $convertor = new Convertor();
            ($height) ? $convertor->setHeight($height) : null;
            ($width) ? $convertor->setWidth($width) : null;
            $fileArr = $convertor->setExtension($ext)
                               ->setData($file)
                               ->toImg($imageType);  //image type <<<*/
            if (!$compression) {
                foreach ($fileArr as $file) {
                    $output[] = str_replace(ROOT_PATH, PUBLIC_ROOT, $file);
                }

                return $output;
            }

            return $convertor->compress($fileArr, $compression);
        }
    }

    /**
     * convert2Pdf.
     *
     * @param string $file        Base64 encoded file content or url
     * @param string $ext         Current file extension
     * @param string $compression Compression format (zip,gz)
     *
     * @return string Output
     */
    public function convert2Pdf($file, $ext, $compression = null)
    {
        $ext = strtolower($ext);
        if ($ext == 'pdf') {
            throw new SoapFault('Logic', 'The file is already in pdf');
        }
        if ($this->validation($ext, $compression)) {
            $convertor = new Convertor();
            $output = $convertor->setExtension($ext)
                              ->setData($file)
                              ->toPdf();
            if (!$compression) {
                return $output;
            }

            return $convertor->compress($output, $compression);
        }
    }

    /**
     * validation - validate paramters send to web service.
     *
     * @param string $ext         file extension
     * @param string $compression compression type
     * @param string $imageType   image type
     * @param string $height      image height
     * @param string $width       image width
     *
     * @return mixed (boolean or exception) value
     */
    private function validation($ext, $compression, $imageType = null, $height = null, $width = null)
    {
        switch ($ext) {
            case 'pdf'    :
            case 'doc'    :
            case 'docx'    :
            case 'rtf'    :
            case 'odt'    :
            case 'ppt'    :
            case 'pptx'    :
            case 'xls'    :
            case 'xlsx'    :
            case 'ods'    :
            case 'odp'    :
            case 'txt'  :
                break;
            default:
                throw new SoapFault('Format', 'Unknown file format');
                break;
        }
        if ($compression) {
            $compression = strtolower($compression);
            if (!($compression == 'zip' || $compression == 'gz')) {
                logger("Unknown compression format - {$compression}");
                throw new SoapFault('Compression', 'Unknown compression format');
            }
        }
        if ($imageType) {
            switch ($imageType) {
                case 'png' :
                case 'jpg' :
                case 'jpeg':
                case 'bmp' :
                    break;
                default:
                    logger("Unknown image format - {$imageType}");
                    throw new SoapFault('Types', 'Unknown image type');
                    break;
            }
        }
        if ($height) {
            if (!is_int($height)) {
                logger("Invalid data type - Height: {$height}");
                throw new SoapFault('Data Type', 'Must be integer');
            }
        }
        if ($width) {
            if (!is_int($width)) {
                logger("Invalid data type - Width: {$height}");
                throw new SoapFault('Data Type', 'Must be integer');
            }
        }

        return true;
    }

    /**
     * updateWsdl - update WSDL based on url of this file.
     *
     *
     * @return bool Value.
     */
    private function updateWsdl()
    {
        $dom = new DOMDocument();
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->load(ROOT_PATH.'service.wsdl');
        $address = $dom->getElementsByTagName('address')->item(0);
        $location = $address->getAttribute('location');
        if ($location != PUBLIC_ROOT.'service.php') {
            $address->setAttribute('location', PUBLIC_ROOT.'service.php');
            $dom->save(ROOT_PATH.'service.wsdl');
        }
        $operations = $dom->getElementsByTagName('operation');
        for ($i = 0; $i < $operations->length; ++$i) {
            $operation = $operations->item($i);
            $action = $operation->getAttribute('soapAction');
            if ($action && $action != PUBLIC_ROOT.'service.php') {
                $operation->setAttribute('soapAction', PUBLIC_ROOT.'service.php');
                $dom->save(ROOT_PATH.'service.wsdl');
            }
        }

        return true;
    }
}
