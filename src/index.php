<?php 
	include( 'constants.php' );
	if( isset($_SESSION['email'])){
		$email = $_SESSION['email'];
		$sql = "SELECT * FROM poll_questions WHERE id NOT IN (SELECT question_id FROM poll_responses WHERE email_id = '$email' ) ORDER BY id LIMIT 0, 1";
	} else {
		$sql = "SELECT * FROM poll_questions ORDER BY id LIMIT 0, 1";
	}
	$res = mysql_query($sql);
	if( mysql_num_rows($res) ){
		$que = mysql_fetch_assoc( $res );
		$sql = "SELECT * FROM poll_options where question_id = '" . $que['id'] ."'";
		$res = mysql_query( $sql );
		$options =  array();
		if( !mysql_error() ){
			while( $row = mysql_fetch_assoc( $res ) ){
				$options[] = array('id'=>$row['id'], 'option'=>$row['option_text']);
			}
		} else {
			echo mysql_error();
			exit();
		}
	} else {
		echo 'No New Poll for you!<br/>Please come back later!';
		exit();
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
				<h4><?php echo $que['question']; ?></h4>
				<input	type="hidden" class="form-control" name="question" id="question" value="<?php echo $que['id']; ?>" />
			</div>
			<div>
				<?php foreach ($options as $option) { ?>
					<div class="input-group">
						<span class="input-group-addon">
							<input type="radio" name="option" value="<?php echo $option['id']; ?>"> 
						</span>
						<input type="text" class="form-control" readonly="" value="<?php echo $option['option']; ?>">
					</div><!-- /input-group -->
					<br/>
				<?php } ?>
			</div>
			<br/>
			<div>
				<button class="btn btn-primary" type="submit" name="saveResponse">Submit</button>
			</div>
		</form>
	</div>
	
</body>
</html>