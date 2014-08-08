<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once __DIR__ .'/include/send_mail.php';

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    
    // include db connect/
    require_once __DIR__ . '/include/DbHandler.php';
	
    // connect to db
    $db = new DbHandler();
    
    // query check email exists in db.
    $user = $db->getUserByEmail($email);

    if ($user != null) {            
        
			// update password user to default.
			$kq = $db->updateUser($email);
			if ($kq == USER_CREATED_SUCCESSFULLY) {
				
				// send mail.
				if (sendmail($email) == 1) { 
					$response["message"] = "A email sent to your email. Please check email!";
				} else {
					$response["message"] = $error;		
				}
                
                $response["success"] = 0;
			} else {
                $response["success"] = 1;
			}			
						
			// response to client.
			echo json_encode($response);
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