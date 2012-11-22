<?php

/**
* Convertor class     
*/
class Convertor implements ConvertorInterface{

	private $file;
	private $pdf;
	private $path;
	private $outputDir;
	private $width;
	private $height;
	private $ext;

    /**
     * __construct
     * 
     * @access public
     *
     * @return mixed Value.
     */
	public function __construct(){
		$this->path=SHELL;
		$this->outputDir=CONVERTDIR;
		$this->uploadDir=UPLOADDIR;		
		$this->mkdir($this->outputDir);
		$this->mkdir($this->uploadDir);
		$this->height=300;
		$this->width=300;
	}

    /**
     * setData
     * 
     * @param mixed $data Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
	public function setData($data){		
		$this->data=$data;
		$this->saveStream();		
		return $this;
	}

    /**
     * getPdf
     * 
     * @access public
     *
     * @return mixed Value.
     */
	public function getPdf(){
		return $this->pdf;
	}

    /**
     * setPdf
     * 
     * @param mixed $pdf Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
	public function setPdf($pdf){
		$this->pdf=$pdf;
		return $this;
	}

    /**
     * setHeight
     * 
     * @param mixed $height Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
	public function setHeight($height){
		$this->height=$height;
		return $this;
	}

    /**
     * setWidth
     * 
     * @param mixed $width Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
	public function setWidth($width){
		$this->width=$width;
		return $this;
	}

    /**
     * setExtension
     * 
     * @param mixed $ext Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
	public function setExtension($ext){
		$this->ext=".{$ext}";
		return $this;
	}

    /**
     * toPdf
     * 
     * @access public
     *
     * @return mixed Value.
     */
	public function toPdf(){
		$cmd="cd \"{$this->path}\" && ";
		$cmd.="sh libreoffice.sh ";
		$cmd.="\"{$this->file}\" \"{$this->outputDir}\"";
		if(shell_exec($cmd)!=null){
			$info=pathinfo($this->file);
			$this->pdf=$this->outputDir.$info['filename'].'.pdf';
			return str_replace(ROOT_PATH, PUBLIC_ROOT, $this->pdf);
		}
	}

    /**
     * toHtml
     * 
     * @access public
     *
     * @return mixed Value.
     */
	public function toHtml(){
		if(!isset($this->pdf)){
			$this->toPdf();
		}
		$cmd="cd {$this->path}/shell && ";
		$cmd.="sh toHtml.sh \"{$this->outputDir}/{$this->pdf}\"";

		echo shell_exec($cmd);
	}

    /**
     * toJpg
     * 
     * @access public
     *
     * @return mixed Value.
     */
	public function toImg($type){
		if(!isset($this->pdf)){
			$this->toPdf();
		}
		$unique=basename($this->getUnique());
		$this->outputDir=$this->outputDir.$unique;
		$this->mkdir($this->outputDir);
		$cmd="cd \"{$this->path}\" && ";
		$cmd.="sh toImg.sh {$type} \"{$this->pdf}\" \"{$this->outputDir}\" ".basename($this->pdf);
		$cmd.=" {$this->height}x{$this->width}";
		shell_exec($cmd);		
		$files=glob("{$this->outputDir}/*.{$type}");
		natcasesort($files);
		return $files;
	}

    /**
     * toText
     * 
     * @access public
     *
     * @return mixed Value.
     */
	public function toText(){
		if(!isset($this->pdf)){
			$this->toPdf();
		}
		$cmd="pdftotext \"{$this->pdf}\" \"{$this->outputDir}\"";
		shell_exec($cmd);
	}

    /**
     * getUnique
     * 
     * @access public
     *
     * @return mixed Value.
     */
	private function getUnique(){
        $output=mt_rand();
        if(file_exists($this->outputDir.$output)){
            return $this->getUnique();
        }else{
            return $this->filename=$output;
        }
    }

    /**
     * getRemoteFile
     * 
     * @access private
     *
     * @return mixed Value.
     */
    private function getRemoteFile($link){
        $cp=curl_init($link);
        $fp=fopen($this->file, "w");
        curl_setopt($cp, CURLOPT_FILE, $fp);
        curl_setopt($cp, CURLOPT_HEADER, 0);
        curl_exec($cp);
        curl_close($cp);
        fclose($fp);
        return true;
    }

    /**
     * scan
     * 
     * @access private
     *
     * @return mixed Value.
     */
	private function scan(){
		if(!extension_loaded('clamav')){
			if(!dl('clamav.so')){
				return true;
			}else{
				$this->scan();
			}
		}else{	
			$retCode=cl_scanfile($this->file,$virus);
			if($retCode==CL_VIRUS){
				$this->virusName=$virus;
				$this->virusCode=cl_pretcode($retCode);
				return false;
			}
			return true;
		}
    }

    /**
     * mkdir
     * 
     * @param mixed $dir  Description.
     * @param int   $mode Description.
     *
     * @access private
     *
     * @return mixed Value.
     */
	private function mkdir($dir,$mode=0777){
		try{
			if(!(file_exists($dir) && is_dir($dir))){
				return mkdir($dir,$mode);				
			}
			return true;
		}catch(Exception $e){		
			return false;
		}
	}

	private function saveStream(){
		$data=base64_decode($this->data);
		$this->file=$this->uploadDir.$this->getUnique().$this->ext;
		if((substr($data,0,4)=='http')||(substr($data, 0,3)=='ftp')){			
			$arr=explode('.', $data);
			$ext=end($arr);
			if($ext=='pdf'){
				$this->pdf=$this->file;
			}
			if($this->getRemoteFile($data)){
				return true;
			}
		}else{
			file_put_contents($this->file, $data);
		}
		if(!$this->scan()){
			unlink($this->file);
			throw new SoapFault("Virus","Virus: {$this->virusName}");
		}
		return true;
	}

    /**
     * compress
     * 
     * @param mixed $fileArr Description.
     * @param mixed $type    Description.
     * @param mixed $output  Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
	public function compress($fileArr,$type,$output=null){
		switch ($type) {
			case 'zip':
				$zip=new \ZipArchive();
				$zip->open("{$this->outputDir}.zip",\ZipArchive::CREATE);
				foreach ($fileArr as $key => $filename) {
					$zip->addfile($filename,basename($filename));
				}					
				$zip->close();
				$this->outputDir=str_replace(ROOT_PATH, PUBLIC_ROOT, $this->outputDir);
				return array("{$this->outputDir}.zip");				
			case 'gz':
				$gz=gzopen("{$this->outputDir}.gz",'w9');
				foreach ($fileArr as $key => $filename) {
					// overwrite?
					gzwrite($gz, file_get_contents($filename));
				}					
				gzclose($gz);	
				return "{$this->outputDir}.gz";			
		}
	}
}

?>