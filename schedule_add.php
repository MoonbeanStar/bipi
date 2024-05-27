<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $ans_no = $_POST['ans_no'];
    $supplier = $_POST['supplier']; 
    $delDate = $_POST['delDate'];
    $delTime = $_POST['delTime'];
    $category_id = $_POST['name']; 
    $type_id = $_POST['itemType']; 
    $totalDel = $_POST['totalDel'];
    $uom1_id = $_POST['uom1Name']; 
    $totalQty = $_POST['totalQty'];
    $uom2_id = $_POST['uom2Name']; 
    $vehicleModel = $_POST['vehicleModel'];
    $plateNo = $_POST['plateNo'];
    $driverName = $_POST['driverName'];
    $helperName = $_POST['helperName'];
    $cancel = $_POST['remarks'];
    
    // Handle file upload
    $targetDir = "images/";
    $filename = basename($_FILES["drPhoto"]["name"]);
    $targetFile = $targetDir . $filename;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $uploadOk = 1;
    
    // Check if image file is a actual image or fake image
    if (getimagesize($_FILES["drPhoto"]["tmp_name"]) === false) {
        $_SESSION['error'] = "File is not an image.";
        $uploadOk = 0;
    }
    
    // Check if file already exists
    if (file_exists($targetFile)) {
        $_SESSION['error'] = "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["drPhoto"]["size"] > 500000) {
        $_SESSION['error'] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Upload file if no errors
    if ($uploadOk) {
        if (move_uploaded_file($_FILES["drPhoto"]["tmp_name"], $targetFile)) {
            $_SESSION['success'] = "The file " . htmlspecialchars($filename) . " has been uploaded.";
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        }
    }
    header('Location: schedule.php');
    exit();
    

    // Retrieve supplier ID
    $sql_supplier = "SELECT id FROM supplier WHERE supplier_id = '$supplier'";
    $result_supplier = $conn->query($sql_supplier);

    if($result_supplier->num_rows < 1){
        // Supplier not found, handle error
        $_SESSION['error'] = 'Supplier not found';
        header('Location: schedule.php');
        exit();
    } else {
        $row_supplier = $result_supplier->fetch_assoc();
        $supplier_id = $row_supplier['id'];

        // Fetch category name
        $sql_category = "SELECT name FROM category WHERE id = '$category_id'";
        $result_category = $conn->query($sql_category);
        if ($result_category->num_rows < 1) {
            $_SESSION['error'] = 'Category not found';
            header('Location: schedule.php');
            exit();
        }
        $row_category = $result_category->fetch_assoc();
        $category_name = $row_category['name'];

        // Fetch type name
        $sql_type = "SELECT name FROM type WHERE id = '$type_id'";
        $result_type = $conn->query($sql_type);
        if ($result_type->num_rows < 1) {
            $_SESSION['error'] = 'Type not found';
            header('Location: schedule.php');
            exit();
        }
        $row_type = $result_type->fetch_assoc();
        $type_name = $row_type['name'];

        // Fetch uom1 name
        $sql_uom1 = "SELECT uom1Name FROM package WHERE id = '$uom1_id'";
        $result_uom1 = $conn->query($sql_uom1);
        if ($result_uom1->num_rows < 1) {
            $_SESSION['error'] = 'UOM1 not found';
            header('Location: schedule.php');
            exit();
        }
        $row_uom1 = $result_uom1->fetch_assoc();
        $uom1_name = $row_uom1['uom1Name'];

        // Fetch uom2 name
        $sql_uom2 = "SELECT qtyname FROM quantity WHERE id = '$uom2_id'";
        $result_uom2 = $conn->query($sql_uom2);
        if ($result_uom2->num_rows < 1) {
            $_SESSION['error'] = 'UOM2 not found';
            header('Location: schedule.php');
            exit();
        }
        $row_uom2 = $result_uom2->fetch_assoc();
        $uom2_name = $row_uom2['qtyname'];

        $sql = "INSERT INTO schedule_data (ans_no, supplier_id, delDate, delTime, category, type, drPhoto, totalDel, uom1, totalQty, uom2, vehicleModel, plateNo, driverName, helperName, status, remarks) 
                VALUES ('$ans_no', '$supplier_id', '$delDate', '$delTime', '$category_name', '$type_name', '$filename', '$totalDel', '$uom1_name', '$totalQty', '$uom2_name', '$vehicleModel', '$plateNo', '$driverName', '$helperName', '1', '$cancel')";

        // Execute the statement
        if ($conn->query($sql) === TRUE) {
            // Data inserted successfully
            $_SESSION['success'] = 'Data saved successfully.';
        } else {
            // Error occurred
            $_SESSION['error'] = 'Error: ' . $conn->error;
        }
        
        // Close database connection
        $conn->close();

        // Redirect back to schedule.php
        header('Location: schedule.php');
        exit(); // Terminate script execution after redirection
    }
}
?>
