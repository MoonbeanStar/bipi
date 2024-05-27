<?php
include 'includes/session.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'deleteRecord' && isset($_POST['id'])) {
        $id = intval($_POST['id']);

        // Escaping values before embedding in SQL query to prevent SQL injection
        $id_escaped = $conn->real_escape_string($id);
		
		$sql_fetch = "SELECT * FROM schedule_data WHERE id = '$id_escaped'";
        $result = $conn->query($sql_fetch);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $new_status = $row['status'];

            if (in_array($new_status, [1, 2, 5])) {
                $new_status = 6; // Unsuccessful Delivered
            }

        // Fetch and move the record to scheduled_history table in a single query
        $sql_insert = "
            INSERT INTO scheduled_history (id, ans_no, supplier_id, delDate, delTime, category, type, drPhoto, status, remarks)
            SELECT id, ans_no, supplier_id, delDate, delTime, category, type, drPhoto, status, remarks
            FROM schedule_data
            WHERE id = '$id_escaped'
        ";

        if ($conn->query($sql_insert)) {
            // Delete the record from the original table
            $sql_delete = "DELETE FROM schedule_data WHERE id = '$id_escaped'";
            if ($conn->query($sql_delete)) {
                $response = array('status' => 'success', 'message' => 'Record moved to history and deleted successfully');
            } else {
                $response = array('status' => 'error', 'message' => 'Failed to delete the record from the original table');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Failed to move the record to history');
		}
        }  else {
            $response = array('status' => 'error', 'message' => 'Record not found');
        }

        echo json_encode($response);
        exit;
    }
}
?>