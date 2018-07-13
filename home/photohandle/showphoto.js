var nblikes = document.getElementById("likes");
var likeimg = document.getElementById("likimg");

likeimg.addEventListener("click", disliked);

function getlikimg() {

	var idimg = document.getElementsByClassName("image")[0].id;
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'dis_like.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		if (xhr.status === 200 && xhr.responseText == "not liked") {
			likeimg.src = "unliked.png";
		}
		else if (xhr.status === 200 && xhr.responseText == "liked") {
			likeimg.src = "liked.png";
		}
	};
	xhr.send('id='+idimg);
}

getlikimg();


function disliked() {
	var idimg = document.getElementsByClassName("image")[0].id;
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'dis_like.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		if (xhr.status === 200 && xhr.responseText == "like") {
			nblikes.innerHTML++;
			getlikimg();
		}
		else if (xhr.status === 200 && xhr.responseText == "dislike") {	
			nblikes.innerHTML--;
			getlikimg();
		}
	};
	xhr.send('like='+idimg);
}

var textbox = document.getElementById("combox");
var cbutton = document.getElementById("cbutton");
var nbcomment = document.getElementById("nbcomment");

cbutton.addEventListener("click", sendcom);

function sendcom()
{
	var idimg = document.getElementsByClassName("image")[0].id;
	var xhs = new XMLHttpRequest();
	xhs.open('POST', 'comment.php');
	xhs.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhs.onload = function() {
		if (xhs.status === 200 && xhs.responseText == "done") {
			nbcomment.innerHTML++;
		}
		else if (xhs.status === 200 && xhs.responseText == "done") {
			alert ("your com is too long, don't make a story, 200letters ares enought");
		}
		alert (xhs.responseText);
	};
	var text = textbox.value;
	xhs.send('id='+idimg+'&comment='+text);
}
