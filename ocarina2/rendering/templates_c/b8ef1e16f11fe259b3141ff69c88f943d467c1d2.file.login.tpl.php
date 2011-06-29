<?php /* Smarty version Smarty-3.0.8, created on 2011-06-29 16:14:36
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20482782294e0b4f6cc13877-76051598%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8ef1e16f11fe259b3141ff69c88f943d467c1d2' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/login.tpl',
      1 => 1309363433,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20482782294e0b4f6cc13877-76051598',
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
