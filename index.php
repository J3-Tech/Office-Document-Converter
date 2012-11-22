<?php
require_once realpath(dirname(__FILE__).'/resources/config.php');
$title='Index';
getTemplate('header');
?>

<div class="hero-unit">
	<h1>Office Document Convertor</h1>
</div>
<div class="well">
	<h2>Overview</h2>
	<p class="lead">
	Office Document Convertor (ODC) is an online convertor for office document which runs as a web service.  Its aim is to provide the facility of converting almost all office documents into image which make office documents viewable even without any office suite software installed on your machines.</p>
	<div><h2>Other services provided by ODC are listed below:</h2>
		<ul>
			<li>Convert to Portable Document Format (PDF)</li>
			<li>Virus Scanning on upload files</li>
			<li>Can optionally compressed the output (images or PDF)</li>
			<li>Allow different image format including jpeg, png, bmp - default: jpg</li>
			<li>Allow different resolution of images</li>
		</ul>
	</div>
	<div>
		<h2>List of files supported by ODC:</h2>
		<ul class="unstyled">
			<li>Word Processing format
				<ul>
					<li>Rich Text Format (rtf)</li>
					<li>OpenDocument text (odt)</li>
					<li>MS Word (doc,docx)</li>					
				</ul>
			</li>
			<li>Spreedsheet
				<ul>
					<li>OpenDocument Spreedsheet (ods)</li>
					<li>MS Excel (xls,xlsx)</li>
				</ul>
			</li>
			<li>Presentation
				<ul>
					<li>OpenDocument Presentation (odp)</li>
					<li>MS Powerpoint (ppt,pptx)</li>
				</ul>
			</li>
			<li>Portable Document Format (pdf)</li>
		</ul>		
	</div>
</div>
<?php getTemplate('footer');?>