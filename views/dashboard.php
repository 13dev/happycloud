<?php
include('../bitdrop.class.php');
$uid = $bitdrop->createUniqueID();
$url = "http://happycloud.ddns.net";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Painel De controle - <?=serviceName?></title>
		
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
				<link rel="stylesheet" type="text/css" href="css/bitdrop.css" />
		<link rel="stylesheet" type="text/css" href="css/ui.css" />
		
		        <!-- Javascript -->
		<script type="text/javascript" src="js/numericalize.js"></script>
		<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/logof.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/logof.ico">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="logof.ico">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="logof.ico">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/logof.ico">
		
		 <link rel="stylesheet" type="text/css" href="css/style1.css" />
		<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
				<link rel="stylesheet" type="text/css" href="css/shake.css" />
	</head>
	
	<script type="text/javascript">
	$(function()
	{
		var html;
		var json = $.parseJSON('<?=$bitdrop->getData('dash', $uid)?>');
		if( json.length > 0 )
		{
			$.each(json, function(i, file)
			{
				html = '<tr><td>';
			if(file.flag == 1) html += ' <img src="images/flag.png" alt="flag" width="14" height="14">';
			html += ' '+decodeURIComponent(file.name);
			html += ' <span class="icon-views">'+file.views+'</span>';
			if(file.public == 1) html += ' <span class="green">&bull;</span>';
			if(file.password == 1) html += ' <span class="yellow">&bull;</span>';
			html += '</td>\
			<td><span class="data">'+file.size+'</span></td>\
			<td><a href="'+file.link+'" class="link">'+file.link+'</a></td>\
			<td><span class="time-min">'+file.date+'</span></td>\
			</tr>';
			$('#dash > tbody').append(html);
			});
		}
		else
		{
			$('#dash > tbody').append('<tr><td colspan="4" class="empty">Seus Uploads estão vazios :( <a href="<?=$url?>"> Fazer Upload</a></td></tr>');
		}
		
	});
	</script>
	<body>
			        <ul class="cb-slideshow" style="z-index:-111111;list-style: none;">

        </ul>
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
								<a href="http://www.Ultra-configs.tk"><i class="fa fa-envelope"></i></a> 
							</span>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	<noscript><h1>Ative O Java Script!</h1></noscript>
	
			<div class="row" >
	<div class="col-sm-12 text">
	<div class="wrapper">
		<h2 style="color: #fff;">Olá ! Aqui poderás gerir os teus Arquivos! </h2><center><hr style="width:100px;"></center><h4 style="color: #fff;">O nosso sistema gerou-te uma intidade unica não poderás altera-la, assim não necessitas de te logar !</h4><p class="bg-primary">O identificador exclusivo é usado para manter seu histórico de upload. Se você limpar o cache do seu navegador, você pode perder todo o seu Historico de Upload.</p>
	</div>
	</div>
	</div>
	
	
	<!--
<div class="wrapper box">
		<h3>Tags</h3>
		<table id="tags" class="ui-min" style="width: 100%;">
			<thead>
				<tr>
					<th>Filename</th>
					<th>Size</th>
					<th>Link</th>
					<th>Expires</th>
					<th><a href="#" class="delete">&minus;</a></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
-->




<div class="container">	
		<div class="row" >
	<div class="col-sm-12 text">
<div class="wrapper box">
		<div class="table-bordered">
			<table id="dash" class="table table-hover ui-min">
			<thead>
				<tr>
					<th>Nome do Ficheiro</th>
					<th>tamanho</th>
					<th>Link</th>
					<th>Expira Dentro de</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		</div>

	</div>
	<br>
	<br>

		
	</div>
	<div class="col-sm-6 col-sm-offset-3">
		<table class="table table-bordered" style="background-color: #fff;border: rgba(222, 222, 222, 0) solid;border-radius: 10px;">
	<tbody>
	<center><h2 style="color: #fff;">Legenda</h2><hr style="width:100px;"><br></center>
							<tr>
							<th style="font-weight: 400;font-size: 18px;">PUBLICO</th>
							<td>
							<text class="legend"><span class="green">&bull;</span></text>
							
							
							</td>
							</tr>
							<tr>
							<th style="font-weight: 400;font-size: 18px;">Contem Password</th>
							<td>
							<span class="yellow">&bull;</span>
							
							
							</td>
							</tr>
							
							</td>
							</tr>
							<tr>
							
						<th style="font-weight: 400;font-size: 18px;">Arquivo Marcado</th>
							<td>
							
							<img src="images/flag.png" alt="flag" width="14" height="14"></img>
							</td>
							</tr>
							</tbody>

		</table>
		</div>
	</div>
	</div>



	
<div class="col-sm-10 col-sm-offset-1">	
	<div class="wrapper">

		<h3 class="id">	<p class="bg-primary">O seu identificador exclusivo é: <?=$uid?> </span> [<a title="O identificador exclusivo é usado para manter seu histórico de upload. Se você limpar o cache do seu navegador, você pode perder todo o seu Historico." href="#">?</a>]</p></h3>
	</div>
	</div><br>
	
	<div class="col-sm-10 col-sm-offset-1">	
	<hr>
	<div class="wrapper">
		<div class="footer" style="color: #fff;"><?=bitdropFooter?></div>
	</div>
	</div>
	
	
	</body>
</html>