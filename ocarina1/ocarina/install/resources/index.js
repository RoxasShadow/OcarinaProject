function controlla(ff){
  var msg='';
  if(ff.Nome.value=='')msg+='Inserire Nome\n';
  if(ff.keys.value=='')msg+='Inserire Chiavi di ricerca\n';
  if(ff.desc.value=='')msg+='Inserire Descrizione\n';
  if(ff.URL.value=='')msg+='Inserire URL\n';
  if(ff.URL_index.value=='')msg+='Inserire URL della root \n';
  if(msg!=''){
    alert('ATTENZIONE!\n'+msg);
    return false
  }
  else return true
}

function nascondi() {
	$("div#box").slideDown("normal");
}
