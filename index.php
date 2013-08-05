<?php #index.php
session_start();
include 'stdlib.php';

$site = new csite();

initialise_site($site);

$page = new cpage("Welcome");
$site->setPage($page);

$content[] ='<br>The code for this site can be found <a href="https://github.com/ddobrev81/learnsite">here.</a>';

$page->setContent($content);

$site->render();

?>