<?php
session_start();

    // Include the main TCPDF library (search for installation path).
    require_once('../../tcpdf/tcpdf.php');
    include "classes/application-view.classes.php";

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $appView = new ApplicationView() ;
    $landlordID = $_SESSION["userId"];

    $landlord = $appView->showLandlord($landlordID) ;
    $landlordsName = $landlord['user_name'];
    $propName = $_GET['propName'] ;

    $logo = K_PATH_IMAGES."images/images/University_of_Johannesburg_Logo.png" ;
    //$pdf->setPrintHeader(false);
    $pdf->Image($logo,10,10,0,0,'PNG');

    // set document information
    //$pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Sipho');
    //$pdf->SetTitle('PDF file using TCPDF');

    // set default header data
    $pdf->SetHeaderData($logo, PDF_HEADER_LOGO_WIDTH, ' POSA','UJ APK 011 855 6789');

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(20, 20, 20);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // add a page
    $pdf->AddPage();

    $html = <<<EOD
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .letter {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      <!--border: 1px solid #ccc;
      border-radius: 10px;-->
    }
  </style>
</head>
<body>

<div class="letter">
  <h1>Accreditation Letter</h1>
  
  <p>Dear $landlordsName </p>
  
  <p>We are pleased to inform you that your accommodation, $propName , has been accredited by our organization. This accreditation reflects our recognition of the quality and standards met by your accommodation.</p>
  
  <p>Accreditation provides assurance to potential tenants that your accommodation meets specified criteria related to safety, amenities, and overall quality of living. This recognition demonstrates your commitment to maintaining a high standard of housing.</p>
  
  <p>If you have any questions or need further information, please feel free to contact us.</p>
  
  <p>Thank you for your dedication to providing quality housing for individuals in our community.</p>
  
  <p>Sincerely,</p>
  <p>Privately Owned Student Accomodations UJ</p>
</div>

</body>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        
    // $pdf->writeHTML($html, true, false, true, false, '');
    
        // add a page
    //$pdf->AddPage();

    ////$html = '<h4>Second page</h4>';
    
    //$pdf->writeHTML($html, true, false, true, false, '');

    // reset pointer to the last page
    $pdf->lastPage();
    //Close and output PDF document
    $pdf->Output('../example.pdf', 'I');
0
?>