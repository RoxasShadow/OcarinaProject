<?php /* Smarty version Smarty-3.0.8, created on 2011-08-05 14:22:46
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/default/inviamp.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15861078794e3bfcb6d46732-72322948%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10347577bf2a23794d353e09c84902498867e8a9' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/default/inviamp.tpl',
      1 => 1311958602,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15861078794e3bfcb6d46732-72322948',
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
		Destinatario<br />
		<select name="destinatario">
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
		</select><br />
		Oggetto<br />
		<input type="text" name="oggetto" /><br />
		Contenuto<br />
		<textarea name="contenuto" cols="22" rows="10"></textarea><br />
		<?php echo $_smarty_tpl->getVariable('captcha')->value;?>
<br />
		<input type="submit" value="Invia" name="submit" />
		</form>
	<?php }else{ ?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('result')->value;?>
</div>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
