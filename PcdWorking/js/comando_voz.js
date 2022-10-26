(function(){
	var speakBtn = document.querySelector('#speakbt');
	var resultSpeaker = document.querySelector('#resultspeak');
	
	if (window.SpeechRecognition || window.webkitSpeechRecognition) {
		var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;

		var myRecognition = new SpeechRecognition();
		myRecognition.lang = 'pt-BR';
		speakBtn.addEventListener('click', function(){
			try{
				myRecognition.start();
				resultSpeaker.innerHTML = "Estou te ouvindo";
			}catch(erro){
				alert('erro:' + erro.message);
			}
		}, false);
		myRecognition.addEventListener('result', function(evt){
			var resultSpeak = evt.results[0][0].transcript;
			console.log(resultSpeak);
			resultSpeaker.innerHTML = resultSpeak;

			switch(resultSpeak.toLowerCase()){
				case 'clearear':
					document.body.style.background = '#fff';
					break;

				case 'escurecer':
					document.body.style.background = '#003399';
					break;
			}

			if (resultSpeak.match(/buscar por/)) {
				resultSpeaker.innerHTML = 'Redirecionando...';
				setTimeOut(function(){
					var resultado = resultSpeak.split('buscar por');
					window.location.href = 'https://www.google.com.br/search?q=' + resultado[1];
				}, 2000);
			}

		}, false);

		myRecognition.addEventListener('erro', function(){
			resultSpeaker.innerHTML = 'Não conseguir te escutar bem!';
		}, false);
	}else{
		resultSpeaker.innerHTML = 'Seu navegador não suporta essa tecnologia! :(';
	}	
})();