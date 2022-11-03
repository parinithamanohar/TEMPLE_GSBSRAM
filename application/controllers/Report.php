<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require_once 'vendor/autoload.php';

class Report extends BaseController
{
     /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('own_vehicle_model');
        // $this->load->model('cash_account_model');
        // $this->load->model('lease_vehicle_model');
        // $this->load->model('transporter_model');
        // $this->load->model('party_model');
        $this->load->model('Bank_model');
        $this->load->model('asset_model');
        $this->load->model('committee_model');
        $this->load->model('Devotee_model');
        $this->load->model('DailyPooja_model');

        $this->load->library('excel');
        $this->isLoggedIn();      
    }
   
    /**
     * View Overall report
    */
    public function report()
    {
     if ($this->isAdmin() == true ) {
         $this->loadThis();
     } else {
        //  $data['vehicles'] = $this->lease_vehicle_model->getAllLeaseVehicles($this->company_id);
        //  $data['ownVehicles'] = $this->own_vehicle_model->getAllOwnVehicles($this->company_id);
        //  $data['transporters'] = $this->transporter_model->getAllTransporters($this->company_id);
        //  $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);
        //  $data['getAllPumpInfo'] = $this->fuel_model->getAllPumpInfo($this->company_id);
        //  $data['party'] = $this->party_model->getAllParty($this->company_id);
        //  $data['bank'] = $this->Bank_model->getAllBank($this->company_id);
         $data="";
         $this->global['pageTitle'] = $this->company_name.' : Report ';
         $this->loadViews("report/report", $this->global,$data,null);
        }
    }


    public function downloadAsset(){
        if ($this->isAdmin() == true ) {
            setcookie('isDownLoaded',1);  
            $this->loadThis();
        } else {
            $filter = array();
            $purchase_fromDate = $this->security->xss_clean($this->input->post('purchase_fromDate'));
            $purchase_toDate = $this->security->xss_clean($this->input->post('purchase_toDate'));
            log_message('debug','bfrom'.$purchase_fromDate);
            $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            $sheet = 0;
                $this->excel->setActiveSheetIndex($sheet);
                $this->excel->getActiveSheet()->setTitle($sheet);
                $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
                $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
                $this->excel->getActiveSheet()->setCellValue('A2',"Asset Report");
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
                $this->excel->getActiveSheet()->mergeCells('A1:F1');
                $this->excel->getActiveSheet()->mergeCells('A2:F2');
                $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('A1:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $excel_row = 3;
                $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(28);
                
                $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
                $this->excel->getActiveSheet()->getStyle('A3:N3')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A3:N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
                $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Name');
                $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Invoice No');
                $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Purchase Date');
                $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Purchase Amount');
                $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Depreciated Amount');
                $filter['report_type']= "Asset";
                // $filter['stream_name']= $stream[$sheet];
                if(!empty($purchase_fromDate)) {
                $filter['purchase_fromDate']= date('Y-m-d',strtotime($purchase_fromDate));
                }
                else{
                    $filter['purchase_fromDate'] = ''; 
                }
                if(!empty($purchase_toDate)) {
                $filter['purchase_toDate']=  date('Y-m-d',strtotime($purchase_toDate));
                }
                else{
                    $filter['purchase_toDate']= '';
                }
                log_message('debug','bfrom'.$filter['purchase_fromDate']);


                $sl = 1;
                $excel_row = 4;
                $assetInfo = $this->asset_model->assetInfoForReport($filter,$this->company_id);
                    foreach($assetInfo as $asset){
                        if($asset->purchase_date=="1970-01-01")
                        {
                            $purchased_date = '';
                        }
                        else
                        {
                            $purchased_date = date('d-m-Y',strtotime($asset->purchase_date)) ; 
                        }
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $asset->asset_name);
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row,$asset->invoice_no);
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, $purchased_date);
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $asset->purchase_amount);
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $this->asset_model->getDepreciationAmountByAsset($asset->row_id));
                        $this->excel->getActiveSheet()->getStyle('A'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle('C'.$excel_row.':F'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $excel_row++;
                    }
                    $this->excel->createSheet(); 
                // }
                
            }
            
            $filename ='Asset_Report_-'.date('d-m-Y').'.xls'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            ob_start();
            setcookie('isDownLoaded',1);  
            $objWriter->save("php://output");
            
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function downloadDevotee(){
    if ($this->isAdmin() == true ) {
        setcookie('isDownLoaded',1);  
        $this->loadThis();
    } else {
        $filter = array();
        error_reporting(0);
        $purchase_fromDate = $this->security->xss_clean($this->input->post('purchase_fromDate'));
        $purchase_toDate = $this->security->xss_clean($this->input->post('purchase_toDate'));
        $post_status = $this->security->xss_clean($this->input->post('post_status'));
        $reportFormat = $this->security->xss_clean($this->input->post('reportFormat'));

        $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

        $filter['post_status']= $post_status;
        // $filter['stream_name']= $stream[$sheet];
        if(!empty($purchase_fromDate)) {
        $filter['purchase_fromDate']= date('Y-m-d',strtotime($purchase_fromDate));
        }
        else{
            $filter['purchase_fromDate'] = ''; 
        }
        if(!empty($purchase_toDate)) {
        $filter['purchase_toDate']=  date('Y-m-d',strtotime($purchase_toDate));
        }
        else{
            $filter['purchase_toDate']= '';
        }

        if($reportFormat == 'VIEW'){
            $data['dt_filter'] = $filter;
            $data['company_id'] = $this->company_id;
            $data['devotee_model'] = $this->Devotee_model;
            $this->global['pageTitle'] = ''.EXCEL_TITLE.' : DEVOTEE REPORT';
            $mpdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf','default_font' => 'timesnewroman']);
            $mpdf->AddPage('P','','','','',10,10,10,10,8,8);
            $mpdf->SetTitle('DEVOTEE REPORT');
            $html = $this->load->view('report/devoteeView',$data,true);
            $mpdf->WriteHTML($html);
            $mpdf->Output('Devotee_Report.pdf', 'I');
        }else{
        $sheet = 0;
            $this->excel->setActiveSheetIndex($sheet);
            $this->excel->getActiveSheet()->setTitle($sheet);
            $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
            $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
            $this->excel->getActiveSheet()->setCellValue('A2',"Devotee Report");
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
            $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
            $this->excel->getActiveSheet()->mergeCells('A1:F1');
            $this->excel->getActiveSheet()->mergeCells('A2:F2');
            $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A1:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            
            $excel_row = 3;
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(28);
            
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
            $this->excel->getActiveSheet()->getStyle('A3:N3')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A3:N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Devotee name');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Devotee_id');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Email');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Gender');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Contact number');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, 'Devotee address');
            
        

            $sl = 1;
            $excel_row = 4;
            $assetInfo = $this->Devotee_model->devoteeInfoForReport($filter,$this->company_id);
                foreach($assetInfo as $asset){
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $asset->devotee_name);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row,$asset->devotee_id);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, $asset->email);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $asset->gender);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $asset->contact_number);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, $asset->devotee_name.', '.$asset->devotee_address.' , PH: '.$asset->contact_number);

                    //$this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $this->asset_model->getDepreciationAmountByAsset($asset->row_id));
                    $this->excel->getActiveSheet()->getStyle('A'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('C'.$excel_row.':F'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $excel_row++;
                }
                $this->excel->createSheet(); 
            // }
            
        
        
        $filename ='Devotee_Report_-'.date('d-m-Y').'.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_start();
        setcookie('isDownLoaded',1);  
        $objWriter->save("php://output");
            }
    } 
    }

    public function downloadBank(){
        if ($this->isAdmin() == true ) {
            setcookie('isDownLoaded',1);  
            $this->loadThis();
        } else {
            $filter = array();
            $purchase_fromDate = $this->security->xss_clean($this->input->post('purchase_fromDate'));
            $purchase_toDate = $this->security->xss_clean($this->input->post('purchase_toDate'));
            log_message('debug','bfrom'.$purchase_fromDate);
            $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            $sheet = 0;
            $this->excel->setActiveSheetIndex($sheet);
            $this->excel->getActiveSheet()->setTitle($sheet);
            $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
            $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
            $this->excel->getActiveSheet()->setCellValue('A2',"Bank transaction Report");
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
            $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
            $this->excel->getActiveSheet()->mergeCells('A1:F1');
            $this->excel->getActiveSheet()->mergeCells('A2:F2');
            $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A1:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            
            $excel_row = 3;
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(28);
            
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
            $this->excel->getActiveSheet()->getStyle('A3:N3')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A3:N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Bank name');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Particular');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Amount');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Company id');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Transaction type');
            // $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, 'Devotee address');
            
            $filter['report_type']= "Asset";
            // $filter['stream_name']= $stream[$sheet];
            if(!empty($purchase_fromDate)) {
            $filter['purchase_fromDate']= date('Y-m-d',strtotime($purchase_fromDate));
            }
            else{
                $filter['purchase_fromDate'] = ''; 
            }
            if(!empty($purchase_toDate)) {
            $filter['purchase_toDate']=  date('Y-m-d',strtotime($purchase_toDate));
            }
            else{
                $filter['purchase_toDate']= '';
            }
            log_message('debug','bfrom'.$filter['purchase_fromDate']);


            $sl = 1;
            $excel_row = 4;
            
            $bankTInfo = $this->Bank_model->bankInfoForReport();
                foreach($bankTInfo as $bank){
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $bank->bank_name);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row,$bank->particular);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, $bank->amount);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $bank->company_id);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $bank->trans_type);
                    // $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, $asset->devotee_address);

                    //$this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $this->asset_model->getDepreciationAmountByAsset($asset->row_id));
                    $this->excel->getActiveSheet()->getStyle('A'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('C'.$excel_row.':F'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $excel_row++;
                }
                $this->excel->createSheet(); 
                // }
                
            }
            
            $filename ='Bank_transaction_Report_-'.date('d-m-Y').'.xls'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            ob_start();
            setcookie('isDownLoaded',1);  
            $objWriter->save("php://output");
            
        }
    

    //////////////////////////////////////////////////////////////////////////////////////////////////////

        public function downloadCommitteeReport(){
            if ($this->isAdmin() == true ) {
                setcookie('isDownLoaded',1);  
                $this->loadThis();
            } else {
                $filter = array();
                $purchase_fromDate = $this->security->xss_clean($this->input->post('purchase_fromDate'));
                $purchase_toDate = $this->security->xss_clean($this->input->post('purchase_toDate'));
                $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
                $sheet = 0;
                    $this->excel->setActiveSheetIndex($sheet);
                    $this->excel->getActiveSheet()->setTitle($sheet);
                    $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
                    $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
                    $this->excel->getActiveSheet()->setCellValue('A2',"Committee Report");
                    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                    $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
                    $this->excel->getActiveSheet()->mergeCells('A1:H1');
                    $this->excel->getActiveSheet()->mergeCells('A2:H2');
                    $this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('A2:H2')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('A1:H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    $excel_row = 3;
                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
                    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
                    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
                    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                    
                    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
                    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
                    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
                    $this->excel->getActiveSheet()->getStyle('A3:H3')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('A3:H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Name');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Contact Number One');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Contact Number Two');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Role');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Address');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, 'Email');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, 'Year');

                    $filter['report_type']= "Asset";
                    // $filter['stream_name']= $stream[$sheet];
                   
    
                    $sl = 1;
                    $excel_row = 4;
                    $committeeInfo = $this->committee_model->committeeInfoForReport($this->company_id);
                        foreach($committeeInfo as $committee){
                        
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $committee->committee_name);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row,$committee->contact_number_one);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, $committee->contact_number_two);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $committee->role);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $committee->committee_address);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, $committee->email);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, $committee->year);
                            $this->excel->getActiveSheet()->getStyle('A'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $this->excel->getActiveSheet()->getStyle('C'.$excel_row.':E'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $this->excel->getActiveSheet()->getStyle('H'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $excel_row++;
                        }
                        $this->excel->createSheet(); 
                    // }
                    
                }
                
                $filename ='Committee_Report_-'.date('d-m-Y').'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                ob_start();
                setcookie('isDownLoaded',1);  
                $objWriter->save("php://output");
                
            }
    


            public function downloadDailyPoojaReport(){
                if ($this->isAdmin() == true ) {
                    setcookie('isDownLoaded',1);  
                    $this->loadThis();
                } else {
                    $filter = array();
                    $purchase_fromDate = $this->security->xss_clean($this->input->post('purchase_fromDate'));
                    $purchase_toDate = $this->security->xss_clean($this->input->post('purchase_toDate'));
                    $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
                    $sheet = 0;
                        $this->excel->setActiveSheetIndex($sheet);
                        $this->excel->getActiveSheet()->setTitle($sheet);
                        $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
                        $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
                        $this->excel->getActiveSheet()->setCellValue('A2',"Daily Pooja Report");
                        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
                        $this->excel->getActiveSheet()->mergeCells('A1:M1');
                        $this->excel->getActiveSheet()->mergeCells('A2:M2');
                        $this->excel->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->getStyle('A2:M2')->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->getStyle('A1:M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle('A1:M2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        
                        $excel_row = 3;
                        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
                        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
                        
                        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(25);

                        $this->excel->getActiveSheet()->getStyle('A3:M3')->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->getStyle('A3:M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Seva By');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Event Type');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Date');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Tithi');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Nakshatra');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, 'Masa');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, 'Rashi');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('I'.$excel_row, 'Gothra');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('J'.$excel_row, 'Ocassion');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('K'.$excel_row, 'Paksha');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('L'.$excel_row, 'Amount');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('M'.$excel_row, 'Remarks');
    
                        // $filter['report_type']= "Asset";
                        // $filter['stream_name']= $stream[$sheet];
                       
        
                        $sl = 1;
                        $excel_row = 4;
                        $dpInfo = $this->DailyPooja_model->getDPDetailsForReport();
                        foreach($dpInfo as $dp){
                            if(date('d-m-Y',strtotime($dp->date)) == '01-01-1970'){
                              $event_date = '';
                            }else{
                                $event_date = date('d-m-Y',strtotime($dp->date));       
                            }
                            
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $dp->devotee_name);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, $dp->event_type);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, $event_date);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $dp->tithi);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $dp->nakshathra);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, $dp->masa);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, $dp->rashi);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('I'.$excel_row, $dp->gothra);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('J'.$excel_row, $dp->occation);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('K'.$excel_row, $dp->paksha);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('L'.$excel_row, $dp->amount);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('M'.$excel_row, $dp->remarks);
                                $this->excel->getActiveSheet()->getStyle('A'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                $this->excel->getActiveSheet()->getStyle('C'.$excel_row.':L'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                // $this->excel->getActiveSheet()->getStyle('H'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                $excel_row++;
                            }
                            $this->excel->createSheet(); 
                        // }
                        
                    }
                    
                    $filename ='Daily_Pooja_Report_-'.date('d-m-Y').'.xls'; //save our workbook as this file name
                    header('Content-Type: application/vnd.ms-excel'); //mime type
                    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                    header('Cache-Control: max-age=0'); //no cache
                    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                    ob_start();
                    setcookie('isDownLoaded',1);  
                    $objWriter->save("php://output");
                    
                }

   
}

?>