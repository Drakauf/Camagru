(function() {

	chargediv();
	var streaming	= false,
	video			= document.querySelector('#video'),
	cover			= document.querySelector('#cover'),
	canvas			= document.querySelector('#canvas'),
	photo			= document.querySelector('#photo'),
	startbutton 	= document.querySelector('#startbutton'),
	filtre			= document.getElementsByClassName("toshow"),
	oldphoto		= document.getElementById("divoldphotos"),
	videoplay		= true;
	var data;
	var image = new Image();
	width = 680,
	height = 480;

	navigator.mediaDevices.getUserMedia({ video: true, audio: false
		     },
			function(stream) {
					var vendorURL = window.URL || window.webkitURL;
					video.src = vendorURL.createObjectURL(stream);
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
			if (xhr.status === 200 && xhr.responseText == "nofiltre") {
				alert("can't take a photo without a filter");
			}
			else if (xhr.status === 200 && xhr.responseText == "nodata") {
				alert("take/choose a photo");
			}
			else if (xhr.status !== 200) {
				alert('Request failed.  Returned status of ' + xhr.status);
			}
			else
				oldphoto.innerHTML = xhr.responseText;
		};
		xhr.send('filtre='+fil+'&data='+data);
		video.style.display = "block";
		canvas.style.display = "none";
	}

	function chargediv()
	{
		var dpho = new XMLHttpRequest();
		dpho.open('POST', 'oldphoto.php');
		dpho.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		dpho.onload = function() {
			oldphoto.innerHTML = dpho.responseText;
		};
		dpho.send();
	}

	function takepicture() {
		canvas.width = width;
		canvas.height = height;
		if (videoplay){
			canvas.getContext('2d').drawImage(video, 0, 0, width, height);
			data = canvas.toDataURL();
		}
		else
			input.value = "";
		var tosend=data;
		setfilter(tosend);
		videoplay = true;
	}

	startbutton.addEventListener('click', function(ev){
		takepicture();
		ev.preventDefault();
	}, false);



	input		= document.getElementById("upload");
	input.onchange = function(event)
	{
		
		video.style.display = "none";
		canvas.style.display = "block";
		canvas.width = 680;
		canvas.height = 480;

		if (this.files[0])
			image.src = window.URL.createObjectURL(this.files[0]);
		image.addEventListener("load", cargado);

		function cargado(e)
		{
			canvas.getContext('2d').drawImage(image, 0, 0, canvas.width, canvas.height);
			data = canvas.toDataURL('image/png');
//		if (videoplay)
//			{
//				let stream = video.src;
//				let tracks = stream.getTracks();
//
//				tracks.forEach(function(track) {
//					track.stop();
//				});
//				video.srcObject = null;
//			}
			videoplay = false;
		}
	}
})();

