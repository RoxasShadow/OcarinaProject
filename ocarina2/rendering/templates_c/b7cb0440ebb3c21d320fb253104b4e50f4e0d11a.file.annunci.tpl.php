<?php /* Smarty version Smarty-3.0.8, created on 2011-07-14 22:33:31
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/admin/annunci.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6192353734e1f6ebb5d3e77-63747187%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7cb0440ebb3c21d320fb253104b4e50f4e0d11a' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/admin/annunci.tpl',
      1 => 1310682807,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6192353734e1f6ebb5d3e77-63747187',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ((($_smarty_tpl->getVariable('grado')->value=='')||($_smarty_tpl->getVariable('grado')->value>=6))){?>
		Accesso negato.
	<?php }elseif(is_array($_smarty_tpl->getVariable('ads')->value)){?>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('ads')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<fieldset><legend><?php echo $_smarty_tpl->getVariable('ads')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
 - Scritto da <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profile/<?php echo $_smarty_tpl->getVariable('ads')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
.html"><?php echo $_smarty_tpl->getVariable('ads')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
</a> il giorno <?php echo $_smarty_tpl->getVariable('ads')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('ads')->value[$_smarty_tpl->tpl_vars['key']->value]->ora;?>
.</legend><?php echo $_smarty_tpl->getVariable('ads')->value[$_smarty_tpl->tpl_vars['key']->value]->contenuto;?>
</fieldset>
			<br /><br />
		<?php }} ?>
	<?php }else{ ?>
		Nessun annuncio presente.
	<?php }?>
