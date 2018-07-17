function winload()
{

var images = document.getElementsByClassName("image");
var likesph = document.getElementsByClassName("likimg");
var likesnb = document.getElementsByClassName("likes");

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
	addlikimage(i);
	addlikevent(i);
}

function redirect(k)
{
	location.href = "photohandle/showphoto.php?id=" + k;
}

function addlikimage(k){
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'photohandle/dis_like.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		if (xhr.status === 200 && xhr.responseText == "not liked") {
			likesph[k].src = "photohandle/unliked.png";
		}
		else if (xhr.status === 200 && xhr.responseText == "liked") {
			likesph[k].src = "photohandle/liked.png";
		}
	};
	var idimg = images[k].id;
	xhr.send('id='+idimg);
}

function addlikevent(k){
	likesph[k].addEventListener("click", function(){
		likdislike(k);
	});
}

function likdislike(k) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'photohandle/dis_like.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		if (xhr.status === 200 && xhr.responseText == "like") {
			likesnb[k].innerHTML++;
			addlikimage(k);
		}
		else if (xhr.status === 200 && xhr.responseText == "dislike") {
			likesnb[k].innerHTML--;
			addlikimage(k);
		}
	};
	var idimg = images[k].id;
	xhr.send('like='+idimg);
}
}
winload();
var reload = document.getElementById("loadmore");
refresh.addEventListener("click", winload);
reload.addEventListener("click", load);
var imgdis = document.getElementById("imgdisplay");
var images = document.getElementsByClassName("image");

function load()
{
	var lastid = images[image.length - 1].id;
	var xhp = new XMLHttpRequest();
	xhp.open('POST', 'pagination.php');
	xhp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhp.onload = function() {
		if (xhp.responseText == "nomore")
			reload.style.display = "none";
		else
		imgdis.innerHTML = imgdis.innerHTML + xhp.responseText;
	};
	xhp.send('id='+lastid);
}
