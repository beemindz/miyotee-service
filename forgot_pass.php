<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include 'include/send_mail.php';

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    
    // include db connect/
    require_once __DIR__ .'include/DbConnect.php';
    // connect to db
    $db = new DbConnect();
    
    // query check email exists in db.
    $query = "SELECT `userId`, `username` FROM `users` WHERE `username`='".$email."'";
    $result = mysql_query($query);

    if (!empty($result)) {
        if (mysql_numrows($result) > 0) {
            $result = mysql_fetch_array($result);
            //$user = array();
            //$user["userId"] = $result["userId"];
            //$user["email"] = $result["username"];
            
            $response["success"] = 1;
			// update password user to default.
			$uquery = "UPDATE `users` SET `password`='123456' WHERE `username`='".$email."'";
			mysql_query($uquery);
			
			// send mail.
			if (sendmail($email) == 1) { 
				$response["message"] = "A email sent to your email. Please check email!";
			} else {
				$response["message"] = $error;		
			}
			
			//$response["user"] = array();
			//array_push($response["user"], $user);
				
			// response to client.
			echo json_encode($response);
		} else {
			user_not_exists($email, "user ".$email." not exists.");
		}
    } else {
        user_not_exists($email, "user ".$email." not exists.");
    }
} else {
    // email is null.
    user_not_exists($email, "Email is required!");
    
}

function user_not_exists($email, $message) {
    $response["success"] = 0;
    $response["message"] = $message;
    echo json_encode($response);
}


?>