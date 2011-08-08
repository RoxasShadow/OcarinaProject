<?php /* Smarty version Smarty-3.0.8, created on 2011-08-08 16:53:02
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/admin/log.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19521086954e40146e69dbb6-93403741%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13ea0142f7ce7513ab1cd7e7cfc6eac83d8d3621' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/admin/log.tpl',
      1 => 1312822380,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19521086954e40146e69dbb6-93403741',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ((($_smarty_tpl->getVariable('grado')->value=='')||($_smarty_tpl->getVariable('grado')->value>=6))){?>
		Accesso negato.
	<?php }elseif(isset($_smarty_tpl->getVariable('error',null,true,false)->value)){?>
		<?php echo $_smarty_tpl->getVariable('error')->value;?>

	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value){?>
		<table>
		<tr>
		<td><b>Nickname</b></td>
		<td><b>Azione</b></td>
		<td><b>IP</b></td>
		<td><b>Data e ora</b></td>
		<td><b>Useragent</b></td>
		<td><b>Referer</b></td>
		</tr>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('log')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<tr>
			<?php if ($_smarty_tpl->getVariable('log')->value[$_smarty_tpl->tpl_vars['key']->value]->nickname=='~'){?>
				<td>~</td>
			<?php }else{ ?>
				<td><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profilo.php?nickname=<?php echo $_smarty_tpl->getVariable('log')->value[$_smarty_tpl->tpl_vars['key']->value]->nickname;?>
"><?php echo $_smarty_tpl->getVariable('log')->value[$_smarty_tpl->tpl_vars['key']->value]->nickname;?>
</a></td>
			<?php }?>
			<td><?php echo $_smarty_tpl->getVariable('log')->value[$_smarty_tpl->tpl_vars['key']->value]->azione;?>
</td>
			<td><a href="http://www.db.ripe.net/whois?form_type=simple&full_query_string=&do_search=Search&searchtext=<?php echo $_smarty_tpl->getVariable('log')->value[$_smarty_tpl->tpl_vars['key']->value]->ip;?>
"><?php echo $_smarty_tpl->getVariable('log')->value[$_smarty_tpl->tpl_vars['key']->value]->ip;?>
</a></td>
			<td><?php echo $_smarty_tpl->getVariable('log')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 alle <?php echo $_smarty_tpl->getVariable('log')->value[$_smarty_tpl->tpl_vars['key']->value]->ora;?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('log')->value[$_smarty_tpl->tpl_vars['key']->value]->useragent;?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('log')->value[$_smarty_tpl->tpl_vars['key']->value]->referer;?>
</td>
			</tr>
		<?php }} ?>
		</table>
		<?php if ($_smarty_tpl->getVariable('grado')->value==1){?>
			<br /><br />
			<form action="" method="post">
			<input type="submit" name="submit" value="Pulisci i log" />
			</form>
		<?php }?>
		<div align="center"><?php  $_smarty_tpl->tpl_vars['pagina'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('navigatore')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['pagina']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['pagina']->iteration=0;
if ($_smarty_tpl->tpl_vars['pagina']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pagina']->key => $_smarty_tpl->tpl_vars['pagina']->value){
 $_smarty_tpl->tpl_vars['pagina']->iteration++;
 $_smarty_tpl->tpl_vars['pagina']->last = $_smarty_tpl->tpl_vars['pagina']->iteration === $_smarty_tpl->tpl_vars['pagina']->total;
?><?php if ($_smarty_tpl->tpl_vars['pagina']->value==$_smarty_tpl->getVariable('currentPage')->value&&!$_smarty_tpl->tpl_vars['pagina']->last){?><b><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/admin/log/<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
.html"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a></b> | <?php }elseif($_smarty_tpl->tpl_vars['pagina']->value!==$_smarty_tpl->getVariable('currentPage')->value&&$_smarty_tpl->tpl_vars['pagina']->last){?><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/admin/log/<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
.html"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a><?php }elseif($_smarty_tpl->tpl_vars['pagina']->value==$_smarty_tpl->getVariable('currentPage')->value&&$_smarty_tpl->tpl_vars['pagina']->last){?><b><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/admin/log/<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
.html"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a></b><?php }else{ ?><a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/admin/log/<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
.html"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a> | <?php }?><?php }} ?></div>
	<?php }elseif($_smarty_tpl->getVariable('grado')->value==1&&$_smarty_tpl->getVariable('submit')->value){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }else{ ?>
		Accesso negato.
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
