<?php /* Smarty version Smarty-3.0.8, created on 2011-08-01 15:03:05
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/default/recuperapassword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19502088914e36c0298f5348-56263415%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1fd25d78a6943930b2d598ff4f882978908add97' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/default/recuperapassword.tpl',
      1 => 1311967585,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19502088914e36c0298f5348-56263415',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<div id="post-0" class="post">
	<?php if ($_smarty_tpl->getVariable('logged')->value||isset($_smarty_tpl->getVariable('recupera',null,true,false)->value)){?>
		<h2 class="title"><?php echo $_smarty_tpl->getVariable('result')->value;?>
</h2>
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value&&!isset($_smarty_tpl->getVariable('recupero',null,true,false)->value)){?>
		<form action="" method="post">
		<table border="0">
		<tr>
		<td>
		Email<br />
		<input type="text" name="email" /><br />
		</td>
		</table>
		<br />
		<?php echo $_smarty_tpl->getVariable('captcha')->value;?>

		<br />
		<input type="submit" value="Recupera password" name="submit" />
		</form>
	<?php }else{ ?>
		<h2 class="title"><?php echo $_smarty_tpl->getVariable('result')->value;?>
</h2>
	<?php }?>
	</div>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
