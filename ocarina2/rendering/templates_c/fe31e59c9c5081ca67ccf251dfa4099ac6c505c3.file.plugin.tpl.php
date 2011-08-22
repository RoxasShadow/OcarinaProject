<?php /* Smarty version Smarty-3.0.8, created on 2011-08-22 20:04:04
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/admin/plugin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9885796234e52b634dcd845-74827815%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fe31e59c9c5081ca67ccf251dfa4099ac6c505c3' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/admin/plugin.tpl',
      1 => 1314023126,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9885796234e52b634dcd845-74827815',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ((($_smarty_tpl->getVariable('grado')->value=='')||($_smarty_tpl->getVariable('grado')->value>1))){?>
		Accesso negato.
	<?php }elseif(isset($_smarty_tpl->getVariable('result',null,true,false)->value)){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }elseif(isset($_smarty_tpl->getVariable('plugins',null,true,false)->value)){?>
		<form action="" method="post" enctype="multipart/form-data">
		<input name="plugin" type="file" size="40" /><br />
		<input name="upload" type="submit" value="Upload" />				
		</form>
		<br />
		<?php if (isset($_smarty_tpl->getVariable('plugins',null,true,false)->value['name'])){?>
			<table>
			<tr>
			<td><b>Nome</b></td>
			<td><b>Autore</b></td>
			<td><b>Descrizione</b></td>
			<td><b>Percorso</b></td>
			<td><b>Abilitato</b></td>
			</tr>
			<?php $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['var']->step = 1;$_smarty_tpl->tpl_vars['var']->total = (int)ceil(($_smarty_tpl->tpl_vars['var']->step > 0 ? count($_smarty_tpl->getVariable('plugins')->value['name'])-1+1 - (0) : 0-(count($_smarty_tpl->getVariable('plugins')->value['name'])-1)+1)/abs($_smarty_tpl->tpl_vars['var']->step));
if ($_smarty_tpl->tpl_vars['var']->total > 0){
for ($_smarty_tpl->tpl_vars['var']->value = 0, $_smarty_tpl->tpl_vars['var']->iteration = 1;$_smarty_tpl->tpl_vars['var']->iteration <= $_smarty_tpl->tpl_vars['var']->total;$_smarty_tpl->tpl_vars['var']->value += $_smarty_tpl->tpl_vars['var']->step, $_smarty_tpl->tpl_vars['var']->iteration++){
$_smarty_tpl->tpl_vars['var']->first = $_smarty_tpl->tpl_vars['var']->iteration == 1;$_smarty_tpl->tpl_vars['var']->last = $_smarty_tpl->tpl_vars['var']->iteration == $_smarty_tpl->tpl_vars['var']->total;?>
				<tr>
				<td><?php echo $_smarty_tpl->getVariable('plugins')->value['name'][$_smarty_tpl->tpl_vars['var']->value];?>
 <?php echo $_smarty_tpl->getVariable('plugins')->value['version'][$_smarty_tpl->tpl_vars['var']->value];?>
 (<a href="?disinstall=<?php echo $_smarty_tpl->getVariable('plugins')->value['name'][$_smarty_tpl->tpl_vars['var']->value];?>
">Disinstalla</a>)</td>
				<td><a href="http://<?php echo $_smarty_tpl->getVariable('plugins')->value['website'][$_smarty_tpl->tpl_vars['var']->value];?>
"><?php echo $_smarty_tpl->getVariable('plugins')->value['author'][$_smarty_tpl->tpl_vars['var']->value];?>
</a></td>
				<td><?php echo $_smarty_tpl->getVariable('plugins')->value['description'][$_smarty_tpl->tpl_vars['var']->value];?>
</td>
				<td><?php echo $_smarty_tpl->getVariable('plugins')->value['path'][$_smarty_tpl->tpl_vars['var']->value];?>
</td>
				<?php if ($_smarty_tpl->getVariable('plugins')->value['enabled'][$_smarty_tpl->tpl_vars['var']->value]=='true'){?>
					<td><a href="?deactive=<?php echo $_smarty_tpl->getVariable('plugins')->value['name'][$_smarty_tpl->tpl_vars['var']->value];?>
">Si</a></td>
				<?php }elseif($_smarty_tpl->getVariable('plugins')->value['enabled'][$_smarty_tpl->tpl_vars['var']->value]=='false'){?>
					<td><a href="?active=<?php echo $_smarty_tpl->getVariable('plugins')->value['name'][$_smarty_tpl->tpl_vars['var']->value];?>
">No</a></td>
				<?php }?>
			<?php }} ?>
			</table>
		<?php }else{ ?>
			Nessun plugin attualmente installato.
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
