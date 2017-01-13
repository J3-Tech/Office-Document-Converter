<?php

interface ServiceInterface{
	public function create();
	public function convert2Image($file,$ext,$imageType=null,$compression=null,$height=null,$width=null);
	public function convert2Pdf($file,$ext,$compression=null);
}
