<?php /* Smarty version Smarty-3.0.8, created on 2011-08-02 21:04:07
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/admin/newsletter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8516097374e386647068672-94281688%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee4150f81260406f812611e7a578c63461a59334' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/admin/newsletter.tpl',
      1 => 1311542146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8516097374e386647068672-94281688',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (($_smarty_tpl->getVariable('grado')->value==1)){?>
		<?php if (!$_smarty_tpl->getVariable('submit')->value){?>
			<form action="" method="post">
			Oggetto<br />
			<input type="text" name="oggetto" /><br />
			Testo<br />
			<textarea name="testo" cols="59" rows="10"></textarea><br />
			<input type="submit" name="submit" value="Invia" />
			</form>
		<?php }else{ ?>
			<?php echo $_smarty_tpl->getVariable('result')->value;?>

		<?php }?>
	<?php }else{ ?>
		Accesso negato.
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
