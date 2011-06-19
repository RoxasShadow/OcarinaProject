<?php /* Smarty version Smarty-3.0.8, created on 2011-06-19 19:53:11
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/categoria.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7598177194dfe53a773bdb1-29438587%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ca93c7496c36aaae90c5c5579beedb1ff8fb154' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/categoria.tpl',
      1 => 1308513190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7598177194dfe53a773bdb1-29438587',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (!is_array($_smarty_tpl->getVariable('news')->value)&&isset($_smarty_tpl->getVariable('errore_news',null,true,false)->value)){?>
		<?php echo $_smarty_tpl->getVariable('errore_news')->value;?>

	<?php }elseif(isset($_smarty_tpl->getVariable('news',null,true,false)->value)){?>
		&bull; <b>News</b><br />
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<?php if ($_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
				&raquo; <a href="news.php?titolo=<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</a><br />
			<?php }?>
		<?php }} ?>
	<?php }?>
	<hr />
	<?php if (!is_array($_smarty_tpl->getVariable('pagine')->value)&&isset($_smarty_tpl->getVariable('errore_pagine',null,true,false)->value)){?>
		<?php echo $_smarty_tpl->getVariable('errore_pagine')->value;?>

	<?php }elseif(isset($_smarty_tpl->getVariable('news',null,true,false)->value)){?>
		&bull; <b>Pagine</b><br />
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pagine')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<?php if ($_smarty_tpl->getVariable('pagine')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
				&raquo; <a href="pagina.php?titolo=<?php echo $_smarty_tpl->getVariable('pagine')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('pagine')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</a><br />
			<?php }?>
		<?php }} ?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
