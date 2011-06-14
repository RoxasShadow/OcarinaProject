<?php /* Smarty version Smarty-3.0.8, created on 2011-06-14 09:50:16
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2567344254df72ece652349-09369096%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7808f9898dc1175403824d69eeb66c3cc1394aa9' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/index.tpl',
      1 => 1308045015,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2567344254df72ece652349-09369096',
  'function' => 
  array (
  ),
  'cache_lifetime' => 3600,
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/htdocs/ocarina2/rendering/plugins/modifier.capitalize.php';
if (!is_callable('smarty_modifier_date_format')) include '/var/www/htdocs/ocarina2/rendering/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_html_options')) include '/var/www/htdocs/ocarina2/rendering/plugins/function.html_options.php';
if (!is_callable('smarty_function_cycle')) include '/var/www/htdocs/ocarina2/rendering/plugins/function.cycle.php';
?><html>
	<head>
		<title><?php echo smarty_modifier_capitalize((($tmp = @$_smarty_tpl->getVariable('titolo')->value)===null||$tmp==='' ? "no title" : $tmp));?>
</title>
	</head>
	<body>
		Hello, <?php echo $_smarty_tpl->getVariable('Nome')->value;?>
 <?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('Cognome')->value);?>
!1<br />
		Today is <?php echo smarty_modifier_date_format(time(),"%d-%m-%Y");?>
<br />
		<select name=user>
			<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->getVariable('values')->value,'output'=>$_smarty_tpl->getVariable('names')->value,'selected'=>"2"),$_smarty_tpl);?>

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
	</body>
</html>
