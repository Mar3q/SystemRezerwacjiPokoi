var pokazanoFormularzRejstracji = false;
var pokazanoFormularzLogowania = false;
function pokazFormularzRejstracji()
{	
	if(!pokazanoFormularzRejstracji)
	{
		document.getElementById("rejstracja").style.display = "inline";	
		pokazanoFormularzRejstracji = true;
	}	
	else
	{
		document.getElementById("rejstracja").style.display = "none";
		pokazanoFormularzRejstracji = false;
	}		
}
function pokazFormularzLogowania()
{	
	if(!pokazanoFormularzLogowania)
	{
		document.getElementById("logowanie").style.display = "inline";	
		pokazanoFormularzLogowania = true;
	}	
	else
	{
		document.getElementById("logowanie").style.display = "none";
		pokazanoFormularzLogowania = false;
	}		
}

/*
var i = 0;
var txt = document.getElementById("divtemat");
var speed = 50;

function typeWriter() {
  if (i < txt.length) {
    document.getElementById("textExample").innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
  }
  myFunction();
}

function myFunction() {
    var x = document.getElementById("textExample").value;
    document.getElementById("myTextarea").innerHTML = x;  
	
}
*/
/*
function animateText(textArea) {
  let text = textArea.value;
  let to = text.length,
	from = 0;
  animate({
	duration: 1000,
	timing: bounce,
	draw: function(progress) {
	  let result = (to - from) * progress + from;
	  textArea.value = text.substr(0, Math.ceil(result))
	}
  });
}
function bounce(timeFraction) {
document.getElementById("textExample").style.display = "inline";	
document.getElementById("textExample2").style.display = "inline";
document.getElementById("textExample3").style.display = "inline";
  for (let a = 0, b = 1, result; 1; a += b, b /= 2) {
	if (timeFraction >= (7  * a) / 11) {
	  return -Math.pow((11 - 6 * a - 11 * timeFraction) / 4, 2) + Math.pow(b, 2)
	}
  }
}
*/	
     $(document).ready(function()
      {
        var navItems = $('.admin-menu li > a');
        var navListItems = $('.admin-menu li');
        var allWells = $('.admin-content');
        var allWellsExceptFirst = $('.admin-content:not(:first)');
        allWellsExceptFirst.hide();
        navItems.click(function(e)
        {
            e.preventDefault();
            navListItems.removeClass('active');
            $(this).closest('li').addClass('active');
            allWells.hide();
            var target = $(this).attr('data-target-id');
            $('#' + target).show();
        });
        });

