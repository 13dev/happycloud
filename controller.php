<?php
/* File:	BitDrop - controller.php - v1.4
 * Date:	June 17, 2013
 * Copyright (C) 2013 by http://codeeverywhere.ca
 */
session_start();

require('bitdrop.class.php');

switch($_GET['method'])
{
	case "flag":
	if( $bitdrop->flag($_POST['shortURL']) )
		echo "O Arquivo {$_POST['shortURL']} for marcado.";
	else
		echo $bitdrop->errorMessage;;
	break;
	
	case "api":
	if( enableAPI )
		echo $bitdrop->getData('total');
	else
		echo '{ error : "api access disabled"}';
	break;
	
	case "delete":
	if( $_SESSION['auth'] !== true) { echo '{ error : "not authenticated" }'; break; }
	if( $bitdrop->delete($_POST['shortURL']))
		echo "O Arquivo {$_POST['shortURL']} For eliminado.";
	else
		echo $bitdrop->errorMessage;
	break;
	
	
	case "deleteAllExpired":
	if( $_SESSION['auth'] !== true) { echo '{ error : "not authenticated" }'; break; }
	if( $bitdrop->deleteAllExpired() )
		echo "Todos os arquivos expirados foram eliminados corretamente.";
	else
		echo $bitdrop->errorMessage;
	break;
	
	
	case "reset":
	if( $_SESSION['auth'] !== true) { echo '{ error : "not authenticated" }'; break; }
	if( $bitdrop->reset($_POST['shortURL']))
		echo "O Arquivo {$_POST['shortURL']} foi resetado.";
	else
		echo $bitdrop->errorMessage;
	break;
	
	
	case "logs":
	if( $_SESSION['auth'] !== true) { echo '{ error : "not authenticated" }'; break; }
	echo $bitdrop->getLog();
	break;
	
	
	case "history":
	if( $_SESSION['auth'] !== true) { echo '{ error : "not authenticated" }'; break; }
	echo $bitdrop->getLog($_POST['shortURL']);
	break;
	
	
	default:
	echo '{ error : "no method supplied"}';
}
?>