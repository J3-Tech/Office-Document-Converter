<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
ini_set("soap.wsdl_cache_enabled", "0");
require_once realpath(dirname(__FILE__).'/resources/config.php');
$title="Requirements";
getTemplate('header');
// dir used to save file, do conversion and logging
$writeables=array('convert','upload','log');
// binary file (program) used by the project
$bins=array('Ghostscript'=>'gs','Libreoffice'=>'libreoffice','ClamAV'=>'freshclam');
$valid=true;
?>
<div class="row">
	<div class="span9 offset1 well">
		<h2>System Requirements</h2>
		<p class="lead">Operating System: Linux preferably Ubuntu (since the project make use shell scripts)</p>
		<?php
			// loop through the binary to check if it's installed			
			foreach ($bins as $key => $bin) {
				$exe=trim(exec(escapeshellcmd("which {$bin}")));	
				if(is_executable($exe)){
					echo "<div class=\"alert alert-info\"><i class=\"icon-ok-sign pull-right\"></i><strong>{$key}</strong> is currently installed and is working correctly.</div>";
				}else{
					$valid=false;
					echo "<div class=\"alert alert-error\"><i class=\"icon-question-sign pull-right\"></i>";
					if($exe){
						echo "<strong>{$key}</strong> is not executable by your webserver";
					}else{
						echo "<p><strong>{$key}</strong> has not been installed on the server.</p>";
						echo "<p>Install it by using the following code in console: (need to be root)</p>";
						echo "<ul><li>Ubuntu:";
						echo "<section><code>apt-get install ".strtolower($key)."</code></section><br/></li>";
						echo "<li>CentOs:";
						echo "<p><code>yum install ".strtolower($key)."</code></p></li>";
						echo "</ul>";
					}
					echo "</div>";
				}
			}
			//  check if directories is writeable
			foreach ($writeables as $key => $dir) {
				if(!(file_exists(ROOT_PATH.$dir) && is_dir($dir))){
					mkdir(ROOT_PATH.$dir,0777);					
				}
				if(!is_writable(ROOT_PATH.$dir)){
					chmod(ROOT_PATH.$dir, 0777);
				}else{
					echo "<div class=\"alert alert-info\"><i class=\"icon-ok-sign pull-right\"></i>Folder <strong>{$dir}</strong> exist and is writable.</div>";
				}
			}
			// check if clamav's PHP extension is loaded
			if(!extension_loaded('clamav')){
				if(!@dl('clamav.so')){
					echo "<div class=\"alert alert-error\"><i class=\"icon-question-sign pull-right\"></i>PHP Extension <strong>ClamAV</strong> not found.  It is not critical but worth using it when clients transfer files.</div>";
				}else{
					echo "<div class=\"alert alert-info\"><i class=\"icon-ok-sign pull-right\"></i>PHP Extension <strong>ClamAV</strong> exist and has been loaded.</div>";				
				}
			}else{
					echo "<div class=\"alert alert-info\"><i class=\"icon-ok-sign pull-right\"></i>PHP Extension <strong>ClamAV</strong> exist and is loaded.</div>";
			}

?>
		<?php
		if(!$valid){
			echo "<a href=\"{$_SERVER['PHP_SELF']}\" class=\"btn pull-right\"><i class=\"icon-retweet\"></i>&nbsp;Click here to re-check</a>";			
		}
		?>
	</div>
</div>

<?php getTemplate('footer');?>