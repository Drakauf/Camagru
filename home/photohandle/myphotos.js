var images = document.getElementsByClassName("image");

imagesload();

function imagesload()
{
	var i;

	i = 0;
	while (i < images.length)
	{
		addimgevent(i);
		i++;
	}
}

function addimgevent(i)
{
	images[i].addEventListener("click", function(){
		redirect(images[i].id);
	});
}

function redirect(k)
{
	location.href = "showphoto.php?id=" + k;
}

/***************************************************************************************/
/*delete
/***************************************************************************************/

var boutons = document.getElementsByClassName("suppr");
var imgdiv  = document.getElementsByClassName("modif");

boutonload();

function boutonload()
{
	var i;

	i = 0;
	while (i < boutons.length)
	{
		addboutevent(i);
		i++;
	}
}

function addboutevent(i)
{
	boutons[i].addEventListener("click", function(){
		deldiv(i);
	});
}

function deldiv(i)
{
	if (confirm("Save data?"))
	{
	imgdiv[i].style.display = "none";
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'delphoto.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		if (xhr.status === 200 && xhr.responseText == "done") {
			alert ("la photo viens d'etre supprime");
		}
		else if (xhr.status === 200 && xhr.responseText == "nophoto") {
			alert("This photo doesn't exist (maybe already deleted)");
		}
		else if (xhr.status === 200 && xhr.responseText == "prob"){
			alert("un probleme est survenu");
		}
		else if (xhr.status !== 200) {
			alert('Request failed.  Returned status of ' + xhr.status);
		}
		else if (xhr.status === 200)
		{
			alert(xhr.responseText);
		}
	};
	xhr.send('id='+images[i].id);
	}
}

/***************************************************************************************/
/*change name
/***************************************************************************************/

var nwname = document.getElementsByClassName("imgname");
var chname = document.getElementsByClassName("cname");


nameload();

function nameload()
{
	var i;

	i = 0;
	while (i < chname.length)
	{
		addnameevent(i);
		i++;
	}
}

function addnameevent(i)
{
	chname[i].addEventListener("click", function(){
		newname(i);
	});
}

function newname(i)
{
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'modifname.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		if (xhr.status === 200 && xhr.responseText == "done"){
			alert ("le nom viens d'etre modifie");
		}
		else if (xhr.status === 200 && xhr.responseText == "toolong"){
			alert("le nom est trop (25 caractere max)");
		}
		else if (xhr.status === 200 && xhr.responseText == "prob"){
			alert("un probleme est survenu");
		}
		else if (xhr.status !== 200){
			alert('Request failed.  Returned status of ' + xhr.status);
		}
		else if (xhr.status === 200)
		{
			alert(xhr.responseText);
		}
	};
	xhr.send('id='+images[i].id+'&name='+nwname[i].value);
}
