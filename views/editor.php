<?php
session_start();

include('../bitdrop.class.php');

if(isset($_POST['submit']) and isset($_POST['password']) and $_POST['password'] == editorPass){ $_SESSION['auth'] = true; }

if( isset($_GET['logout']) ){ $_SESSION['auth'] = false; session_destroy(); }

if(!isset($_GET['logout']) and $_SESSION['auth'] == true):
?>
<!DOCTYPE html>
<html>
	<head>
	 <meta charset="utf-8">
		<title>Painel de Controlo - <?=serviceName?></title>
		<link rel="shortcut icon" href="assets/ico/logof.ico">
		<link rel="stylesheet" type="text/css" href="css/bitdrop.css" />
		<link rel="stylesheet" type="text/css" href="css/ui.css" />
		<script type="text/javascript" src="js/numericalize.js"></script>
		        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/build.css">
		        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>
	</head>
	
	<script type="text/javascript">
	$(function()
	{
		var html;
		$.each($.parseJSON('<?=$bitdrop->getData('admin')?>'), function(i, file)
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
			<td>\
			<a href="#" title="Mostrar Historico do ShorURL " class="showHistory" style="color: rgba(29, 222, 206, 0.5);font-size: 30px;">?</a>\
			<a href="#" title="Resetar o Tempo de expiração"  style="color: rgba(29, 222, 54, 0.5);font-size: 30px;" class="reset">&plus;</a>\
			<a href="#" title="Eliminar"  style="color: rgba(222, 29, 29, 0.5);font-size: 30px;" class="delete">&times;</a>\
			</td>\
			</tr>';
		$('#admin > tbody').append(html);
		}); 
		
		var json = $.parseJSON('<?=$bitdrop->getData('total')?>');
		$('#admin-files').text(json[0].count + ' Ficheiros');		
		$('#admin-size').text(json[0].sum);
		
		//--
		$('.delete').click(function(e)
		{
			e.preventDefault();
			var row = $(this).parent().parent();
			row.css('background', '#efc223');
			$.ajax({
				type: "POST",
				url: 'controller.php?method=delete',
				data: 'shortURL=' + $('td:nth-child(3)', row).text(),
				success: function(response)
				{
					console.log( response );
					row.css('background', '#FF6666');
					row.fadeOut(250, function(){ $(this).remove() });
				}
			});
		});
		//--
		
		//--
		$('.deleteAllExpired').click(function(e)
		{
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: 'controller.php?method=deleteAllExpired',
				success: function(response)
				{
					console.log(response);
					location.reload();
				}
			});
		});
		//--
		
		//--
		$('.reset').click(function(e)
		{
			e.preventDefault();
			var row = $(this).parent().parent();
			row.css('background', '#efc223');
			$.ajax({
				type: "POST",
				url: 'controller.php?method=reset',
				data: 'shortURL=' + $('td:nth-child(3)', row).text(),
				success: function(response)
				{
					console.log( response );
					row.css('background', 'none');
					$('td:nth-child(4)', row).html('<span class="ui-label-green">Atualizado</span>');
				}
			});
		});
		//--
		
		
		//--
		$('.history').hide();
		$('.showHistory').click(function(e)
		{
			$('.history tbody').empty();
			e.preventDefault();
			var row = $(this).parent().parent();
			$.ajax({
				type: "POST",
				dataType: "json",
				url: 'controller.php?method=history',
				data: 'shortURL=' + $('td:nth-child(3)', row).text(),
				success: function(res)
				{
					var html, temp;
					$.each(res, function(i, k)
					{
						html += '<tr>';
						$.each(k, function(x, e)
						{
							if(typeof e === 'object')
							{
								temp = '';
								$.each(e, function(i){ temp += i +' : '+ e[i] + '<br/>' ; });
								e = temp;
							}
							html += '<td>' + e + '</td>';
						});
						html += '<tr>';
					});
					$('.history tbody').append(html);
					$('.history').slideDown(500);
				}
			});
		});
		//--
		
		
		//--
		$('.logs').hide();
		$('.showLogs').click(function(e)
		{
			$('.logs tbody').empty();
			e.preventDefault();
			$.ajax({
				dataType: "json",
				url: 'controller.php?method=logs',
				success: function(res)
				{
					var html, temp;
					$.each(res, function(i, k)
					{
						html += '<tr>';
						$.each(k, function(x, e)
						{
							if(typeof e === 'object')
							{
								temp = '';
								$.each(e, function(i){ temp += i +' : '+ e[i] + '<br/>' ; });
								e = temp;
							}
							html += '<td>' + e + '</td>';
						});
						html += '<tr>';
					});
					$('.logs tbody').append(html);
					$('.logs').slideDown(500);
				}
			});
		});
		//--
		
	});
	
	</script>
	<body>
				        <ul class="cb-slideshow" style="z-index:-111111;list-style: none;">
        </ul>
	<noscript><h1>Ativa o Javascript</h1></noscript>
	
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
					<a href="<?=URLPrefix?>://<?=yourURL?>"><span class="li-text" ><img class="shake" src="images/logo.png" width="260"></a>
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

			
			        <div class="top-content">
   
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text">
						<h1>Comandos</h1>
						<hr>
		<div class="col-md-6">
				<a href="editor" class="btn btn-success btn-block btn-lg" ><span class="glyphicon glyphicon-refresh"></span> Atualizar</a>
				<a href="#" class="btn btn-info btn-block btn-lg showLogs"><span class="glyphicon glyphicon-eye-open"></span> Mostar Logs</a>
				</div>

				<div class="col-md-6">
				<a href="#" class="btn btn-danger btn-block btn-lg deleteAllExpired" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> Eliminar Arquivos Expirados</a>
				<a href="?logout" class="btn btn-warning btn-block btn-lg"><span class="glyphicon glyphicon-log-out"></span> Sair</a>
				<br>
				</div>
	
	
		<h1><?=serviceName?> Tem  <span id="admin-files">X Ficheiros</span> Com total de <span id="admin-size" class="data">0</span>.</h1>

<hr>


	<div class="panel panel-primary">
  <div class="panel-heading">ARQUIVOS</div>
  <div class="panel-body">		

			<table id="admin" class="table table-striped" style="color: #808080;">
			<thead>
			<tr>
					<th style="text-align: center;">Nome</th>
					<th style="text-align: center;">Tamanho</th>
					<th style="text-align: center;">Link</th>
					<th style="text-align: center;">Expira em</th>
					<th style="text-align: center;">Opções</th>
				</tr>
			</thead>

			<tbody>
			<!--
			<tr>
						<td><a href="#" class="showHistory">?</a></td>
						<td><a href="#" class="reset">&plus;</a></td>
						<td><a href="#" class="delete">&times;</a></td>
					
				</tr> -->
			</tbody>
		</table>
		
		<hr/>
		<p class="legend">Legenda: 
			<span class="green">&bull;</span> Publico | 
			<span class="yellow">&bull;</span> Comtem Password | 
			<img src="images/flag.png" alt="flag" width="14" height="14"> Marcado
		</p>
		
	</div>
</div>


	
	
	<div class="history wrapper box"  style="color: #808080;">
		<h3>Histórico de ShorURL</h3>
		<table class="ui-min">
			<thead>
				<tr>
					<th style="text-align: center;">ID</th>
					<th style="text-align: center;">Data</th>
					<th style="text-align: center;">Ação</th>
					<th style="text-align: center;">IP</th>
					<th style="text-align: center;">Data</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
	

	<div class="logs wrapper box"  style="color: #808080;">
		<h3>Logs Recentes (Ultimos 25)</h3>
		<table class="table table-striped">
			<thead>
				<tr>
					<th style="text-align: center;">ID</th>
					<th style="text-align: center;">Data</th>
					<th style="text-align: center;">Ação</th>
					<th style="text-align: center;">IP</th>
					<th style="text-align: center;">Data</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
	
	
	<div class="wrapper">
		<div class="footer"><?=bitdropFooter?></div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	
	</body>
</html>

<?php else: ?>

<!DOCTYPE html>
<html>
	<head>
	 <meta charset="utf-8">
		<title>Painel de Controlo - <?=serviceName?></title>
		<link rel="shortcut icon" href="assets/ico/logof.ico">
		<link rel="stylesheet" type="text/css" href="css/bitdrop.css" />
		<link rel="stylesheet" type="text/css" href="css/ui.css" />
		        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/build.css">
		        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>
	</head>
	<body>
	
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
					<a href="<?=URLPrefix?>://<?=yourURL?>"><span class="li-text" ><img class="shake" src="images/logo.png" width="260"></a>
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
	
				        <div class="top-content">
   
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text">
		<h1>Bem Vindo a <?=serviceName?> Painel de Controlo, Por Favor faça o login.</h1><hr>
	
		<div class="panel panel-primary">
  <div class="panel-heading">ENTRAR</div>
  <div class="panel-body">		

		<?php 
			if( isset($_GET['logout']) ) { echo '<div class="alert alert-success"><strong>Sucesso!</strong> Log Out Foi efetuado com sucesso!</div><hr/>'; }
			if( isset($_POST['submit']) ) { echo '<div class="alert alert-danger"><strong>Erro!</strong> A Password intruduzida esta incorreta!</div><hr/>'; }
		?>
		<div class="form-group" align="center">
		<form action="editor" method="post" style="color:#808080;" >
		<strong>Password:</strong>
			<input type="password" name="password" class="form-control input-lg" style="width: 30%;" Placeholder="Password" />
			<input type="submit" name="submit" value="Entrar" style="width: 20%;" class="btn btn-success btn-block btn-lg" />
		</form>
		<hr/>
	</div>
	</div>
	</div>
	
	
	<div class="wrapper">
		<div class="footer"><?=bitdropFooter?></div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	
	</body>
</html>

<?php endif; ?>