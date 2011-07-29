<?php /* Smarty version Smarty-3.0.8, created on 2011-07-29 20:14:14
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/mobile/errorpage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18808306064e331496e2e813-40450974%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca0e8db0adde99b9ae239166cf0e0e5eea379893' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/mobile/errorpage.tpl',
      1 => 1311527918,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18808306064e331496e2e813-40450974',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (isset($_smarty_tpl->getVariable('id',null,true,false)->value)){?>
		<div class="titolo">Errore <?php echo $_smarty_tpl->getVariable('id')->value;?>
</div>
	<?php }else{ ?>
		<div class="titolo">Errore indefinito</div>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
