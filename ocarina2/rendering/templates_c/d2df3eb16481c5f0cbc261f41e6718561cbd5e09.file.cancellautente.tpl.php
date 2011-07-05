<?php /* Smarty version Smarty-3.0.8, created on 2011-07-04 23:27:10
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/admin/cancellautente.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19509862204e124c4e610383-65821536%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2df3eb16481c5f0cbc261f41e6718561cbd5e09' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/admin/cancellautente.tpl',
      1 => 1309821997,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19509862204e124c4e610383-65821536',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ((($_smarty_tpl->getVariable('grado')->value=='')||($_smarty_tpl->getVariable('grado')->value>1))){?>
		Accesso negato.
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value){?>
		<form action="" method="post">
		Utente<br />
		<select name="nickname">
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('utenti')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<option value="<?php echo $_smarty_tpl->getVariable('utenti')->value[$_smarty_tpl->tpl_vars['key']->value]->nickname;?>
"><?php echo $_smarty_tpl->getVariable('utenti')->value[$_smarty_tpl->tpl_vars['key']->value]->nickname;?>
</option>
		<?php }} ?>
		</select>
		Rimuovi anche tutti i suoi contenuti <input type="checkbox" name="all" />
		<br />
		<input type="submit" name="submit" value="Cancella" />
		</form>
	<?php }elseif($_smarty_tpl->getVariable('submit')->value){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
