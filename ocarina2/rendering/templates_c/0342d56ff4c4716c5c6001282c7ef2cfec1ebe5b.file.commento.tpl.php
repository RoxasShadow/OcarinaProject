<?php /* Smarty version Smarty-3.0.8, created on 2011-07-05 00:50:17
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/commento.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3889872494e125fc9332509-08778416%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0342d56ff4c4716c5c6001282c7ef2cfec1ebe5b' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/commento.tpl',
      1 => 1309526080,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3889872494e125fc9332509-08778416',
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
		<?php if (isset($_smarty_tpl->getVariable('commento',null,true,false)->value)){?>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('commento')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<?php if ($_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
					<div class="titolo">Commento #<?php echo $_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->id;?>
</div>
					<div class="newsheader" align="center">Scritto da <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profilo.php?nickname=<?php echo $_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
"><?php echo $_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
</a> il giorno <?php echo $_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->ora;?>
.(<a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/news.php?titolo=<?php echo $_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->news;?>
">News originale</a>)</div><br />
					<div class="news"><?php echo $_smarty_tpl->getVariable('commento')->value[$_smarty_tpl->tpl_vars['key']->value]->contenuto;?>
</div>
				<?php }else{ ?>
					Il commento non è stato approvato, e quindi non è visibile.
				<?php }?>
			<?php }} ?>
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
