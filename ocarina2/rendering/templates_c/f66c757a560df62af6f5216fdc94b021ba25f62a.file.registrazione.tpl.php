<?php /* Smarty version Smarty-3.0.8, created on 2011-07-04 01:19:22
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/registrazione.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19062629414e11151a7706b0-09369406%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f66c757a560df62af6f5216fdc94b021ba25f62a' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/registrazione.tpl',
      1 => 1309705668,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19062629414e11151a7706b0-09369406',
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
	<?php }elseif(((isset($_smarty_tpl->getVariable('codiceRegistrazione',null,true,false)->value))&&($_smarty_tpl->getVariable('codiceRegistrazione')->value!==''))){?>
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
		Conferma password<br />
		<input type="password" name="confPassword" /><br />
		</td>
		<td>
		Email<br />
		<input type="text" name="email" /><br />
		</td>
		<td>
		<br />
		<input type="submit" value="Registrati" name="submit" />
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
