<?php /* Smarty version Smarty-3.0.8, created on 2011-07-09 18:54:25
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/default/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7875037984e18a3e1756476-23851276%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e80fffa811cf26e1daf05af3fd288c6d6de8e15' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/default/login.tpl',
      1 => 1309526080,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7875037984e18a3e1756476-23851276',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ($_smarty_tpl->getVariable('logged')->value){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('result')->value;?>
</div>
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value){?>
		<form action="" method="post">
		<table border="0">
		<tr>
		<td>
		Nickname<br />
		<input type="text" name="nickname" /><br />
		</td>
		<td>
		Password<br />
		<input type="password" name="password" /><br />
		</td>
		<td>
		<br />
		<input type="submit" value="Login" name="submit" />
		</td>
		</tr>
		</table>
		</form>
	<?php }else{ ?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('result')->value;?>
</div>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>