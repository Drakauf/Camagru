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
	location.href = "photohandle/showphoto.php?id=" + k;
}
