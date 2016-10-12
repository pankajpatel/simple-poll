<?php 
	include( 'constants.php' );
	$question = 0;
	$option = 0;
	$email = false;
	if( isset($_POST['saveResponse'] ) ){
		$question = $_POST['question'];
		$option = $_POST['option'];
		if(isset($_POST['email'])){
			$_SESSION['email'] = $_POST['email'];
		}
		if(isset($_SESSION['email'])){
			$email = $_SESSION['email'];
		} else {
			$email = false;
		}

		if( $email ){
			$sql = "SELECT * FROM poll_responses WHERE email_id = '$email' and question_id = '$question'";
			$res = mysql_query( $sql );
			if( mysql_num_rows( $res ) == 0 ){
				$sql = "INSERT INTO `poll_responses`(`email_id`, `question_id`, `option_id`) VALUES ( '$email', $question, $option )";
				mysql_query( $sql );
				if( !mysql_error() ){
					header( 'Location:status.php?id='.$question );
					exit();
				} else {
					echo mysql_error();
					exit();
				}
			} else {
				echo 'Sorry! You already voted for this poll!';
				exit();
			}
			
		}
	}
?><!DOCTYPE html>
<html>
<head>
	<title>Poll</title>
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
		<form name="addPoll" method="POST" action="addAnswer.php" role="form">
			<div class="form-group">
				<label for="email">Your Email Please:</label>
				<input	type="email" class="form-control" name="email" id="email" value="" required/>
				<p><small>Note: You need ot enter email only once per session.</small></p>
				<input	type="hidden" name="question" id="question" value="<?php echo $question; ?>" />
				<input	type="hidden" name="option" id="option" value="<?php echo $option; ?>" />
			</div>
			<br/>
			<div>
				<button class="btn btn-primary" type="submit" name="saveResponse">Save Response</button>
			</div>
		</form>
	</div>
	
</body>
</html>