function quota(id){document.getElementById('targetForm').value=document.getElementById('targetForm').value+'[quote]'+document.getElementById(id).innerHTML+'[/quote]';}
function requestcolor(){add('[color='+prompt('Digita il nome del colore (esempio: red, black, white)')+'][/color]');}
function requesturl(){add('[url='+prompt('URL')+']'+prompt('Testo')+'[/url]');}
function requestimg(){add('[img]'+prompt('URL')+'[/img]');}
function requestimgdim(){add('[img width='+prompt('Larghezza')+' height='+prompt('Altezza')+']'+prompt('URL')+'[/img]');}
function requestuser(){add('[user]'+prompt('Nickname utente')+'[/user]');}
function requestyoutube(){add('[youtube]'+prompt('Link video')+'[/youtube]');}
function request(bbcode){add('['+bbcode+']'+prompt('Testo')+'[/'+bbcode+']');}
function add(bbcode){var textbox=document.getElementById('targetForm');textbox.focus();if(textbox.selectionStart!==undefined){var startPos=textbox.selectionStart;var endPos=textbox.selectionEnd;var selectedText=textbox.value.substring(startPos,endPos);textbox.value=textbox.value.substring(0,startPos)+bbcode+selectedText+textbox.value.substring(endPos,textbox.value.length);textbox.selectionStart=startPos+preText.length;textbox.selectionEnd=textbox.selectionStart;}else if(document.selection!==undefined){textRange=document.selection.createRange();var originalText=textRange.text;textRange.text=preText+textRange.text;textRange.moveStart('character',-(postText.length+originalText.length));textRange.moveEnd('character',-(postText.length+originalText.length));textRange.select();}else
textbox.value+=text;textbox.focus();}
