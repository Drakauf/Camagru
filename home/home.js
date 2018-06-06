//-------------------------------------------------------------------\\
// Div en fonction de connection                                     \\
//-------------------------------------------------------------------\\

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

//-------------------------------------------------------------------\\
// Boutton de connection                                             \\
//-------------------------------------------------------------------\\

var cobutton = document.getElementById("cobutton");
cobutton.addEventListener("click", coredirect);
function coredirect()
{
	location.href = "connection/connection.php";
}
