/* File:	BitDrop - numericalize.js - v1.4
 * Date:	June 17, 2013
 * Copyright (C) 2013 by http://codeeverywhere.ca */
var format_time = function(timestamp, size)
{
	var timeZoneOffset = 3;//in hours
	var t = timestamp.split(/[- :]/);
	timestamp = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
	timestamp.setHours( timestamp.getHours() + timeZoneOffset );
	var diff = Math.floor((new Date() - timestamp) / 1000);
	if(Math.abs(diff) < 60) return "Agora";
	//return (diff < 0)? 'in ' + seconds2time(-diff, size) : seconds2time(diff, size) + ' ago';
	return (diff < 0)? 'in ' + seconds2time(-diff, size) : '<span class="ui-label-red">Expirado</span>';
}

var seconds2time = function(timer, size)
{	
	var weeks = Math.floor(timer/604800);
	timer -= (weeks*604800);
	var dias = Math.floor(timer/86400);
	timer -= (dias*86400);
	var hours = Math.floor(timer/3600);
	var minutes = Math.floor((timer - (hours * 3600)) / 60);
	var buffer = '';

	if(size == "L")
	{
		if(weeks > 1)	buffer += weeks + ' semanas ';
		if(weeks == 1)	buffer += ' semana ';
		if(dias > 1)	buffer += dias + ' dias ';
		if(dias == 1)	buffer += dias +' dia ';
		if(hours > 1)	buffer += hours + ' horas ';
		if(hours == 1)	buffer += hours + ' hora ';
		if(minutes > 1)	buffer += minutes + ' minutos ';
		if(minutes == 1)buffer += minutes + ' minuto';

	}else{
		if(weeks > 1)	buffer += weeks + ' w ';
		if(weeks == 1)	buffer += ' w ';
		if(dias > 1)	buffer += dias + 'd ';
		if(dias == 1)	buffer += dias +'d ';
		if(hours > 1)	buffer += hours + 'h ';
		if(hours == 1)	buffer += hours + 'h ';
		if(minutes > 1)	buffer += minutes + 'm ';
		if(minutes == 1)buffer += minutes + 'm';		
	}
	return buffer;	
}

//Bytes to KB | MB | GB
var format_data = function(bytes)
{
	if(bytes < 1000) return bytes + ' Bytes';
	if(bytes < 1000000) return Math.round(bytes/1000*100) / 100 + ' KB';
	if(bytes < 1000000000) return Math.round(bytes/1000000*100) / 100 + ' MB';
	if(bytes < 1000000000000) return Math.round(bytes/1000000000*100) / 100 + ' GB';
}
//--
function ajax_run_first()
{
	var expire_after = document.getElementById('expire_after');
	if(expire_after != null)
		expire_after.innerHTML = seconds2time(expire_after.innerHTML, "L");
	
	var spans = document.getElementsByTagName("span");
	var len = spans.length;
	for (var x = 0; x < len; x++)
		if(spans[x].getAttribute('class') == 'data-byte')
			spans[x].innerHTML = format_data(spans[x].innerHTML);
		else if(spans[x].getAttribute('class') == 'data')
			spans[x].innerHTML = format_data(spans[x].innerHTML*1000);
		else if(spans[x].getAttribute('class') == 'time-min')
		{
			spans[x].title = spans[x].innerHTML;
			spans[x].innerHTML = format_time(spans[x].innerHTML, "S");
		}
		else if(spans[x].getAttribute('class') == 'time')
		{
			spans[x].title = spans[x].innerHTML;
			spans[x].innerHTML = format_time(spans[x].innerHTML, "L");
		}
}

function ajax_run()
{
	var spans = document.getElementsByTagName("span");
	var len = spans.length;
	for (var x = 0; x < len; x++)
		if(spans[x].getAttribute('class') == 'time-min')
			spans[x].innerHTML = format_time(spans[x].title, "S");
		else if(spans[x].getAttribute('class') == 'time')
			spans[x].innerHTML = format_time(spans[x].title, "L");
}

window.onload = ajax_run_first;
setInterval(ajax_run, 5000);