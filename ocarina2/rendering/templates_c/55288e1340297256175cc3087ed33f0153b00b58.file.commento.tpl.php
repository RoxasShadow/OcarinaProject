<?php /* Smarty version Smarty-3.0.8, created on 2011-08-01 13:09:57
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/default/commento.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6322790294e36a5a53e79f0-01262579%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55288e1340297256175cc3087ed33f0153b00b58' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/default/commento.tpl',
      1 => 1311966705,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6322790294e36a5a53e79f0-01262579',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (isset($_smarty_tpl->getVariable('error',null,true,false)->value)){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('error')->value;?>
</div>
	<?php }else{ ?>
		<?php if (isset($_smarty_tpl->getVariable('commento',null,true,false)->value)){?>
			<div class="titolo">Commento #<?php echo $_smarty_tpl->getVariable('commento')->value[0]->id;?>
</div>
			<div class="newsheader" align="center">Scritto da <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profile/<?php echo $_smarty_tpl->getVariable('commento')->value[0]->autore;?>
.html"><?php echo $_smarty_tpl->getVariable('commento')->value[0]->autore;?>
</a> il giorno <?php echo $_smarty_tpl->getVariable('commento')->value[0]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('commento')->value[0]->ora;?>
.(<a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/news/<?php echo $_smarty_tpl->getVariable('commento')->value[0]->news;?>
.html">News originale</a>)</div><br />
			<div class="news"><?php echo $_smarty_tpl->getVariable('commento')->value[0]->contenuto;?>
</div>
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
