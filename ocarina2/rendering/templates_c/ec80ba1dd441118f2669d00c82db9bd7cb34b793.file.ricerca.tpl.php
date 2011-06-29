<?php /* Smarty version Smarty-3.0.8, created on 2011-06-29 16:08:22
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/ricerca.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8895550954e0b4df6a4e5b4-06359766%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec80ba1dd441118f2669d00c82db9bd7cb34b793' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/ricerca.tpl',
      1 => 1309363433,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8895550954e0b4df6a4e5b4-06359766',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ($_smarty_tpl->getVariable('cerca')->value){?>
		Cerca tra le news:<br />
		<form action="" method="post">
		<input type="text" name="news" /><input type="submit" value="Cerca" name="submitNews" />
		</form>
		<br />
		Cerca tra le pagine:<br />
		<form action="" method="post">
		<input type="text" name="pagine" /><input type="submit" value="Cerca" name="submitPage" />
		</form>
		<br />
		Cerca tra i commenti:<br />
		<form action="" method="post">
		<input type="text" name="commenti" /><input type="submit" value="Cerca" name="submitComment" />
		</form>
	<?php }else{ ?>
	
	<?php if (isset($_smarty_tpl->getVariable('error_news',null,true,false)->value)){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('error_news')->value;?>
</div>
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
	
	<?php if (isset($_smarty_tpl->getVariable('error_page',null,true,false)->value)){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('error_page')->value;?>
</div>
	<?php }elseif(isset($_smarty_tpl->getVariable('pagina',null,true,false)->value)){?>
		&bull; <b>Pagine</b><br />
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pagina')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<?php if ($_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
				&raquo; <a href="pagina.php?titolo=<?php echo $_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</a><br />
			<?php }?>
		<?php }} ?>
	<?php }?>
	
	<?php if (isset($_smarty_tpl->getVariable('error_comment',null,true,false)->value)){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('error_comment')->value;?>
</div>
	<?php }elseif(isset($_smarty_tpl->getVariable('commento',null,true,false)->value)){?>
		&bull; <b>Commenti</b><br />
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('commento')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<?php if ($_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
				&raquo; <a href="news.php?titolo=<?php echo $_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->news;?>
">#<?php echo $_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->id;?>
</a><br />
			<?php }?>
		<?php }} ?>
	<?php }?>
	
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
