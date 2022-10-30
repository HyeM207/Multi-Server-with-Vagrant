<?php
//phpinfo();
/* DISPLAYS THE SUBMITTED INFO (TESTING)
	echo $_POST['first'];
	echo " ";
echo $_POST['last'];
	echo '<br />';
	echo $_POST['email'];

*/

$username = 'root';
$password = 'rootpass';
$dsn = 'mysql:host=192.168.3.7;dbname=formresponses';

try{
	$db = new PDO($dsn, $username, $password);
	$result=FALSE;

	if($_POST['first']!=null && $_POST['last']!=null && $_POST['email']!=null)
	{
		$first=filter_var(trim($_POST['first']),FILTER_SANITIZE_SPECIAL_CHARS);
		$last=filter_var(trim($_POST['last']),FILTER_SANITIZE_SPECIAL_CHARS);
		$email=filter_var(trim($_POST['email']),FILTER_SANITIZE_EMAIL);
		if(validSubmission($first,$last,$email))
			$result=insertInfo($db,$first,$last,$email);
	}

} catch(PDOException $ex) {
	echo $ex->getMessage();
}

header('Location: index.php?success='.$result);



//Return true if user info is valid (not empty, email syntax okay)
function validSubmission($first,$last,$email)
{
	$result=FALSE;
	if(nonempty($first) && nonempty($last) && nonempty($email) && validEmail($email))
		$result=TRUE;
	return $result;
}

//Return true if email contains '@' and at least one '.' after '@'
function validEmail($email)
{
	$valid=FALSE;
	$position=strpos($email,'@');
	if($position!=FALSE && strpos(substr($email,$position),'.')!=FALSE) //false if @ is first char too
		$valid=TRUE;
	return $valid;
}

//Return true if input is not null and not an empty string
function nonempty($input)
{
	$nonempty=FALSE;
	if($input!=null && $input!='')
		$nonempty=TRUE;
	return $nonempty;
}

//Insert entered form info into the database
function insertInfo($db,$first,$last,$email)
{
	$stmt = $db->prepare("INSERT INTO response2(firstname, lastname, email, submitdate) VALUES (:first, :last, :email, :date)");
	$stmt->bindParam(':first', $first);
	$stmt->bindParam(':last', $last);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':date', date_format(date_create("now",timezone_open("America/New_York")), "Y-m-d H:i:s"));
	
	return $stmt->execute();
}

?>