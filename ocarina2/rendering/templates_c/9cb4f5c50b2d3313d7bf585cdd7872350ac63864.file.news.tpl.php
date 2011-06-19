<?php /* Smarty version Smarty-3.0.8, created on 2011-06-19 20:16:20
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/news.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17331396174dfe5914b2fb80-59435331%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9cb4f5c50b2d3313d7bf585cdd7872350ac63864' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/news.tpl',
      1 => 1308514579,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17331396174dfe5914b2fb80-59435331',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (isset($_smarty_tpl->getVariable('errore',null,true,false)->value)){?>
		<div id="titolo"><?php echo $_smarty_tpl->getVariable('errore')->value;?>
</div>
	<?php }elseif(isset($_smarty_tpl->getVariable('commentSended',null,true,false)->value)){?>
		<div id="titolo"><?php echo $_smarty_tpl->getVariable('commentSended')->value;?>
</div>
	<?php }elseif(is_array($_smarty_tpl->getVariable('news')->value)){?>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->iteration=0;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
 $_smarty_tpl->tpl_vars['item']->iteration++;
?>
			<?php if ($_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
				<div id="titolo"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</div>
				<div id="newsheader" align="center">Scritto da <a href="profilo.php?nickname=<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
</a> il giorno <?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->ora;?>
 nella categoria <a href="categoria.php?cat=<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->categoria;?>
"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->categoria;?>
</a>.</div><br />
				<div id="news"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->contenuto;?>
</div>
			<?php }?>
		<?php }} ?>
		<?php if (!is_array($_smarty_tpl->getVariable('commenti')->value)){?>
			<br /><hr /><br />
			<div id="news"><?php echo $_smarty_tpl->getVariable('commenti')->value;?>
</div>
		<?php }else{ ?>
			<br /><hr /><br />
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('commenti')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->iteration=0;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
 $_smarty_tpl->tpl_vars['item']->iteration++;
?>
				<fieldset><legend>#<?php echo $_smarty_tpl->tpl_vars['item']->iteration;?>
 Commento inviato il giorno <?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->ora;?>
 da <a href="profilo.php?nickname=<?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
"><?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
</a></legend><?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->contenuto;?>
</fieldset><br />
			<?php }} ?>
		<?php }?>
		<br />
		<form action="" method="post">
		<textarea name="comment" cols="59" rows="10"></textarea><br />
		<input type="submit" value="Invia commento" />
		</form>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
