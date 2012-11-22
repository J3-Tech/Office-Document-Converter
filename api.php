<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
ini_set("soap.wsdl_cache_enabled", "0");
require_once realpath(dirname(__FILE__).'/resources/config.php');
$title="API";
getTemplate('header');
?>
<div class="row">
	<div class="span12">
		<a id="\Service"></a>
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo PUBLIC_ROOT;?>"><i class="icon-custom icon-class"></i></a><span class="divider">\</span>
			</li>
			<li><a href="<?php echo PUBLIC_ROOT;?>">Main</a></li>
			<li class="active">
				<span class="divider">\</span><a href="<?php echo PUBLIC_ROOT;?>api.php">API</a>
			</li>
		</ul>
		<div class="element class"><div class="details">
			<h3><i class="icon-custom icon-method"></i> Methods</h3>
			<a id="method_convert2Image"></a>
			<div class="element clickable method public method_convert2Image" data-toggle="collapse" data-target=".method_convert2Image .collapse">
				<h2>convert2Image</h2>
				<pre>convert2Image(string $file, string $ext, string $imageType, string $compression, integer $height, integer $width) : array</pre>
				<div class="labels"></div>
				<div class="row collapse">
					<div class="detail-description">
					<div class="long_description"></div>
					<h3>Parameters</h3>
					<div class="subelement argument">
						<h4>$file</h4>
						<code>string</code><p>Base64 encoded file content or url</p>
					</div>
					<div class="subelement argument">
						<h4>$ext</h4>
						<code>string</code><p>Current file extension</p>
					</div>
					<div class="subelement argument">
						<h4>$imageType</h4>
						<code>string</code><p>Output image extension (jpg,png,bmp)</p>
					</div>
					<div class="subelement argument">
						<h4>$compression</h4>
						<code>string</code><p>Compression format (zip,gz)</p>
					</div>
					<div class="subelement argument">
						<h4>$height</h4>
						<code>integer</code><p>Output image height</p>
					</div>
					<div class="subelement argument">
						<h4>$width</h4>
						<code>integer</code><p>Output image width</p>
					</div>
					<h3>Returns</h3>
					<div class="subelement response">
						<code>array</code>link(s) (can view directly or use command like wget or curl to get the files)
					</div>
				</div>
			</div>
		</div>
		<a id="method_convert2Pdf"></a>
			<div class="element clickable method public method_convert2Pdf" data-toggle="collapse" data-target=".method_convert2Pdf .collapse">
				<h2>convert2Pdf</h2>
				<pre>convert2Pdf(string $file, string $ext, string $compression) : string</pre>
				<div class="labels"></div>
					<div class="row collapse">
						<div class="detail-description">
							<div class="long_description"></div>
							<h3>Parameters</h3>
							<div class="subelement argument">
								<h4>$file</h4>
								<code>string</code><p>Base64 encoded file content or url</p>
							</div>
							<div class="subelement argument">
								<h4>$ext</h4>
								<code>string</code><p>Current file extension</p>
							</div>
							<div class="subelement argument">
								<h4>$compression</h4>
								<code>string</code><p>Compression format (zip,gz)</p>
							</div>
							<h3>Returns</h3>
							<div class="subelement response">
									<code>string</code>link (can view directly or use command like wget or curl to get the PDF)
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php getTemplate('footer');?>
