<?php
/* File:	BitDrop - upload.php - v1.4
 * Date:	June 17, 2013
 * Copyright (C) 2013 by http://codeeverywhere.ca
 */

include("../bitdrop.class.php");

//Upload the file
if( $bitdrop->upload( $bitdrop->createUniqueID() ) )
	echo '<a href="'.URLPrefix.'://'.yourURL.'/'.$bitdrop->shortURL.'" Style="color:#fff;">'.URLPrefix.'://'.yourURL.'/'.$bitdrop->shortURL.'</a>';
else
	echo $bitdrop->errorMessage;
?>