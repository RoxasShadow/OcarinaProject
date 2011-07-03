<?php /* Smarty version Smarty-3.0.8, created on 2011-07-03 17:14:07
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/admin/robots.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14285668604e10a35f0b22f1-82500353%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd322bc87d571ff9b7670646bfcae97e1a173fada' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/admin/robots.tpl',
      1 => 1309713219,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14285668604e10a35f0b22f1-82500353',
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
			<a href="http://www.robotstxt.org/robotstxt.html">About the robots...</a><br />
			<form action="" method="post">
			<textarea name="robots" cols="59" rows="10"><?php if ((isset($_smarty_tpl->getVariable('robots',null,true,false)->value))){?><?php echo $_smarty_tpl->getVariable('robots')->value;?>
<?php }?></textarea><br />
			<input type="submit" name="submit" value="Salva" />
			</form>
		<?php }else{ ?>
			Robots aggiornato.
		<?php }?>
	<?php }else{ ?>
		Accesso negato.
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
