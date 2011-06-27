<?php /* Smarty version Smarty-3.0.8, created on 2011-06-26 21:48:48
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/admin/cancellanews.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18334794234e07a940176568-36637736%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9064ae86f1f8f6f2ed26c252f1c03d24fa6fcd01' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/admin/cancellanews.tpl',
      1 => 1309124509,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18334794234e07a940176568-36637736',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ($_smarty_tpl->getVariable('utente')->value==''||$_smarty_tpl->getVariable('grado')->value==''||!$_smarty_tpl->getVariable('logged')->value){?>
		Accesso negato.
	<?php }elseif($_smarty_tpl->getVariable('grado')->value<3&&!$_smarty_tpl->getVariable('submit')->value){?>
		<form action="" method="post">
		News da cancellare<br />
		<select name="news">
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<option value="<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</option>
		<?php }} ?>
		</select>
		<input type="submit" name="submit" value="Cancella news" />
		</form>
	<?php }elseif($_smarty_tpl->getVariable('grado')->value<3&&$_smarty_tpl->getVariable('submit')->value){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }else{ ?>
		Accesso negato.
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
