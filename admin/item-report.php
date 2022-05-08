<?php include('partials/menu.php'); ?>

<?php

    function fetch_data()
    {
        $output = "";
        $conn = mysqli_connect("localhost", "root", "", "electronic-item");
        $sql = "SELECT * FROM tbl_item ORDER BY id ASC";
        $res = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_array($res))
        {
            $output.= '<tr>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['category_id'].'</td>
                            <td>'.$row['title'].'</td>
                            <td>'.$row['price'].'</td>
                        </tr>';

        }

        return $output;
    }

    if(isset($_POST['generate_pdf']))
    {
        require_once('../tcpdf_min/tcpdf.php');  
        $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
        $obj_pdf->SetCreator(PDF_CREATOR);  
        $obj_pdf->SetTitle("Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP");  
        $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
        $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
        $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
        $obj_pdf->SetDefaultMonospacedFont('helvetica');  
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
        $obj_pdf->setPrintHeader(false);  
        $obj_pdf->setPrintFooter(false);  
        $obj_pdf->SetAutoPageBreak(TRUE, 10);  
        $obj_pdf->SetFont('helvetica', '', 11);  
        $obj_pdf->AddPage();  
        $content = '';  
        $content .= '  
            <h4 align="center">Item Details Report</h4><br /> 
            <table border="1" cellspacing="0" cellpadding="3">  
            <tr>  
                <th width="25%">Item Id</th>  
                <th width="25%">Category Id</th>  
                <th width="25%">Title</th> 
                <th width="25%">Price</th>
            </tr>  
      ';
      
        $content .= fetch_data();  
        $content .= '</table>';  
        $obj_pdf->writeHTML($content);  
        $obj_pdf->Output('file.pdf', 'I');  
        //ob_end_clean();
    }
        
    
?>

<html>  
        <head>  
           <title>REPORT</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />            
        </head>  
        <body>  
           <br />
           <div class="container">  
                <h2 align="center"><strong>Item Details Report<strong></h2><br />  
                <div class="table-responsive">  
                    <div class="col-md-12" align="right">
                        <form method="post">  
                            <input type="submit" name="generate_pdf" class="btn btn-success" value="Download Report" />  
                        </form>  
                        </div>
                        <br><br>
                        <br>
                        <table class="table table-bordered">  
                            <tr>  
                                <th width="25%">Item Id</th>  
                                <th width="25%">Category Id</th>  
                                <th width="25%">Title</th> 
                                <th width="25%">Price</th>
                                  
                            </tr>  
                        <?php  
                            echo fetch_data();  
                        ?>  
                        </table>  
                </div>  
            </div>  
        </body>  
</html>
<?php include('partials/footer.php'); ?>