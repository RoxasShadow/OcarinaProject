<?php
/* Questa classe permette di impaginare le news */
// definiamo una costante per la pagina corrente
define("SELF", $_SERVER['PHP_SELF']);

// definiamo la classe
class Paging
{
  // definiamo la pagina di partenza
  function paginaIniziale($max_row)
  {
    if ((!isset($_GET['p'])) || ($_GET['p'] == "1"))
    {
      $parti_da = 0;
      $_GET['p'] = 1;
    }else{
      $parti_da = ($_GET['p']-1) * $max_row;
    }
    return $parti_da;
  }

  // contiamo le pagine e stabiliamo quanti records devono essere impaginati 
  function contaPagine($conta, $max_row)
  {
    $pgg = (($conta % $max_row) == 0) ? $conta / $max_row : floor($conta / $max_row) + 1;
    return $pgg;
  }

  // mostriamo l'elenco delle pagine
  function listaPagine($p_corrente, $pgg)
  {
    $listapgg = "";
    if (($p_corrente != 1) && ($p_corrente))
    {
      $listapgg .= " <a href=\"".SELF."?p=1\">Prima pag.</a> ";
    }
    if (($p_corrente-1) > 0)
    {
      $listapgg .= "<a href=\"".SELF."?p=".($p_corrente-1)."\"><</a> ";
    }
    for ($i=1; $i<=$pgg; $i++)
    {
      if ($i == $p_corrente)
      {
        $listapgg .= "<b>".$i."</b>";
      }else{
        $listapgg .= "<a href=\"".SELF."?p=".$i."\">".$i."</a>";
      }
      $listapgg .= " ";
    }
    if (($p_corrente+1) <= $pgg)
    {
      $listapgg .= "<a href=\"".SELF."?p=".($p_corrente+1)."\">></a> ";
    }
    if (($p_corrente != $pgg) && ($pgg != 0))
    {
      $listapgg .= "<a href=\"".SELF."?p=".$pgg."\">Ultima pag.</a> ";
    }
    $listapgg .= "</td>\n";
    return $listapgg;
  }

  // permettiamo la navigazione per pagine precedenti e successive
  function precedenteSuccessiva($p_corrente, $pgg)
  {
	$impaginazione = "";
    if (($p_corrente-1) <= 0)
    {
      $impaginazione .= "";
    }else{
      $impaginazione .= "<a href=\"?p=".($p_corrente-1)."\">&laquo; Pagina precedente</a>";
    }
    $impaginazione .= "  ";
    if (($p_corrente+1) > $pgg)
    {
      $impaginazione .= "";
    }else{
      $impaginazione .= "<a href=\"?p=/".($p_corrente+1)."\">Pagina successiva &raquo;</a>";
    }
    return $impaginazione;
  }
}
?>
