<?php /* Smarty version Smarty-3.0.8, created on 2011-07-11 19:30:54
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/admin/approva.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17791901484e1b4f6ec89767-66398910%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71057f27afa35d2cec8f7d00172696745455991e' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/admin/approva.tpl',
      1 => 1310412647,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17791901484e1b4f6ec89767-66398910',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ((($_smarty_tpl->getVariable('grado')->value=='')||($_smarty_tpl->getVariable('grado')->value>2))){?>
		Accesso negato
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value){?>
		<form action="" method="post">
		<table>
		<tr>
		<td><b>News</b></td>
		<td><b>Commenti</b></td>
		<td><b>Pagine</b></td>
		<td></td>
		</tr>
		<tr>
		<td>
		<select name="news">
		<option value="">------</option>
		<?php if (((isset($_smarty_tpl->getVariable('news',null,true,false)->value))&&(!empty($_smarty_tpl->getVariable('news',null,true,false)->value)))){?>
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
		<?php }?>
		</select>
		</td>
		<td>
		<select name="commento">
		<option value="">------</option>
		<?php if (((isset($_smarty_tpl->getVariable('commenti',null,true,false)->value))&&(!empty($_smarty_tpl->getVariable('commenti',null,true,false)->value)))){?>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('commenti')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<option value="<?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->id;?>
">#<?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->id;?>
</option>
			<?php }} ?>
		<?php }?>
		</select>
		</td>
		<td>
		<select name="pagina">
		<option value="">------</option>
		<?php if (((isset($_smarty_tpl->getVariable('pagine',null,true,false)->value))&&(!empty($_smarty_tpl->getVariable('pagine',null,true,false)->value)))){?>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pagine')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<option value="<?php echo $_smarty_tpl->getVariable('pagine')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('pagine')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</option>
			<?php }} ?>
		<?php }?>
		</select>
		</td>
		<td><input type="submit" name="submit" value="Approva selezionato" /></td>
		</tr>
		</table>
		</form>
	<?php }elseif($_smarty_tpl->getVariable('submit')->value){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
