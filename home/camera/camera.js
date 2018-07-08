(function() {

	var streaming	= false,
	video			= document.querySelector('#video'),
	cover			= document.querySelector('#cover'),
	canvas			= document.querySelector('#canvas'),
	photo			= document.querySelector('#photo'),
	startbutton 	= document.querySelector('#startbutton'),
	filtre			= document.getElementsByClassName("toshow");
	width = 680,
	height = 480;

	navigator.getMedia = ( navigator.getUserMedia ||
			navigator.webkitGetUserMedia ||
			navigator.mozGetUserMedia ||
			navigator.msGetUserMedia);

	navigator.getMedia(
			{
				video: true,
				audio: false
			},
			function(stream) {
				if (navigator.mozGetUserMedia) {
					video.mozSrcObject = stream;
				} else {
					var vendorURL = window.URL || window.webkitURL;
					video.src = vendorURL.createObjectURL(stream);
				}
				video.play();
			},
			function(err) {
				console.log("An error occured! " + err);
			}
			);
	video.addEventListener('canplay', function(ev){
		if (!streaming) {
			video.setAttribute('width', width);
			video.setAttribute('height', height);
			canvas.setAttribute('width', width);
			canvas.setAttribute('height', height);
			streaming = true;
		}
	}, false);
	function setfilter(data) {
		var i;
		i = 0;
		while (i < filtre.length){
			if (filtre[i].style.display === 'block')
				var fil = filtre[i].src;
			i++;
		}
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'showpic.php');
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
			if (xhr.status === 200 && xhr.responseText == "done") {
			}
			else if (xhr.status === 200 && xhr.responseText == "nofiltre") {
				alert("can't take a photo without a filter");
			}
			else if (xhr.status === 200 && xhr.responseText == "nodata") {
				alert("take/choose a photo");
			}
			else if (xhr.status !== 200) {
				alert('Request failed.  Returned status of ' + xhr.status);
			}
			else if (xhr.status === 200)
			{
				alert(xhr.responseText);
			}
		};
		xhr.send('filtre='+fil+'&data='+data);
	}
	function takepicture() {
		canvas.width = width;
		canvas.height = height;
		canvas.style.display = 'block';
		canvas.getContext('2d').drawImage(video, 0, 0, width, height);
		var data = canvas.toDataURL();
		var tosend=data;
		setfilter(tosend);
	}

	startbutton.addEventListener('click', function(ev){
		takepicture();
		ev.preventDefault();
	}, false);

})();
