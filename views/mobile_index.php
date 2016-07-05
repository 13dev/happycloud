<?php
/* File:	BitDrop - mobile_index.php - v1.4
 * Date:	June 17, 2013
 * Copyright (C) 2013 by http://codeeverywhere.ca
 */

include('../bitdrop.class.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?=serviceName?> - upload your file</title>
		<link rel="stylesheet" type="text/css" href="css/bitdrop-mobile.css" />
		<script type="text/javascript" src="js/uploader.js"></script>
		<script type="text/javascript" src="js/numericalize.js"></script>
		<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
		<meta name = "viewport" content = "user-scalable=no, width=device-width, minimum-scale=0.50, maximum-scale=0.50">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/iphone4-icon.png" />
	</head>
	<body>
	<script type="text/javascript">
	$(function()
	{
		$.each($.parseJSON('<?=$bitdrop->getData('recent')?>'), function(i, file){
			$('#recent > tbody').append('<tr><td><a href="'+file.shortURL+'">'+ decodeURIComponent(file.name) +'</a></td><td><span class="time-min">'+file.date+'</span></td></tr>');
		});
		
		$.each($.parseJSON('<?=$bitdrop->getData('popular')?>'), function(i, file){
			$('#popular > tbody').append('<tr><td><a href="'+file.shortURL+'">'+ decodeURIComponent(file.name) +'</a></td><td>'+file.views+' Views</td></tr>');
		});
			
		$('.another').click(function(e){
			e.preventDefault();
			$('.view-progress').fadeOut(500, function(){ $('.view-form').fadeIn(300); });
		});
	});	
	</script>
	
	
	<div class="header">
		<div class="wrapper">
				<a class="logo" href="index"><?=serviceName?></a> - upload your file
		</div>
	</div>
	
	
	<div class="wrapper box">		
		<!-- ========== -->
		<form id="form" name="form" action="upload.php" method="post" enctype="multipart/form-data">
		
		<div class="view-form">
			<input type="hidden" name="MAX_FILE_SIZE" value="<?=maxFileSize?>" />
			<input name="files" id="files" type="file" class="ui file" />
			<input id="submit_btn" type="submit" value="Upload Your File" class="green-button" onclick="upload();"/>
			<iframe name="iframe" style="display:none;"></iframe>
			<hr/>
			<input type="button" onclick="toggle();" value="Options" class="white-button" />
			<div id="bitdrop-options">
				<input type="checkbox" name="bitdrop_share" value="share" /> Make file public 
				[<a href="#" title="by checking this box, this file will appear in public searches">?</a>]
				
				<input type="password" name="bitdrop_password" placeholder="add a file password" />
			</div>
		</div>
		
		<div class="view-progress">
			<h4>your file is uploading</h4>
			<div id="progress_outline">
				<div id="progress_bar"><div id="progress_done"><div id="num">0%</div></div></div>
			</div>
			<a href="/" class="another">Upload Another File</a>
		</div>
		
		<div class="view-uploaded">
			<h4>Your file has been uploaded!</h4>
			<p>Link</p>
		</div>
		
		</form>
		<!-- ========== -->
	</div>
	
	
	<div class="wrapper">
		<div class="box">
			<h3>Recent Uploads</h3>
			<table id="recent" style="width: 100%"><tbody></tbody></table>
		</div>
		<div class="box">
			<h3>Popular Files</h3>
			<table id="popular" style="width: 100%"><tbody></tbody></table>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="footer"><?=bitdropFooter?></div>
	
	</body>
</html>