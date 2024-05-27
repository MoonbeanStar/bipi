<?php  

if(!isset($conn)){
    include 'includes/conn.php';
}
    
    if(isset($_POST['categoryId'])){
        $categoryId = $_POST['categoryId'];
        $sql = "SELECT * FROM type WHERE catid = '$categoryId'";
        $result = mysqli_query($conn, $sql);
        $options = '<option value="" selected disabled>Please Select Type Here.</option>';
        while($row = mysqli_fetch_assoc($result)){
            $options .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
        echo $options;
    }
?>