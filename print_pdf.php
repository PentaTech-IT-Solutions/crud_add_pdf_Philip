<?php
// Ensure proper database connection here

require_once('tcpdf/tcpdf.php');  

$title = "Team Members List";

function generateRow($conn){
    $contents = '';
    
    $contents .= '
        <tr>
            <td width="5%" style="background-color: #E2F907"><b>S/N</b></td>
            <td width="20%" style="background-color: #ED8BDA"><b>First Name</b></td>
            <td width="20%" style="background-color: #ED8BDA"><b>Last Name</b></td>
            <td width="10%" style="background-color: #ED8BDA"><b>Position</b></td>
            <td width="10%" style="background-color: #ED8BDA"><b>Department</b></td> 
            <td width="20%" style="background-color: #ED8BDA"><b>About</b></td>
            <td width="15%" style="background-color: #DDD569"><b>Photo</b></td>
            
        </tr>
    ';

    $sql_candidates = "SELECT firstname, lastname, position, department, about, image_url FROM team_members ORDER BY lastname ASC";
    $cquery = $conn->query($sql_candidates);
    $sn = 1; // Counter for serial number
   

    while($crow = $cquery->fetch_assoc()){
        $contents .= '
            <tr>
                <td>'.$sn.'</td>
                <td style="background-color: #FCDCF5; font-size: 10px">'.$crow['firstname'].'</td>
                <td style="background-color: #FCDCF5; font-size: 10px">'.$crow['lastname'].'</td>
                <td style="background-color: #FCDCF5; font-size: 10px">'.$crow['position'].'</td>
                <td style="background-color: #FCDCF5; font-size: 10px">'.$crow['department'].'</td>
                <td style="background-color: #FCDCF5; font-size: 10px">'.$crow['about'].'</td>
                <td>'; 
                
        if(!empty($crow['image_url'])) {
            // Path to the images folder relative to the current directory
            $imagePath =   $crow['image_url'];
           
            // Check if the image file exists
            if(file_exists($imagePath)) {
                // Display the image
                $contents .= '<img src="'.$imagePath.'" width="65" >';
            } else {
                // Display a placeholder or message if the image file does not exist
                $contents .= 'Image not found';
            }
        } else {
            // Display a placeholder or message if the photo field is empty
            $contents .= '<img src="images/default.jpg" width="65" >';
        }
        $contents .= '</td>
            <td></td>
            </tr>
        ';
        
        $sn++; // Increment serial number
        
    }

    return $contents;
    
}







// Your database connection code here
include 'conn.php';
//$servername = "localhost"; // Replace 'localhost' with your MySQL server host if it's different
//$username = "root"; // Replace 'your_username' with your MySQL username
//$password = "SJGagtaG5t!i2_8n"; // Replace 'your_password' with your MySQL password
//$database = "votesystem"; // Replace 'your_database' with your MySQL database name

// Create connection
//$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
$pdf->SetCreator(PDF_CREATOR);  
$pdf->SetTitle('Result: '.$title);  
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
$pdf->SetDefaultMonospacedFont('helvetica');  
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
$pdf->setPrintHeader(false);  
$pdf->setPrintFooter(true);  
$pdf->SetAutoPageBreak(TRUE, 10);  
$pdf->SetFont('helvetica', '', 11);  
$pdf->AddPage();  
$content = '';  
$content .= '
    <h2 align="center">'.$title.'</h2>
    <table border="1" cellspacing="0" cellpadding="3">  
    
';  
$content .= generateRow($conn);  
$content .= '</table>';  
$pdf->writeHTML($content);  

// Output the PDF to the browser
$pdf->Output('team_members_list.pdf', 'I');
?>


