<?php /* Smarty version Smarty-3.0.8, created on 2011-07-03 17:15:26
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/admin/sitemap.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12368360984e10a3ae6b1999-86985101%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c30801c3c53ca29f0b177e8b350d2916e466c9d7' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/admin/sitemap.tpl',
      1 => 1309713219,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12368360984e10a3ae6b1999-86985101',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ($_smarty_tpl->getVariable('utente')->value==''||$_smarty_tpl->getVariable('grado')->value==''){?>
		Accesso negato.
	<?php }elseif((($_smarty_tpl->getVariable('grado')->value<3)||($_smarty_tpl->getVariable('grado')->value==5))){?>
		<?php if (!$_smarty_tpl->getVariable('submit')->value){?>
			<form action="" method="post">
			<input type="submit" name="submit" value="Ricostruisci le sitemap" />
			</form>
		<?php }else{ ?>
			Sitemap ricostruite.
		<?php }?>
	<?php }else{ ?>
		Accesso negato.
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
