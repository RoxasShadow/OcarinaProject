<?php /* Smarty version Smarty-3.0.8, created on 2011-06-26 21:17:44
         compiled from "/var/www/htdocs/ocarina2/rendering/templates/admin/creanews.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12375834164e07a1f88b8192-88404507%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '859a944845edd4eaf7b1cdfbdec0989b4e7c72b7' => 
    array (
      0 => '/var/www/htdocs/ocarina2/rendering/templates/admin/creanews.tpl',
      1 => 1309123031,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12375834164e07a1f88b8192-88404507',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ($_smarty_tpl->getVariable('utente')->value==''||$_smarty_tpl->getVariable('grado')->value==''||!$_smarty_tpl->getVariable('logged')->value){?>
		Accesso negato.
	<?php }elseif($_smarty_tpl->getVariable('grado')->value<4&&!$_smarty_tpl->getVariable('submit')->value&&!isset($_smarty_tpl->getVariable('result',null,true,false)->value)){?>
		<form action="" method="post">
		Titolo<br />
		<input type="text" name="titolo" /><br /><br />
		Categoria<br />
		<select name="categoria">
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categorie')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<option value="<?php echo $_smarty_tpl->getVariable('categorie')->value[$_smarty_tpl->tpl_vars['key']->value];?>
"><?php echo $_smarty_tpl->getVariable('categorie')->value[$_smarty_tpl->tpl_vars['key']->value];?>
</option>
		<?php }} ?>
		</select><br /><br />
		<?php if ($_smarty_tpl->getVariable('bbcode')->value==1){?>
			
			<script type="text/javascript">
			function add(emoticons) {
			    var text = document.getElementById("txtQuota").value;
			    document.getElementById("txtQuota").value = text + emoticons;
			}
			function requestcolor() {
			    var colore = prompt("Digita il nome del colore (esempio: red, black, white)");
			    add('[color='+colore+'][/color]');
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
		<?php }?>
		<textarea name="news" cols="59" rows="10" id="txtQuota"></textarea><br />
		<input type="submit" name="submit" value="Crea news" />
		</form>
	<?php }elseif($_smarty_tpl->getVariable('grado')->value<4&&$_smarty_tpl->getVariable('submit')->value||(!$_smarty_tpl->getVariable('submit')->value&&isset($_smarty_tpl->getVariable('result',null,true,false)->value))){?>
		<?php echo $_smarty_tpl->getVariable('result')->value;?>

	<?php }else{ ?>
		Accesso negato.
	<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('root_rendering')->value)."/templates/".($_smarty_tpl->getVariable('skin')->value)."/include/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
