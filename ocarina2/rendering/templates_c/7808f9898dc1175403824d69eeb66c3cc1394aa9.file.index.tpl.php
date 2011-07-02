<?php /* Smarty version Smarty-3.0.8, created on 2011-07-02 18:24:13
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5456152114e0f624d6098e8-23042081%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7808f9898dc1175403824d69eeb66c3cc1394aa9' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/index.tpl',
      1 => 1309631020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5456152114e0f624d6098e8-23042081',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_php')) include '/var/www/htdocs/ocarina2/rendering/plugins/block.php.php';
?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (isset($_smarty_tpl->getVariable('lastlogout',null,true,false)->value)){?>
		<div align="center">Ciao <?php echo $_smarty_tpl->getVariable('utente')->value;?>
, non ti connettevi a <?php echo $_smarty_tpl->getVariable('nomesito')->value;?>
 dal <?php echo $_smarty_tpl->getVariable('lastlogout')->value;?>
, siamo felici di rivederti!</div>
	<?php }?>
	<?php if (isset($_smarty_tpl->getVariable('errore',null,true,false)->value)){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('errore')->value;?>
</div>
	<?php }else{ ?>
		<?php if (is_array($_smarty_tpl->getVariable('news')->value)){?>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<?php if ($_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
					<div class="titolo"><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/news.php?titolo=<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</a></div>
					<div class="newsheader" align="center">Scritto da <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profilo.php?nickname=<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
</a> il giorno <?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->ora;?>
 nella categoria <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/categoria.php?cat=<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->categoria;?>
"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->categoria;?>
</a>.</div><br />
					<div class="news"><p><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->contenuto;?>
</p></div>
					<div align="right"><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/news.php?titolo=<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
">Lascia un commento <?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; smarty_block_php(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
require_once('core/class.Comments.php'); $v = new Comments(); echo $v->countCommentByNews('<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
');<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_php(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a></div>
					<hr />
				<?php }?>
			<?php }} ?>
			<div align="center"><?php  $_smarty_tpl->tpl_vars['pagina'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('navigatore')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['pagina']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['pagina']->iteration=0;
if ($_smarty_tpl->tpl_vars['pagina']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pagina']->key => $_smarty_tpl->tpl_vars['pagina']->value){
 $_smarty_tpl->tpl_vars['pagina']->iteration++;
 $_smarty_tpl->tpl_vars['pagina']->last = $_smarty_tpl->tpl_vars['pagina']->iteration === $_smarty_tpl->tpl_vars['pagina']->total;
?><?php if ($_smarty_tpl->tpl_vars['pagina']->value==$_smarty_tpl->getVariable('currentPage')->value&&!$_smarty_tpl->tpl_vars['pagina']->last){?><b><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/Aindex.php?p=<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a></b> | <?php }elseif($_smarty_tpl->tpl_vars['pagina']->value!==$_smarty_tpl->getVariable('currentPage')->value&&$_smarty_tpl->tpl_vars['pagina']->last){?><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/Aindex.php?p=<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a><?php }elseif($_smarty_tpl->tpl_vars['pagina']->value==$_smarty_tpl->getVariable('currentPage')->value&&$_smarty_tpl->tpl_vars['pagina']->last){?><b><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/Aindex.php?p=<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a></b><?php }else{ ?><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/Aindex.php?p=<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a> | <?php }?><?php }} ?></div>
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
