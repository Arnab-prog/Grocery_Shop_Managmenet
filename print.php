<?php
require('fpdf/fpdf.php');
include("connection.php");

$pdf = new FPDF('p', 'mm', 'A4');

$pdf->AddPage();

if(isset($_POST['seprint'])) {
    $key = $_POST['print'];
    $sql = "SELECT * FROM ((orders INNER JOIN customer ON orders.customer_id = customer.customer_id) INNER JOIN products ON orders.product_id = products.product_id) WHERE customer.`customer_id`='$key';";
    $result = $conn->query($sql);
    $row = $result->fetch_row();


    //dummy cell
    $pdf->Cell(130,8,"",0,1);

        $pdf->SetFont("Times", "bu", 30);
        $pdf->Cell(180,8,"-:Invoice:-",0,1,"C");
    //dummy cell
    $pdf->Cell(130,8,"",0,1);
        //set font to arial,bold,14
        $pdf->SetFont("Arial", "b", 16);

        $pdf->Cell(130,8,"Grocery Shop:-",0,1);


        $pdf->SetFont("Arial", "", 12);
        $pdf->Cell(130,5,"P.K.Road",0,0);
        $pdf->Cell(50,5,"Date:- ".$row[2],0,1);

        $pdf->Cell(130,5,"Kolkata-700061",0,0);
        $pdf->Cell(50,5,"Order Id:- ".$row[0],0,1);

        $pdf->Cell(130,5,"9251305295",0,0);
        $pdf->Cell(50,5,"Customer Id:- ".$row[1],0,1);
        //dummy cell
        $pdf->Cell(130,8,"",0,1);

        $pdf->SetFont("Arial", "b", 15);
        $pdf->Cell(130,8,"Billing To:-",0,1);

        $pdf->SetFont("Arial", "b", 12);
        $pdf->Cell(130,6,"Customer Name:- ".strtoupper($row[6]),0,1);
        $pdf->Cell(130,6,"Customer Address:- ".strtoupper($row[8]),0,1);
        $pdf->Cell(130,6,"Customer Phone No. :- ".$row[7],0,1);
    //dummy cell NEXT LINE
    $pdf->Cell(130,5,"",0,1);

//dummy cell
    $pdf->Cell(130,8,"",0,1);

    $pdf->SetFont("Arial", "b", 15);
    $pdf->Cell(100,8,"Description:",1,0);
    $pdf->Cell(30,8,"Price /Pcs:",1,0);
    $pdf->Cell(25,8,"Quantity:",1,0);
    $pdf->Cell(25,8,"Amount:",1,1);


    $pdf->SetFont("Arial","i",12);
    $amount=0;
    $total=0;
    $quan=0;
    $key = $_POST['print'];
    $sql1 = "SELECT orders.order_id,customer.customer_id,orders.quantity,products.product_name,products.product_price,customer.`customer_id`,customer.customer_name,customer.customer_phone FROM ((orders INNER JOIN customer ON orders.customer_id = customer.customer_id) INNER JOIN products ON orders.product_id = products.product_id) WHERE customer.`customer_id`='$key';";
    $result1 = $conn->query($sql1);
    while($row1 = $result1->fetch_assoc())
    {
        //add cell(width,height,text,border,end line,[align])
        $pdf->Cell(100, 7, strtoupper($row1["product_name"]),1, 0);
        $pdf->Cell(30, 7,$row1["product_price"],1, 0);
        $pdf->Cell(25, 7, $row1["quantity"], 1, 0,"C");

        $amount=($row1["quantity"]*$row1["product_price"]);
        $total=$total+$amount;
        $quan=$quan+$row1["quantity"];
        $pdf->Cell(25,7,$amount,1, 1,"C");

    }

   $pdf->SetFont("Times", "b", 14);

    //dummy cell NEXT LINE
    $pdf->Cell(130,5,"",0,1);
    //Dummy cell BLANK CELL
    $pdf->Cell(125,5,"",0,0);


   // $pdf->Cell(180,5,"Total No. of Product:".$quan,0,1,"C");


    $pdf->SetFont("Times", "bu", 16);
    //$pdf->Cell(180,5,"Total Amount Paid:".$total,0,0,"C");
    $pdf->Cell(30,5,"Total Amount:",0,0);
    $pdf->Cell(25,5,$total,0,1,"C");



    $pdf->SetFont("Arial", "b", 14);
    //dummy cell
    $pdf->Cell(130,8,"",0,1);
    //dummy cell
    $pdf->Cell(130,8,"",0,1);
    //dummy cell
    $pdf->Cell(130,8,"",0,1);
    //dummy cell
    $pdf->Cell(130,8,"",0,1);

    $pdf->Cell(130,8,"",0,1);
    //dummy cell
    $pdf->Cell(130,8,"",0,1);

    //dummy cell
    $pdf->Cell(130,50,"",0,1);
    //Dummy cell
    $pdf->Cell(150,5,"",0,0);
    $pdf->Cell(25,5,"______________",0,1,"C");
    $pdf->Cell(150,5,"",0,0);
    $pdf->Cell(25,5,"Received By",0,1,"C");


}
$pdf->Output();


?>