/*********************************************************************/
/* Filtres: filtre a afficher                                        */
/*********************************************************************/

var filtre = document.getElementsByClassName("filtre");
var toshow = document.getElementsByClassName("toshow");

onload();

function onload()
{
	var i;

	i = 0;
	while (i < filtre.length)
	{
		addevent(i);
		i++;
	}
}

function addevent(i)
{
	filtre[i].addEventListener("click", function(){
		display(i);
	});
}

function display(k)
{
	var j;

	j = 0;
	while (j < toshow.length)
	{
		toshow[j].style.display = 'none';
		j++;
	}
	toshow[k].style.display = 'block';
}
