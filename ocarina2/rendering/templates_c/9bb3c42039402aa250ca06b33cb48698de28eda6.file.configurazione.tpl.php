<?php /* Smarty version Smarty-3.0.8, created on 2011-08-04 17:15:08
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/admin/configurazione.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20608724314e3ad39ce61dc2-56108341%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9bb3c42039402aa250ca06b33cb48698de28eda6' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/admin/configurazione.tpl',
      1 => 1312477963,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20608724314e3ad39ce61dc2-56108341',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/htdocs/ocarina2/rendering/plugins/modifier.capitalize.php';
?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ((($_smarty_tpl->getVariable('grado')->value=='')||($_smarty_tpl->getVariable('grado')->value>1))){?>
		Accesso negato.
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value&&!isset($_smarty_tpl->getVariable('result',null,true,false)->value)){?>
		<form action="" method="post">
		Nome del sito<br />
		<input type="text" name="nomesito" maxlength="100" <?php if ((isset($_smarty_tpl->getVariable('nomesito_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('nomesito_default')->value;?>
"<?php }?> /><br /><br />
		Email<br />
		<input type="text" name="email" maxlength="100" <?php if ((isset($_smarty_tpl->getVariable('email_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('email_default')->value;?>
"<?php }?> /><br /><br />
		Attiva BBCode (0 = No, 1 = Si)<br />
		<input type="text" name="bbcode" maxlength="1" <?php if ((isset($_smarty_tpl->getVariable('bbcode_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('bbcode_default')->value;?>
"<?php }?> /><br /><br />
		Permetti registrazioni (0 = No, 1 = Si)<br />
		<input type="text" name="registrazioni" maxlength="1" <?php if ((isset($_smarty_tpl->getVariable('registrazioni_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('registrazioni_default')->value;?>
"<?php }?> /><br /><br />
		Validazione account con conferma email (0 = No, 1 = Si)<br />
		<input type="text" name="validazioneaccount" maxlength="1" <?php if ((isset($_smarty_tpl->getVariable('validazioneaccount_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('validazioneaccount_default')->value;?>
"<?php }?> /><br /><br />
		Abilita commenti (0 = No, 1 = Si)<br />
		<input type="text" name="commenti" maxlength="1" <?php if ((isset($_smarty_tpl->getVariable('commenti_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('commenti_default')->value;?>
"<?php }?> /><br /><br />
		Approva commenti automaticamente (0 = Si, 1 = No)<br />
		<input type="text" name="approvacommenti" maxlength="1" <?php if ((isset($_smarty_tpl->getVariable('approvacommenti_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('approvacommenti_default')->value;?>
"<?php }?> /><br /><br />
		Registra log automaticamente (0 = No, 1 = Si)<br />
		<input type="text" name="log" maxlength="1" <?php if ((isset($_smarty_tpl->getVariable('log_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('log_default')->value;?>
"<?php }?> /><br /><br />
		Attiva motore plugin (0 = No, 1 = Si)<br />
		<input type="text" name="plugin" maxlength="1" <?php if ((isset($_smarty_tpl->getVariable('plugin_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('plugin_default')->value;?>
"<?php }?> /><br /><br />
		Nome del cookie<br />
		<input type="text" name="cookie" maxlength="20" <?php if ((isset($_smarty_tpl->getVariable('cookie_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('cookie_default')->value;?>
"<?php }?> /><br /><br />
		Durata login in secondi (ex.: 3600 = 1 ora, 1296000 = 15 giorni)<br />
		<input type="text" name="loginexpire" maxlength="20" <?php if ((isset($_smarty_tpl->getVariable('loginexpire_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('loginexpire_default')->value;?>
"<?php }?> /><br /><br />
		Skin di default<br />
		<select name="skin">
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listaskin')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<?php if (((isset($_smarty_tpl->getVariable('skin_default',null,true,false)->value))&&($_smarty_tpl->getVariable('skin_default')->value!=='')&&($_smarty_tpl->getVariable('listaskin')->value[$_smarty_tpl->tpl_vars['key']->value]==$_smarty_tpl->getVariable('skin_default')->value))){?>
				<option value="<?php echo $_smarty_tpl->getVariable('listaskin')->value[$_smarty_tpl->tpl_vars['key']->value];?>
" selected><?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('listaskin')->value[$_smarty_tpl->tpl_vars['key']->value]);?>
</option>
			<?php }else{ ?>
				<option value="<?php echo $_smarty_tpl->getVariable('listaskin')->value[$_smarty_tpl->tpl_vars['key']->value];?>
"><?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('listaskin')->value[$_smarty_tpl->tpl_vars['key']->value]);?>
</option>
			<?php }?>
		<?php }} ?>
		</select><br /><br />
		Breve descrizione del sito<br />
		<input type="text" name="description" maxlength="151" <?php if ((isset($_smarty_tpl->getVariable('description_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('description_default')->value;?>
"<?php }?> /><br /><br />
		Limite caratteri news<br />
		<input type="text" name="limitenews" maxlength="10" <?php if ((isset($_smarty_tpl->getVariable('limitenews_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('limitenews_default')->value;?>
"<?php }?> /><br /><br />
		News da mostrare per pagina<br />
		<input type="text" name="impaginazionenews" maxlength="10" <?php if ((isset($_smarty_tpl->getVariable('impaginazionenews_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('impaginazionenews_default')->value;?>
"<?php }?> /><br /><br />
		Minuti per i quali un utente è considerato online finchè non compie un'azione<br />
		<input type="text" name="limiteonline" maxlength="10" <?php if ((isset($_smarty_tpl->getVariable('limiteonline_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('limiteonline_default')->value;?>
"<?php }?> /><br /><br />
		Permetti i voti alle news<br />
		<input type="text" name="permettivoto" maxlength="10" <?php if ((isset($_smarty_tpl->getVariable('permettivoto_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('permettivoto_default')->value;?>
"<?php }?> /><br /><br />
		URL (ex.: http://www.tuosito.com)<br />
		<input type="text" name="url" maxlength="100" <?php if ((isset($_smarty_tpl->getVariable('url_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('url_default')->value;?>
"<?php }?> /><br /><br />
		URL index (ex.: http://www.tuosito.com/ocarina2)<br />
		<input type="text" name="url_index" maxlength="100" <?php if ((isset($_smarty_tpl->getVariable('url_index_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('url_index_default')->value;?>
"<?php }?> /><br /><br />
		URL admin (ex.: http://www.tuosito.com/ocarina2/admin)<br />
		<input type="text" name="url_admin" maxlength="100" <?php if ((isset($_smarty_tpl->getVariable('url_admin_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('url_admin_default')->value;?>
"<?php }?> /><br /><br />
		URL rendering (ex.: http://www.tuosito.com/ocarina2/rendering/)<br />
		<input type="text" name="url_rendering" maxlength="100" <?php if ((isset($_smarty_tpl->getVariable('url_rendering_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('url_rendering_default')->value;?>
"<?php }?> /><br /><br />
		URL immagini (ex.: http://www.tuosito.com/ocarina2/immagini)<br />
		<input type="text" name="url_immagini" maxlength="100" <?php if ((isset($_smarty_tpl->getVariable('url_immagini_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('url_immagini_default')->value;?>
"<?php }?> /><br /><br />
		Root (ex.: /var/www/htdocs)<br />
		<input type="text" name="root" maxlength="100" <?php if ((isset($_smarty_tpl->getVariable('root_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('root_default')->value;?>
"<?php }?> /><br /><br />
		Root index (ex.: /var/www/htdocs/ocarina2)<br />
		<input type="text" name="root_index" maxlength="100" <?php if ((isset($_smarty_tpl->getVariable('root_index_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('root_index_default')->value;?>
"<?php }?> /><br /><br />
		Root admin (ex.: /var/www/htdocs/ocarina2/admin)<br />
		<input type="text" name="root_admin" maxlength="100" <?php if ((isset($_smarty_tpl->getVariable('root_admin_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('root_admin_default')->value;?>
"<?php }?> /><br /><br />
		Root rendering (ex.: /var/www/htdocs/ocarina2/rendering)<br />
		<input type="text" name="root_rendering" maxlength="100" <?php if ((isset($_smarty_tpl->getVariable('root_rendering_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('root_rendering_default')->value;?>
"<?php }?> /><br /><br />
		Root immagini (ex.: /var/www/htdocs/ocarina2/immagini)<br />
		<input type="text" name="root_immagini" maxlength="100" <?php if ((isset($_smarty_tpl->getVariable('root_immagini_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('root_immagini_default')->value;?>
"<?php }?> /><br /><br />
		<input type="submit" name="submit" value="Salva" />
		</form>
	<?php }elseif($_smarty_tpl->getVariable('submit')->value&&isset($_smarty_tpl->getVariable('result',null,true,false)->value)||(!$_smarty_tpl->getVariable('submit')->value&&isset($_smarty_tpl->getVariable('result',null,true,false)->value))){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }elseif(isset($_smarty_tpl->getVariable('result',null,true,false)->value)){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
