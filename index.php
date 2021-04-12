<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	session_start();

	require_once 'classes/main.php';
	$main = new main();
	
	if(isset($_REQUEST['state']) && $_REQUEST['state']!=NULL){
		$state=$_REQUEST["state"];
	}
	else{
		$state = "home";
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Micro Quiz Hour</title>

	<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
	<link href="microquizhour.css" rel="stylesheet">
	<link href="bootstrap.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">-->
</head>	
<body>
	<?php
		$main->switchboard($state);
	?>
<script>

	$(document).ready(function(){
	localStorage.setItem("dollarAmount", 0);
	var dollarAmount = localStorage.getItem("dollarAmount");

	$('.jeopardy').click(function(){
		var buttonId = $(this).data('id');

		//AJAX
		$.ajax({
			url: 'classes/ajax.php',
			type: 'post',
			data: {id: buttonId},
			success: function(response){
				$('.modal-content').html(response);

				$('#example').modal('show');
			}
		});
	});
});

</script>
</body>
</html>