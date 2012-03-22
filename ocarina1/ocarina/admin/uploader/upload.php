<?php
/* Carica le immagini nel server */
// Includo le classi principali
include_once "../../core/class.Ocarina.php";
include_once "../../core/class.MySQL.php";
include_once "../../core/class.Functions.php";
include_once "../../rendering/config.php";

// Istanzio le classi
$cms = new Ocarina;
$db = new MySQL;
$func = new Functions;

if(isset($_POST['upload'])) {
	if(trim($_POST['destinazione']) == ('non specificato')) {

		// Directory dove salvare i files uploadati
		$upload_dir = $cms->dir_immagini();

		// Se $new_name è vuoto, il nome sarà lo stesso del file uploadato
		$file_name = $_FILES["upfile"]["name"];

		// Controllo l'estensione (1-2-3 = Gif, JPG, PNG
		list($width, $height, $type, $attr) = getimagesize($_FILES['upfile']['tmp_name']);
		if(($type != 1) && ($type != 2) && ($type != 3))  {
			die("Sono accettate solo immagini GIF, JPG e PNG.");
		}

		// Controllo se è stato caricato
		if(is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
			move_uploaded_file($_FILES["upfile"]["tmp_name"], "$upload_dir/$file_name") 
			or die("Impossibile effettuare l' upload.");

			$text = 'L\' immagine è stata caricata.<br /><br />';
			$text .= '<p align="center"><img src="'.$cms->url_immagini().$file_name.'"><br /><br /></p>';
			$text .= '<b>Codici per la condivisione</b><br /><br />';
			$text .= '<b>Link</b><br />[url='.$cms->url_immagini().$file_name.']'.$cms->url_immagini().$file_name.'[/url]<br /><br />';
			$text .= '<b>Immagine</b><br />[img]'.$cms->url_immagini().$file_name.'[/img]<br /><br />';
			$text .= '<b>Link + Immagine</b><br />[url='.$cms->url_immagini().$file_name.'][img]'.$cms->url_immagini().$file_name.'[/img][/url]<br /><br />';

			// Visualizzo la pagina
			$smarty->assign("titolo", "Carica immagine");
			$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
			$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
			$smarty->assign("contents", $text);
			$smarty->assign("url_cms", $cms->url_cms());
			$smarty->assign("url_smartytpl", $cms->url_smartytpl());
			$smarty->assign("cmsversion", $cms->cmsversion());
			$smarty->display("admin/index/index.tpl");
			exit;
		}

		else {
			die("Problemi nell'upload del file " . $_FILES["upfile"]["name"]);
		}
	}

	else{
		$dirspec = $_POST['destinazione'].'/';

		// Directory dove salvare i files uploadati
		$upload_dir = $cms->dir_immagini().$dirspec;

		// Se $new_name è vuoto, il nome sarà lo stesso del file uploadato
		$file_name = $_FILES["upfile"]["name"];

		// Controllo l'estensione (1-2-3 = Gif, JPG, PNG
		list($width, $height, $type, $attr) = getimagesize($_FILES['upfile']['tmp_name']);
		if(($type != 1) && ($type != 2) && ($type != 3))  {
			die("Sono accettate solo immagini GIF, JPG e PNG.");
		}

		// Controllo se è stato caricato
		if(is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
			move_uploaded_file($_FILES["upfile"]["tmp_name"], "$upload_dir/$file_name") 
			or die("Impossibile effettuare l' upload.");

			$text =  'L\' immagine è stata caricata.<br /><br />';
			$text .=  '<p align="center"><img src="'.$cms->url_immagini().$dirspec.$file_name.'"><br /><br /></p>';
			$text .=  '<b>Codici per la condivisione</b><br /><br />';
			$text .=  '<b>Link</b><br />[url='.$cms->url_immagini().$dirspec.$file_name.']'.$cms->url_immagini().$dirspec.$file_name.'[/url]<br /><br />';
			$text .=  '<b>Immagine</b><br />[img]'.$cms->url_immagini().$dirspec.$file_name.'[/img]<br /><br />';
			$text .=  '<b>Link + Immagine</b><br />[url='.$cms->url_immagini().$dirspec.$file_name.'][img]'.$cms->url_immagini().$dirspec.$file_name.'[/img][/url]<br /><br />';

			// Visualizzo la pagina
			$smarty->assign("titolo", "Carica immagine");
			$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
			$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
			$smarty->assign("contents", $text);
			$smarty->assign("url_cms", $cms->url_cms());
			$smarty->assign("url_smartytpl", $cms->url_smartytpl());
			$smarty->assign("cmsversion", $cms->cmsversion());
			$smarty->display("admin/index/index.tpl");
			exit;
		}

		else {
		die("Problemi nell'upload del file " . $_FILES["upfile"]["name"]);
		}
	}
}

/* Form */

$text = 'Tramite il seguente form puoi caricare un\'immagine nel server.<br /><br />

<form action="" method="post" enctype="multipart/form-data">
<input name="upfile" type="file" size="40" /><br />
<select name="destinazione">
<option value="news">News</option>
<option value="sezioni">Sezioni</option>
</select>
<input name="upload" type="submit" value="Carica" />
</form>';

// Visualizzo la pagina
$smarty->assign("titolo", "Carica immagine");
$smarty->assign("cookie", $db->auth($_COOKIE[$func->cookie()]));
$smarty->assign("grado", $db->grado($_COOKIE[$func->cookie()]));
$smarty->assign("contents", $text);
$smarty->assign("url_cms", $cms->url_cms());
$smarty->assign("url_smartytpl", $cms->url_smartytpl());
$smarty->assign("cmsversion", $cms->cmsversion());
$smarty->display("admin/index/index.tpl");
?>
