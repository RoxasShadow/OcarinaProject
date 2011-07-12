<?php
$action = 'news';
$titolo = '';
require_once('core/class.Comments.php');
$comment = new Comments();

$comment = $comment->getNews();
$json = json_encode($comment);
$obj = json_decode($json);
echo $obj[0]->id;
