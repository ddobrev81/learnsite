<?php # register.php

include 'stdlib.php';

$site = new csite();

initialise_site($site);

$page = new cPage("Register");
$site->setPage($page);


if(isset($_POST['submitted']))	{
			
		if(empty($_POST['first_name']))	{
				$content[]="You forgot to enter your first name.\n";
		}
		else{
				$fn=trim($_POST['first_name']);
		}
		if(empty($_POST['last_name']))	{
				$content[]="You forgot to enter your last name.\n";
		}
		else{
				$ln=trim($_POST['last_name']);
		}
		if(empty($_POST['email']))	{
				$content[]="You forgot to enter your email.\n";
		}
		else{
				$e = trim($_POST['email']);
		}
		if(!empty($_POST['pass1']))		{
			if($_POST['pass1'] != $_POST['pass2'])	{
				$content[] = "Your password did not match the confirmed password!\n";
			}
			else {
				$p = trim($_POST['pass1']);
			}
		}
		else {
			$content[] = "You forgot to enter your password!\n";
		}

if(empty($content)) {
	require_once('dbc.php');
	$q = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES (:fn, :ln, :e, SHA1(:p), NOW() )";
	$ps = $pdo->prepare($q);
	$params = array(
				'fn' => $fn,
				'ln' => $ln,
				'e' => $e,
				'p' => $p
				);
	$r = $ps->execute($params);
	if($r){
		$content[] = '<h1> Thank you!</h1><p>You are now registered!</p><p><br /></p>';
	}
	else{
		$content[] = '<h1>System Error</h1><p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
	}
	
}
else{
	$content[] = '<h1>Error!</h1><p class=”error”>The following error(s) occurred:<br />';
}
}

$content[] = <<<HTML
<form action="register.php" method="post">
<p>First Name: <input type="text" name="first_name" size="15" maxlength="20" /></p>
<p>Last Name: <input type="text" name="last_name" size="15" maxlength="20" /></p>
<p>Email Address: <input type="text" name="email" size="20" maxlength="80"  /> </p>
<p>Password: <input type="password" name="pass1" size="10" maxlength="20" /></p>
<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" /></p>
<p><input type="submit" name="submit" value="Register" /></p>
<input type="hidden" name="submitted" value="TRUE"/>
</form>
HTML;

$page->setContent($content);

$site->render();

?>
