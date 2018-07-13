

/*********************************************************************/
/* Reglette: Reglette                                                */
/*********************************************************************/


var ranger = document.getElementById('taille');
var image =  document.getElementsByClassName('image');
var imdiv =  document.getElementsByClassName('imgbody');

ranger.onchange = function(){
	var i;
	i = 0;
	while (i < image.length)
	{
	    image[i].width =ranger.value;
		image[i].height = ranger.value;
		imdiv[i].width = ranger.value;
		i++;
	}
}


/*********************************************************************/
/* Body: afficher le menu une fois connecter                         */
/*********************************************************************/

var comenu = document.getElementById("comenu");

if (log)
{
	comenu.style.display = "block";
}
else
{
	comenu.style.display = "none";
}
