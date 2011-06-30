<?php /* Smarty version Smarty-3.0.8, created on 2011-06-30 17:07:11
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18826785544e0cad3f7f8482-78957938%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8ef1e16f11fe259b3141ff69c88f943d467c1d2' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/login.tpl',
      1 => 1309394368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18826785544e0cad3f7f8482-78957938',
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
