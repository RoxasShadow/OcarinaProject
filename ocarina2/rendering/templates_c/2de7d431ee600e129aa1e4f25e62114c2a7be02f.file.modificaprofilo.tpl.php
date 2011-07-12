<?php /* Smarty version Smarty-3.0.8, created on 2011-07-12 22:47:19
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/default/modificaprofilo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4565448044e1ccef73bce02-90810571%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2de7d431ee600e129aa1e4f25e62114c2a7be02f' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/default/modificaprofilo.tpl',
      1 => 1309526080,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4565448044e1ccef73bce02-90810571',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/htdocs/ocarina2/rendering/plugins/modifier.capitalize.php';
?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (!$_smarty_tpl->getVariable('logged')->value){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('result')->value;?>
</div>
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value){?>
		<form action="" method="post">
		Email<br />
		<input type="text" name="email" value="<?php echo $_smarty_tpl->getVariable('email')->value;?>
" /><br /><br />
		Skin<br />
		<select name="skin">
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listaskin')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<?php if ($_smarty_tpl->getVariable('listaskin')->value[$_smarty_tpl->tpl_vars['key']->value]==$_smarty_tpl->getVariable('skinattuale')->value){?>
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
		Bio<br />
		<textarea name="bio" cols="22" rows="10"><?php echo $_smarty_tpl->getVariable('bio')->value;?>
</textarea><br /><br />
		Avatar<br />
		<input type="text" name="avatar" value="<?php echo $_smarty_tpl->getVariable('avatar')->value;?>
" /><br /><br />
		Password (per confermare le modifiche)<br />
		<input type="password" name="password" /><br /><br />
		<input type="submit" value="Modifica profilo" name="submit" />
		</form>
	<?php }else{ ?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('result')->value;?>
</div>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
