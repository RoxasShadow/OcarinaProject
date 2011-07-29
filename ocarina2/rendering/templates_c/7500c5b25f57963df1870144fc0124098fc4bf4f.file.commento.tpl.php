<?php /* Smarty version Smarty-3.0.8, created on 2011-07-29 19:13:33
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/mobile/commento.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19115248504e33065d8db4d3-47419134%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7500c5b25f57963df1870144fc0124098fc4bf4f' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/mobile/commento.tpl',
      1 => 1311966792,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19115248504e33065d8db4d3-47419134',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (isset($_smarty_tpl->getVariable('error',null,true,false)->value)){?>
		<div id="post-0" class="post">
		<h2 class="title"><?php echo $_smarty_tpl->getVariable('error')->value;?>
</h2>
		</div>
	<?php }else{ ?>
		<?php if (isset($_smarty_tpl->getVariable('commento',null,true,false)->value)){?>
			<div id="post-0" class="post">
			<h2 class="title">Commento #<?php echo $_smarty_tpl->getVariable('commento')->value[0]->id;?>
</h2>
			<div class="meta" align="center">Scritto da <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profile/<?php echo $_smarty_tpl->getVariable('commento')->value[0]->autore;?>
.html"><?php echo $_smarty_tpl->getVariable('commento')->value[0]->autore;?>
</a> il giorno <?php echo $_smarty_tpl->getVariable('commento')->value[0]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('commento')->value[0]->ora;?>
.(<a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/news/<?php echo $_smarty_tpl->getVariable('commento')->value[0]->news;?>
.html">News originale</a>)</div><br />
			<?php echo $_smarty_tpl->getVariable('commento')->value[0]->contenuto;?>

			</div>
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
