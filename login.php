<?php

/**
 * @author GallerySoft.info
 * @copyright 2014
 */
 
require_once __DIR__ . '/include/DbHandler.php';



/**
 * User Login
 * url - /login
 * method - POST
 * params - email, password
 */
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['fbAccessToken'])) {
           
            // reading post params
            $email = $_POST['username'];
            $password = $_POST['password'];
            $fbAccessToken = $_POST['fbAccessToken'];
            
            
            $result = null;
            $response = array();

            $db = new DbHandler();
            if($password != "") {
                
                $result = $db->checkLogin($email, $password);
            } else if ($fbAccessToken != "") {
                
                $result = $db->checkFbLogin($email, $fbAccessToken);
            }
            // check for correct email and password
            if ($result) {
                // get the user by email
                $user = $db->getUserByEmail($email);

                if ($user != NULL) {
                    $response["error"] = false;
                    
                     // user node
                    $response["user"] = array();
        
                    array_push($response["user"], $user);
                    
                } else {
                    // unknown error occurred
                    $response['error'] = true;
                    $response['message'] = "An error occurred. Please try again";
                }
            } else {
                // user credentials are wrong
                $response['error'] = true;
                $response['message'] = 'Login failed. Incorrect credentials';
            }

            // echo json response
            echo json_encode($response);
        }