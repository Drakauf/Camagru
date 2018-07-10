/*********************************************************************/
/* Header: Div a afficher                                            */
/*********************************************************************/

var codiv = document.getElementById("connected");
var nocodiv = document.getElementById("noconnect");

if (log)
{
	codiv.style.display = "block";
	nocodiv.style.display = "none";
}
else
{
	codiv.style.display = "none";
	nocodiv.style.display = "block";
}
