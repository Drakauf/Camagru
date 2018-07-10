/*********************************************************************/
/* Menu: Aller a l'acceuil                                          */
/*********************************************************************/

var camera = document.getElementById("acceuil");
camera.addEventListener("click", accdirect);
function accdirect()
{
		location.href = "/home/home.php";
}

/*********************************************************************/
/* Menu: Aller page camera                                           */
/*********************************************************************/

var camera = document.getElementById("gophoto");
camera.addEventListener("click", camdirect);
function camdirect()
{
		location.href = "/home/camera/camera.php";
}

/*********************************************************************/
/* Menu: Aller aux reglages                                          */
/*********************************************************************/

var regla = document.getElementById("settings");
regla.addEventListener("click", regladirect);
function regladirect()
{
		location.href = "/home/reglages/reglages.php";
}

/*********************************************************************/
/* Menu: Aller a mes photos                                          */
/*********************************************************************/

var regla = document.getElementById("myphotos");
regla.addEventListener("click", myphotodirect);
function myphotodirect()
{
		location.href = "/home/photohandle/myphotos.php";
}
