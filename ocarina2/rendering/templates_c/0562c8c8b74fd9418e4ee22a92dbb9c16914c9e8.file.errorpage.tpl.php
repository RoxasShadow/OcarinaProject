<?php /* Smarty version Smarty-3.0.8, created on 2011-07-12 00:27:57
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/default/errorpage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9579566964e1b950de12fd3-99079648%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0562c8c8b74fd9418e4ee22a92dbb9c16914c9e8' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/default/errorpage.tpl',
      1 => 1309526080,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9579566964e1b950de12fd3-99079648',
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