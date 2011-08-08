<?php /* Smarty version Smarty-3.0.8, created on 2011-08-08 13:01:59
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/default-ajax/pagina.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17211462854e3fde47e24cd8-18855434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4abdddf732c147d420e2ed000cb98e93dcfb05c5' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/default-ajax/pagina.tpl',
      1 => 1312808518,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17211462854e3fde47e24cd8-18855434',
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
		<?php if (is_array($_smarty_tpl->getVariable('pagina')->value)){?>
			<div class="titolo"><?php echo $_smarty_tpl->getVariable('pagina')->value[0]->titolo;?>
</div>
			<div class="newsheader" align="center">Scritto da <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/profile/<?php echo $_smarty_tpl->getVariable('pagina')->value[0]->autore;?>
.html"><?php echo $_smarty_tpl->getVariable('pagina')->value[0]->autore;?>
</a> il giorno <?php echo $_smarty_tpl->getVariable('pagina')->value[0]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('pagina')->value[0]->ora;?>
 nella categoria <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/category/<?php echo $_smarty_tpl->getVariable('pagina')->value[0]->categoria;?>
.html"><?php echo $_smarty_tpl->getVariable('pagina')->value[0]->categoria;?>
</a>. <?php if ($_smarty_tpl->getVariable('pagina')->value[0]->oraultimamodifica==$_smarty_tpl->getVariable('pagina')->value[0]->ora){?>Ultima modifica <?php if ($_smarty_tpl->getVariable('pagina')->value[0]->dataultimamodifica==$_smarty_tpl->getVariable('pagina')->value[0]->data){?>oggi<?php }else{ ?> il giorno <?php echo $_smarty_tpl->getVariable('pagina')->value[0]->dataultimamodifica;?>
<?php }?> alle ore <?php echo $_smarty_tpl->getVariable('pagina')->value[0]->ora;?>
 <?php if ($_smarty_tpl->getVariable('pagina')->value[0]->autoreultimamodifica!==$_smarty_tpl->getVariable('pagina')->value[0]->autore){?>da parte di <?php echo $_smarty_tpl->getVariable('pagina')->value[0]->autoreultimamodifica;?>
.<?php }?><?php }?></div><br />
			<div class="news"><p><?php echo $_smarty_tpl->getVariable('pagina')->value[0]->contenuto;?>
</p></div><br />
			<div id="voteresponse"></div>
			<?php if ($_smarty_tpl->getVariable('utente')->value!==''){?>
				<a href="#" onclick="sendGet('<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/api.php?action=votepage&title=<?php echo $_smarty_tpl->getVariable('pagina')->value[0]->minititolo;?>
', 'voteresponse', undefined, 'true', Array(9, 'Votato.'), 'Hai già votato questa pagina.'); setTimeout('sendGet(\'<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/api.php?action=page&title=<?php echo $_smarty_tpl->getVariable('pagina')->value[0]->minititolo;?>
\', \'voto\', undefined, \'true\', undefined, undefined, \'votes\');', 1000);">Vota questa pagina</a>
				<?php if ($_smarty_tpl->getVariable('pagina')->value[0]->voti==1){?>
					(<a id="voto" class="no-prop">1</a> voto)
				<?php }else{ ?>
					(<a id="voto" class="no-prop"><?php echo $_smarty_tpl->getVariable('pagina')->value[0]->voti;?>
</a> voti)
					<?php }?>
			<?php }else{ ?>
				<a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/registrazione.php">Registrati</a> o <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/login.php">accedi</a> per votare questa pagina.
			<?php }?>
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
