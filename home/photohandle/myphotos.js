var images = document.getElementsByClassName("image");

onload();

function onload()
{
	 var i;

	  i = 0;
	   while (i < images.length)
		    {
				  addevent(i);
				    i++;
					 }
}

function addevent(i)
{
	 images[i].addEventListener("click", function(){
		 redirect(images[i].id);
		    });
}

function redirect(k)
{
	alert(k);
	location.href = "modifimage.php?id=" + k;
}
