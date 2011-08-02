<?php /* Smarty version Smarty-3.0.8, created on 2011-08-02 20:57:16
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/admin/formcontents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19223716334e3864ad0037a5-71584353%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b32bc29ea7bc6ae8fd7ea4877b533022756e886f' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/admin/formcontents.tpl',
      1 => 1311706096,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19223716334e3864ad0037a5-71584353',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ((($_smarty_tpl->getVariable('grado')->value=='')||($_smarty_tpl->getVariable('grado')->value>3))){?>
		Accesso negato.
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value&&!isset($_smarty_tpl->getVariable('result',null,true,false)->value)){?>
		<form action="" method="post">
		Titolo<br />
		<input type="text" name="titolo" <?php if ((isset($_smarty_tpl->getVariable('titolo_default',null,true,false)->value))){?>value="<?php echo $_smarty_tpl->getVariable('titolo_default')->value;?>
"<?php }?> /><br /><br />
		<?php if (((!isset($_smarty_tpl->getVariable('nocategory',null,true,false)->value))||($_smarty_tpl->getVariable('nocategory')->value!==1))){?>
			Categoria<br />
			<select name="categoria">
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categorie')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				 <?php if (((isset($_smarty_tpl->getVariable('categoria',null,true,false)->value))&&($_smarty_tpl->getVariable('categorie')->value[$_smarty_tpl->tpl_vars['key']->value]==$_smarty_tpl->getVariable('categoria')->value))){?>
				 	<option value="<?php echo $_smarty_tpl->getVariable('categorie')->value[$_smarty_tpl->tpl_vars['key']->value];?>
" selected><?php echo $_smarty_tpl->getVariable('categorie')->value[$_smarty_tpl->tpl_vars['key']->value];?>
</option>
				 <?php }else{ ?>
					<option value="<?php echo $_smarty_tpl->getVariable('categorie')->value[$_smarty_tpl->tpl_vars['key']->value];?>
"><?php echo $_smarty_tpl->getVariable('categorie')->value[$_smarty_tpl->tpl_vars['key']->value];?>
</option>
				<?php }?>
			<?php }} ?>
			</select><br /><br />
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('bbcode')->value==1){?>
			<a onclick="request('b');"><b>Grassetto</b></a>
			<a onclick="request('i');"><b>Corsivo</b></a>
			<a onclick="request('u');"><b>Sottolineato</b></a>
			<a onclick="request('s');"><b>Barrato</b></a>
			<a onclick="requestcolor();"><b>Colore</b></a>
			<a onclick="requesturl();"><b>URL</b></a>
			<a onclick="request('spoiler');"><b>Spoiler</b></a>
			<a onclick="requestimg();"><b>Immagine</b></a>
			<a onclick="requestimgdim();"><b>Immagine con dimensioni</b></a>
			<a onclick="request('summary');"><b>Paragrafo</b></a>
			<a onclick="request('left');"><b>Allineato a sinistra</b></a>
			<a onclick="request('center');"><b>Allineato a centro</b></a>
			<a onclick="request('right');"><b>Allineato a destra</b></a>
			<a onclick="request('code');"><b>Codice</b></a>
			<a onclick="request('quote');"><b>Citazione</b></a>
			<a onclick="requestuser();"><b>Utente</b></a>
			<a onclick="requestyoutube();"><b>Youtube</b></a>
			<a onclick="requesttranslate();"><b>Traduci</b></a><br />
		<?php }else{ ?>
			Tag HTML permessi.<br />
		<?php }?>
		<textarea name="testo" cols="59" rows="10" id="targetForm"><?php if ((isset($_smarty_tpl->getVariable('testo',null,true,false)->value))){?><?php echo $_smarty_tpl->getVariable('testo')->value;?>
<?php }?></textarea><br />
		<?php if (isset($_smarty_tpl->getVariable('sel',null,true,false)->value)){?><input type="hidden" name="selected" value="<?php echo $_smarty_tpl->getVariable('sel')->value;?>
" /><?php }?>
		<input type="submit" name="submit" value="Conferma" /><input type="button" onclick="return sendSinglePost('<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/preview.php', 'previewBox', 'text', 'targetForm');" value="Anteprima" /><br />
		<div id="previewBox"></div>
		</form>
	<?php }elseif($_smarty_tpl->getVariable('submit')->value&&isset($_smarty_tpl->getVariable('result',null,true,false)->value)||(!$_smarty_tpl->getVariable('submit')->value&&isset($_smarty_tpl->getVariable('result',null,true,false)->value))){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }elseif(isset($_smarty_tpl->getVariable('result',null,true,false)->value)){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
