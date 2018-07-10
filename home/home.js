/*********************************************************************/
/* Header : Redirection a connection/inscription                     */
/*********************************************************************/

var cobutton = document.getElementById("cobutton");
cobutton.addEventListener("click", coredirect);
function coredirect()
{
	location.href = "connection/connection.php";
}

/*********************************************************************/
/* Reglette: Reglette                                                */
/*********************************************************************/

var ranger = document.getElementById('taille');
var image =  document.getElementsByClassName('image');


ranger.onchange = function(){
	var i;
	i = 0;
	while (i < image.length)
	{
	    image[i].width =ranger.value;
		image[i].height = ranger.value;
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
