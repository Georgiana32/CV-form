<?php
require_once "cv.php";

require_once "fpdf/fpdf.php";

class PDF extends FPDF{
    function Header(){
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(0, 20, 'Curriculum Vitae', 0, 0, 'C');
        $this->Ln(30);
    }

    function Footer()
    {
        $this->SetY(-15);

        $this->SetFont('Arial', 'I', 8);

        $this->Cell(0, 10, 'Page ' . 
            $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function ChapterTitle($num){
        $this->SetFont('Arial','',12);
        $this->SetFillColor(200,220,255);
        $this->Cell(0,6,"$num",0,1,'L',true);
        $this->Ln(4);
    }

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetMargins(5.0, 10.2, 5.0);
$pdf->AddPage();
$pdf->SetFont('Times', '', 14);
$pdf->SetTitle('Your CV');
$pdf->ChapterTitle("Personal info");
$pdf->Ln(2);

$sql1 = "SELECT * FROM pinfo WHERE pinfo.id = " . $_POST['idForm1'] . ";";
$result1 = $conn->query($sql1);
$sql2 = "SELECT * FROM profxp WHERE profxp.id_cv = " . $_POST['idForm1'] . ";";
$result2 = $conn->query($sql2);

if ($result1->num_rows > 0 && $result2->num_rows > 0) {
        while ($row1 = $result1 -> fetch_assoc()) {

            $pdf->Cell(30, 20, 'About me', 0, 0, 'L');
            $pdf->MultiCell(150, 5, $row1["aboutme"], 0);
            $pdf->Ln(0.2);

            $nameMap = ["First name"=>$row1['fname'], "Last name"=>$row1['lname'], "Birthday"=>$row1['birthday'], "Gender"=>$row1['gender'], "Citizenship"=>$row1['citizenship'], 
                        "Email"=>$row1['email'], "Phone"=>$row1['phone'], "Address1"=>$row1['address1'], "Address2"=>$row1['address2'], "City"=>$row1['city'], "Country"=>$row1['country']];
            foreach($nameMap as $key=>$value){
                //verif mai intai daca cheia este in nameMap
                $pdf->Cell(30, 10, $key, 0, 0, 'L');
                $pdf->Cell(30, 10, $value, 0, 10, 'L');
                $pdf->Ln(1);
            }

            $pdf->Ln(10);
            $pdf->ChapterTitle("Education");
        }
        while ($row2 = $result2 -> fetch_assoc()){
            $edMap = ["Organization"=>$row2['organization'], "Qualification"=>$row2['qualification'], "Since"=>$row2['edsince'], "Up to"=>$row2['edupto']];
            foreach($edMap as $key=>$value){
                //verif mai intai daca cheia este in nameMap
                $pdf->Cell(30, 10, $key, 0, 0, 'L');
                $pdf->Cell(30, 10, $value, 0, 10, 'L');
                $pdf->Ln(1);
            }

            $pdf->ChapterTitle("Professional experience");

            $expMap = ["Occupation"=>$row2['occupation'], "Employer"=>$row2['employer'], "Since"=>$row2['since'], "Upto"=>$row2['upto']];
            foreach($expMap as $key=>$value){
                //verif mai intai daca cheia este in nameMap
                $pdf->Cell(30, 10, $key, 0, 0, 'L');
                $pdf->Cell(30, 10, $value, 0, 10, 'L');
                $pdf->Ln(1);
            }
        }
} else{
    echo "no records";
  }

$pdf->Output();
$conn->close();
?>