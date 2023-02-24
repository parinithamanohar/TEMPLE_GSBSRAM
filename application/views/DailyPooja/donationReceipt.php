<style>
table {
    width: 100% !important;
}

/*.border{
    border: 2px solid black;
}*/
.border_full {
    border: 1px solid black;
    /* height: 90% !important; */
}

.border_bottom {
    border-bottom: 1px solid black;
}

.hr_line {
    margin: 5px 0px;
    color: black;
}

.table_bordered {
    border-collapse: collapse;
}

.table_bordered th,
.table_bordered td {
    border-top: 1px solid black;
    border-right: 1px solid black;
    padding: 3px;
}

.table_bordered th .border_right_none,
.table_bordered td .border_right_none {
    border-right: 1px solid transparent !important;
}

.break {
    page-break-before: always;
}

.break_after {
    page-break-before: none;
}
</style>

<!--  -->

<br /><br /><br />
<div class="container-fluid border_full">

    <div class="row">
        <div class="">

            <table class="table text_highlight" style="background-color:#FFD300">
                <tr>
                    <!-- <td style="text-align:center;" width="80">
                        <!-- <img class="mt-2" width="100" height="90" src="<?php echo $companyLogo; ?>" alt="logo"> 
                    </td> -->
                    <td width="700" style="text-align:center;">
                        <b style="font-size: 25px;margin-bottom: 2px;">ಶ್ರೀ ರಾಮ ಮಂದಿರ</b><br />
                        <b style="font-size: 25px;margin-bottom: 2px;">SHRI RAMA MANDIRA</b><br />
                        <b style="font-size: 13px;margin-bottom: 2px;">Near Kalmady Bridge, Malpe Main Road Udupi District,Karnataka, India 576108</b><br/>
                        <span style="font-size: 18px;margin-bottom: 2px;">Purpose: <b><?php echo $donationInfo->purpose_name; ?></b>
                        </span><br />
                        <br />

                    </td>
                </tr>
            </table>
            <!-- <hr class="border_bottom hr_line"> -->

            <h4 style="margin-left:300px"> Donation/ Seva Reciept </h4>
           
                        <table class="table" style="font-size: 15px;">

                            <tr>
                             
                                <td><b>Receipt No.:</b> <span
                                        style="color: red;"><?php echo $donationInfo->row_id; ?></span></td>
                            </tr>
                            <tr>
                                <td><b>Receipt Date :</b> <?php echo date('d-m-Y'); ?></td>
                            </tr>

                            <tr>
                                <td width="400"><b>Name :</b> <?php echo $donationInfo->devotee_name; ?></td>

                            </tr>

                            <tr>
                                <td><b>Number :</b>
                                    <?php echo $donationInfo->mobile_number; ?></td>
                            </tr>
                            <tr>
                                <td width="220"><b>Email :</b> <?php echo $donationInfo->email; ?></td>

                            </tr>
                            <tr>
                                <td width="700"><b>Address : </b><?php echo $donationInfo->address; ?></td>

                            </tr>
                        
                          
                            </table>
                            <?php if($donationInfo->donation_type == 'SEVA'){ ?>
                            <table class="table table_bordered" style="font-size: 15px;">
                            <tr><td style="border: none"></td></tr>
                <tr>
                    <th>Seva Info</th>
                    <th width="120">Amount</th>
                </tr> 
                <tr>
                    <td style="text-align: left;">
                    <?php foreach($seva_name as $seva){ ?>
                                    <b><?php echo $seva ?></b><br/>
                                
                            <?php } ?>
                                  </td>
                    <td style="text-align: right;"><?php foreach($seva_amount as $amount){ ?>
                                    <b><?php echo $amount ?></b><br/>
                                
                            <?php } ?></td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <th style="text-align: right;"><?php echo sprintf('%0.2f', $donationInfo->amount); ?></th>
                </tr>
                <tr>
                    <td colspan="2" style="font-size: 13px;"><b><span style="text-transform: none;"></span></b></td>
                </tr>
            </table>
            <?php }else if($donationInfo->donation_type == 'DONATION'){ ?>
                            <table class="table table_bordered" style="font-size: 15px;">
                            <tr><td style="border: none"></td></tr>
                <tr>
                    <th>Donation Info</th>
                    <th width="120">Amount</th>
                </tr> 
                <tr>
                    <td style="text-align: left;">
                                    <b><?php echo $donationInfo->purpose_name ?></b><br/>
                                                                  
                                </td>
                    <td style="text-align: right;">
                                    <b><?php echo $donationInfo->amount ?></b><br/>
                                
                            </td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <th style="text-align: right;"><?php echo sprintf('%0.2f', $donationInfo->amount); ?></th>
                </tr>
                <tr>
                    <td colspan="2" style="font-size: 13px;"><b><span style="text-transform: none;"></span></b></td>
                </tr>
            </table>
            <?php } ?>
            <table class="table" style="font-size: 15px;">

                            <tr>
                                <td width="400"><b>Amount :</b> Rs.<?php echo $donationInfo->amount; ?>/- (<?php echo getIndianCurrency(floatval($donationInfo->amount)).' only'; ?>)</td>

                            </tr>
                            <tr>
                                <td><b>Payment Mode :</b> <?php echo $donationInfo->payment_type; ?></td>

                            </tr>
                            <tr>
                                <td width="700"><b>Notes :</b> <?php echo $donationInfo->note; ?></td>

                            </tr>

                        </table>

                        <h4 style="margin-left:450px"> Collected By : <?php echo $donationInfo->type; ?> </h4>
                        <br/>
                          
                
            <!-- <table class="table table_bordered" style="font-size: 15px;">
                <tr>
                    <th>ವಿವರಗಳು</th>
                    <th width="120">ಮೊತ್ತ</th>
                </tr>
                <tr>
                    <td style="text-align: left;"><b>Pooja Date</b> - <?php echo $date.' - '.$dpInfo->month ?><br />
                        <b>Nakshatra</b> - <?php echo $dpInfo->nakshathra ?><br />
                        <b>Rashi</b> - <?php echo $dpInfo->rashi ?><br />
                        <b>Gothra</b> - <?php echo $dpInfo->gothra ?><br />
                        <b>Occassion</b> - <?php echo $dpInfo->occation ?>
                    </td>
                    <td style="text-align: right;"><?php echo sprintf('%0.2f', $dpInfo->amount); ?></td>
                </tr>
                <tr>
                    <th>ಒಟ್ಟು ಮೊತ್ತ</th>
                    <th style="text-align: right;"><?php echo sprintf('%0.2f', $dpInfo->amount); ?></th>
                </tr>
                <tr>
                    <td colspan="2" style="font-size: 13px;"><br><b>: <span
                                style="text-transform: none;"><?php echo getIndianCurrency(floatval($dpInfo->amount)).' only'; ?></span></b>
                    </td>
                </tr>
            </table> -->

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