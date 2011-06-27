<?php /* Smarty version Smarty-3.0.8, created on 2011-06-27 00:02:10
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/admin/gestiscicategorie.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13403267754e07c8823bdc84-89351393%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95dd2c85a08a391a57f60347d985f6d9def7165f' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/admin/gestiscicategorie.tpl',
      1 => 1309132928,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13403267754e07c8823bdc84-89351393',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ($_smarty_tpl->getVariable('utente')->value==''||$_smarty_tpl->getVariable('grado')->value==''||!$_smarty_tpl->getVariable('logged')->value){?>
		Accesso negato.
	<?php }elseif($_smarty_tpl->getVariable('grado')->value<4&&!$_smarty_tpl->getVariable('submit')->value&&!isset($_smarty_tpl->getVariable('result',null,true,false)->value)){?>
		<form action="" method="post">
		Crea categoria per le news<br />
		<input type="text" name="categoria_news" /><br />
		<input type="submit" name="submit" value="Crea categoria" /><br /><br />
		
		Crea categoria per le pagine<br />
		<input type="text" name="categoria_pagina" /><br />
		<input type="submit" name="submit" value="Crea categoria" /><br /><br />
		
		Rimuovi categoria per le news<br />
		<select name="categoria_news_rimuovi">
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categorie_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<option value="<?php echo $_smarty_tpl->getVariable('categorie_news')->value[$_smarty_tpl->tpl_vars['key']->value];?>
"><?php echo $_smarty_tpl->getVariable('categorie_news')->value[$_smarty_tpl->tpl_vars['key']->value];?>
</option>
		<?php }} ?>
		</select><br />
		<input type="submit" name="submit" value="Rimuovi categoria" /><br /><br />
		
		Rimuovi categoria per le pagine<br />
		<select name="categoria_pagina_rimuovi">
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categorie_pagine')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<option value="<?php echo $_smarty_tpl->getVariable('categorie_pagine')->value[$_smarty_tpl->tpl_vars['key']->value];?>
"><?php echo $_smarty_tpl->getVariable('categorie_pagine')->value[$_smarty_tpl->tpl_vars['key']->value];?>
</option>
		<?php }} ?>
		</select><br />
		<input type="submit" name="submit" value="Rimuovi categoria" />
		</form>
	<?php }elseif($_smarty_tpl->getVariable('grado')->value<4&&$_smarty_tpl->getVariable('submit')->value||(!$_smarty_tpl->getVariable('submit')->value&&isset($_smarty_tpl->getVariable('result',null,true,false)->value))){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }else{ ?>
		Accesso negato.
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
