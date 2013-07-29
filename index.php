<?php #index.php

include 'stdlib.php';

$site = new csite();

initialise_site($site);

$page = new cpage("Welcome");
$site->setPage($page);

$content[] ='Welcome to my personal web site!';

$page->setContent($content);

$site->render();

?>
