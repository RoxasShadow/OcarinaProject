<?php /* Smarty version Smarty-3.0.8, created on 2011-07-29 16:04:25
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/default/leggimp.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2862393244e32da099baed6-33147385%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f15ba7750220706c296627eafdb5aec748abf139' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/default/leggimp.tpl',
      1 => 1311955464,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2862393244e32da099baed6-33147385',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (!$_smarty_tpl->getVariable('result')->value){?>
		<div class="titolo">0 Messaggi Personali</div>
	<?php }else{ ?>
		<?php if (isset($_smarty_tpl->getVariable('id',null,true,false)->value)){?>
			<?php if (isset($_smarty_tpl->getVariable('mp',null,true,false)->value)){?>
				MP non esistente.
			<?php }else{ ?>
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mp')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
					Da: <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profile/<?php echo $_smarty_tpl->getVariable('mp')->value[0]->mittente;?>
.html"><?php echo $_smarty_tpl->getVariable('mp')->value[0]->mittente;?>
</a><br />
					Data: <?php echo $_smarty_tpl->getVariable('mp')->value[0]->data;?>
<br />
					Oggetto: <?php echo $_smarty_tpl->getVariable('mp')->value[0]->oggetto;?>
<br />
					Contenuto:<br />
					<?php echo $_smarty_tpl->getVariable('mp')->value[0]->contenuto;?>

				<?php }} ?>
			<?php }?>
		<?php }else{ ?>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mp')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				&bull; <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/pm/<?php echo $_smarty_tpl->getVariable('mp')->value[$_smarty_tpl->tpl_vars['key']->value]->id;?>
.html"><?php echo $_smarty_tpl->getVariable('mp')->value[$_smarty_tpl->tpl_vars['key']->value]->oggetto;?>
</a> (Inviato il <?php echo $_smarty_tpl->getVariable('mp')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 da <?php echo $_smarty_tpl->getVariable('mp')->value[$_smarty_tpl->tpl_vars['key']->value]->mittente;?>
)<br />
			<?php }} ?>
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
