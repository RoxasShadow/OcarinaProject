<?php /* Smarty version Smarty-3.0.8, created on 2011-06-20 22:55:52
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/recuperapassword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4684844554dffcff8dd46e1-98567735%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef94397fdb2e81823e98b260a02184c9651e9a7b' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/recuperapassword.tpl',
      1 => 1308610550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4684844554dffcff8dd46e1-98567735',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ($_smarty_tpl->getVariable('logged')->value||isset($_smarty_tpl->getVariable('recupera',null,true,false)->value)){?>
		<div id="titolo"><?php echo $_smarty_tpl->getVariable('result')->value;?>
</div>
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value&&!$_smarty_tpl->getVariable('recupero')->value){?>
		<form action="" method="post">
		<table border="0">
		<tr>
		<td>
		Email<br />
		<input type="text" name="email" /><br />
		</td>
		<td>
		<br />
		<input type="submit" value="Recupera password" name="submit" />
		</td>
		</tr>
		</table>
		</form>
	<?php }else{ ?>
		<div id="titolo"><?php echo $_smarty_tpl->getVariable('result')->value;?>
</div>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
