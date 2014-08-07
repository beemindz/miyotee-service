<?php

require_once __DIR__ . '/include/DbHandler.php';
/**
 * Deleting task. Users can delete only their tasks
 * method DELETE
 * url /tasks
 */
 if (isset($_POST['username']) && isset($_POST['taskId'])) {
    $db = new DbHandler();
    
    $username = $_POST['username'];
    $taskId = $_POST['taskId'];

    $user = $db->getUserByEmail($username);
    if($user != null) {
        $result = $db->deleteTask($taskId);
        if ($result) {
            // task deleted successfully
            $response["error"] = false;
            $response["message"] = "Task deleted succesfully";
        } else {
            // task failed to delete
            $response["error"] = true;
            $response["message"] = "Task failed to delete. Please try again!";
        }
    } else {
        $response["error"] = true;
        $response["message"] = "Task failed to delete. Please try again!";
    }
    echo json_encode($response);
 }
        
?>