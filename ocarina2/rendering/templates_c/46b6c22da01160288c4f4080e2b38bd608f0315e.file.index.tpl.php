<?php /* Smarty version Smarty-3.0.8, created on 2011-07-04 20:00:31
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/admin/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16911732944e121bdfc287b0-09576455%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46b6c22da01160288c4f4080e2b38bd608f0315e' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/admin/index.tpl',
      1 => 1309809630,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16911732944e121bdfc287b0-09576455',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ((($_smarty_tpl->getVariable('grado')->value=='')||($_smarty_tpl->getVariable('grado')->value>=6))){?>
		Accesso negato.
	<?php }elseif((($_smarty_tpl->getVariable('grado')->value<4)&&isset($_smarty_tpl->getVariable('immagini',null,true,false)->value))){?>
		<?php if (count($_smarty_tpl->getVariable('immagini')->value)==0){?>
			Nessuna immagine presente.
		<?php }else{ ?>
			<?php $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['var']->step = 1;$_smarty_tpl->tpl_vars['var']->total = (int)ceil(($_smarty_tpl->tpl_vars['var']->step > 0 ? count($_smarty_tpl->getVariable('immagini')->value)-1+1 - (0) : 0-(count($_smarty_tpl->getVariable('immagini')->value)-1)+1)/abs($_smarty_tpl->tpl_vars['var']->step));
if ($_smarty_tpl->tpl_vars['var']->total > 0){
for ($_smarty_tpl->tpl_vars['var']->value = 0, $_smarty_tpl->tpl_vars['var']->iteration = 1;$_smarty_tpl->tpl_vars['var']->iteration <= $_smarty_tpl->tpl_vars['var']->total;$_smarty_tpl->tpl_vars['var']->value += $_smarty_tpl->tpl_vars['var']->step, $_smarty_tpl->tpl_vars['var']->iteration++){
$_smarty_tpl->tpl_vars['var']->first = $_smarty_tpl->tpl_vars['var']->iteration == 1;$_smarty_tpl->tpl_vars['var']->last = $_smarty_tpl->tpl_vars['var']->iteration == $_smarty_tpl->tpl_vars['var']->total;?>
				<a href="<?php echo $_smarty_tpl->getVariable('url_immagini')->value;?>
/<?php echo $_smarty_tpl->getVariable('immagini')->value[$_smarty_tpl->tpl_vars['var']->value];?>
" target="_blank"><?php echo $_smarty_tpl->getVariable('immagini')->value[$_smarty_tpl->tpl_vars['var']->value];?>
</a> (<a href="<?php echo $_smarty_tpl->getVariable('url_admin')->value;?>
/immagini.php?delete=<?php echo $_smarty_tpl->getVariable('immagini')->value[$_smarty_tpl->tpl_vars['var']->value];?>
">X</a>)<br />
			<?php }} ?>
		<?php }?>
	<?php }elseif(!isset($_smarty_tpl->getVariable('immagini',null,true,false)->value)){?>
		Ciao <?php echo $_smarty_tpl->getVariable('nickname')->value;?>
, benvenuto nell'amministrazione.
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
