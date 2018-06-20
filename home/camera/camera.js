/*********************************************************************/
/* Header: Div a afficher                                            */
/*********************************************************************/

var camdiv = document.getElementById("camera");
var filtre = document.getElementsByClassName("filtre");
var i;
i = 0;
while (i < filtre.length)
{
	fil = filtre[i];
	filtre[i].onclick = function() {
		camdiv.style.backgroundColor = 'red';
	}
	i++;
}

