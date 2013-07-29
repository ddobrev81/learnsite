<?php #stdlib.php


include 'csite.php';
include 'cpage.php';

function initialise_site(csite $site) {
  $site->addHeader("header.php");
	$site->addFooter("footer.php");
}
?>
