<?php /* Smarty version Smarty-3.0.8, created on 2011-08-25 16:20:56
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/mobile/include/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1301887534e567668550b02-03742021%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e0ce316370861c86fa27b3fd8588b78d6eb6481' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/mobile/include/footer.tpl',
      1 => 1312732869,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1301887534e567668550b02-03742021',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

</td>
</tr>
</table>
</td>
</tr>
</table>
<div align="center">
<?php echo $_smarty_tpl->getVariable('stats')->value;?>

<p><font color="white">Pagina generata in <?php echo $_smarty_tpl->getVariable('time')->value;?>
 secondi, con <?php echo $_smarty_tpl->getVariable('numQuery')->value;?>
 query e <?php echo $_smarty_tpl->getVariable('numCache')->value;?>
 accessi alla cache.<br />
<?php if (((isset($_smarty_tpl->getVariable('useronline',null,true,false)->value))&&(!empty($_smarty_tpl->getVariable('useronline',null,true,false)->value)))){?>
	Utenti online: 
	<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('useronline')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['user']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['user']->iteration=0;
if ($_smarty_tpl->tpl_vars['user']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
 $_smarty_tpl->tpl_vars['user']->iteration++;
 $_smarty_tpl->tpl_vars['user']->last = $_smarty_tpl->tpl_vars['user']->iteration === $_smarty_tpl->tpl_vars['user']->total;
?>
		<?php if ($_smarty_tpl->tpl_vars['user']->last){?>
			<a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profile/<?php echo $_smarty_tpl->tpl_vars['user']->value;?>
.html"><?php echo $_smarty_tpl->tpl_vars['user']->value;?>
</a>
		<?php }else{ ?>
			<a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profile/<?php echo $_smarty_tpl->tpl_vars['user']->value;?>
.html"><?php echo $_smarty_tpl->tpl_vars['user']->value;?>
</a>, 
		<?php }?>
	<?php }} ?>
<?php }else{ ?>
	Nessun utente online.
<?php }?>
<?php if (((isset($_smarty_tpl->getVariable('visitatoronline',null,true,false)->value))&&(is_numeric($_smarty_tpl->getVariable('visitatoronline')->value))&&($_smarty_tpl->getVariable('visitatoronline')->value>0))){?>
	<br />Visitatori online: <?php echo $_smarty_tpl->getVariable('visitatoronline')->value;?>

<?php }else{ ?>
	<br />Nessun visitatore online.
<?php }?>
<?php if (((isset($_smarty_tpl->getVariable('totaleaccessi',null,true,false)->value))&&(is_numeric($_smarty_tpl->getVariable('totaleaccessi')->value)))){?>
	<br />Totale accessi: <?php echo $_smarty_tpl->getVariable('totaleaccessi')->value;?>

<?php }?>
</font></p>
<a href="http://validator.w3.org/check?uri=referer"><img src="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/images/valid-xhtml10-blue.png" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/images/vcss-blue.png" alt="CSS Valido!" height="31" width="88" /></a>
<a href="http://feed2.w3.org/check.cgi?url=<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/feed.php"><img src="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/images/valid-rss-blue.gif" alt="[Valid RSS]" height="31" width="88" /></a>
</div>
<?php echo $_smarty_tpl->getVariable('footer')->value;?>

</body>
</html>