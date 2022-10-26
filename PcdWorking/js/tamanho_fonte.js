window.onload = function tamanhofonte(){
	var elementBody = document.querySelector('body');
	var elementFontMais = document.getElementById('fontmais');
	var elementFontMenos = document.getElementById('fontmenos');
	var fontSize = 100;
	var increaseDecrease = 10;

	elementFontMais.addEventListener('click',function(event){
		fontSize = fontSize+increaseDecrease;
		elementBody.style.fontSize = fontSize+'%';
	});

	elementFontMenos.addEventListener('click',function(event){
		fontSize = fontSize - increaseDecrease;
		elementBody.style.fontSize = fontSize+'%';
	});
}