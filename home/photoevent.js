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

document.height = window.height;

document.addEventListener("scroll", test);

function test()
{
	if (window.height == document.height)
		alert (window.inner.height);
	document.height = document.height + 300;
}
