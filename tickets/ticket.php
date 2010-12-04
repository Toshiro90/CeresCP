<?php

	$charname = cleanstring($_POST['charname']);
	$writeline = "Character Name: $charname
";
	$time = time();
	$thetime = "Time submitted: $time
"; //Change this to the date and time later
	$bugreport = $_POST['report'];
	$bugreport = sanitize_html_string($bugreport);
	$bugreport = cleanstring($bugreport);
	if(strlen($bugreport)>650) {
		die('This Report is too long, try slimming it down.');
	}
	$rand = rand(99, 20000);
	$createFile = "suggestion$rand.txt";
	$openfile = fopen($createFile, 'w+');
	fwrite($openfile, $writeline); //writes the persons login name onto the first line of the ticket
	fwrite($openfile, $thetime);
	fwrite($openfile, $bugreport);
	fclose($openfile);
        echo 'Report successfully submitted, thank you. A GM will get to you as soon as possible.';
		echo '<br>Redirecting...</br>';
		echo "<meta http-equiv='refresh' content='3;url=../index.php'>";
        die();
	
	
function cleanstring($var) {

$var = strip_tags($var);
$var = htmlentities($var);
return $var;

}
	
// sanitize a string for HTML (make sure nothing gets interpretted!)
function sanitize_html_string($string)
{
  $pattern[0] = '/\&/';
  $pattern[1] = '/</';
  $pattern[2] = "/>/";
  $pattern[3] = '/\n/';
  $pattern[4] = '/"/';
  $pattern[5] = "/'/";
  $pattern[6] = "/%/";
  $pattern[7] = '/\(/';
  $pattern[8] = '/\)/';
  $pattern[9] = '/\+/';
  $pattern[10] = '/-/';
  $replacement[0] = '&amp;';
  $replacement[1] = '&lt;';
  $replacement[2] = '&gt;';
  $replacement[3] = '<br>';
  $replacement[4] = '&quot;';
  $replacement[5] = '&#39;';
  $replacement[6] = '&#37;';
  $replacement[7] = '&#40;';
  $replacement[8] = '&#41;';
  $replacement[9] = '&#43;';
  $replacement[10] = '&#45;';
  return preg_replace($pattern, $replacement, $string);
}

?>

