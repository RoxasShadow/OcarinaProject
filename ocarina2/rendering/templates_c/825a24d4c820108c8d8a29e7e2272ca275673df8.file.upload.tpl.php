<?php /* Smarty version Smarty-3.0.8, created on 2011-07-21 21:00:36
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/admin/upload.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8762626854e289374e25906-72042690%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '825a24d4c820108c8d8a29e7e2272ca275673df8' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/admin/upload.tpl',
      1 => 1310856884,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8762626854e289374e25906-72042690',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ((($_smarty_tpl->getVariable('grado')->value=='')||($_smarty_tpl->getVariable('grado')->value>=4))){?>
		Accesso negato.
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value){?>
		<form action="" method="post" enctype="multipart/form-data">
		<?php $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['var']->step = 1;$_smarty_tpl->tpl_vars['var']->total = (int)ceil(($_smarty_tpl->tpl_vars['var']->step > 0 ? $_smarty_tpl->getVariable('multiple')->value+1 - (1) : 1-($_smarty_tpl->getVariable('multiple')->value)+1)/abs($_smarty_tpl->tpl_vars['var']->step));
if ($_smarty_tpl->tpl_vars['var']->total > 0){
for ($_smarty_tpl->tpl_vars['var']->value = 1, $_smarty_tpl->tpl_vars['var']->iteration = 1;$_smarty_tpl->tpl_vars['var']->iteration <= $_smarty_tpl->tpl_vars['var']->total;$_smarty_tpl->tpl_vars['var']->value += $_smarty_tpl->tpl_vars['var']->step, $_smarty_tpl->tpl_vars['var']->iteration++){
$_smarty_tpl->tpl_vars['var']->first = $_smarty_tpl->tpl_vars['var']->iteration == 1;$_smarty_tpl->tpl_vars['var']->last = $_smarty_tpl->tpl_vars['var']->iteration == $_smarty_tpl->tpl_vars['var']->total;?>
			<input name="image[]" type="file" size="40" /><br />
		<?php }} ?>
		<input name="upload" type="submit" value="Upload" />				
		</form><br />
		<div align="right">
		<form action="" method="get">
		<input name="multiple" type="text" size="1" />
		<input type="submit" value="Genera" />
		</form>
		</div>
	<?php }else{ ?>
		<?php if (isset($_smarty_tpl->getVariable('result',null,true,false)->value)){?>
			<?php echo $_smarty_tpl->getVariable('result')->value;?>

		<?php }else{ ?>
			<?php $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['var']->step = 1;$_smarty_tpl->tpl_vars['var']->total = (int)ceil(($_smarty_tpl->tpl_vars['var']->step > 0 ? count($_smarty_tpl->getVariable('image')->value)-1+1 - (0) : 0-(count($_smarty_tpl->getVariable('image')->value)-1)+1)/abs($_smarty_tpl->tpl_vars['var']->step));
if ($_smarty_tpl->tpl_vars['var']->total > 0){
for ($_smarty_tpl->tpl_vars['var']->value = 0, $_smarty_tpl->tpl_vars['var']->iteration = 1;$_smarty_tpl->tpl_vars['var']->iteration <= $_smarty_tpl->tpl_vars['var']->total;$_smarty_tpl->tpl_vars['var']->value += $_smarty_tpl->tpl_vars['var']->step, $_smarty_tpl->tpl_vars['var']->iteration++){
$_smarty_tpl->tpl_vars['var']->first = $_smarty_tpl->tpl_vars['var']->iteration == 1;$_smarty_tpl->tpl_vars['var']->last = $_smarty_tpl->tpl_vars['var']->iteration == $_smarty_tpl->tpl_vars['var']->total;?>
				<div align="center"><a href="<?php echo $_smarty_tpl->getVariable('url_immagini')->value;?>
/<?php echo $_smarty_tpl->getVariable('image')->value[$_smarty_tpl->tpl_vars['var']->value];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->getVariable('url_immagini')->value;?>
/<?php echo $_smarty_tpl->getVariable('image')->value[$_smarty_tpl->tpl_vars['var']->value];?>
" width="200" height="200" alt="<?php echo $_smarty_tpl->getVariable('image')->value[$_smarty_tpl->tpl_vars['var']->value];?>
" /></a></div><br /><br />
				<b>Codice BBCode:</b> [img]<?php echo $_smarty_tpl->getVariable('url_immagini')->value;?>
/<?php echo $_smarty_tpl->getVariable('image')->value[$_smarty_tpl->tpl_vars['var']->value];?>
[/img]<br />
				<b>Codice BBCode con link:</b> [url=<?php echo $_smarty_tpl->getVariable('url_immagini')->value;?>
/<?php echo $_smarty_tpl->getVariable('image')->value[$_smarty_tpl->tpl_vars['var']->value];?>
][img]<?php echo $_smarty_tpl->getVariable('url_immagini')->value;?>
/<?php echo $_smarty_tpl->getVariable('image')->value[$_smarty_tpl->tpl_vars['var']->value];?>
[/img][/url]<br />
				<b>Codice HTML:</b> &lt;img src="<?php echo $_smarty_tpl->getVariable('url_immagini')->value;?>
/<?php echo $_smarty_tpl->getVariable('image')->value[$_smarty_tpl->tpl_vars['var']->value];?>
" alt="<?php echo $_smarty_tpl->getVariable('image')->value[$_smarty_tpl->tpl_vars['var']->value];?>
" /&gt;<br />
				<b>Codice HTML con link:</b> &lt;a href="<?php echo $_smarty_tpl->getVariable('url_immagini')->value;?>
/<?php echo $_smarty_tpl->getVariable('image')->value[$_smarty_tpl->tpl_vars['var']->value];?>
" target="_blank">&lt;img src="<?php echo $_smarty_tpl->getVariable('url_immagini')->value;?>
/<?php echo $_smarty_tpl->getVariable('image')->value[$_smarty_tpl->tpl_vars['var']->value];?>
" alt="<?php echo $_smarty_tpl->getVariable('image')->value[$_smarty_tpl->tpl_vars['var']->value];?>
" /&gt;&lt;/a&gt;<hr />					
			<?php }} ?>
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
