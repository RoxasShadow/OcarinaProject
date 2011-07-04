<?php /* Smarty version Smarty-3.0.8, created on 2011-07-04 20:09:35
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/admin/deletecontent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4169162084e121dff16d380-83861429%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ff41e9c97c47cfbdcada8abc08392c0aeecaa5b' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/admin/deletecontent.tpl',
      1 => 1309810172,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4169162084e121dff16d380-83861429',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ((($_smarty_tpl->getVariable('grado')->value=='')||($_smarty_tpl->getVariable('grado')->value>3))){?>
		Accesso negato.
	<?php }elseif(!$_smarty_tpl->getVariable('submit')->value){?>
		<form action="" method="post">
		<?php if ((isset($_smarty_tpl->getVariable('whatis',null,true,false)->value)&&($_smarty_tpl->getVariable('whatis')->value=='pagina'))){?>Pagina<?php }elseif((isset($_smarty_tpl->getVariable('whatis',null,true,false)->value)&&($_smarty_tpl->getVariable('whatis')->value=='news'))){?>News<?php }?> da cancellare<br />
		<select name="content">
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('content')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<option value="<?php echo $_smarty_tpl->getVariable('content')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
"><?php echo $_smarty_tpl->getVariable('content')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</option>
		<?php }} ?>
		</select>
		<input type="submit" name="submit" value="Cancella <?php if ((isset($_smarty_tpl->getVariable('whatis',null,true,false)->value)&&($_smarty_tpl->getVariable('whatis')->value=='pagina'))){?>pagina<?php }elseif((isset($_smarty_tpl->getVariable('whatis',null,true,false)->value)&&($_smarty_tpl->getVariable('whatis')->value=='pagina'))){?>news<?php }?>" />
		</form>
	<?php }elseif($_smarty_tpl->getVariable('submit')->value){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
