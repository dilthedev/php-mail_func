<!--Developed By dil.dev
	contact dilshankaliyanage@yahoo.com
-->

<?php 
	
	//Message Vars
	$msg = '';
	$msgClass = '';
	

	//Check for submit
if(filter_has_var(INPUT_POST,'submit')){
	//Get the form data

	$email = htmlspecialchars($_POST['email']);
	$name = htmlspecialchars($_POST['name']);
	$txt = htmlspecialchars($_POST['txt']);

	//check required fields
	if(!empty($email)&& !empty($name) && !empty($txt)){
		//Passed
		if(filter_var($email,FILTER_VALIDATE_EMAIL)===false){
			//failed
			$msg = 'E-mail you entered is not valid';
			$msgClass = 'alert-danger';
		}else{
			//Passed
			//Recepient Email
			$toEmail = ''; //Enter E-mail Here
			$subject = 'Contact Request from '.$name;
			$body = '<h2>Contact Request</h2>
						<h4>Name</h4><p>'.$name.'</p>
						<h4>E-Mail</h4><p>'.$email.'</p>
						<h4>Message</h4><p>'.$txt.'</p>';

			//E-mail headers
				$headers = "MIME-Version: 1.0"."\r\n";
				$headers .= "Content-Type:text/html;charset=UTF-8".
				"\r\n";
				//Additional headers
				$headers .= "From: " .$name."<".$email.">"."\r\n";

				if(mail($toEmail,$subject,$body,$headers)){
					$msg = 'Your E-mail has been sent!!! ';
					$msgClass = 'alert-success';

				}else{
						$msg = 'Your E-mail was not sent!!!';
						$msgClass = 'alert-danger';

				}

		}
	}else{
		//failed
		$msg = 'Please fill in all fileds';
		$msgClass = 'alert-danger';

	}
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contact Us</title>
	<link rel="stylesheet" href="bootstrap.min.css"> <!--Apply here bootstrap theme whatever you want-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">MY WEBSITE</a>
			</div>
		</div>
	</nav>
	<div class="container">
		<?php if($msg != '') : ?>
			<div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
		<?php endif; ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div class="form-group">
				<label for="">Name</label>
				<input value="<?php echo isset($_POST['name']) ? $name : ''; ?>" type="text" name="name" class="form-control" placeholder="Enter Name here!">
			</div>
			<div class="form-group">
				<label for="">E-Mail</label>
				<input value="<?php echo isset($_POST['email']) ? $email : ''; ?>" placeholder="Enter E-Mail here!" type="text" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Message</label>
				<input type="text" value="<?php echo isset($_POST['txt']) ? $txt : ''; ?>" placeholder="Enter Message here!" name="txt" class="form-control">
			</div>
			<br>
			<button type="submit" name="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
	
</body>
</html>