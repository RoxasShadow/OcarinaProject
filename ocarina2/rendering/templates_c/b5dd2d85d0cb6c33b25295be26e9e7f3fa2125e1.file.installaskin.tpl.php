<?php /* Smarty version Smarty-3.0.8, created on 2011-08-02 21:04:59
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/admin/installaskin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9466136584e38667bab99d3-64804994%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5dd2d85d0cb6c33b25295be26e9e7f3fa2125e1' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/admin/installaskin.tpl',
      1 => 1311542321,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9466136584e38667bab99d3-64804994',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (!(($_smarty_tpl->getVariable('grado')->value==1)||($_smarty_tpl->getVariable('grado')->value==4))){?>
		Accesso negato.
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value){?>
		<form action="" method="post" enctype="multipart/form-data">
		<input name="skin" type="file" size="40" /><br />
		<input name="upload" type="submit" value="Installa" />			
		</form>
	<?php }else{ ?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
