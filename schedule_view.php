<?php
include 'includes/session.php';

if (isset($_POST['view'])) {
    $id = $_POST['id']; // Get the id from the form

    $sql = "SELECT * FROM schedule_data WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();

        // Assign data to variables
        $asn_no = $row['asn_no'];
        $name = $row['firstname'].' '.$row['lastname'];
        $delDate = $row['delDate'];
        $delTime = $row['delTime'];
        $category = $row['category'];
        $type = $row['type'];
        $drPhoto = $row['drPhoto'];
        $totalDR = $row['totalDR'];
        $totalDel = $row['totalDel'];
        $uom1 = $row['uom1'];
        $totalQty = $row['totalQty'];
        $uom2 = $row['uom2'];
        $vehicleModel = $row['vehicleModel'];
        $plateNo = $row['plateNo'];
        $driverName = $row['driverName'];
        $helperName = $row['helperName'];

        // Display the modified view of the details
        // Modify the HTML code according to your requirements
        echo "<h1>Details for ID: $id</h1>";
        echo "<p>ASN No: $asn_no</p>";
        echo "<p>Name: " . $row['firstname'] . ' ' . $row['lastname'] . "</p>";
        echo "<p>Delivery Date: $delDate</p>";
        echo "<p>Delivery Time: $delTime</p>";
        echo "<p>Category: $category</p>";
        echo "<p>Type: $type</p>";
        echo "<p>DR Photo: $drPhoto</p>";
        echo "<p>Total DR: $totalDR</p>";
        echo "<p>Total Deliveries: $totalDel</p>";
        echo "<p>UOM1: $uom1</p>";
        echo "<p>Total Quantity: $totalQty</p>";
        echo "<p>UOM2: $uom2</p>";
        echo "<p>Vehicle Model: $vehicleModel</p>";
        echo "<p>Plate No: $plateNo</p>";
        echo "<p>Driver Name: $driverName</p>";
        echo "<p>Helper Name: $helperName</p>";

    } else {
        echo "No data found for ID: $id";
    }
}
?>