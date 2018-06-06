//-------------------------------------------------------------------\\
// Div a afficher                                                    \\
//-------------------------------------------------------------------\\

var con= document.getElementById("co");
var ins= document.getElementById("in");
var insdiv = document.getElementById("inscription");
var condiv = document.getElementById("connection");

con.addEventListener("click", cofun);
ins.addEventListener("click", infun);
affichdiv();

function cofun()
{
	c = 1;
	affichdiv();
}

function infun()
{
	c = 0;
	affichdiv();
}

function affichdiv()
{
	if (c == 1)
	{
		insdiv.style.display= "none";
		condiv.style.display= "block";
	}
	if (c == 0)
	{
		insdiv.style.display= "block";
		condiv.style.display= "none";
	}
}
