<?php
if((isset($_GET['from'])) && isset($_GET['to']) && isset($_GET['text'])) {
	include_once('etc/class.Translator.php');
	$translator = new Translator();
	echo $translator->translate($_GET['text'], $_GET['from'], $_GET['to']);
}
else
	echo '<html>
<head>
<script type="text/javascript" src="etc/loadJavascript.js.php"></script>
</head>
<body onclick="sendGet(\'http://localhost/ocarina2/translator.php?from=it&to=en&text=Ciao\', \'box\');">
<div id="box" style="height:auto;border:1px dashed black;margin-top:2px;margin-left:2px;padding:2px;"></div>
</body>
</html>';
