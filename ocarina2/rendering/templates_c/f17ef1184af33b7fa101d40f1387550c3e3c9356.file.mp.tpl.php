<?php /* Smarty version Smarty-3.0.8, created on 2011-07-29 19:21:08
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/mobile/mp.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8705426374e3308242ed217-17370420%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f17ef1184af33b7fa101d40f1387550c3e3c9356' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/mobile/mp.tpl',
      1 => 1311967264,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8705426374e3308242ed217-17370420',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (!$_smarty_tpl->getVariable('logged')->value){?>
		<div id="post-0" class="post">
		<h2 class="title"><?php echo $_smarty_tpl->getVariable('result')->value;?>
</h2>
		</div>
	<?php }elseif(!$_smarty_tpl->getVariable('result')->value){?>
		<div id="post-0" class="post">
		<h2 class="title">Nessun MP ricevuto.</h2>
		</div>
	<?php }else{ ?>
		<div id="post-0" class="post">
		<?php if (is_numeric($_smarty_tpl->getVariable('id')->value)){?>
			<b>Da:</b> <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profile/<?php echo $_smarty_tpl->getVariable('result')->value[0]->mittente;?>
.html"><?php echo $_smarty_tpl->getVariable('result')->value[0]->mittente;?>
</a><br />
			<b>Data:</b> <?php echo $_smarty_tpl->getVariable('result')->value[0]->data;?>
<br />
			<b>Oggetto:</b> <?php echo $_smarty_tpl->getVariable('result')->value[0]->oggetto;?>
<br />
			<b>Contenuto:</b><br />
			<?php echo $_smarty_tpl->getVariable('result')->value[0]->contenuto;?>

		<?php }else{ ?>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('result')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<?php if ($_smarty_tpl->getVariable('result')->value[$_smarty_tpl->tpl_vars['key']->value]->letto==1){?>
					&bull; <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/mp/<?php echo $_smarty_tpl->getVariable('result')->value[$_smarty_tpl->tpl_vars['key']->value]->id;?>
.html"><?php echo $_smarty_tpl->getVariable('result')->value[$_smarty_tpl->tpl_vars['key']->value]->oggetto;?>
</a> (Inviato il <?php echo $_smarty_tpl->getVariable('result')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 da <?php echo $_smarty_tpl->getVariable('result')->value[$_smarty_tpl->tpl_vars['key']->value]->mittente;?>
)<br />
				<?php }else{ ?>
					<font color="red">&bull;</font> <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/mp/<?php echo $_smarty_tpl->getVariable('result')->value[$_smarty_tpl->tpl_vars['key']->value]->id;?>
.html"><?php echo $_smarty_tpl->getVariable('result')->value[$_smarty_tpl->tpl_vars['key']->value]->oggetto;?>
</a> (Inviato il <?php echo $_smarty_tpl->getVariable('result')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 da <?php echo $_smarty_tpl->getVariable('result')->value[$_smarty_tpl->tpl_vars['key']->value]->mittente;?>
)<br />
				<?php }?>
			<?php }} ?>
		<?php }?>
		</div>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>