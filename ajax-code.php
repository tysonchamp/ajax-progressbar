<!DOCTYPE html>
<html>
<head>
<script>
/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function _(el){
	return document.getElementById(el);
}
function fun()
{
	 document.getElementById("file1").click();
	 
}

function uploadFile(){
	var file = _("file1").files[0];
	var type=file.type;
	if(type!='image/jpeg' && type!='image/jpg' && type!='image/gif' && type!='image/png')
	{
	_("status").innerHTML ="please upload only jpeg/gif/png image file";
	return;
	}
	var formdata = new FormData();
	formdata.append("file1", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "file_upload_parser.php");
	ajax.send(formdata);
}
function progressHandler(event){
	//_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	document.getElementById("div").style.display = "inline";
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
document.getElementById("div").style.display = "none";
	_("status").innerHTML = event.target.responseText;
	_("progressBar").value = 0;
	
}
function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}
</script>
</head>
<body>

<a href='#' id='#upfile1' onClick="fun()">Upload Image File</a><h3 id="status"></h3>
  <input type="file" name="file1" id="file1" onchange="uploadFile()" style="display:none"><br>
  <div id="div" style="display:none"><progress id="progressBar" value="0" max="100" style="width:300px;"></progress><div>
  

</body>
</html>
