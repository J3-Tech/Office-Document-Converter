<?php

class convertor{
	/**
     * convert2Image engklerngergklenerklgnerklnkl
     * @param string $file        Description.
     * @param string $ext 		  Description.
     * @param string $imageType   Description.
     * @param string $compression Description.
     * @param int $height      Description.
     * @param int $width       Description.
     *
     * @access public
     *
     * @return string[]
     */
	public function convert2Image($file,$ext,$imageType=null,$compression=null,$height=null,$width=null){		
		$imageType=($imageType) ? $imageType : 'jpg';
		$imageType=($imageType=='jpeg') ? 'jpg': $imageType;
		if($this->validation($ext,$compression,$imageType,$height,$width)){			
			$convertor=new Convertor();
			($height) ? $convertor->setHeight($height) : null;
			($width) ? $convertor->setWidth($width) : null;
			$fileArr=$convertor->setExtension($ext)
							   ->setData($file)
					  		   ->setCompression($compression)
					           ->toImg($imageType);  //image type <<<*/
			if(!$compression){
				foreach ($fileArr as $file) {
					$output[]=str_replace(ROOT_PATH,PUBLIC_ROOT, $file);
				}
				return $output;
			}
			return $convertor->compress($fileArr,$compression);
		}
	}

    /**
     * convert2Pdf
     * 
     * @param string $file        Description.
     * @param string $ext         Description.
     * @param string $compression Description.
     *
     * @access public
     *
     * @return string[]
     */
	public function convert2Pdf($file,$ext,$compression=null){
		if($this->validation($file,$ext,$compression)){
			$fileArr=$convertor->setData($file)
							   ->setExtension($ext)
					  	  	   ->setCompression($compression)
					  	  	   ->toPdf();
			if(!$compression){
				return $fileArr;
			}
			//return Convertor::compress($fileArr,$compression);
		}
	}
}

?>