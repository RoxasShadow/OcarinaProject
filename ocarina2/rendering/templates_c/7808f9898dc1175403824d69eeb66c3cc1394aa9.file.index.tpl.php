<?php /* Smarty version Smarty-3.0.8, created on 2011-06-14 12:27:22
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17346406134df753aab503e1-81810116%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7808f9898dc1175403824d69eeb66c3cc1394aa9' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/index.tpl',
      1 => 1308054038,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17346406134df753aab503e1-81810116',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/htdocs/ocarina2/rendering/plugins/modifier.capitalize.php';
if (!is_callable('smarty_function_mailto')) include '/var/www/htdocs/ocarina2/rendering/plugins/function.mailto.php';
if (!is_callable('smarty_modifier_date_format')) include '/var/www/htdocs/ocarina2/rendering/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_html_options')) include '/var/www/htdocs/ocarina2/rendering/plugins/function.html_options.php';
if (!is_callable('smarty_function_cycle')) include '/var/www/htdocs/ocarina2/rendering/plugins/function.cycle.php';
if (!is_callable('smarty_block_textformat')) include '/var/www/htdocs/ocarina2/rendering/plugins/block.textformat.php';
?>
<html>
	<head>
		<title><?php echo smarty_modifier_capitalize((($tmp = @$_smarty_tpl->getVariable('titolo')->value)===null||$tmp==='' ? "no title" : $tmp));?>
</title>
		<style type="text/css">
		
		p {
		    font-style: italic;
		}
		
		</style>
	</head>
	<body>
		Hello, <?php echo $_smarty_tpl->getVariable('nome')->value;?>
 <?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('cognome')->value);?>
!<br />
		Your email (<?php echo smarty_function_mailto(array('address'=>$_smarty_tpl->getVariable('email')->value,'encode'=>'javascript_charcode'),$_smarty_tpl);?>
) is protected by spambot ;)<br />
		Today is <?php echo smarty_modifier_date_format(time(),"%d-%m-%Y");?>
<br />
		<select name=user>
			<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->getVariable('values')->value,'output'=>$_smarty_tpl->getVariable('names')->value,'selected'=>"3"),$_smarty_tpl);?>

		</select>
		<br />
		<table>
		<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('users')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
			<tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#aaaaaa,#bbbbbb"),$_smarty_tpl);?>
"><td><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['user']->value['name']);?>
</td><td><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['user']->value['phone']);?>
</td></tr>
		<?php }} ?>
		</table>
		<br />
		 <?php $_smarty_tpl->smarty->_tag_stack[] = array('textformat', array()); $_block_repeat=true; smarty_block_textformat(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->getVariable('testo')->value;?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_textformat(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	</body>
</html>
