<?php
/* Start the PHP session, and issue required script includes for functions, database connection, 
fpdf Library. This is necessary to enable .htaccess requirements which should be imposed. */
session_start();
require $_SERVER['DOCUMENT_ROOT']."/scripts/fpdf/fpdf.php";
require $_SERVER['DOCUMENT_ROOT']."/scripts/functions.php";
require $_SERVER['DOCUMENT_ROOT']."/scripts/connect.php";
// check if user is logged in, and not banned.
logincheck();
bancheck();
//Get Users IP address as defined in functions.php
$ip = getIP();
//Get the current Date in format mm/dd/yyyy CST.
date_default_timezone_set("America/Chicago");
$date = date("m/d/Y");
/*dbinfo is a function defined in functions.php which returns the database connection varriables 
 for $host, $user, $pass, and $dbname. */
dbinfo();
//Connect to SQL database.
$con = mysqli_connect($host, $user, $pass, $dbname);
//check for database connection errors, and kill script if errors occur.
if ( mysqli_connect_errno()) {
die('Failed to connect to SQL:' . mysqli_connect_error());
}

/* SQL to get file count to serial number file names. This provides a unique file name and 
prevents file overwrite unless the clean script is called. 
$idnum  is the variable for the Primary Key in SQL table count. With each different document
This will need to reflect a different row in the table. */
$idnum = '1'; 
$stmt = $con->prepare('SELECT cnt FROM count  WHERE id = ?');
$stmt->bind_param('s', $idnum);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
//Returns the number of the last file written to the database. Cannot be NULL value.
$filecount = $row['cnt'];   
}
//Close the SQL Statement but leave database connection open for use later.
$stmt->close();
//increment filecount for new file. We will write this as string to SQL database later.
$filecount = $filecount+1;
/* Assign directory and name to the PDF file to be generated. This directory must 
be chmod -R 777 (read and write by everyone.) use .htaccess for directory permissions */
$filename = $_SERVER['DOCUMENT_ROOT']."/pdf/file$filecount.pdf";
//Get Signature POST Data from HTML form
$sig = $_POST['sig'];
/*create and Save PDF file server-side using fpdf library. Support for fpdf library 
located at http://fpdf.org. */
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Cell(200,10,'Lorem Ipsum Contract',0,1,'C');
$pdf->Ln();
$pdf->Cell(200,5,'This is not a binding contract',0,1,'C');
$pdf->Ln();
$pdf->MultiCell('0','5','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pharetra est sed blandit convallis. Ut suscipit interdum feugiat. Duis molestie arcu non iaculis sagittis. Maecenas consectetur at nunc eu aliquet. Fusce nec nunc cursus, egestas augue in, vulputate nulla. Sed id quam metus. Pellentesque sit amet magna ullamcorper, tempor lacus at, imperdiet eros. Nunc tristique venenatis mi, in consectetur orci iaculis eu. Aliquam imperdiet magna eros, id condimentum felis eleifend et. Sed porttitor, orci et tincidunt sodales, ex dolor accumsan ipsum, quis dapibus diam augue ac purus. Nunc id mi mauris. Vestibulum eget leo lacinia, tincidunt massa sit amet, semper ipsum. Duis mollis ullamcorper auctor.

    Morbi justo sapien, malesuada sit amet faucibus nec, tincidunt non justo. Duis ultricies ornare elit, at ullamcorper orci ullamcorper vel. Maecenas in lobortis ex. Nam non fringilla ex, finibus porttitor orci. Nunc ligula eros, dictum nec turpis suscipit, tristique luctus massa. Donec pellentesque neque quis interdum tempor. Cras ligula sapien, vulputate ac nisl vel, pharetra eleifend lacus. Quisque commodo risus id eleifend pharetra. Aliquam elementum leo vestibulum purus ornare, quis sodales erat laoreet. Suspendisse ut metus risus. Sed congue efficitur nibh. Praesent aliquam lorem pretium, viverra sem eu, hendrerit nunc. Duis at ligula ut magna iaculis malesuada quis sit amet lectus. Ut porttitor tortor non neque blandit suscipit. Maecenas a nisl sit amet diam aliquet volutpat id eu enim. Cras porta fringilla sagittis.

    Suspendisse facilisis purus et nibh ornare tristique. Mauris ut ante sed dui finibus consequat. Praesent sapien tellus, pellentesque ac est ac, fermentum euismod orci. Morbi a nisl odio. Nullam at tellus ac leo consequat lacinia. Aliquam et vulputate ligula. Cras luctus ex at quam ultricies, eu sollicitudin velit volutpat. In hac habitasse platea dictumst. Quisque eget venenatis ante. Quisque lobortis vel nisl at lobortis. Nam quis nibh ac sapien consectetur tempor et ac urna. Mauris pellentesque orci sed massa suscipit vestibulum.

Cras elit neque, posuere at semper rhoncus, feugiat id dolor. Pellentesque suscipit est nec justo cursus fermentum. Praesent blandit interdum viverra. Nulla placerat vitae odio cursus sollicitudin. Proin eu magna quis nunc mattis pharetra. Curabitur nec lectus convallis, pellentesque diam eu, semper velit. Nullam tincidunt eleifend dolor vitae lacinia. Quisque accumsan quis dui vel sollicitudin. Curabitur accumsan mi in placerat aliquet. In dictum est vel ultricies eleifend. Pellentesque dui massa, hendrerit et sagittis vel, sollicitudin sed erat. Curabitur maximus tincidunt odio, sit amet efficitur ligula volutpat id. Morbi quis porttitor magna.

    Phasellus vel dapibus arcu. Vivamus in ornare sapien. In in lectus posuere, finibus enim in, posuere leo. Integer dignissim porttitor magna, ut semper lorem eleifend a. Etiam bibendum ullamcorper consectetur. Etiam feugiat, sapien vitae aliquet consectetur, eros enim volutpat nisi, non commodo est elit nec risus. Donec eu turpis id felis venenatis venenatis. Nulla facilisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus quis est ultricies, eleifend mi eu, porttitor lectus. Suspendisse eget mi est. Etiam velit nulla, molestie pharetra nisl in, dignissim mattis elit. Nulla hendrerit vehicula efficitur. Ut aliquam nunc sit amet nibh facilisis, id accumsan lacus ultricies. Cras in aliquet nunc.','L','');
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,5,"Signature: /S//$sig / Dated: $date CST");
$pdf->Ln();
$pdf->Cell(40,5,"Signed from IP: $ip");
$pdf->Output("$filename","F");

//SQL to update filecount to reflect new file. Vars were previously set.
$stmt = $con->prepare('UPDATE count SET cnt= ? WHERE id= ?');
$stmt->bind_param('ss', $filecount, $idnum);
$stmt->execute(); 
$stmt->close();

//SQL to insert file pointer to table for later output in HTML table.
$url = "/pdf/file$filecount.pdf";
$name = $_SESSION['name'];
$stmt = $con->prepare('INSERT INTO app(name, date, url) VALUES(?, ?, ?) ');
$stmt->bind_param('sss', $name, $date,  $url);
$stmt->execute();
$stmt->close();
$con->close();
//Redirect user to be able to access file.
header('Location: /database-view.php');
exit;
?>