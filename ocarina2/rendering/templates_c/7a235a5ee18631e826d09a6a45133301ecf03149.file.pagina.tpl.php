<?php /* Smarty version Smarty-3.0.8, created on 2011-06-30 18:23:47
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/pagina.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7103993764e0cbf333ecb87-20178346%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a235a5ee18631e826d09a6a45133301ecf03149' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/pagina.tpl',
      1 => 1309394368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7103993764e0cbf333ecb87-20178346',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (isset($_smarty_tpl->getVariable('errore',null,true,false)->value)){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('errore')->value;?>
</div>
	<?php }else{ ?>
		<?php if (is_array($_smarty_tpl->getVariable('pagina')->value)){?>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pagina')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<?php if ($_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
					<div class="titolo"><?php echo $_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</div>
					<div class="newsheader" align="center">Scritto da <a href="profilo.php?nickname=<?php echo $_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
"><?php echo $_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
</a> il giorno <?php echo $_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->ora;?>
 nella categoria <a href="categoria.php?cat=<?php echo $_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->categoria;?>
"><?php echo $_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->categoria;?>
</a>.</div><br />
					<div class="news"><?php echo $_smarty_tpl->getVariable('pagina')->value[$_smarty_tpl->tpl_vars['key']->value]->contenuto;?>
</div>
				<?php }else{ ?>
					La pagina non è stata approvata, e quindi non è visibile.
				<?php }?>
			<?php }} ?>
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
