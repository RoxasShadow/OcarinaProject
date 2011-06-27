<?php /* Smarty version Smarty-3.0.8, created on 2011-06-26 12:48:59
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/admin/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18972222664e072abb4cac36-75935511%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46b6c22da01160288c4f4080e2b38bd608f0315e' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/admin/index.tpl',
      1 => 1309092536,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18972222664e072abb4cac36-75935511',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ($_smarty_tpl->getVariable('utente')->value==''||$_smarty_tpl->getVariable('grado')->value==''){?>
		Accesso negato.
	<?php }elseif($_smarty_tpl->getVariable('grado')->value<6){?>
		Ciao <?php echo $_smarty_tpl->getVariable('utente')->value;?>
, benvenuto nell'amministrazione.
	<?php }else{ ?>
		Accesso negato.
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
