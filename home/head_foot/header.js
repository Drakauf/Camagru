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

/*********************************************************************/
/* deconnection                                                      */
/*********************************************************************/


var deconnection = document.getElementById("deco");

deconnection.addEventListener("click", decoredirect);

function decoredirect()
{
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '/home/head_foot/deco.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send();
	location.href = "/";
}
