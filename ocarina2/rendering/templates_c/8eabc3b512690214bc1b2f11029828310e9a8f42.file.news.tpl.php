<?php /* Smarty version Smarty-3.0.8, created on 2011-08-08 14:40:18
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/default-ajax/news.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5616960944e3ff5524680e6-25603221%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8eabc3b512690214bc1b2f11029828310e9a8f42' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/default-ajax/news.tpl',
      1 => 1312814417,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5616960944e3ff5524680e6-25603221',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (isset($_smarty_tpl->getVariable('error',null,true,false)->value)){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('error')->value;?>
</div>
	<?php }elseif(isset($_smarty_tpl->getVariable('commentSended',null,true,false)->value)){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('commentSended')->value;?>
</div>
	<?php }elseif(is_array($_smarty_tpl->getVariable('news')->value)){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('news')->value[0]->titolo;?>
</div>
		<div class="newsheader" align="center">Scritto da <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profile/<?php echo $_smarty_tpl->getVariable('news')->value[0]->autore;?>
.html"><?php echo $_smarty_tpl->getVariable('news')->value[0]->autore;?>
</a> il giorno <?php echo $_smarty_tpl->getVariable('news')->value[0]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('news')->value[0]->ora;?>
 nella categoria <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/category/<?php echo $_smarty_tpl->getVariable('news')->value[0]->categoria;?>
.html"><?php echo $_smarty_tpl->getVariable('news')->value[0]->categoria;?>
</a>. <?php if ($_smarty_tpl->getVariable('news')->value[0]->oraultimamodifica==$_smarty_tpl->getVariable('news')->value[0]->ora){?>Ultima modifica <?php if ($_smarty_tpl->getVariable('news')->value[0]->dataultimamodifica==$_smarty_tpl->getVariable('news')->value[0]->data){?>oggi<?php }else{ ?> il giorno <?php echo $_smarty_tpl->getVariable('news')->value[0]->dataultimamodifica;?>
<?php }?> alle ore <?php echo $_smarty_tpl->getVariable('news')->value[0]->ora;?>
 <?php if ($_smarty_tpl->getVariable('news')->value[0]->autoreultimamodifica!==$_smarty_tpl->getVariable('news')->value[0]->autore){?>da parte di <?php echo $_smarty_tpl->getVariable('news')->value[0]->autoreultimamodifica;?>
.<?php }?><?php }?></div><br />
		<div class="news"><p><?php echo $_smarty_tpl->getVariable('news')->value[0]->contenuto;?>
</p></div><br />
		<div id="voteresponse"></div>
		<?php if ($_smarty_tpl->getVariable('utente')->value!==''){?>
			<a href="#" onclick="sendGet('<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/api.php?action=votenews&title=<?php echo $_smarty_tpl->getVariable('news')->value[0]->minititolo;?>
', 'voteresponse', undefined, 'true', Array(9, 'Votato.'), 'Hai già votato questa news.'); setTimeout('sendGet(\'<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/api.php?action=news&title=<?php echo $_smarty_tpl->getVariable('news')->value[0]->minititolo;?>
\', \'voto\', undefined, \'true\', undefined, undefined, \'votes\');', 1000);">Vota questa news</a>
			<?php if ($_smarty_tpl->getVariable('news')->value[0]->voti==1){?>
				(<a id="voto" class="no-prop">1</a> voto)
			<?php }else{ ?>
				(<a id="voto" class="no-prop"><?php echo $_smarty_tpl->getVariable('news')->value[0]->voti;?>
</a> voti)
				<?php }?>
		<?php }else{ ?>
			<a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/registrazione.php">Registrati</a> o <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/login.php">accedi</a> per votare questa news.
		<?php }?>
		
		<?php if (!is_array($_smarty_tpl->getVariable('commenti')->value)){?>
			<br /><hr /><br />
			<div class="news"><?php echo $_smarty_tpl->getVariable('commenti')->value;?>
</div>
		<?php }else{ ?>
			<br /><hr /><br />
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('commenti')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->iteration=0;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
 $_smarty_tpl->tpl_vars['item']->iteration++;
?>
				<fieldset><legend><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/comment/<?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->id;?>
.html">#<?php echo $_smarty_tpl->tpl_vars['item']->iteration;?>
</a> Commento inviato il giorno <?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->ora;?>
 da <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profile/<?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
.html"><?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
</a>. <?php if (((isset($_smarty_tpl->getVariable('grado',null,true,false)->value))&&(is_numeric($_smarty_tpl->getVariable('grado')->value))&&($_smarty_tpl->getVariable('grado')->value<3))){?><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/admin/cancellacommento.php?id=<?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->id;?>
">(X)</a><?php }?> <a onclick="quota('<?php echo $_smarty_tpl->tpl_vars['item']->iteration;?>
');">Quota</a></legend><div id="<?php echo $_smarty_tpl->tpl_vars['item']->iteration;?>
"><?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->contenuto;?>
</div></fieldset><br />
			<?php }} ?>
		<?php }?>
		<br />
		<?php if (!$_smarty_tpl->getVariable('logged')->value){?>
			<a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/registrazione.php">Registrati</a> o <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/login.php">accedi</a> per commentare questa news.
		<?php }else{ ?>
			<?php if ($_smarty_tpl->getVariable('bbcode')->value==1){?>
				<a onclick="request('b');"><b>Grassetto</b></a>
				<a onclick="request('i');"><b>Corsivo</b></a>
				<a onclick="request('u');"><b>Sottolineato</b></a>
				<a onclick="request('s');"><b>Barrato</b></a>
				<a onclick="requestcolor();"><b>Colore</b></a>
				<a onclick="requesturl();"><b>URL</b></a>
				<a onclick="request('spoiler');"><b>Spoiler</b></a>
				<a onclick="request('left');"><b>Allineato a sinistra</b></a>
				<a onclick="request('center');"><b>Allineato a centro</b></a>
				<a onclick="request('right');"><b>Allineato a destra</b></a>
				<a onclick="request('code');"><b>Codice</b></a>
				<a onclick="request('quote');"><b>Citazione</b></a>
				<a onclick="requestuser();"><b>Utente</b></a>
				<a onclick="requesttranslate();"><b>Traduci</b></a><br />
			<?php }?>
			<textarea name="comment" cols="59" rows="10" id="targetForm"></textarea><br />
			<input type="submit" value="Invia commento" onclick="sendGet('<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/api.php?action=createcomment&title=<?php echo $_smarty_tpl->getVariable('news')->value[0]->minititolo;?>
&nickname=<?php echo $_smarty_tpl->getVariable('utente')->value;?>
&content=', 'previewBox', 'targetForm', 'true', Array(13, 'Commento inviato.'), 'È accaduto un errore.'); setTimeout('document.location.reload();', 1000);" /><input type="button" onclick="sendSinglePost('<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/preview.php?type=comment', 'previewBox', 'text', 'targetForm');" value="Anteprima" /><br />
			<div id="previewBox"></div>
			<div id="commenti">1</div>
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>