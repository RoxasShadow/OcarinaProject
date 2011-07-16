/* Url dove inviare il get, div dove stampare il responso, id dell'elemento da cui prendere il testo. */
function sendGet(url, div, sourceForm) {
	if(typeof(sourceForm) != 'undefined') {
		if($('#'+sourceForm).val() == '') {
			$('#'+div).html('Text not found.');
			return false;
		}
		url += $('#'+sourceForm).val();
	}
	$.ajax({
		type: 'GET',
		url: url,
		beforeSend: function() {
			$('#'+div).html('Loading...');
		},
		error: function(e, xhr, settings, exception) {
			$('#'+div).html('Sorry, failed request. Error '+e.status+' '+settings);
		},
		success: function(response) {
			$('#'+div).html('')
			.hide()
			.slideToggle('fast', function() {
				$('#'+div).append(response);
			});
		}

	});
}

/* Url dove inviare il post, div dove stampare il responso, nome del tag post, id dell'elemento da cui prendere il testo. */
function sendSinglePost(url, div, elemname, sourceForm) {
	if(typeof(sourceForm) != 'undefined') {
		if($('#'+sourceForm).val() == '') {
			$('#'+div).html('Text not found.');
			return false;
		}
		query = elemname+'='+$('#'+sourceForm).val();
	}
	$.ajax({
		type: 'POST',
		url: url,
		data: query,
		beforeSend: function() {
			$('#'+div).html('Loading...');
		},
		error: function(e, xhr, settings, exception) {
			$('#'+div).html('Sorry, failed request. Error '+e.status+' '+settings);
		},
		success: function(response) {
			$('#'+div).html('')
			.hide()
			.slideToggle('fast', function() {
				$('#'+div).append(response);
			});
		}

	});
}

/* Un post con tutti gli elementi del form. Il nome del post è uguale al nome dell'elemento. */
/* Url dove inviare il post, div dove stampare il responso, nome del form, nome del bottone del send. Da dichiarare nell'attributo onsubmit del form. */
function sendPost(url, div, formname, send) {
	var form = document.forms[formname];
	var elemArray = form.elements;
	var input = '';
	var element, elemType, elemName;
	
	for(var i=0; i<elemArray.length; i++) {
		element = elemArray[i];
		elemType = element.type.toUpperCase();
		if(elemType == 'TEXT' || elemType == 'TEXTAREA' || elemType == 'PASSWORD' || elemType == 'FILE' || elemType == 'HIDDEN') {
		 	elemName = element.name;
		 	qstr = $('#'+elemName).val();
		 	if(qstr == '') {
		 		$('#'+elemName).focus();
				$.jGrowl('<img src=\'alert.png\' width=\'25\' height=\'25\'>Errore: Il '+elemName+' non è stato inserito.');
				return false;
			}
		}
	}
	
	var dataString = getQuery(formname);
	$('#'+send).attr('disabled', 'true');
	$.ajax({
		type: 'POST',
		url: url,
		data: dataString,
		beforeSend: function() {
			$('#'+div).html('Loading...');
		},
		error: function(e, xhr, settings, exception) {
			$('#'+div).html('Sorry, failed request. Error '+e.status+' '+settings);
		},
		success: function(response) {
			$('#'+div).html('')
			.hide()
			.slideToggle('fast', function() {
				$('#'+div).append(response);
			});
		}

	});

	return false;
}

function getQuery(formname) {
	var form = document.forms[formname];
	var elemArray = form.elements;
	var qstr = '';
	var option, element, elemType, elemName;
	
	function GetElemValue(name, value) {
		qstr += (qstr.length > 0 ? '&' : '') + escape(name).replace(/\+/g, '%2B') + '=' + escape(value ? value : '').replace(/\+/g, '%2B');
	}
	
	for(var i=0; i<elemArray.length; i++) {
		element = elemArray[i];
		elemType = element.type.toUpperCase();
	 	elemName = element.name;

		if(elemName) {
			if(elemType == 'TEXT' || elemType == 'TEXTAREA' || elemType == 'PASSWORD' || elemType == 'FILE' || elemType == 'HIDDEN')
				GetElemValue(elemName, element.value);
			else if(elemType == 'CHECKBOX' && element.checked)
				GetElemValue(elemName, element.value ? element.value : 'On');
			else if(elemType == 'RADIO' && element.checked)
				GetElemValue(elemName, element.value);
			else if(elemType.indexOf('SELECT') != -1)
				for(var j=0; j<element.options.length; j++) {
					option = element.options[j];
					if(option.selected)
						GetElemValue(elemName, option.value ? option.value : option.text);
				}
		}
	}
	return qstr;
}
