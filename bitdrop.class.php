<?php
require('config.inc.php');
function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}

class BitDrop
{
	public $filename 		= 'undefined';
	public $size  			= 'undefined';
	public $type 			= 'undefined';
	public $shortURL 		= 'undefined';
	public $uploadDate 		= 'undefined';
	public $expireDate 		= 'undefined';
	public $largePreview	= 'undefined';
	public $smallPreview	= 'undefined';
	public $fid 			= -1;
	public $views  			= 0;
	public $available		= 0;
	public $isLocked	 	= false;
	public $errorMessage 	= 'undefined';
	private $salt			= 'abc123def456';

	
	//--> Connects to DB
	private function connectDB()
	{
		try{
		    return new PDO('mysql:dbname='.dbname.';host='.dbhost, dbuser, dbpass);
		}
		catch (PDOException $e){
		    echo 'Connection failed: ' . $e->getMessage();
		}
	}
	
	
	private function log($action, $data)
	{
		$db = $this->connectDB();
		$ip = ip2long( $_SERVER['REMOTE_ADDR'] );
		$q = $db->prepare("insert into logs (date, action, ip, data) values (now(), ?, ?, ?);");
	    $q->bindParam(1, $action, PDO::PARAM_STR);
	    $q->bindParam(2, $ip, PDO::PARAM_INT);
	    $q->bindParam(3, $data, PDO::PARAM_STR);
	    if( $q->execute() )
	    	return true;
	    else
	    	return false;
	}
	
	public function getLog($s = null)
	{
		$db = $this->connectDB();
		
		if( is_null($s) )
			$q = $db->prepare("select id, date, action, ip, data from logs order by date desc limit 25;");
		else
		{
			$q = $db->prepare("select id, date, action, ip, data from logs where data like ? order by date desc;");
			$s = "%$s%";
			$q->bindParam(1, $s, PDO::PARAM_STR);
		}
	    $q->execute();
	    $res = $q->fetchAll(PDO::FETCH_ASSOC);
	    $json = '';
	    
	    foreach($res as $log)
	    {
		    $json[] = array(
		    	$log['id'],
		    	$log['date'],
		    	$log['action'],
		    	long2ip($log['ip']),
		    	json_decode( $log['data'], true )
			);
	    }
	    return json_encode($json);
	}
	
	
	private function addTag($name)
	{
		$db = $this->connectDB();
		
		//Find tag_id
		$q = $db->prepare("select tag_id from tags where tag_name = ?;");
	    $q->bindParam(1, $name, PDO::PARAM_STR);
	    $q->execute();
	    $row = $q->fetch(PDO::FETCH_ASSOC);
	    	    
	    if($row === false)
	    {
		    $q = $db->prepare("insert into tags (tag_name) values (?)");
			$q->bindParam(1, $name, PDO::PARAM_STR);
			$q->execute();
			return $db->lastInsertId();
	    }
	    else
	    {
		    return $row['tag_id'];
	    }
	}
	
	
	public function createUniqueID()
	{
		if( isset($_COOKIE['bitdrop']) )
		{
			return $_COOKIE['bitdrop'];			
		}
		else
		{			
			$db = $this->connectDB();
		
			//check if _$key exists in tags
			$res = $db->prepare("select count(tag_id) from tags where tag_name = ?");
			do
			{
				$key = md5(uniqid(rand(), true));				
				$res->execute(array("_$key"));
				$data = $res->fetch(PDO::FETCH_COLUMN, 0);
			}
			while($data[0] != 0);
			
			//"keyfound-$key;"
			$q = $db->prepare("insert into tags (tag_name) values (?);");
		    $tag = "_$key";
		    $q->bindParam(1, $tag, PDO::PARAM_STR);
		    $q->execute();
		    
		    $this->log('newUID', '{ "UID" : "'.$key.'"}');
		    $db = null;
		    	    
			//set $key as cookie
			setcookie("bitdrop", $key, time() + (3600*24*365*3) );
			
			return $key;
		}
	}
	
	
	//--> Creates the ShortURL
	private function shortURL()
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$len = strlen($chars);
		$hash = '';
		for($x=0; $x < shortURLSize; $x++)
    		$hash .= $chars[rand() % $len];
    	$blacklist = array('api', 'editor','dashboard','download','index','m','upload','view');
    	if( in_array($hash, $blacklist) )
    	    return $this->shortURL();
    	else
    		return $hash;
	}
	
	//--> Create image thumbnail
	private function createThumb($fid)
	{
       	if(!createThumbs) return false;
       	       	
       	$file = "../uploads/$fid.temp";
       	$types = array('image/gif', 'image/jpg', 'image/jpeg', 'image/png', 'image/JPG', 'image/pjpeg', 'image/GIF');
       	if($size = getimagesize($file) and $size and in_array($size['mime'], $types))
       	{
			switch($size['mime'])
			{
				case 'image/jpg': case 'image/jpeg': case 'image/pjpeg': case 'image/JPG':
				$src = imagecreatefromjpeg($file);
				break;
				case 'image/gif': case 'image/GIF':
				$src = imagecreatefromgif($file);							
				break;				
				case 'image/png':
				$src = imagecreatefrompng($file);
				break;
			}
			$width = $size[0];
			$height = $size[1];
			
			//Create thumbnail
			$maxwidth = 320;
			$maxheight = 240;
			while(($height/$width)*$maxwidth>$maxheight+1){ $maxwidth = $maxwidth - 1; }
			$newwidth=$maxwidth;
			$newheight=($height/$width)*$maxwidth;
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			$link = md5($salt . $fid . 'small');
			imagepng($tmp, "../previews/$link.png", 0);
			
			//Create preview
			$maxwidth = $width > 800 ? 800 : $width;
			$maxheight = $height > 800 ? 800 : $height;
			while(($height/$width)*$maxwidth>$maxheight+1){ $maxwidth = $maxwidth - 1; }
			$newwidth=$maxwidth;
			$newheight=($height/$width)*$maxwidth;
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			$link = md5($salt . $fid . 'big');
			imagepng($tmp, "../previews/$link.png", 0);
	
			imagedestroy($tmp);
       	}
	}
	
	//--> Uploads the file
	public function upload($uid = 'public')
	{
		//Get file details
		if(isset($_GET['ajax']))
		{
			if(!$_SERVER['HTTP_X_FILE_SIZE'] > 0) return false;
			
			$filename = strip_tags($_SERVER['HTTP_X_FILE_NAME']);
			$file_type = $_SERVER['HTTP_X_FILE_TYPE'];
			$size = round($_SERVER['HTTP_X_FILE_SIZE']/1000, 3);
		}
		else
		{
			if($_FILES["files"]["error"] > 0 or empty($_FILES)) return false;
			
			$filename = strip_tags($_FILES['files']['name']);
			$file_type = $_FILES['files']['type'];
			$size = round($_FILES['files']['size']/1000, 3);
		}
		
		//Check file size
		if($size > (maxFileSize/1000))
		{
			$this->errorMessage = "file too large"; 
			return false;
		}
		
		
		//Check file type
		if( limitFileTypes and !in_array($file_type, explode(',', allowedFileTypes)) )
		{
			$this->errorMessage = "file type not allowed";
			return false;
		}
				
		$db = $this->connectDB();
		
		$share = isset($_GET['ajax'])?$_SERVER['HTTP_BITDROPSHARE']:$_POST['bitdrop_share'];
		$share = ($share == 'true' || $share == 'share' )? 1 : 0;
				
		$password = isset($_GET['ajax'])?$_SERVER['HTTP_BITDROPPASS']:$_POST['bitdrop_password'];
		
		//Find an available shortURL
		$res = $db->prepare("select count(shortURL) from share where shortURL = ?;");
		do
		{
			$shortURL = $this->shortURL();
			$res->execute(array($shortURL));
			$data = $res->fetchAll(PDO::FETCH_COLUMN, 0);
		}
		while($data[0] != 0);
		
		$password = ( is_null($password) or strlen($password)==0 ) ? 0 : sha1($password . $shortURL) ;
		
		$q = "insert into details (date, name, size, type, public, password) values (now(), ?, ?, ?, ?, ?)";
		$data = array($filename, $size, $file_type, $share, $password);
		$res = $db->prepare($q);
		$res->execute($data);

		$fid = $db->lastInsertId();
		
		$q = "insert into share (shortURL, file_id) values (?, ?)";
		$data = array($shortURL, $fid);
		$res = $db->prepare($q);
		$res->execute($data);
		
		//Connect unique user to file
		$tid = $this->addTag("_$uid");
				
		$q = "insert into `fid-tid` (file_id, tag_id) values ('$fid', '$tid');";
		$res = $db->prepare($q);
		$res->execute();
	
		$file = "../uploads/$fid.temp";
		
		$this->log('upload', '{ "uid" : "'.$uid.'", "fid" : "'.$fid.'", "shortURL" : "'.$shortURL.'" }');
		
		$db = null;
		
		//Upload file
		if(isset($_GET['ajax']))
		{
			if(!isset($_SERVER['HTTP_X_FILE_NAME']) && !isset($_SERVER['CONTENT_LENGTH']))
			{
				$this->errorMessage = "no headers found"; 
				return false;
			} 
					    		
		   	$fileReader = fopen('php://input', "r");
		   	$fileWriter = fopen($file, "w+");
		
		   	while(true)
		   	{
		       	$buffer = fgets($fileReader, 4096);
		       	if(strlen($buffer) == 0)
		       	{
		           	fclose($fileReader);
		           	fclose($fileWriter);
		           	$this->createThumb($fid, $shortURL);
		           	$this->shortURL = $shortURL;
		           	return true;
		       	}
		       	fwrite($fileWriter, $buffer);
		   	}
		}
		else
		{
		    move_uploaded_file($_FILES["files"]["tmp_name"], $file);
		    $this->createThumb($fid, $shortURL);
		    $this->shortURL = $shortURL;
		    return true;
		}
	}
	
	
	//--> View The File Info
	public function view($shortURL, $password = '')
	{			
		//If $shortURL is empty, return FALSE
		if(empty($shortURL))
		{
			$this->errorMessage = "shortURL not supplied"; 
			return false;
		}
		
		//Connect to database
		$db = $this->connectDB();
				
		//Update the number of file views
		$res = $db->prepare("update details natural join share set views = views + 1 where shortURL = ?;");
		
		//If $shortURL is not found return FALSE
		if( !$res->execute(array($shortURL)) )
		{
			$this->errorMessage = "Arquivo Não encontrado.";
			return false;
		}
		
		//Get file data
		$q = "select details.file_id as fid, unix_timestamp(date) as upload_date, name, size, type, views, deleted, flag, password FROM details natural join share where shortURL = ? and deleted = 0;";
		$res = $db->prepare($q);		
		$res->execute(array($shortURL));
		$data = $res->fetch(PDO::FETCH_ASSOC, 0);
		$db->query("update details set last_access_date = now() where file_id = {$data['fid']};");
		$db = null;
		
		if(blockOnFlag and $data['flag'] )
		{
		    $this->errorMessage = "Este arquivo foi marcado.";
		    return false;
		}
		
		if($data['deleted'] or !file_exists("../uploads/{$data['fid']}.temp"))
		{
			$this->errorMessage = "Este Aquivo Foi eliminado.";
			return false;
		}
				
		//If file is expired return FALSE
		if(expireTime != 0 and (date("U") - $data['upload_date']) > expireTime)
		{
			$this->errorMessage = "Este Arquivo expirou.";
			return false;
		}
				
		//Check password match	
		$password = ( is_null($password) or strlen($password)==0 ) ? '0' : sha1($password . $shortURL) ;		
		 if( $password != $data['password'] )
		 {		   	
		   	$this->errorMessage = "Password Incorreta";
	    	$this->filename = urldecode( $data['name'] );
	    	$this->isLocked = true;
	    	$this->shortURL = $shortURL;
	    	return false;
		}
		
		if( (maxAllowedDownloads != 0) and ($data['views'] > maxAllowedDownloads) )
		{
			$this->errorMessage = "O Maximo de visualizações foi atingido";
			return false;
		}
		
		//Preview image
		$img_types = array('image/gif', 'image/jpg', 'image/jpeg', 'image/png', 'image/JPG', 'image/pjpeg', 'image/GIF');
		if(createThumbs && in_array($data['type'], $img_types))
		{
			$this->largePreview = "previews/" . md5($salt . $data['fid'] . 'big') . ".png";
			$this->smallPreview = "previews/" . md5($salt . $data['fid'] . 'small') . ".png";
		}
		else
		{
			//->Get File Icon
			switch($data['type'])
			{
				case "image/png": $image = "icon-png"; break;
				case "image/jpg": case "image/jpeg": $image = "icon-jpg"; break;
				case "audio/mp3": $image = "icon-mp3"; break;
				case "video/mp4": $image = "icon-movie"; break;
				default: $image = "icon-etc";
			}
			$icon = 'images/'.$image.'.png';
			$this->smallPreview = $icon;
			$this->largePreview = $icon;
		}
		
		//Load data into variables
		$this->filename = urldecode( $data['name'] );
		$this->fid = $data['fid'];
		$this->type = $data['type'];
		$this->size = $data['size'];
		$this->uploadDate = date('Y-m-d H:i:s', $data['upload_date']);
		$this->expireDate = date('Y-m-d H:i:s', $data['upload_date'] + expireTime);
		$this->views = $data['views'];
		$this->available = (maxAllowedDownloads == 0)? 0 : maxAllowedDownloads - $data['views'];
		$this->shortURL = $shortURL;
		return true;
	}

	//-->Push file to the user
	public function download($shortURL, $password = '')
	{
		if( empty($shortURL) ) return false;
		
		//Stop HotLinking!, check URL Referrer
		$home = parse_url(URLPrefix."://".yourURL);
		$ref = parse_url($_SERVER['HTTP_REFERER']);
		
		if(hotLinkProtection and strcasecmp($home['host'], $ref['host']) != 0)
		{
			header('Location: '.URLPrefix.'://'.yourURL);
			return false;
		}
		
		if( !$this->view($shortURL, $password) ) return false;		
				
		//Push file to user
		header("Content-type: application/force-download");
		header("Content-Transfer-Encoding: Binary");
		header("Content-length: ".filesize("../uploads/{$this->fid}.temp"));
		header("Content-disposition: attachment; filename=\"".urldecode(basename($this->filename))."\"");
		readfile("../uploads/{$this->fid}.temp");
		return true;
	}
	
		
	//-->Delete a file
	public function delete($shortURL)
	{
		//If $id is empty return false;
		if(empty($shortURL)) return false;
				
		$db = $this->connectDB();
		
		//Check if uid access fid
		/*
		$q = "select count(*) from `fid-uid` where user_id = $uid and file_id = $fid;";
		$res = $db->prepare($q);
		$res->execute();
		$c = $res->fetch(PDO::FETCH_COLUMN);
		
		if( $uid != -1 and $c['count(*)'] == 0)
		{
			$this->errorMessage = "file_id not connected to user_id."; 
			return false;
		}*/
		
		//Remove from database
		$res = $db->prepare("select file_id from share where shortURL = :1;update details natural join share set deleted = 1 where shortURL = :1");
		$res->bindParam(':1', $shortURL);
		$res->execute();
		$fid = $res->fetch(PDO::FETCH_COLUMN);
		
		
		//If file doesn't exist, return FALSE
		if(!file_exists("uploads/$fid.temp"))
		{
			$this->errorMessage = "file $fid.temp does not exist on server"; 
			return false;
		}
		
		//Delete the previews
		$file1 = md5($salt . $fid . 'small');
		$file2 = md5($salt . $fid . 'big');
		
		if(file_exists("previews/$file1.png") && file_exists("previews/$file2.png"))
		{
			unlink("previews/$file1.png");
			unlink("previews/$file2.png");
		}
		
		$this->log('delete', '{ "fid" : "'.$fid.'", "shortURL" : "'.$shortURL.'" }');
		
		$db = null;
		
		//Delete the file
		return unlink("uploads/$fid.temp");
	}
	
	
	//-->Delete expired files
	public function deleteAllExpired()
	{				
		if(expireTime == 0)
		{
			$this->errorMessage = "files never expire";
			return false;
		}
		
		$db = $this->connectDB();
		
		$res = $db->prepare("select file_id from details where deleted = 0 and (unix_timestamp(now()) - unix_timestamp(date) > ".expireTime.");");
		
		$res->execute();
		$list = $res->fetchAll(PDO::FETCH_COLUMN);
		
		$res = $db->prepare("update details set deleted = 1 where(unix_timestamp(now()) - unix_timestamp(date) > ".expireTime.");");
		$res->execute();
		
		foreach($list as $fid)
		{
			//If file exist
			if(file_exists("uploads/$fid.temp"))
				unlink("uploads/$fid.temp");
			
			//Delete the previews
			$file1 = md5($salt . $fid . 'small');
			$file2 = md5($salt . $fid . 'big');
			
			if(file_exists("previews/$file1.png") && file_exists("previews/$file2.png"))
			{
				unlink("previews/$file1.png");
				unlink("previews/$file2.png");
			}
		}
		
		$this->log('deleteExpired', '{ }');
		
		$db = null;
		
		return true;
	}
	

	//-->Reset date
	public function reset($shortURL)
	{
		$db = $this->connectDB();
		
		$res = $db->prepare("update details natural join share set date = now() where shortURL = ?;");
		$res->bindParam(1, $shortURL);
		
		$this->log('dateReset', '{ "shortURL" : "'.$shortURL.'" }');
		
		$db = null;
		
		if($res->execute())
			return true;
		else
			return false;
	}


	//--Flag a file
	public function flag($shortURL)
	{
		$db = $this->connectDB();
		
		$q = "update details natural join share set flag = 1 where shortURL = ?;";
		
		$res = $db->prepare($q);
		$res->bindParam(1, $shortURL);
		$res->execute();
		
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$this->log('flag', '{ "shortURL" : "'.$shortURL.'", "user_agent" : "'.$agent.'" }');
		
		$db = null;
		
		return true;
	}
	

	//-->Get file data
	public function getData($type, $data = null)
	{
		$db = $this->connectDB();
		
		switch($type)
		{
			case "recent":			
			if(expireTime == 0)
				$q = $db->prepare("select name, date + interval ".expireTime." second as date, shortURL 
				from details natural join share where deleted = 0 and public = 1 order by date desc limit 25;");
			else
				$q = $db->prepare("select name, date + interval ".expireTime." second as date, shortURL 
				from details natural join share where deleted = 0 and public = 1 
				and (unix_timestamp(now()) - unix_timestamp(date) <= ".expireTime.") order by date desc limit 25;");
			break;
			
			
			case "popular":
			if(expireTime == 0)
				$q = $db->prepare("select name, views, shortURL 
				from details natural join share where deleted = 0 and public = 1 order by views desc limit 25;");
			else
				$q = $db->prepare("select name, views, shortURL 
				from details natural join share where deleted = 0 and public = 1 
				and (unix_timestamp(now()) - unix_timestamp(date) <= ".expireTime.") order by views desc limit 25;");
			break;
			
			
			case "dash":
			$q = $db->prepare("select name, views, size, shortURL as link, date + interval ".expireTime." second as date, flag, public, if(password = '0', 0, 1) as password from details natural join share natural join `fid-tid` natural join tags where deleted = 0 and tag_name = ? order by date desc;");
			$data = "_$data";
			$q->bindParam(1, $data);
			break;
			
			
			case "admin":
			$q = $db->prepare("select name, views, size, shortURL as link, date + interval ".expireTime." second as date, flag, public, if(password = '0', 0, 1) as password from details natural join share where deleted = 0 order by flag desc, date desc;");
			break;
			
			
			case "total":
			$q = $db->prepare("select count(file_id) as count, sum(size) as sum from details where deleted = 0;");
			break;
			
				
			case "tags":
			$query = "";
			$q->bindParam(1, $data);
			break;
		}
				
		if( $q->execute() )			
			return json_encode( $q->fetchAll(PDO::FETCH_ASSOC) );
		else
			return "{ }";
	}		
}
$bitdrop = new BitDrop();
?>