
<style>
table{
    width: 100% !important;
}

/*.border{
    border: 2px solid black;
}*/
.border_full{
    border: 1px solid black;
    /* height: 90% !important; */
}
.border_bottom{
    border-bottom: 1px solid black;
}
.hr_line{
    margin: 5px 0px;
    color: black;
}

.table_bordered{
    border-collapse: collapse;
}
.table_bordered th,.table_bordered td{
    border-top: 1px solid black;
    border-right: 1px solid black;
    padding: 3px;
}

.table_bordered th .border_right_none,.table_bordered td .border_right_none{
    border-right: 1px solid transparent !important;
}

.break { page-break-before: always; } 
.break_after { page-break-before: none; } 

</style>

<style type="text/css">
u {    
    border-bottom: 1px dotted #000;
    text-decoration: none;
}
</style>
  
<!--  -->

   <br/><br/><br/>
<div class="container-fluid border_full">
    
    <div class="row">
        <div class="">
             
            <table class="table text_highlight">
                <tr>
                    <td style="text-align:center;" width="80">
                        <img  class="mt-2" width="100" height="90" src="<?php echo $companyLogo; ?>" alt="logo">
                    </td>
                    <td width="700" style="text-align:center;">
                        <b style="font-size: 25px;margin-bottom: 2px;">ಶ್ರೀ ರಾಮ ಮಂದಿರ</b><br/>
                        <b style="font-size: 24px;margin-bottom: 2px;color:red">SHRI RAMA MANDIRA</b><br/>
                        <!-- <b style="font-size: 13px;margin-bottom: 2px;">Manchi Post - 574323 Buntwal Taluk, Dakshina Kannada District</b><br/>
                        <b style="font-size: 13px;margin-bottom: 2px;">Ph : 08255 - 236453</b><br/><br/>
                        <b style="font-size: 13px;margin-bottom: 2px;">ಪೂಜಾ ಸಮಯ ಬೆಳಗ್ಗೆ - 7:00, ಮಧ್ಯಾಹ್ನ -12:30, ರಾತ್ರಿ -8:30</b><br/>  -->

                        <!-- <b style="font-size: 13px;margin-bottom: 2px;">Unit of KJES </b><br/> -->
                        <span style="font-size: 13px;margin-bottom: 2px;">
                        </span><br/>
                        <br/>
                       
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td width="400" style="padding-left:120px">NO.: <b style="color:red"><?php echo  $donationInfo->row_id; ?></p> </td>
                    <td width="100" style="padding-left:140px">Date: <?php echo date('d-m-Y'); ?></td>
                </tr>
            </table>

            <table>
                  
                  
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    </tr>
                    
                    <tr>
                    <td style="padding-left:30px">
                    <p style="font-size: 12pt;font-family: times new roman;" class="">
                     <i>Recieved with Gratitude Rs </i> &nbsp;<u><?php echo sprintf('%0.2f', $donationInfo->amount); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                    </p>
                    </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                    <td style="padding-left:30px">
                    <p style="font-size: 12pt;font-family: times new roman;" class="">
                     <i>Rupees </i> &nbsp;&nbsp;<u> <?php echo getIndianCurrency(floatval($donationInfo->amount)); ?>&nbsp;&nbsp;</u><i> only</i>
                    </p>
                    </td>
                    </tr>

                    <tr>
                        <td></td>
                    </tr>

                    <tr>
                    <td style="padding-left:30px">
                    <p style="font-size: 12pt;font-family: times new roman;" class="">
                     <i>from Sri / Smt</i>  &nbsp;&nbsp;<u> <?php echo strtoupper($donationInfo->name); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                    </p>
                    </td>
                    </tr>

                    <tr>
                        <td></td>
                    </tr>

                    <tr>
                    <td style="padding-left:30px">
                    <p style="font-size: 12pt;font-family: times new roman;" class="">
                     <u> <?php echo strtoupper($donationInfo->address); ?></u>
                    </p>
                    </td>
                    </tr>


                    <tr>
                        <td></td>
                    </tr>

                    <tr>
                    <td style="padding-left:30px">
                    <p style="font-size: 12pt;font-family: times new roman;" class="">
                     <i>towrads &nbsp;<u><?php echo $donationInfo->purpose_name ?>&nbsp;</u> SHRI RAMA MANDIRA by Cash</i>
                    </p>
                    </td>
                    </tr>

                    <tr>
                        <td></td>
                    </tr>

                    <tr>
                        <td></td>
                    </tr>

                    <tr>
                        <td></td>
                    </tr>
                     
                    

                    <tr>
                        <td></td>
                    </tr>               
                                                                  
            </table>

            <table>
            <!-- <tr>
            <td style="padding-left:380px"><b style="color:red">Shri Durgaparameshwari Temple Monthimaru</b></td>
            </tr> -->
            </table>



              
        </div>
    </div>
  
</div>

<!-- <b style="font-size: 11px;">This is a system generated fee receipt. No seal and signature is required. Fees ones paid is not refundable.</b> -->











<?php 
//  if($totalStudentCount != 0){
//     echo '<div class="break"></div>';
// }else{
//     echo '<div class="break_after"></div>';
// }

// } 



function getIndianCurrency(float $number) {
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? '' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}


?>