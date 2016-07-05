<?php
/* File:	BitDrop - download.php - v1.4
 * Date:	June 17, 2013
 * Copyright (C) 2013 by http://codeeverywhere.ca
 */

//Include BitDrop class
include('../bitdrop.class.php');

//If shortURL is not set or the file cannot be downloaded, show an error
if( empty($_GET['shortURL']) or !$bitdrop->download($_GET['shortURL'], $_POST['password']))
{
	echo '<html>
		<head>
			<link rel="stylesheet" type="text/css" href="../css/bitdrop.css" />
			<link rel="stylesheet" type="text/css" href="../css/ui.css" />
		</head>
		<body>
		<div class="wrapper box full">
			<p class="ui-message-red">'.$bitdrop->errorMessage.'</p>
			<hr/>
			<a class="ui-button-white" href="'.URLPrefix.'://'.yourURL.'/'.$_GET['shortURL'].'">&larr; go back</a>
		</div>
		</body>
	</html>
	';
}
?>