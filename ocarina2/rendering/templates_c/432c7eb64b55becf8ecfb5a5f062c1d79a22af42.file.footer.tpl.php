<?php /* Smarty version Smarty-3.0.8, created on 2011-08-22 20:04:07
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/admin/include/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12501707934e52b6375b4c14-45069027%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '432c7eb64b55becf8ecfb5a5f062c1d79a22af42' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/admin/include/footer.tpl',
      1 => 1312658843,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12501707934e52b6375b4c14-45069027',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<br /><br />
</div>
<div class="clear"></div>
</div>
</div>
</div> <!-- /wrapper -->
<div align="center">
<?php echo $_smarty_tpl->getVariable('stats')->value;?>

<p>Pagina generata in <?php echo $_smarty_tpl->getVariable('time')->value;?>
 secondi, con <?php echo $_smarty_tpl->getVariable('numQuery')->value;?>
 query e <?php echo $_smarty_tpl->getVariable('numCache')->value;?>
 accessi alla cache.</p>
<a href="http://validator.w3.org/check?uri=referer"><img src="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/img/valid-xhtml10-blue.png" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="<?php echo $_smarty_tpl->getVariable('url_rendering')->value;?>
/templates/<?php echo $_smarty_tpl->getVariable('skin')->value;?>
/resources/img/vcss-blue.png" alt="CSS Valido!" height="31" width="88" /></a>
</div>
<?php echo $_smarty_tpl->getVariable('footer')->value;?>

</body>
</html>
