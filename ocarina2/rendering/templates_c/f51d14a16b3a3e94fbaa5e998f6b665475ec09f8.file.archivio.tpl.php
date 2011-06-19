<?php /* Smarty version Smarty-3.0.8, created on 2011-06-19 14:48:36
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/archivio.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17965787394dfe0c44b4f5a1-85113160%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f51d14a16b3a3e94fbaa5e998f6b665475ec09f8' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/archivio.tpl',
      1 => 1308494913,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17965787394dfe0c44b4f5a1-85113160',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	&bull; <b>News</b><br />
	<?php if (is_array($_smarty_tpl->getVariable('news')->value)){?>
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
	<?php if ($_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
	<?php if ($_smarty_tpl->getVariable('news')->last){?>
	&raquo; <a href="news.php?titolo=<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</a>
	<?php }else{ ?>
	&raquo; <a href="news.php?titolo=<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</a><br />
	<?php }?>
	<?php }?>
	<?php }} ?></div>
	<?php }else{ ?>
	<div id="titolo"><?php echo $_smarty_tpl->getVariable('news')->value;?>
</div>
	<?php }?>
	<hr />
	&bull; <b>Pagine</b><br />
	<?php if (is_array($_smarty_tpl->getVariable('pagine')->value)){?>
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pagine')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
	<?php if ($_smarty_tpl->getVariable('pagine')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
	<?php if ($_smarty_tpl->getVariable('pagine')->last){?>
	&raquo; <a href="pagina.php?titolo=<?php echo $_smarty_tpl->getVariable('pagine')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('pagine')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</a>
	<?php }else{ ?>
	&raquo; <a href="pagina.php?titolo=<?php echo $_smarty_tpl->getVariable('pagine')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('pagine')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</a><br />
	<?php }?>
	<?php }?>
	<?php }} ?>
	<?php }else{ ?>
	<div id="titolo"><?php echo $_smarty_tpl->getVariable('pagine')->value;?>
</div>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
