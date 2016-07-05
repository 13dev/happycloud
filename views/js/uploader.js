
var toggle = function(){
	var disp = document.getElementById('bitdrop-options').style.display;
		
	(disp == 'none' || disp.length == 0)?
	document.getElementById('bitdrop-options').style.display = 'block':
	document.getElementById('bitdrop-options').style.display = 'none';
};


try
{
	if(navigator.appVersion.indexOf("MSIE") != -1)
		throw "IE - Use Fallback";
    
    var xhr = new XMLHttpRequest();
    if (xhr.onload !== undefined && xhr.addEventListener !== undefined)
    {
    	//Browser supports W3C Progress Events
			var clickk = function(){
			
			
			function clearFileInput(ctrl) {
  try {
    ctrl.value = null;
  } catch(ex) { }
  if (ctrl.value) {
    ctrl.parentNode.replaceChild(ctrl.cloneNode(true), ctrl);
  }
}

	document.getElementById('titulo').innerHTML = 'O Teu Arquivo Está a ser enviando...';
	clearFileInput(document.getElementById("files"));
	
	
	};
        var upload = function()
        {
        	document.getElementById('form').setAttribute('onsubmit', 'return false');
        	
        	var e = document.getElementById('files');
            var url = "upload.php?ajax";
            var share = document.getElementsByName('bitdrop_share')[0];            
            var password = document.getElementsByName('bitdrop_password')[0];
            var file = e.files[0];
            
            //if file is empty, return false;
            if(e.files[0] == undefined)
            {
            	alert('Selecione Um Arquivo!');
				
            	return false;
            }
            
            //file size to large
            var max = document.getElementsByName("MAX_FILE_SIZE");
        	if(file.size > max[0].value)
        	{
        		alert('O Arquivo é muito grande, Por-favor, selecione outro.');
        		return false;
        	}
        	
        	$('.view-form').fadeOut(500, function(){
	        	$('.view-progress').fadeIn(300);	
        	});
            
            //document.getElementById('submit_btn').setAttribute('value', 'Uploading..');

            xhr.file = file;
            xhr.addEventListener('progress', function(e)
            {
            	var done = e.position || e.loaded, total = e.totalSize || e.total;            	
            	
            }, false);
            
            if(xhr.upload)
            {
            	xhr.upload.onprogress = function(e)
            	{
            		var done = e.position || e.loaded, total = e.totalSize || e.total;
            		var width = (Math.floor(done / total * 100)) * 3.3;

            		//Move up progress bar
            		//document.getElementById('progress_done').style.width = width + 'px';
					document.getElementById('barra').style.width = (Math.floor(done / total * 1000) / 10) + '%';
            		//document.getElementById('num').innerHTML = (Math.floor(done / total * 1000) / 10) + '%';
					document.getElementById('num').innerHTML = (Math.floor(done / total * 1000) / 10) + '%';
                };
            }
            
            xhr.onreadystatechange = function(e)
            {
            	if(4 == this.readyState)
            	{
                    document.getElementById('barra').style.width = '100%';
                    document.getElementById('num').innerHTML = this.responseText;
                    document.getElementById('submit_btn').setAttribute('value', 'Enviar');
					document.getElementById('titulo').innerHTML = 'O seu arquivo foi enviado com sucesso!';
                }
            };

                xhr.open('POST', url, true);
                xhr.setRequestHeader("Content-Type", "application/octet-stream");
                xhr.setRequestHeader("Cache-Control", "no-cache");
                xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                xhr.setRequestHeader("X-File-Name", encodeURIComponent(file.name));
                xhr.setRequestHeader("X-File-Size", file.size);                
                xhr.setRequestHeader("X-File-Type", file.type);
                xhr.setRequestHeader("BitDropPass", encodeURIComponent(password.value));
                xhr.setRequestHeader("BitDropShare", encodeURIComponent(share.checked));
                xhr.send(file);
            };
    }
    else
    {
    	throw 'Run Fallback';
    }
}
catch(e)
{
	//Fallback, use iframe method	
	window.onload = function()
	{		
		if(	navigator.appVersion.indexOf("MSIE 7") != -1 ||
			navigator.appVersion.indexOf("MSIE 6") != -1 ||
			navigator.appVersion.indexOf("MSIE 5") != -1  )
			{
				document.getElementById('progress_outline').style.display = 'none';
				document.getElementsByTagName('iframe')[0].style.display = 'block';
			}
	}

	
	
	

	var upload = function()
	{
		document.getElementById('form').setAttribute('onsubmit', 'return false');
		var e = document.getElementById('files').value;		
		if(e.length == 0)
		{
          	alert('Por favor Selecione Um arquivo');
           	return false;
         }
         
        //file size to large
        var max = document.getElementsByName("MAX_FILE_SIZE");
       	if(e.size > max[0].value)
       	{
       		alert('O Arquivo é muito grande, Por-favor, selecione outro.');
       		return false;
       	}
       	
       	$('.view-form').fadeOut(500, function(){
	        	$('.view-progress').fadeIn(300);	
        	});
		
		document.getElementById('progress_bar').style.backgroundColor = '#e6e6e6';
		document.getElementById('submit_btn').setAttribute('value', 'Uploading..');
		
		document.getElementById('form').setAttribute('target', 'iframe');
		document.getElementById('num').innerHTML = '<img src="images/ajax-loader.gif" alt="ajax-loader" width="16" height="11" /> Uploading...';
		
		
		document.getElementsByTagName('iframe')[0].setAttribute('onload', 'uploaded();');
		form.submit();
	};

    var uploaded = function()
    {
       	document.getElementById('progress_bar').style.backgroundColor = '#e7f6e2';
		
    	var shortURL = window.frames['iframe'].document.getElementsByTagName('body')[0].innerHTML;
    	
    	if( shortURL.length == 0 )
    	{
    		document.getElementById('progress_bar').style.backgroundColor = '#d56a68';
    		document.getElementById('num').innerHTML = 'Desculpe ouve um problema com o carregamento...';
    	}
    	else
    	{
    		document.getElementById('num').innerHTML = shortURL;
			document.getElementById('titulo').innerHTML = 'O seu arquivo foi enviado com sucesso!';
		
    	}
    };
}