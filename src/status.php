<?php 
	include( 'constants.php' );
	$total_responses = 0;
	$options =  array();
	if( isset( $_GET['id']) ){
		$poll_id = $_GET['id'];
		$sql = "SELECT * FROM poll_questions WHERE id = '$poll_id'";
		$res = mysql_query($sql);
		if( mysql_num_rows($res) ){
			$que = mysql_fetch_assoc( $res );
			$sql = "SELECT * FROM poll_options where question_id = '" . $que['id'] ."'";
			$opts = mysql_query( $sql );
			if( !mysql_error() ){
				while( $row = mysql_fetch_assoc( $opts ) ){
					//echo $row['id'].'|'.'opt_'.$row['id'].'<br/>';
					$options['opt_'.$row['id']] = array('id'=>$row['id'], 'option'=>$row['option_text'], 'response'=>0);
				}
				$sql = "SELECT * FROM poll_responses where question_id = '" . $que['id'] ."'";
				$resp = mysql_query( $sql );
				if( !mysql_error() ){
					while( $row = mysql_fetch_assoc( $resp ) ){
						//echo $row['id'].'|'.'resp_'.$row['id'].'<br/>';
						$options['opt_'.$row['option_id']]['response']++;
						$total_responses++;
					}
				} else {
					echo mysql_error();
					exit();
				}
			} else {
				echo mysql_error();
				exit();
			}
			
		} else {
			echo 'Sorry! no information on this Poll!';
			echo mysql_error();
			exit();
		}
	}

?><!DOCTYPE html>
<html>
<head>
	<title>Poll</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<style type="text/css">
	.option_name{
		font-size: 14px;
		padding: 4px 8px;
	}
	</style>

</head>
<body>
	<br/>
	<div class="col-md-6">
		<form name="addPoll" method="POST" action="addAnswer.php" role="form">
			<div class="form-group">
				<h4><?php echo $que['question']; ?></h4>
			</div>
			<div>

				<?php
				//print_r($options);
				foreach ($options as $option) { 
					$class;
					$percent = $option['response'] / $total_responses * 100;
					if( $percent > 80 ){
						$class = 'progress-bar-success';
					} else if( $percent < 80 and $percent > 60 ) {
						$class = 'progress-bar-primary';
					} else if( $percent < 60 and $percent > 40 ) {
						$class = 'progress-bar-info';
					} else if( $percent < 40 and $percent > 20 ) {
						$class = 'progress-bar-warning';
					} else if( $percent < 40 ) {
						$class = 'progress-bar-danger';
					}

					?>

					<div class="progress">
						<div class="progress-bar <?php echo $class; ?>" role="progressbar" aria-valuenow="<?php echo $percent ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent ?>%">
							<span class="option_name"><?php echo $option['option'] ?></span><span class="sr-only"><?php $option['response'] .' / ' . $total_responses; ?></span>
						</div>
					</div>
				<?php } ?>
			</div>
			<br/>
			<div>
				<a href="index.php" class="btn btn-primary" >More Polls...</a>
			</div>
		</form>
	</div>
	
</body>
</html>