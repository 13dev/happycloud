<?php

include('../bitdrop.class.php');
$bitdrop->createUniqueID();
$url = "http://happycloud.ddns.net";


?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=serviceName?></title>
		

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/build.css">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/logof.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
		
		<link rel="stylesheet" type="text/css" href="css/bitdrop.css" />
		<link rel="stylesheet" type="text/css" href="css/buttons.css" />
		<link rel="stylesheet" type="text/css" href="css/ui.css" />
		<link rel="stylesheet" type="text/css" href="css/button.css" />
		<link rel="stylesheet" type="text/css" href="css/button1.css" />
		<link rel="stylesheet" type="text/css" href="css/shake.css" />

		<script type="text/javascript" src="js/uploader.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
		<script type="text/javascript" src="js/numericalize.js"></script>
		<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
   		<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
		
		
        <link rel="stylesheet" type="text/css" href="css/style1.css" />
		<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>

		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<style>
		.numberCircle {
			    border-radius: 50%;
			    behavior: url(PIE.htc);
			    width: 56px;
			    height: 56px;
			    background: rgb(116, 207, 237);
			    margin-right: 10px;
			    padding: 8px 8px 8px;
			    border: 2px solid #74CFED;
			    color: #fff;
			    text-align: center;
			    font: 32px Arial, sans-serif;
			    display: inline-block;
				}
		</style>

    </head>
    <body>
				        <ul class="cb-slideshow" style="z-index:-111111;list-style: none;">
        </ul>
		<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();   
		});
		</script>
	<script type="text/javascript">
	if ( navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|Android)/i) ){ location.replace("m"); }
	$(function()
	{
		$.each($.parseJSON('<?=$bitdrop->getData('recent')?>'), function(i, file)
		{
			$('#recent > tbody').append('<tr><td><a href="'+file.shortURL+'">'+ decodeURIComponent(file.name) +'</a></td><td><span class="time-min">'+file.date+'</span></td></tr>');
		});
			
		$.each($.parseJSON('<?=$bitdrop->getData('popular')?>'), function(i, file)
		{
			$('#popular > tbody').append('<tr><td><a href="'+file.shortURL+'">'+ decodeURIComponent(file.name) +'</a></td><td><span class="icon-views">'+file.views+'</span></td></tr>');
		});
				
		$('.another').click(function(e)
		{
			e.preventDefault();
			$('.view-progress').fadeOut(500, function()
			{
	        	$('.view-form').fadeIn(300);	
			});
		});
	});
	</script>

		<!-- Top menu -->
		<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="<?php echo $url;?>"><span class="li-text" ><img class="shake" src="images/logo.png" width="260"></a>
					</span>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right" style="margin-top: 30px;">
						<li>
							<span class="li-text">
								Ultra-Configs
							</span> 
							<span class="li-social">
								<a href="https://www.facebook.com/profile.php?id=100004221642357"><i class="fa fa-facebook"></i></a> 
								<a href="https://twitter.com/leo13wayne"><i class="fa fa-twitter"></i></a> 
								&nbsp;&nbsp;
							</span>
							
						</li>
						<a href="editor"><button type="button"  class="btn btn-info"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>  Painel De Controlo  <br> Test Free Hosting</button></a>
					</ul>
				</div>
			</div>
		</nav>

        <!-- Top content -->
        <div class="top-content">
   
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text">
                        <!-- <center><a href="#" data-toggle="modal" data-target="#basicModal"><img src="images/bupload.png" class="imggg"></img></a></center>
                        <style type="text/css">
                        	.imggg {
                        		width: 	50%;
                        		cursor: pointer;
   								transition: 0.2s;

                        	}
                        	.imggg:hover{
                        		opacity: 0.9;
                        		cursor: pointer;
                        		width: 50.5%;
                        	}

                        </style>

                       <center><a href="#" class="btn btn-lg btn-success"  style="width: 70%;margin: 30px 30px 30px;height: 70px;font-size: 40px;">
						<span class="glyphicon glyphicon-cloud-upload"></span> FAZER UPLOAD AGORA! <span class="glyphicon glyphicon-cloud-upload"></span></a></center>
                        <center>
                       <ul class="ulb yhe" data-target="#basicModal">
						  <li class="lib"><a href="#" class="round green">FAZER UPLOAD AGORA<span class="round">That is, if you already have an account.</span></a></li>
						  </ul></center><br><br><br>-->
						<div class="enjoy-css" data-toggle="modal" data-target="#basicModal"><span class="glyphicon glyphicon-open"></span> FAZER UPLOAD AGORA <span class="glyphicon glyphicon-menu-right"></span></div><br><h1>OU</h1>
						
						<a href="dashboard"><div class="buttong" ><span class="glyphicon glyphicon-cog"></span> ACESSAR MEUS UPLOADS <span class="glyphicon glyphicon-menu-right"></span></div></a>
						<link async href="http://fonts.googleapis.com/css?family=Advent%20Pro" rel="stylesheet" type="text/css"/><br>
						 <h1> FAZ O TEU UPLOAD EM APENAS 3 ETAPAS</h1><center><hr style="    max-width: 95%;"></center><br>
						<div class="col-md-6">
													 
							  <ul class="list-group">

							    <li class="list-group-item"><h2>Teu arquivo irá permaneçer por: <strong id="expire_after"><?=expireTime?></strong></h2></li>
							 			
							    <li class="list-group-item"><h2>Upload maximo: <strong><span class="data-byte"><?=maxFileSize?></span></strong></h2></li>
							  </ul>
							  </div>
							  <div class="col-md-6">

							  							  <ul class="list-group">

							    <li class="list-group-item list-group-item-success"><h3><span class="glyphicon glyphicon-share-alt"></span> Escolhe Teu Ficheiro </h3></li>
								<li class="list-group-item list-group-item-info"><h3><span class="glyphicon glyphicon-menu-hamburger"></span> Configura As Opções</h3></li>
								<li class="list-group-item list-group-item-warning"><h3><span class="glyphicon glyphicon-send"></span> Envia-o ! </h3></li>
								</ul>
							  <p></p>
							  </div>


						
					<!-- ========== -->
					

					<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
					    <div class="modal-dialog">
					        <div class="modal-content">
					            <div class="modal-header">
					            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					            <h4 class="modal-title" id="myModalLabel" style="color:#19B9E7;">Enviar grandes arquivos on-line gratuitamente!</h4>
					            </div>
					            <div class="modal-body">
					        		<div class="row">
					        			<ul class="list-group">
										  <li class="list-group-item" style="border: 0px;">
										  	
						    			<div class="view-form">
								    	<form id="form" name="form" action="upload.php" method="post" enctype="multipart/form-data" class="ui">
										<div id="enviarr">
										<center>
										<div class="numberCircle" style="float: left;">1</div>
										<div id="1etapa" style="padding-left: 40px;">
										<input type="hidden" name="MAX_FILE_SIZE" value="<?=maxFileSize?>" />
										<button class="btn" href="javascript:;" style="padding: 0px 0px 46px;max-height: 56px;max-width:200px;height: 56px;">
										<text><span class="glyphicon glyphicon-share-alt"></span>  &nbsp;  Escolher</text>
											<input type="file" id="files" class="fich" name="files" style="z-index:2;top:0;height: 56px;margin: -50px 0px;left: 0;width: 500px;max-width: 100%;filter: alpha(opacity=0);-ms-filter:&quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=0)&quot;;opacity:0;background-color: rgba(210, 0, 0, 0);color: rgba(68, 23, 23, 0);" size="40" onchange="$(&quot;#upload-file-info&quot;).html($(this).val());">
											</button></center>
											<script>

											</script>

															<div id="spann" style="color: #19B9E7;margin: 5px 5px 5px;display:none;">
														<center >
														<span class="label label-pill label-warning" >Ficheiro:</span>
														<span class="label label-pill label-info" id="span" maxlength="15" >Ficheiro</span>
														</center>
														</div>
											<script>
													var inputArray = document.getElementsByClassName('fich');

													for(var i = 0; i < inputArray.length; i++){
													    inputArray[i].addEventListener('change',prepareUpload,false);
													};

													function prepareUpload(event)
													{
													    var files = event.target.files;
													    var fileName = files[0].name;
													 
													    $('#spann').css("display", "block");
													    document.getElementById('span').innerHTML = fileName;
														var maxx = 27;
																	$('#span').text($('#files').val().substring( 12, maxx)+'...' );

													}
													</script>
										  </li>
										  <li class="list-group-item">
										  	<div class="view-form">										
										<center>
										<div class="numberCircle" style="float: left;background: rgb(116, 237, 120);border: 2px solid #60E464;">2</div>

										<!--<div id="span">
											</div>
												
													<div id="bitdrop-options1" style="">
													<div style="">
														<center><input id="checkbox1" type="checkbox" name="bitdrop_share" value="share" style="margin-top: 10px;">
														<a href="#" data-toggle="tooltip" title="Ao teres está opção ativa, Todas as pessoas Poderam Baixar este Arquivo"><label for="checkbox1" style="font-weight: 300;color: #EE5A4F;margin-left: 3px;">Publico?</label></a>													
														<a href="#" data-toggle="tooltip" title=" Poderás adicionar Senha ao teu arquivo, ou se perferires poderás deixar em branco e o arquivo ficara sem senha">
														<input type="password" name="bitdrop_password" size="17" placeholder="Password" class="form-control" id="inputPassword2" class="ui"/>
														</a></center>
														<br></div>
										</div>-->

											<button type="button" name="opitions" class="btn" onclick="toggle();" value="Opções" style="width: 200px;background: #74ED78;"><span class="glyphicon glyphicon-menu-hamburger"></span> &nbsp; Opções</button><br>

											<div id="bitdrop-options">
											<ul1 class="list-group">
										 	 <li class="list-group-item">

												<div><a href="#" data-toggle="tooltip" title="Ao teres está opção ativa, Todas as pessoas Poderam Baixar este Arquivo">
													<input type="checkbox" name="bitdrop_share" value="share" checked /> Meter Arquivo publico [?]
												</div></a>
												</li>
												<li class="list-group-item">
												<div><a href="#" data-toggle="tooltip" title=" Poderás adicionar Senha ao teu arquivo, ou se perferires poderás deixar em branco e o arquivo ficara sem senha">
													<label for="bitdrop_password">Adicionar Password:</label>
													<input type="password" name="bitdrop_password" size="17" placeholder="password" class="ui" autocomplete="off"/>
												</div></a>
												</li>
														</ul1>
													</div>

																	
												</center>

											</div>

										  </li>

								    <li class="list-group-item" style="border-bottom-width: 0px;">
									<div class="view-form">										
										<center>
										<div class="numberCircle" style="float: left;background: rgb(237, 116, 116);border: 2px solid #E25F5F;">3</div>
										<button id="submit_btn" type="submit" value="Enviar" class="btn btn-link-1" onclick="upload();" style="width: 200px;background: #ED7474;"><span class="glyphicon glyphicon-send"></span> &nbsp; Enviar</button>
											<iframe name="iframe" style="display:none;"></iframe>
										</center>
									</div>
									</li>
								<div class="view-progress" style="color: #19b9e7;">
								<h2 id="titulo">O Teu Arquivo Está a ser enviando...</h2>
									<div class="progress" style="margin: 20px 50px;border-radius: 10px;height:30px;">
									  <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" id="barra" style="width: 0%;border-radius: 5px;font-size: 18px;">
									    <div id="progress_bar"><div id="progress_done"><div id="num" style="padding: 4px 5px 5px;color: #fff;">0%</div></div></div>
									  </div>
									</div>
									<a href="/" class="another" onclick="setTimeout(clickk, 300);">Fazer Upload de outro arquivo</a>
									</div>
										<!--

									<div class="view-progresss">
											<h4>your file is uploading</h4>
											<div id="progress_outline">
												<div id="progress_bar"><div id="progress_done"><div id="num">0%</div></div></div>
											</div>
											
										</div>-->
										

										</form>
											<div class="clear"></div>	


										</ul>										
										




						


						



						    
						
						

					
					<!--	<input name="files" id="files" type="file" class="ui input-file" />-->
					</div>

					
					            </div>
					    </div>
					  </div>
					</div>

					<!-- ========== -->
				<div class="col-md-12">
						<div class="panel panel-primary">
						  <div class="panel-heading">Uploads Recentes</div>
						  <div class="panel-body">
						<table id="recent" class="ui-min half" style="width: 100%;color: #7D7D7D;"><tbody></tbody></table>
						  </div>
						</div></div>
						<div class="col-md-12">
						<div class="panel panel-primary">
						  <div class="panel-heading">Arquivos Populares</div>
						  <div class="panel-body">
						<table id="popular" class="ui-min half" style="width: 100%;color: #7D7D7D;"><tbody></tbody></table>
						  </div>
						</div></div>

						</div>
						
					
					</div>
					</div>
					<br>
											<div class="enjoy-css" data-toggle="modal" data-target="#basicModal"><span class="glyphicon glyphicon-open"></span> FAZER UPLOAD AGORA <span class="glyphicon glyphicon-menu-right"></span></div>
						<link async href="http://fonts.googleapis.com/css?family=Advent%20Pro" rel="stylesheet" type="text/css"/><br>
						<center><hr style="max-width:80%;"></center>
						<text style="color:#fff;">Copyright© Happycloud 2016</text>
	</div>
	</div>
  </div>
        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
		
    </body>
</html>