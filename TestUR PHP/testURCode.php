<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <link rel="shortcut icon" href="http://static.php.net/www.php.net/favicon.ico" />
        <title>Test your PHP Code</title>
        <style type="text/css">
        body{font-family:verdana;font-size:12px;}
        pre,plaintext, listing {font-family: monospace;white-space: pre;margin: 1em 0px;}
        .formatterDiv{width:450px;height:500px;overflow:auto;line-height:22px;}
        </style>
        </head>
		<body>
			<form action="testURCode.php" method="post" >
				<table width="80%" align="center" border=1 style="border:1px;border-color:#000;">

				<tr>
					<td style="width:45%;height:200px">
					<?php if(isset($_POST['run']) && trim(@$_POST['runPHP'])!=null){?>					  	
						<div class="formatterDiv">
						 <?php 
						 $linesArray = explode("\n",$_POST['runPHP']);
						 $lineCounter = 1;
						 foreach($linesArray as $line)
						 {
						 	echo $lineCounter.". ".$line."<br/>";
						 	$lineCounter++;
						 }
						 ?>
						</div>
						<?php }else{?>
						<textarea name="runPHP" style="width:100%;height:100%;"><?php echo base64_decode(@$_POST['storeCode'])?></textarea>
						<?php }?>
					</td>
					<td align="center" style="width:10%;height:200px">
					<?php if(isset($_POST['run']) && trim(@$_POST['runPHP'])!=null){
					?>
					<input type="submit" name="edit" value="Edit PHP"/>
					<?php }?>
					<input type="submit" name="run" value="Run PHP"/>
					<input type="hidden" name="storeCode" value="<?php echo base64_encode(@$_POST['runPHP'])?>"/>
					</td>

					<td align="left" style="width:45%;height:500px;padding:10px;">
						<div class="formatterDiv">
	<?php
if(isset($_POST['run']))
{
	$linesToExecute = (isset($_POST['runPHP']))?$_POST['runPHP']:base64_decode(@$_POST['storeCode']);
$str =<<<PHP
<?php $linesToExecute
	?>
PHP;
	$file = fopen("run.php","w");
	fwrite($file,$str);
	fclose($file);
	echo file_get_contents($_SERVER['HTTP_ORIGIN']."/run.php");
}
?>
						</div>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>




