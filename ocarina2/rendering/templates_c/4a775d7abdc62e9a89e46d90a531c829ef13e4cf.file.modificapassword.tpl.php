<?php /* Smarty version Smarty-3.0.8, created on 2011-07-05 00:50:41
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/modificapassword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20913691884e125fe1924781-49098782%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a775d7abdc62e9a89e46d90a531c829ef13e4cf' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/modificapassword.tpl',
      1 => 1309526080,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20913691884e125fe1924781-49098782',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (!$_smarty_tpl->getVariable('logged')->value){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('result')->value;?>
</div>
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value){?>
		<form action="" method="post">
		<table border="0">
		<tr>
		<td>
		Password attuale<br />
		<input type="password" name="oldPassword" /><br />
		</td>
		<td>
		Nuova password<br />
		<input type="password" name="password" /><br />
		</td>
		<td>
		Conferma nuova password<br />
		<input type="password" name="confPassword" /><br />
		</td>
		<td>
		<br />
		<input type="submit" value="Modifica password" name="submit" />
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
