<?php /* Smarty version Smarty-3.0.8, created on 2011-06-26 12:43:41
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/adminf/findex.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13392516074e07297d475758-38473477%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5cb52deb0f15fa296ec565ec1609f30060f830cb' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/adminf/findex.tpl',
      1 => 1309092052,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13392516074e07297d475758-38473477',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ($_smarty_tpl->getVariable('utente')->value==''){?>
		Accesso negato.
	<?php }elseif($_smarty_tpl->getVariable('grado')->value>5){?>
		Ciao <?php echo $_smarty_tpl->getVariable('utente')->value;?>
, benvenuto nell'amministrazione.
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
