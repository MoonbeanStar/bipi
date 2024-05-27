<?php
if(!isset($conn)){
    include 'includes/conn.php';
  }

require_once 'dompdf/autoload.inc.php'; 
use Dompdf\Dompdf;
extract($_POST);

if(isset($submit)){
    $sql = "Select * from schedule_data order by id desc";
    $query = mysqli_query($conn, $sql);
    $html = "";
    $html .= '
        <h2 align = "center">BURLINGTON INDUSTRIES PHILS., INC.</h2>
        <h2 align = "center">Advance Shipping Notice (ASN) </h2>

        <table style = "width:100%; border-collapse;>
        <tr>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">ASN No.</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Name.</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Delivery Date.</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Delivery Time</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Location Area</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Item Category</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Item Type.</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">DR Photo.</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Total No. of DR</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Total No. of Delivery</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">UOM</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Total Quantity</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">UOM</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Vehicle Model</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Plate No.</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Driver Name</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;">Helper Name</th>  
        </tr>
    ';

    while($row = mysqli_fetch_assoc($query)) {
        $html .= '
            <tr>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['id'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['supplier'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['delivery_date'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['delivery_time'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['location_name'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['item_category_name'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['item_type_name'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['dr_photo'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['total_dr'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['total_delivery'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['uom_dropdown_name'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['total_qty'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['uomDropdown_name'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['vehicle_model'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['plate_no'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['driver_name'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['helper_name'].'</td>
            </tr>
        ';
    }
    $html .= '</table>';

    // Create PDF
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    // Output the generated PDF to Browser
    $dompdf->stream("ASN_Report.pdf");
}

?>