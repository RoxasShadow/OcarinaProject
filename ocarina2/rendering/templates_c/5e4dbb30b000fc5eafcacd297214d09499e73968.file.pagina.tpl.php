<?php /* Smarty version Smarty-3.0.8, created on 2011-07-29 17:59:06
         compiled from "/var/www/htdocs/ocarina2/rendering//templates/default/pagina.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5333331464e32f4ea921282-82494171%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e4dbb30b000fc5eafcacd297214d09499e73968' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering//templates/default/pagina.tpl',
      1 => 1311962339,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5333331464e32f4ea921282-82494171',
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
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pagina')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
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
			<?php if ($_smarty_tpl->getVariable('utente')->value!==''){?>
				<a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/vote.php?action=page&titolo=<?php echo $_smarty_tpl->getVariable('pagina')->value[0]->minititolo;?>
">Vota questa pagina</a>
				<?php if ($_smarty_tpl->getVariable('pagina')->value[0]->voti==1){?>
					(1 voto)
				<?php }else{ ?>
					(<?php echo $_smarty_tpl->getVariable('pagina')->value[0]->voti;?>
 voti)
				<?php }?>
			<?php }else{ ?>
				<a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/registrazione.php">Registrati</a> o <a href="<?php echo $_smarty_tpl->getVariable('url_index')->value;?>
/login.php">accedi</a> per votare questa pagina.
			<?php }?>
		<?php }} ?>
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
