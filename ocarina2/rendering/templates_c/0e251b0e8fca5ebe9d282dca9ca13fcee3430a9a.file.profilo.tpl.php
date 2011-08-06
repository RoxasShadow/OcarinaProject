<?php /* Smarty version Smarty-3.0.8, created on 2011-08-06 14:43:01
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/default/profilo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12471178774e3d52f5896d88-90616491%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e251b0e8fca5ebe9d282dca9ca13fcee3430a9a' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/default/profilo.tpl',
      1 => 1311967559,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12471178774e3d52f5896d88-90616491',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_mailto')) include '/var/www/htdocs/ocarina2/rendering/plugins/function.mailto.php';
?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<div id="post-0" class="post">
	<?php if (isset($_smarty_tpl->getVariable('listautenti',null,true,false)->value)){?>
		<div align="center">
		<form action="" method="post">
		<select name="nickname">
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listautenti')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<option value="<?php echo $_smarty_tpl->getVariable('listautenti')->value[$_smarty_tpl->tpl_vars['key']->value]->nickname;?>
"><?php echo $_smarty_tpl->getVariable('listautenti')->value[$_smarty_tpl->tpl_vars['key']->value]->nickname;?>
</option>
			<?php }} ?>
		</select>
		<input type="submit" value="Visita profilo" />
		</form>
		</div>
	<?php }elseif(is_array($_smarty_tpl->getVariable('result')->value)){?>
		<div align="center">
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('result')->value[0]->nickname;?>
</div>
		<?php if ($_smarty_tpl->getVariable('result')->value[0]->avatar!==''){?><img src="<?php echo $_smarty_tpl->getVariable('result')->value[0]->avatar;?>
" /><br /><?php }?>
		<br />
			
		<table border="0" cellpadding="2">
		<tr>
		<td><b>Email</b></td>
		<td><b>Data registrazione</b></td>
		<td><b>Grado</b></td>
		<td><b>Bio</b></td>
		<td><b>Browser</b></td>
		<td><b>Piattaforma</b></td>
		</tr>
		<tr>
		<td><?php ob_start();?><?php echo $_smarty_tpl->getVariable('result')->value[0]->email;?>
<?php $_tmp1=ob_get_clean();?><?php echo smarty_function_mailto(array('address'=>$_tmp1,'encode'=>'javascript_charcode'),$_smarty_tpl);?>
</td>
		<td><?php echo $_smarty_tpl->getVariable('result')->value[0]->data;?>
</td>
		<td><?php if ($_smarty_tpl->getVariable('result')->value[0]->grado==1){?>Amministratore<?php }elseif($_smarty_tpl->getVariable('result')->value[0]->grado==2){?>Moderatore<?php }elseif($_smarty_tpl->getVariable('result')->value[0]->grado==3){?>Editore<?php }elseif($_smarty_tpl->getVariable('result')->value[0]->grado==4){?>Grafico<?php }elseif($_smarty_tpl->getVariable('result')->value[0]->grado==5){?>SEO<?php }elseif($_smarty_tpl->getVariable('result')->value[0]->grado==6){?>Utente<?php }elseif($_smarty_tpl->getVariable('result')->value[0]->grado==7){?>Bannato<?php }?></td>
		<td><?php echo $_smarty_tpl->getVariable('result')->value[0]->bio;?>
</td>
		<td><?php echo $_smarty_tpl->getVariable('result')->value[0]->browsername;?>
<br /><?php echo $_smarty_tpl->getVariable('result')->value[0]->browserversion;?>
</td>
		<td><?php echo $_smarty_tpl->getVariable('result')->value[0]->platform;?>
</td>
		</tr>
		</table>
		</div>
	<?php }else{ ?>
		<h2 class="title"><?php echo $_smarty_tpl->getVariable('result')->value;?>
</h2>
	<?php }?>
	</div>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
