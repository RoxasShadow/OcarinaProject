<?php /* Smarty version Smarty-3.0.8, created on 2011-07-04 17:28:24
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/archivio.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10781713014e11f838026e27-35365861%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f51d14a16b3a3e94fbaa5e998f6b665475ec09f8' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/archivio.tpl',
      1 => 1309800500,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10781713014e11f838026e27-35365861',
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
		<?php if (!isset($_smarty_tpl->getVariable('news',null,true,false)->value)&&isset($_smarty_tpl->getVariable('errore_news',null,true,false)->value)){?>
			<div class="titolo"><?php echo $_smarty_tpl->getVariable('errore_news')->value;?>
</div>
		<?php }elseif(isset($_smarty_tpl->getVariable('news',null,true,false)->value)){?>
			&bull; <b>News</b> <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/feed.php?content=news"><img src="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/images/rss.png" alt="Feed RSS News" height="12" width="18" /></a><br />
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<?php if ($_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
					&raquo; <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/news.php?titolo=<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</a><br />
				<?php }?>
			<?php }} ?>
		<?php }?>
		<hr />
		<?php if (!isset($_smarty_tpl->getVariable('pagine',null,true,false)->value)&&isset($_smarty_tpl->getVariable('errore_pagine',null,true,false)->value)){?>
			<div class="titolo"><?php echo $_smarty_tpl->getVariable('errore_pagine')->value;?>
</div>
		<?php }elseif(isset($_smarty_tpl->getVariable('news',null,true,false)->value)){?>
			&bull; <b>Pagine <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/feed.php?content=page"><img src="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/images/rss.png" alt="Feed RSS News" height="12" width="18" /></a></b><br />
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pagine')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<?php if ($_smarty_tpl->getVariable('pagine')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
					&raquo; <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/pagina.php?titolo=<?php echo $_smarty_tpl->getVariable('pagine')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('pagine')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</a><br />
				<?php }?>
			<?php }} ?>
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
