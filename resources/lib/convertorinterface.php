<?php

interface ConvertorInterface{
	public function toImg($type);
	public function toPdf();	
	public function compress($fileArr,$type,$output);
}