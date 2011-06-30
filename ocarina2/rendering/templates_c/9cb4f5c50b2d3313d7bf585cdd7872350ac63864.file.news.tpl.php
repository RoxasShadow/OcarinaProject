<?php /* Smarty version Smarty-3.0.8, created on 2011-06-30 19:11:26
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/default/news.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14356629044e0cca5eab25d5-57699679%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9cb4f5c50b2d3313d7bf585cdd7872350ac63864' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/default/news.tpl',
      1 => 1309461085,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14356629044e0cca5eab25d5-57699679',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if (isset($_smarty_tpl->getVariable('errore',null,true,false)->value)){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('errore')->value;?>
</div>
	<?php }elseif(isset($_smarty_tpl->getVariable('commentSended',null,true,false)->value)){?>
		<div class="titolo"><?php echo $_smarty_tpl->getVariable('commentSended')->value;?>
</div>
	<?php }elseif(is_array($_smarty_tpl->getVariable('news')->value)){?>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->iteration=0;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
 $_smarty_tpl->tpl_vars['item']->iteration++;
?>
			<?php if ($_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
				<div class="titolo"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->titolo;?>
</div>
				<div class="newsheader" align="center">Scritto da <a href="profilo.php?nickname=<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
</a> il giorno <?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->ora;?>
 nella categoria <a href="categoria.php?cat=<?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->categoria;?>
"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->categoria;?>
</a>.</div><br />
				<div class="news"><?php echo $_smarty_tpl->getVariable('news')->value[$_smarty_tpl->tpl_vars['key']->value]->contenuto;?>
</div>
			<?php }else{ ?>
				La news non è stata approvata, e quindi non è visibile.
			<?php }?>
		<?php }} ?>
		<?php if (!is_array($_smarty_tpl->getVariable('commenti')->value)){?>
			<br /><hr /><br />
			<div class="news"><?php echo $_smarty_tpl->getVariable('commenti')->value;?>
</div>
		<?php }else{ ?>
			<br /><hr /><br />
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('commenti')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->iteration=0;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
 $_smarty_tpl->tpl_vars['item']->iteration++;
?>
				<?php if ($_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->approvato==1){?>
					<fieldset><legend><a href="commento.php?id=<?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->id;?>
">#<?php echo $_smarty_tpl->tpl_vars['item']->iteration;?>
</a> Commento inviato il giorno <?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->data;?>
 alle ore <?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->ora;?>
 da <a href="profilo.php?nickname=<?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
"><?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->autore;?>
</a>. <?php if (((isset($_smarty_tpl->getVariable('grado',null,true,false)->value))&&(is_numeric($_smarty_tpl->getVariable('grado')->value))&&($_smarty_tpl->getVariable('grado')->value<3))){?><a href="admin/cancellacommento.php?id=<?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->id;?>
">(X)</a><?php }?></legend><div onclick="javascript:quota(this);"><?php echo $_smarty_tpl->getVariable('commenti')->value[$_smarty_tpl->tpl_vars['key']->value]->contenuto;?>
</div></fieldset><br />
				<?php }?>
			<?php }} ?>
		<?php }?>
		<br />
		<?php if (!$_smarty_tpl->getVariable('logged')->value){?>
			<a href="registrazione.php">Registrati</a> o <a href="login.php">accedi</a> per commentare questa news.
		<?php }else{ ?>
			<?php if ($_smarty_tpl->getVariable('bbcode')->value==1){?>
				
				<script type="text/javascript">
				function quota(objDom) {
					document.getElementById("txtQuota").value = document.getElementById("txtQuota").value+'[quote]'+objDom.textContent+'[/quote]';
				}
				function add(emoticons) {
					document.getElementById("txtQuota").value = document.getElementById("txtQuota").value + emoticons;
				}
				function requestcolor() {
					add('[color='+prompt("Digita il nome del colore (esempio: red, black, white)")+'][/color]');
				}
				</script>
				
				<a onclick="javascript:add('[b][/b]');"><b>Grassetto</b></a>
				<a onclick="javascript:add('[i][/i]');"><b>Corsivo</b></a>

				<a onclick="javascript:add('[u][/u]');"><b>Sottolineato</b></a>
				<a onclick="javascript:add('[s][/s]');"><b>Barrato</b></a>
				<a onclick="javascript:requestcolor();"><b>Colore</b></a>
				<a onclick="javascript:add('[url=http://][/url]');"><b>URL</b></a>
				<a onclick="javascript:add('[spoiler][/spoiler]');"><b>Spoiler</b></a>
				<a onclick="javascript:add('[left][/left]');"><b>Allineato a sinistra</b></a>
				<a onclick="javascript:add('[center][/center]');"><b>Allineato a centro</b></a>
				<a onclick="javascript:add('[right][/right]');"><b>Allineato a destra</b></a>
				<a onclick="javascript:add('[br]');"><b>Accapo</b></a>

				<a onclick="javascript:add('[code][/code]');"><b>Codice</b></a>
				<a onclick="javascript:add('[quote][/quote]');"><b>Citazione</b></a>
				<a onclick="javascript:add('[user][/user]');"><b>Utente</b></a>
			<?php }?>
			<form action="" method="post">
			<textarea name="comment" cols="59" rows="10" id="txtQuota"></textarea><br />
			<input type="submit" value="Invia commento" />
			</form>
		<?php }?>
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
