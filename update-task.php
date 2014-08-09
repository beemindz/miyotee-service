<?php

require_once __DIR__ . '/include/DbHandler.php';

	/**
 * Creating new task in db
 * method POST
 * params - name
 * url - /tasks/
 */
if (isset($_POST['username']) && isset($_POST['taskId']) && isset($_POST['taskName']) && isset($_POST['taskDescription']) 
    && isset($_POST['dueDate']) && isset($_POST['reminderDate']) && isset($_POST['isReminder'])
    && isset($_POST['isDueDate'])&& isset($_POST['isComplete']) && isset($_POST['updatedDate'])) {
    
    $response = array();
    $taskId = $_POST['taskId'];
    $username = $_POST['username'];
    $taskName = $_POST['taskName'];
    $taskDescription = $_POST['taskDescription'];
    $reminderDate = $_POST['reminderDate'];
    $dueDate = $_POST['dueDate'];
    $isReminder = $_POST['isReminder'];
    $isDueDate = $_POST['isDueDate'];
    $isComplete = $_POST['isComplete'];
    $updatedDate = $_POST['updatedDate'];
    
    $db = new DbHandler();

    $user = $db->getUserByEmail($username);
    if($user != null) {
        $result = $db->updateTask($taskId, $taskName, $taskDescription,$dueDate, $reminderDate, $isReminder,
        $isDueDate, $isComplete, $updatedDate);
        if ($result) {
            $task = $db->getTask($taskId);
             // task node
             
            $response["task"] = array();
            $response["error"] = false;
            array_push($response["task"], $task);
            
        } else {
            $response["error"] = true;
            $response["message"] = "Failed to update task. Please try again";
        }
     } else {
            $response["error"] = true;
            $response["message"] = "Failed to update task. Please try again";
        }
    // echo json response
    echo json_encode($response);
}
?>