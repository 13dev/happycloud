<?php

include('../bitdrop.class.php');
include('../urlgogle.php');
$url = "http://happycloud.ddns.net/";
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Happy Cloud </title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
		
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

    </head>

    <body>
		     
<script type="text/javascript">
	if ( navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|Android)/i) ){ location.replace("m/<?=$_GET['shortURL']?>"); }
	/*
	//=====
	jQuery.fn.lightbox = function () {
    var close = function () {
        $('.ui-lightbox').fadeOut(500, function () {
            $('.ui-backdrop, .ui-backdrop-light').fadeOut(200, function () {
                $(this).remove();
                $(document).off('keydown');
                $(window).off('resize');
            });
        });
    };

    var resize = function (event) {
        var maxw = ($(window).width() - 75 < 100) ? 100 : $(window).width() - 75,
            maxh = ($(window).height() - 75 < 100) ? 100 : $(window).height() - 75,
            height = event.data.height,
            width = event.data.width,
            ratio = maxh / maxw;

        if (height / width > ratio) {
            if (height > maxh) {
                width = Math.round(width * (maxh / height));
                height = maxh;
            }
        } else {
            if (width > maxw) {
                height = Math.round(height * (maxw / width));
                width = maxw;
            }
        }
        $('.ui-lightbox > img').attr({ width: width, height: height });
        $('.ui-lightbox').css({ 'width': width, 'height': height });
    };


    var open = function(a)
    {
        $('body').prepend('<div class="ui-backdrop"><div class="ui-lightbox"><a class="ui-lightbox-close">&#215;</a>Loading...</div></div>');

        $('.ui-close').click(function (e) {
            e.preventDefault();
            close();
        });

        var img = new Image();
        img.onload = function () {
            $('.ui-lightbox')
                .empty()
                .append('<a class="ui-lightbox-close" href="#">&#215;</a>')
                .append('<img src="' + img.src + '" alt="" width="' + this.width + '" height="' + this.height + '" />');

            $('.ui-lightbox-close').click(function (e) {
                e.preventDefault();
                close();
            });

            $(window).on('resize.cssui', {
                    width: this.width,
                    height: this.height
                }, resize);
            $(window).trigger('resize.cssui');
            
        };
        img.src = $(a).attr('href');
        
        $('.ui-backdrop, .ui-backdrop-light').fadeIn(250, function () {
            $('.ui-lightbox').fadeIn(100);
        });

        $(document).on('keydown', function (e) {
            switch (e.which) {
	            case 37: console.log("left"); break;
	            case 39: console.log("right"); break;
	            case 27: console.log("esc"); close(); break;
            }
            return false;
        });
    };

    $.each($(this), function(a, k)
    {
        $(k).click(function(e){ e.preventDefault(); open(k); });
    });
    return this;
	};
	//=====

	$(function()
	{
		$('.flag').click(function(e)
		{
			e.preventDefault();
			$.ajax({
					type: "POST",
					url: 'controller.php?method=flag',
					data: 'shortURL=' + $(this).attr('data-file'),
					success: function(response){ $('.flag').html(' <span class="flag">Ficheiro foi marcado.</span>'); }
			});
		});
		$('a.preview').lightbox();
	});*/
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
					<span class="li-text" style="font-size: 32px;"><img src="images/logo.png" style="padding: 10px 10px 10px;padding-top: 0px;">
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

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text">
                            <h1>Informações  do Arquivo - <?=$_GET['shortURL']?></h1>
                            <div class="description">
                            </div>
                            <div class="top-big-link">
								<?php if( $bitdrop->view($_GET['shortURL'], $_POST['password'])): ?>
									<div class="wrapper center">
									<a href="<?=$bitdrop->largePreview?>" class="preview">
										<img src="<?=$bitdrop->smallPreview?>" />
									</a>
								</div>
                            

								
		<div class="wrapper box">		
			<div class="col-sm-9 text">

				<h3>DETALHES</h3>
				<table class="table table-bordered" style="width: 100%;">
					<tbody>
						<tr>
							<th style="font-weight: 400;font-size: 18px;">Nome</th>
							<td><?=$bitdrop->filename?> <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="padding: 5px 3px 4px;"></span><?=$bitdrop->views?></td>
						</tr>
						<tr>
							<th style="font-weight: 400;font-size: 18px;">Tamanho</th>
							<td><span class="data"><?=$bitdrop->size?></span></td>
						</tr>
						<tr>
							<th style="font-weight: 400;font-size: 18px;">Expira dentro de </th>
							<td><span class="time"><?=$bitdrop->expireDate?></span></td>
						</tr>
						<tr>
							<th style="font-weight: 400;font-size: 18px;">Nº Possiveis de Visualizações</th>
							<td><?=$bitdrop->available?></td>
						</tr>
						<tr>
							<th style="font-weight: 400;font-size: 18px;">Opções</th>
							<td>	
								<a href="download.php?shortURL=<?=$bitdrop->shortURL?>" class="btn btn-link-1">Download</a>
								<span class="red">&bull;</span><a href="#" class="flag" data-file="<?=$bitdrop->shortURL?>"> Marcar</a>
							</td>
							<tr>
						<th style="font-weight: 400;font-size: 18px;">Url by Google</th>
							<td>	
				
								<?php
								$shortDWName = $googer->shorten(URLPrefix.'://'.yourURL.'/'.$bitdrop->shortURL);
								  $g = $shortDWName;
							
								?>
								<a href="<?=$g?>" style="color:#fff;"><?=$g?></a>
		
								
								
							</td>
							</tr>
						</tr>
					</tbody>
				</table>
				<script> document.title = '<?=$bitdrop->filename?>'; </script>
			</div>
		
			<div class="right halfminus">
				<h3>QR CODE</h3>
				<img src="http://chart.apis.google.com/chart?cht=qr&chs=200x200&chl=<?=URLPrefix.'://'.yourURL.'/'.$bitdrop->shortURL?>" />
			</div>
		
			<div class="clear"></div>
		</div>
	<?php elseif($bitdrop->isLocked): ?>
		
		<div class="wrapper box full">
			<div class="panel panel-primary">
				  <div class="panel-heading"><h4>O Arquivo <?=$bitdrop->filename?> está Protegido.</h4></div>
				  <div class="panel-body">
							<form action="views/download.php?shortURL=<?=$bitdrop->shortURL?>" method="post" >
								<h1 class="ui-message-yellow"></h1>
								<center><strong style="color: #19B9E7;">Introduza a Password:<input type="password" name="password" class="form-control" placeholder=" Password" style="width: 20%;"></strong></center>
								<br><button type="submit" class="btn" > <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download</button><br><br>
							</form> 
							<hr>  
				  </div>
				</div>

			
		</div>
		
	<?php else: ?>
		
		<div class="wrapper box full">
			<p class="ui-message-red"><?=$bitdrop->errorMessage?></p>
		</div>
	
	<?php endif; ?>

	
	<div class="wrapper">
		<div class="footer"><?=bitdropFooter?></div>
	</div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>




    </body>

</html>