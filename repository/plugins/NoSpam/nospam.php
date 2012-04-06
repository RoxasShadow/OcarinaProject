<?php
/**
	/plugin/NoSpam/nospam.php
	(C) Giovanni Capuano 2012
*/
class NoSpam extends Utilities implements FrameworkPlugin {
	public function main($templateVarList) {
		if(isset($templateVarList['commento'])) {
			for($i=0, $count=count($templateVarList['commento']); $i<$count; ++$i)
				if($templateVarList['commenti'][$i]->contenuto != null)
					$templateVarList['commento'][$i]->contenuto = parent::cleanTextFromURL($templateVarList['commento'][$i]->contenuto);
			$rendering['commento'] = $templateVarList['commento'];
		}
		elseif(isset($templateVarList['commenti'])) {
			for($i=0, $count=count($templateVarList['commenti']); $i<$count; ++$i)
				if($templateVarList['commenti'][$i]->contenuto != null)
					$templateVarList['commenti'][$i]->contenuto = parent::cleanTextFromURL($templateVarList['commenti'][$i]->contenuto);
			$rendering['commenti'] = $templateVarList['commenti'];
		}
		/* The following code makes the cleaning persistents working when the user sends the comment to database.
		if(isset($_POST['comment']))
			$_POST['comment'] = parent::cleanTextFromURL($_POST['comment']);
		*/
	}
	
	public function install() {
		return true;
	}
	
	public function disinstall() {
		return true;
	}
}