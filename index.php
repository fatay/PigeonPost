<!DOCTYPE html>
<html>
	<head>
		<title>PigeonPost by FATAY</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 		<link rel="stylesheet" type="text/css" href="style.css" />
  		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	</head>
<body>

<div class = "container">
<div class = "row align-items-center">
<div class = "col sm-3">

<!-- MENÃœ Ä°Å LEMLERÄ° BURADA OLACAK -->
<div align="center" class="alert alert-primary">
    <p>MENU</p>
</div>
</div>

<!-- BURASI LOGO AYARLARININ YAPILDIÄ I KISIM -->
<div class = "col-md-6">
<div class = "eksi" align="center"><img style="margin-bottom:-80px;" src="img/head.png" class="logo"><br></div>
<?php
$mail 	= "{imap.gmail.com:993/imap/ssl}INBOX";
$kadi 	= "***********";
$sifre 	= "F***********";
$mbox	= imap_open($mail,$kadi,$sifre);
$ileti	= imap_search($mbox,'ALL');

if($ileti){
	rsort($ileti);
	$cikti[] = null;
	$i = 0;
	foreach($ileti as $msjNo){
		$goster = imap_fetch_overview($mbox,$msjNo,0);
		$cikti[$i] = "<tbody><tr>";
	    $cikti[$i] = $cikti[$i]."<th scope='col'><span align='center'>".$msjNo."<span></th>";
		$cikti[$i] = $cikti[$i]."<th scope='col'><div align='center'><span id='".$msjNo."' class='crs' onclick='myFunction(this.id)' data-toggle='modal' data-target='#exampleModal'>".@imap_utf8(iconv_mime_decode($goster[0]->subject,0))."</span></div></th>";
		$cikti[$i] = $cikti[$i]."<th scope='col'><div align='center'>".@imap_utf8(iconv_mime_decode($goster[0]->from,0))."<div></th>";
		$cikti[$i] = $cikti[$i]."</tr></tbody>";
		$i++;
	}
}	

$page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
$total = count( $cikti ); 
$limit = 10; 
$totalPages = ceil( $total/ $limit ); 
$page = max($page, 1); 
$page = min($page, $totalPages);
$offset = ($page - 1) * $limit;
if( $offset < 0 ) $offset = 0;

$cikti = array_slice( $cikti, $offset, $limit );
echo "<table id='asd' class='table table-sm table-hover'><thead class='thead-dark'><tr><th scope='col'><b>#</b></th><th scope='col'><div align='center'>Subject</div></th><th scope='col'><div align='center'>From</div></th scope='col'></tr></thead>";

foreach ($cikti as $k => $v) {
	echo '<pre>' . print_r($v, true) . '</pre>';
}

echo "</table><hr class='hr'>";
$link = 'index.php?page=%d';
$pagerContainer = '<div align="center">';   

if( $totalPages != 0 ) {
	if( $page == 1 ){
		$pagerContainer .= ''; 
	} 
	else { 
		$pagerContainer .= sprintf( '<a href="' . $link . '"> &#171; prev page</a>', $page - 1 ); 
	}
	$pagerContainer .= ' <span>( page <strong>' . $page . '</strong> from ' . $totalPages . ' )</span>'; 
	if( $page == $totalPages ){ 
			$pagerContainer .= ''; 
	}else { 
		$pagerContainer .= sprintf( '<a href="' . $link . '"> next page &#187; </a>', $page + 1 ); 
	}	           
}                   
$pagerContainer .= '</div>';
echo $pagerContainer;
imap_close($mbox);
?>

<!-- @bootstrap MODALS kullanÄ±mÄ± -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="modalHeader"><span id="asd"></span></h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
			<div class="modal-body">
				    <div id="tt"></div>
        			<div id="sss">
        				<div class="mail-body"></div>
        				<img id="loading-image" src="img/load.gif" style="display:none;"/>			
					</div>
        	</div>
        	<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       			<button type="button" class="btn btn-primary">Save changes</button>
      		</div>
    	</div>
  	</div>
</div> 
</div> <!-- col-md*6 kapanma div'i -->

<div class = "col sm-3">
	<div align="center" class="alert alert-primary">
    	<p>REKLAM</p>
	</div>
</div>
<footer class="container text-center">
  <h3> FATAY COMPUTERS INC.</h3>
  <span class="badge"><i style="color:lightblue;">&copy;opyright | W3 Mail Standarts | </i></span>
  <span class="badge"><i style="color:pink">"Make e-mails great again"</i></span>
</footer>
<script>

	
function myFunction(item) {
	$.ajax({
    type: "POST",
    data:{'id': item},
    dataType: "html",
    url: "get_id.php",
    async: true,
    beforeSend: function() {
        $("#loading-image").show();
        $('#sss').children('.mail-body').hide();
    },
    success: function (data) {
        $('#sss').children('.mail-body').html(data).show();
        $("#loading-image").hide();
    }
    });
}
</script>

</body>
</html>