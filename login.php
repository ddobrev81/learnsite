<?php #login.php

include('stdlib.php');
$site = new csite();
initialise_site($site);
$page = new cpage("Login");
$site->setPage($page);

if( isset($_POST['submitted'])) {
  	require_once('dbc.php');
		list($check, $data) = check_login($pdo, $_POST['email'], $_POST['pass']);
		if($check) {
				#setcookie('user_id', $data['user_id'], time()+3600, '/', '', 0, 0);
				#setcookie('first_name', $data['first_name'], time()+3600, '/', '', 0, 0);
				session_start();
				$_SESSION['user_id']= $data['user_id'];
				$_SESSION['first_name'] = $data['first_name'];
				$url = absolute_url('loggedin.php');
				header("Location: $url");
				exit();
		}else{
			$errors=$data;
		}
}
	
if(!empty($errors)) {
		$content[] = '<h1> Error!</h1>
		<p class="error"> The following error(s) occurred:<br />
		';
		foreach($errors as $msg) {
				$content[]= "- $msg<br />\n";
		}
		$content[]= '</p><p>Please try again!</p>';
}


$content[] ='
<form action="login.php" method="post">
	<p>Email Address: <input type="text" name="email" size=20 maxlength=20 /></p>
	<p>Password: <input type="password" name="pass" size=20 maxlength=20 /></p>
	<p><input type="submit" name="submit" value="Login" /></p>
	<input type="hidden" name="submitted" value="TRUE"/>
</form>
';

$page->setContent($content);
$site->render();
?>
