<?php /* Smarty version Smarty-3.0.8, created on 2011-06-19 18:29:40
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5709540664dfe40145be1f4-11634203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7808f9898dc1175403824d69eeb66c3cc1394aa9' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/index.tpl',
      1 => 1308507887,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5709540664dfe40145be1f4-11634203',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (isset($_smarty_tpl->getVariable('errore',null,true,false)->value)){?>
		<div id="titolo"><?php echo $_smarty_tpl->getVariable('contenuto')->value;?>
</div>
	<?php }else{ ?>
		<?php if (is_array($_smarty_tpl->getVariable('contenuto')->value)){?>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('contenuto')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<?php if ($_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
					<div id="titolo"><a href="news.php?titolo=<?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</a></div>
					<div id="newsheader" align="center">Scritto da <a href="profilo.php?nickname=<?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
"><?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
</a> il giorno <?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->ora;?>
 nella categoria <a href="categoria.php?cat=<?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->categoria;?>
"><?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->categoria;?>
</a>.</div><br />
					<div id="news"><?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->contenuto;?>
</div>
					<div align="right"><a href="news.php?titolo=<?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
">Lascia un commento</a></div>
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
?><?php if ($_smarty_tpl->tpl_vars['pagina']->value==$_smarty_tpl->getVariable('currentPage')->value&&!$_smarty_tpl->tpl_vars['pagina']->last){?><b><a href="?p=<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a></b> | <?php }elseif($_smarty_tpl->tpl_vars['pagina']->value!==$_smarty_tpl->getVariable('currentPage')->value&&$_smarty_tpl->tpl_vars['pagina']->last){?><a href="?p=<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a><?php }elseif($_smarty_tpl->tpl_vars['pagina']->value==$_smarty_tpl->getVariable('currentPage')->value&&$_smarty_tpl->tpl_vars['pagina']->last){?><b><a href="?p=<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a></b><?php }else{ ?><a href="?p=<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a> | <?php }?><?php }} ?></div>
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
