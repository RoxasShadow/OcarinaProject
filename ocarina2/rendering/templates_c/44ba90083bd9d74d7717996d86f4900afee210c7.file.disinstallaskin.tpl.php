<?php /* Smarty version Smarty-3.0.8, created on 2011-08-02 21:05:10
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/admin/disinstallaskin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4532355364e386686756032-45072321%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44ba90083bd9d74d7717996d86f4900afee210c7' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/admin/disinstallaskin.tpl',
      1 => 1311542302,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4532355364e386686756032-45072321',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/htdocs/ocarina2/rendering/plugins/modifier.capitalize.php';
?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (!(($_smarty_tpl->getVariable('grado')->value==1)||($_smarty_tpl->getVariable('grado')->value==4))){?>
		Accesso negato.
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value){?>
		<form action="" method="post" enctype="multipart/form-data">
		<select name="nomeskin">
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listaskin')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<option value="<?php echo $_smarty_tpl->getVariable('listaskin')->value[$_smarty_tpl->tpl_vars['key']->value];?>
"><?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('listaskin')->value[$_smarty_tpl->tpl_vars['key']->value]);?>
</option>
			<?php }} ?>
		</select>
		<input name="submit" type="submit" value="Disinstalla" />				
		</form>
	<?php }else{ ?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
