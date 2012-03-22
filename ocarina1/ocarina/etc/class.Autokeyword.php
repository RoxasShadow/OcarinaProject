<?php
/* Genera le keyword delle news e delle sezioni. */
class autokeyword {

var $contents;
var $encoding;
var $keywords;
var $wordLengthMin;
var $wordOccuredMin;
var $word2WordPhraseLengthMin;
var $phrase2WordLengthMinOccur;
var $word3WordPhraseLengthMin;
var $phrase2WordLengthMin;
var $phrase3WordLengthMinOccur;
var $phrase3WordLengthMin;

function autokeyword($params, $encoding)
{
$this->encoding = $encoding;
mb_internal_encoding($encoding);
$this->contents = $this->replace_chars($params['content']);

$this->wordLengthMin = $params['min_word_length'];
$this->wordOccuredMin = $params['min_word_occur'];

$this->word2WordPhraseLengthMin = $params['min_2words_length'];
$this->phrase2WordLengthMin = $params['min_2words_phrase_length'];
$this->phrase2WordLengthMinOccur = $params['min_2words_phrase_occur'];

$this->word3WordPhraseLengthMin = $params['min_3words_length'];
$this->phrase3WordLengthMin = $params['min_3words_phrase_length'];
$this->phrase3WordLengthMinOccur = $params['min_3words_phrase_occur'];
}

function get_keywords()
{
$keywords = $this->parse_words().$this->parse_2words().$this->parse_3words();
return substr($keywords, 0, -2);
}

function replace_chars($content)
{
$content = mb_strtolower($content);
$content = strip_tags($content);

$punctuations = array(',', ')', '(', '.', "'", '"',
'<', '>', ';', '!', '?', '/', '-',
'_', '[', ']', ':', '+', '=', '#',
'$', '&quot;', '&copy;', '&gt;', '&lt;',
chr(10), chr(13), chr(9));

$content = str_replace($punctuations, " ", $content);
$content = preg_replace('/ {2,}/si', " ", $content);

return $content;
}

function parse_words()
{
/* FILTRO KEYWORD DA ESCLUDERE */
$common = array("articolo", "pagina", "pagine", "sezione", "sezioni", "scritto");
$s = split(" ", $this->contents);
$k = array();
foreach( $s as $key=>$val ) {
if(mb_strlen(trim($val)) >= $this->wordLengthMin  && !in_array(trim($val), $common)  && !is_numeric(trim($val))) {
$k[] = trim($val);
}
}
$k = array_count_values($k);
$occur_filtered = $this->occure_filter($k, $this->wordOccuredMin);
arsort($occur_filtered);

$imploded = $this->implode(", ", $occur_filtered);
unset($k);
unset($s);

return $imploded;
}

function occure_filter($array_count_values, $min_occur)
{
$occur_filtered = array();
foreach ($array_count_values as $word => $occured) {
if ($occured >= $min_occur) {
$occur_filtered[$word] = $occured;
}
}

return $occur_filtered;
}

function implode($gule, $array)
{
$c = "";
foreach($array as $key=>$val) {
@$c .= $key.$gule;
}
$c = trim($c, " ,"); // Elimino la virgola finale
return $c;
}
}
?>
