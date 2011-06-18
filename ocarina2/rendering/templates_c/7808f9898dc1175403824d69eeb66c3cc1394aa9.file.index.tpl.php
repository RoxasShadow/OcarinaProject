<?php /* Smarty version Smarty-3.0.8, created on 2011-06-18 18:44:29
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19117149604dfcf20d08c459-91814644%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7808f9898dc1175403824d69eeb66c3cc1394aa9' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/index.tpl',
      1 => 1308422667,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19117149604dfcf20d08c459-91814644',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
	<title><?php echo $_smarty_tpl->getVariable('titolo')->value;?>
</title>
	<meta name="description" content="<?php echo $_smarty_tpl->getVariable('description')->value;?>
" />
	<meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('keywords')->value;?>
" />
	<link rel="stylesheet" type="text/css" href="http://www.giovannicapuano.net/rendering/templates/dark/resources/style.css" />
	<meta name="robots" content="index,follow" />
</head>
<body>
	<div id="header"><?php echo $_smarty_tpl->getVariable('titolo')->value;?>
</div>
	<div id="menu" align="center">
	<a href="index.php">News</a> | <a href="#">Filler</a> | <a href="#">Filler</a> | <a href="#">Filler</a> | <a href="#">Filler</a><br />
	Bentornato <?php echo $_smarty_tpl->getVariable('utente')->value;?>
 (<a href="admin/logout.php">Logout</a> | <a href="admin/profilo.php?nickname=<?php echo $_smarty_tpl->getVariable('utente')->value;?>
">Profilo</a>)
	<br />
	<table id="colunica">
	<tr>
	<td>
	<table style="width:50%; margin-left:auto; margin-right:auto;">
	<tr>
	<td style="width:50%">
	<?php if (is_array($_smarty_tpl->getVariable('contenuto')->value)){?>	 
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('contenuto')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<div id="titolo"><?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</div>
			<div id="newsheader" align="center">Scritto il giorno <?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->ora;?>
 nella categoria 			<a href="categoria.php?cat=<?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->categoria;?>
"><?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->categoria;?>
</a>.</div><br />
			<div id="news"><?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->contenuto;?>
</div>
			<div align="right"><a href="news.php?titolo=<?php echo $_smarty_tpl->getVariable('contenuto')->value[$_smarty_tpl->tpl_vars['key']->value]->minititolo;?>
">Lascia un commento</a></div>
			<hr />
		<?php }} ?>
		<div align="center"><?php  $_smarty_tpl->tpl_vars['pagina'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('navigatore')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['pagina']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['pagina']->iteration=0;
if ($_smarty_tpl->tpl_vars['pagina']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pagina']->key => $_smarty_tpl->tpl_vars['pagina']->value){
 $_smarty_tpl->tpl_vars['pagina']->iteration++;
 $_smarty_tpl->tpl_vars['pagina']->last = $_smarty_tpl->tpl_vars['pagina']->iteration === $_smarty_tpl->tpl_vars['pagina']->total;
?><?php if ($_smarty_tpl->tpl_vars['pagina']->value==$_smarty_tpl->getVariable('currentPage')->value&&!$_smarty_tpl->tpl_vars['pagina']->last){?><b><a href="?p=<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a></b> | <?php }elseif($_smarty_tpl->tpl_vars['pagina']->value!==$_smarty_tpl->getVariable('currentPage')->value&&$_smarty_tpl->tpl_vars['pagina']->last){?><a href="?p=<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a><?php }elseif($_smarty_tpl->tpl_vars['pagina']->value==$_smarty_tpl->getVariable('currentPage')->value&&$_smarty_tpl->tpl_vars['pagina']->last){?><b><a href="?p=<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a></b><?php }else{ ?><a href="?p=<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>
</a> | <?php }?><?php }} ?></div>
	<?php }else{ ?>
		<div id="titolo"><?php echo $_smarty_tpl->getVariable('contenuto')->value;?>
</div>
	<?php }?>
	</td>
	</tr>
	</table>
	</div>
	</td>
	</tr>
	</table>
</body>
</html>
