<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	session_start();

	$id=$_REQUEST["id"];

	include("mysql.php");
	$mysql = new mysql();

	$preTitle = $mysql->getTitleInfo($id);
	$row = $preTitle[0];
	$name = $row['name'];
	$points = $row['points'];
	$title = "$name for $$points";


	$preImage = $mysql->getNanoImage($id);
	$row = $preImage[0];
	$imageSrc = $row['filename'];
	$image = "../images/$imageSrc";

	$preHint = $mysql->getHint($id);
	$row = $preHint[0];
	$hint = $row['clue'];

	$preAnswer = $mysql->getAnswer($id);
	$row = $preAnswer[0];
	$answer = $row['answer'];

	$preStudentInfo = $mysql->getStudentInfo($id);
	$row = $preStudentInfo[0];
	$studentInfo = $row['student_name'] . ', ' . $row['student_grad_year'];

	$preSummary = $mysql->getSummary($id);
	$row = $preSummary[0];
	$summary = $row['summary'];

?>

<div class="modal-header">
	<h5 class="modal-title"><?=$title?></h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
	<img src=<?="$image"?>>
	<div class="flip-card" id="flipcard1">
			<div id="hint">
				<h5>Hint</h5>
				<p><?=$hint?></p>
			</div>
	</div>
	<div class="flip-card" id="flipcard2">
			<div id="answer">
				<h5>Answer</h5>
				<p><?=$answer?></p>
			</div>
			<div id="summary">
				<h5>Summary</h5>
				<p><?=$summary?></p>
			</div>
			<div id="dollarButtons">
				<input type="radio" id="right" name="check" value="right">
				<label for="right">I got it right!</label> <br>
				<input type="radio" id="wrong" name="check" value="wrong">
				<label for="wrong">I got it wrong...</label>
			</div>
	</div>
	<div class="modal-footer">
		<p style="text-align: left; float: left;"><?=$studentInfo?></p>
		<button type="button" class="btn btn-secondary hint">Show Answer</button>
		
		<button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".hint").click(function(){
		$("#flipcard1").hide();
		$("#flipcard2").show();
		$("button[data-id='<?=$id?>'] img").attr("src", "<?=$image?>");
		$(".hint").hide();

	});
	$("#right").click(function(){
		//if(document.getElementById('right').checked){
			localStorage.setItem("dollarAmount", (parseInt(localStorage.getItem("dollarAmount"))+ parseInt(<?=$points?>)));
		//}
		/*else if(document.getElementById('wrong').checked){
			localStorage.setItem("dollarAmount", (parseInt(localStorage.getItem("dollarAmount")) - parseInt(<?=$points?>)));
		}*/
		var current = localStorage.getItem("dollarAmount");
		$("#points").html("Money Won: $"+current);
		//console.log(localStorage.getItem("dollarAmount"));
	});
	$("#wrong").click(function(){
		localStorage.setItem("dollarAmount", (parseInt(localStorage.getItem("dollarAmount")) - parseInt(<?=$points?>)));
		var current = localStorage.getItem("dollarAmount");
		$("#points").html("Money Won: $"+current);
	})
});

</script>