<?php
require_once realpath(dirname(__FILE__).'/resources/config.php');
$title="Examples";
if(isset($_POST['submit'])){
	$compress=null;
	$height=null;
	$width=null;
	$type=null;
	foreach ($_POST as $key => $value) {
		$$key=$value;
	}
	if($compress){
		$compress='zip';
	}
	$tmpfile=$_FILES['file']['tmp_name'];
	$filename=$_FILES['file']['name'];
	$handle = fopen($tmpfile, "r");
	$contents = fread($handle, filesize($tmpfile));
	fclose($handle);
	$encodeContent   = base64_encode($contents);
	$info=new SplFileInfo($filename);
	$ext=$info->getExtension();
	if(!$encodeContent && $url){
		$encodeContent=base64_encode($url);
		$arr=explode('.', $url);
		$ext=end($arr);
		$type=$rtype;
	}
	// consume web service
	$client=new SoapClient('http://localhost/service/service.php?wsdl'); 
	try{
		if($encodeContent){
			if($type=='pdf'){
				$response = $client->convert2Pdf($encodeContent,$ext,$compress);
			}else{
				$response = $client->convert2Image($encodeContent,$ext,$type,$compress,$height,$width);
			}
		}
	}catch(Exception $e){
		$exception=$e->getMessage();
	}
}
getTemplate('header');
?>
<div class="row">
	<div class="span5 well">
		<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form-horizontal" >				
			<h2>Local Content</h2>
			<div>
				<label class="control-label" for="file">Select a file </label>
				<input type="file" name="file" id="file" />
				<label class="control-label" for="compress"><input type="checkbox" name="compress"/>&nbsp;Compress output</label>
				<fieldset>
					<legend>Output format</legend>
					<label class="control-label" for="jpeg"><input type="radio" name="type" id="jpg" value="jpg"/>&nbsp;JPEG</label>
					<label class="control-label" for="png"><input type="radio" name="type" id="png" value="png"/>&nbsp;PNG</label>
					<label class="control-label" for="bmp"><input type="radio" name="type" id="bmp" value="bmp"/>&nbsp;BMP</label>
					<label class="control-label" for="pdf"><input type="radio" name="type" id="pdf" value="pdf"/>&nbsp;PDF</label>
				</fieldset>
				<fieldset>
					<legend>Resolution</legend>
					<label for="height">Height</label>
					<input type="number" name="height" id="height" value="300"/>
					<label for="width">Width</label>
					<input type="number" name="width" id="width" value="300" />
				</fieldset>
				<br />							
				<div class="btn-group">
					<button class="btn btn-primary" name="submit" type="submit">Convert</button>
					<button class="btn" type="reset">Reset</button>
				</div>
			</div>
		</form>
	</div>
	<div class="span5 well pull-right">
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form-horizontal">
			<h2>Remote Content</h2>
			<div>
				<label for="url">Url:</label>
				<input type="url" name="url" id="url" />
				<fieldset>
					<legend>Output format</legend>
					<label class="control-label" for="jpeg"><input type="radio" name="rtype" id="jpg" value="jpg"/>&nbsp;JPEG</label>
					<label class="control-label" for="png"><input type="radio" name="rtype" id="png" value="png"/>&nbsp;PNG</label>
					<label class="control-label" for="bmp"><input type="radio" name="rtype" id="bmp" value="bmp"/>&nbsp;BMP</label>
					<label class="control-label" for="pdf"><input type="radio" name="rtype" id="pdf" value="pdf"/>&nbsp;PDF</label>				
				</fieldset>
				<div class="btn-group">
					<br />
					<button class="btn btn-primary" name="submit" type="submit">Convert</button>
					<button class="btn" type="reset">Reset</button>
				</div>
			</div>
		</form>
	</div>
<!-- display response -->
<?php if($response){ ?>
		<div class="span12">
			<h2>Output:</h2>
			<?php 
				if(!$compress  && $type!='pdf'){
					foreach ($response->return as $img) {
						echo "<img src=\"{$img}\" />";
					}
				}else{
					if(is_object($response)){
						echo "<a href=\"{$response->return}\">{$response->return}</a>";
					}else{
						echo "<a href=\"{$response}\">{$response}</a>";
					}
				}
			?>
		</div>
<?php }elseif ($exception) {
	echo "<div class=\"span12 alert alert-error\">{$exception}</div>";
} 
?>
</div>
<?php getTemplate('footer');?>