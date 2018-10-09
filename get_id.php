<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">	
</head>
<body>
<?php 

$uid      = $_POST['id'];
$mail2 	  = "{imap.gmail.com:993/imap/ssl}INBOX";
$kadi2    = "***********";
$sifre2   = "***********";
$mbox	  = imap_open($mail2,$kadi2,$sifre2);
$foo2	  = imap_fetchbody($mbox,$uid,2);
$foo 	  = quoted_printable_decode($foo2);

$matches = array();
$matches[0] = '';
$test = imap_fetchmime($mbox,$uid,FT_UID);
@preg_match('/".*?"/', $test, $matches);
if(@$matches[0]=="utf-8"){
echo $foo;
}else{
echo @mb_convert_encoding($foo,"UTF-8",$matches[0]);
}


imap_close($mbox);
?>
</body>
</html>



