<?php /* Smarty version Smarty-3.0.8, created on 2011-07-29 19:27:48
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/mobile/ricerca.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18766339314e3309b46fa175-79525793%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0384ecf479dab6233b8ee3765b2d06eb2a0bd9d5' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/mobile/ricerca.tpl',
      1 => 1311527918,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18766339314e3309b46fa175-79525793',
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
			&raquo; <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/news/<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
.html"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</a><br />
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
			&raquo; <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/page/<?php echo $_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
.html"><?php echo $_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</a><br />
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
			&raquo; <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/comment/<?php echo $_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->id;?>
.html">#<?php echo $_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->id;?>
 - <?php echo $_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
</a><br />
		<?php }} ?>
	<?php }?>
	
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>