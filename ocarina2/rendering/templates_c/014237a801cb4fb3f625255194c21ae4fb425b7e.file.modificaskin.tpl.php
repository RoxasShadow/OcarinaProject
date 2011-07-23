<?php /* Smarty version Smarty-3.0.8, created on 2011-07-21 20:44:19
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/admin/modificaskin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2600036964e288fa3dea3e7-66242370%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '014237a801cb4fb3f625255194c21ae4fb425b7e' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/admin/modificaskin.tpl',
      1 => 1311281056,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2600036964e288fa3dea3e7-66242370',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ((($_smarty_tpl->getVariable('grado')->value=='')||($_smarty_tpl->getVariable('grado')->value>4)||($_smarty_tpl->getVariable('grado')->value<1))){?>
		Accesso negato.
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value&&!isset($_smarty_tpl->getVariable('result',null,true,false)->value)){?>
		<form action="" method="post">
		<textarea name="contenuto" cols="59" rows="10"><?php if ((isset($_smarty_tpl->getVariable('result',null,true,false)->value))){?><?php echo $_smarty_tpl->getVariable('result')->value;?>
<?php }?></textarea><br />
		<?php if (isset($_smarty_tpl->getVariable('sel',null,true,false)->value)){?><input type="hidden" name="selected" value="<?php echo $_smarty_tpl->getVariable('sel')->value;?>
" /><?php }?>
		<?php if (isset($_smarty_tpl->getVariable('sel2',null,true,false)->value)){?><input type="hidden" name="selected2" value="<?php echo $_smarty_tpl->getVariable('sel2')->value;?>
" /><?php }?>
		<input type="submit" name="submit" value="Conferma" />
		</form>
	<?php }elseif($_smarty_tpl->getVariable('submit')->value&&isset($_smarty_tpl->getVariable('result',null,true,false)->value)||(!$_smarty_tpl->getVariable('submit')->value&&isset($_smarty_tpl->getVariable('result',null,true,false)->value))){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }elseif(isset($_smarty_tpl->getVariable('result',null,true,false)->value)){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
