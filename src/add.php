<?php 
	include( 'constants.php' );
	if(isset($_POST['savePoll'])){
		echo $que = trim($_POST['question']);
		$sql = "INSERT INTO `poll_questions`( `question` ) VALUES ('$que')";
		mysql_query( $sql );
		if( !mysql_error() ){
			$que_id = mysql_insert_id();

			$options = array();
			foreach ($_POST['option'] as $option) {
				$options[] = "( $que_id, '".mysql_real_escape_string($option)."')";
			}
			$sql = "INSERT INTO `poll_options`( `question_id`, `option_text`) VALUES  ". implode(',', $options);
			mysql_query($sql);
			if( !mysql_error()){
				echo 'Added Sussessfully!';
				exit();
			} else {
				echo mysql_error();
			}
		} else {
			echo mysql_error();
		}
		

	}
?><!DOCTYPE html>
<html>
<head>
	<title>Add Poll</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	function addOption(){
		$('.options').append('<div><input class="form-control" type="text" name="option[]" value="" /></div>');
	}
	</script>
</head>
<body>
<br/>
	<div class="col-md-6">
		<form name="addPoll" method="POST" action="add.php" role="form">
			<div class="form-group">
				<label for="question">Poll Question</label>
				<input	type="text" class="form-control" name="question" id="question" value="" />
			</div>
			<div class="form-group">
				<button class="btn btn-default" type="button" onclick="addOption()">Add More Options</button>
			</div>
			<div class="form-group options">
				<label for="exampleInputEmail1">Options</label>
				<div>
					<input	type="text" class="form-control input-block" name="option[]" value="" />
				</div>
			</div>
			<br/>
			<div>
				<button class="btn btn-primary" type="submit" name="savePoll">Add Poll</button>
			</div>
		</form>
	</div>
	
</body>
</html>