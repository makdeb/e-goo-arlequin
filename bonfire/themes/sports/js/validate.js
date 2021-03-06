/*
	анонимная функция:
	запускаеться после загрузки документа
*/

(function () {
	if (window.addEventListener) window.addEventListener('load', init, false) 
	else if (window.attachEvent) window.attachEvent('onload', init);
	
	function init() {

		for(var i=0; i < document.forms.length; i++) {
			var f = document.forms[i];
			
			var needValidation = false;
			
			for(j=0; j < f.elements.length; j++) {
				var e = f.elements[j];
				
				if ((e.type != 'text') && (e.type != 'email') ) continue;
				
				var pattern = e.getAttribute('pattern');
				
				var required = e.getAttribute('required') != null;
				
				if (required && !pattern) {
					pattern = '\\S';
					e.setAttribute('pattern', pattern);
				}
				
				if (pattern) {
					e.onchange = validateOnChange;
					
					needValidation = true;
				}
				
			}	
			if (needValidation) f.onsubmit = validateOnSubmit;
		}
	}
	
	function validateOnChange() {
		var textfield = this;
		var pattern = textfield.getAttribute('pattern');
		var value = this.value;
		if (value.search(pattern) == -1) { textfield.className = 'invalid' }
		else textfield.className = 'valid';
		
		
	}
	
	function validateOnSubmit() {
		var invalid = false;
		
		for(var i=0; i<this.elements.length; i++) {
			var e = this.elements[i];
			
			if ( (e.type == 'text' || e.type == 'email') && (e.onchange == validateOnChange)) {
				e.onchange();
				if (e.className == 'invalid') invalid = true;
			}
		}
		
		if (invalid) {
			alert('Введите, пожалуйста, Ваш email и сообщение.');
			return false;
			
		}
		
	}
	
	
})();