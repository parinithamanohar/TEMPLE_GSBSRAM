<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require_once 'vendor/autoload.php';


class DailyPooja extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DailyPooja_model');
        $this->load->model('setting_model');
        $this->load->model('income_model');
        $this->load->model('committee_model');
        $this->load->model('setting_model','settings');

        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the committee list
     */
    function DailyPoojaListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {   
            $data['poojaInfo'] =$this->DailyPooja_model->getDailyPoojaInfo($this->company_id); 
            $data['eventInfo'] =$this->DailyPooja_model->getEventInfo($this->company_id); 
            $data['tithiInfo'] =$this->DailyPooja_model->getTithiInfo($this->company_id); 
            $data['nakshathraInfo'] =$this->DailyPooja_model->getNakshathraInfo($this->company_id);
            $data['masaInfo'] =$this->DailyPooja_model->getMasaInfo($this->company_id);  
            $data['rashiInfo'] =$this->DailyPooja_model->getRashiInfo($this->company_id); 
            $data['gothraInfo'] =$this->DailyPooja_model->getGothraInfo($this->company_id); 
            $data['occationInfo'] = $this->setting_model->getAllOccationInfo($this->company_id);
            $data['pakshaInfo'] = $this->setting_model->getAllPakshaInfo($this->company_id);
            $data['subscriptionInfo'] = $this->setting_model->getAllSubscriptionInfo($this->company_id);
            $data['datePoojaCount'] = $this->DailyPooja_model->poojaListCount($this->company_id);

            // $data['committeeTypeInfo'] =$this->Event_model->getCommitteeTypeInfo($this->company_id);  
            $this->global['pageTitle'] = $this->company_name.' :DailyPooja Details ';
            $this->loadViews("DailyPooja/dailyPooja", $this->global, $data, NULL);
        }
    }


    function getDailyPoojaDetails()
    {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->DailyPooja_model->poojaList($this->company_id);
        
       
        foreach($data_array as $r) {
            $viewButton ='<a class="btn  btn-sm btn-primary" href="'.site_url('viewDailyPooja/'.$r->row_id).'"title="View"><i class="fa fa-eye"></i></a>';
             if($this->role == ROLE_ADMIN ) {
             $editButton = '<a class="btn  btn-sm btn-info" href="'.site_url('editDailyPooja/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
             $deleteButton = '<a class="btn btn-sm btn-danger deleteDailyPooja" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
             $recieptButton = '<a href="'.site_url('puFeePaymentReceiptPrint/'.$r->row_id).'" target="_blank">Receipt</a>';
            }else{
                $editButton='';
                $deleteButton='' ;
            }

            $data_array_new[] = array(
                // $r->row_id,
                 $r->devotee_name,
                 $r->event_type,
                 $r->month,
                 $viewButton.' '.$editButton.' '.$deleteButton.' '.$recieptButton
            );
       }
   
       $count = count($data_array);
        $result = array(
             "draw" => $draw,
              "recordsTotal" => $count,
              "recordsFiltered" => $count,
              "data" => $data_array_new
         );
   echo json_encode($result);
   exit();
    }


    /**
     * This function is used to add new committee to the system
     */
    function addDailyPooja()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {

                $devotee_id = $this->security->xss_clean($this->input->post('devotee_id'));
                $event_type = $this->security->xss_clean($this->input->post('event_type'));
                $datedp = $this->security->xss_clean($this->input->post('date'));
                if(!empty( $datedp)){
                $dateinfo = date('d-m',strtotime($datedp));
                }else{
                    $dateinfo = '';  
                    $datedp = date('d-m-Y');
                }
                if(date('m',strtotime($datedp)) == 1){
                    $month = 'JANUARY';
                }else if(date('m',strtotime($datedp)) == 2){
                    $month = 'FEBRUARY'; 
                }else if(date('m',strtotime($datedp)) == 3){
                    $month = 'MARCH'; 
                }else if(date('m',strtotime($datedp)) == 4){
                    $month = 'APRIL'; 
                }else if(date('m',strtotime($datedp)) == 5){
                    $month = 'MAY'; 
                }else if(date('m',strtotime($datedp)) == 6){
                    $month = 'JUNE'; 
                }else if(date('m',strtotime($datedp)) == 7){
                    $month = 'JULY'; 
                }else if(date('m',strtotime($datedp)) == 8){
                    $month = 'AUGUST'; 
                }else if(date('m',strtotime($datedp)) == 9){
                    $month = 'SEPTEMBER'; 
                }else if(date('m',strtotime($datedp)) == 10){
                    $month = 'OCTOBER'; 
                }else if(date('m',strtotime($datedp)) == 11){
                    $month = 'NOVEMBER'; 
                }else if(date('m',strtotime($datedp)) == 12){
                    $month = 'DECEMBER'; 
                }
                $eventdp = $this->security->xss_clean($this->input->post('event_id'));
                $tithidp = $this->security->xss_clean($this->input->post('tithi_id'));
                $nakshathradp = $this->security->xss_clean($this->input->post('nakshathra_id'));
                $masadp = $this->security->xss_clean($this->input->post('masa_id'));
                $rashidp = $this->security->xss_clean($this->input->post('rashi_id'));
                $gothradp = $this->security->xss_clean($this->input->post('gothra_id'));
                $occation_id = $this->security->xss_clean($this->input->post('occation_id'));
                $paksha_id = $this->security->xss_clean($this->input->post('paksha_id'));
                $amount = $this->security->xss_clean($this->input->post('amount'));
                $remarks = $this->security->xss_clean($this->input->post('remarks'));
                // if($event_type=='Date'){
                //     $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Event'){
                //     $dateinfo='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Tithi'){
                //     $dateinfo='0'; $eventdp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Nakshathra'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Masa'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Rashi'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $gothradp='0'; }
                // if($event_type=='Gothra'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; }
                                                   

                $eventInfo = array('devotee_id'=>$devotee_id,
                'event_type'=>$event_type,
                'date'=>$dateinfo,
                'event_id'=>$eventdp,
                'paksha_id' =>$paksha_id,
                'occation_id' =>$occation_id,
                'tithi_id'=>$tithidp,
                'nakshathra_id'=>$nakshathradp,
                'masa_id'=>$masadp,
                'rashi_id'=>$rashidp,
                'gothra_id'=>$gothradp,
                'amount'  =>$amount,
                'remarks' =>$remarks,
                'month' =>$month,
                'created_by'=>$this->company_id,
                'created_date_time' =>date('Y-m-d H:i:s'),
                'company_id'=>$this->company_id);

                $result = $this->DailyPooja_model->addPooja($eventInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Pooja added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Pooja creation failed');
                }
                if($event_type == 'Panchanga'){
                redirect('PanchangaPoojaListing');
                }else{
                redirect('DailyPoojaListing');  
                }
            }
    }

    function editDailyPooja($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            if($row_id == null){
                redirect('eventListing');
            }
            $data['dpInfo'] = $this->DailyPooja_model->getDPDetails($row_id);
            $data['poojaInfo'] =$this->DailyPooja_model->getDailyPoojaInfo($this->company_id); 
            $data['eventInfo'] =$this->DailyPooja_model->getEventInfo($this->company_id); 
            $data['tithiInfo'] =$this->DailyPooja_model->getTithiInfo($this->company_id); 
            $data['nakshathraInfo'] =$this->DailyPooja_model->getNakshathraInfo($this->company_id);
            $data['masaInfo'] =$this->DailyPooja_model->getMasaInfo($this->company_id);  
            $data['rashiInfo'] =$this->DailyPooja_model->getRashiInfo($this->company_id); 
            $data['gothraInfo'] =$this->DailyPooja_model->getGothraInfo($this->company_id); 
            $data['occationInfo'] = $this->setting_model->getAllOccationInfo($this->company_id);
            $data['pakshaInfo'] = $this->setting_model->getAllPakshaInfo($this->company_id);
            $data['subscriptionInfo'] = $this->setting_model->getAllSubscriptionInfo($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit DailyPooja ';
            $this->loadViews("DailyPooja/editDailyPooja", $this->global, $data, NULL);
        }
    }

    function updateDailyPooja()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
           

            // $event_id = $this->security->xss_clean($this->input->post('events'));
            // $event_date = $this->security->xss_clean($this->input->post('event_date'));
                $devotee_id = $this->security->xss_clean($this->input->post('devotee_id'));
                $event_type = $this->security->xss_clean($this->input->post('event_type'));
                $datedp = $this->security->xss_clean($this->input->post('date'));
                // $dateinfo = date('Y-m-d',strtotime($datedp));
                $eventdp = $this->security->xss_clean($this->input->post('event_id'));
                $tithidp = $this->security->xss_clean($this->input->post('tithi_id'));
                $nakshathradp = $this->security->xss_clean($this->input->post('nakshathra_id'));
                $masadp = $this->security->xss_clean($this->input->post('masa_id'));
                $rashidp = $this->security->xss_clean($this->input->post('rashi_id'));
                $gothradp = $this->security->xss_clean($this->input->post('gothra_id'));
                $paksha_id = $this->security->xss_clean($this->input->post('paksha_id'));
                $occation_id = $this->security->xss_clean($this->input->post('occation_id'));
                $amount = $this->security->xss_clean($this->input->post('amount'));
                $remarks = $this->security->xss_clean($this->input->post('remarks'));
                if(!empty( $datedp)){
                    $dateinfo = date('d-m',strtotime($datedp));
                    }else{
                        $dateinfo = '';  
                        $datedp = date('d-m-Y');
                    }
                    if(date('m',strtotime($datedp)) == 1){
                        $month = 'JANUARY';
                    }else if(date('m',strtotime($datedp)) == 2){
                        $month = 'FEBRUARY'; 
                    }else if(date('m',strtotime($datedp)) == 3){
                        $month = 'MARCH'; 
                    }else if(date('m',strtotime($datedp)) == 4){
                        $month = 'APRIL'; 
                    }else if(date('m',strtotime($datedp)) == 5){
                        $month = 'MAY'; 
                    }else if(date('m',strtotime($datedp)) == 6){
                        $month = 'JUNE'; 
                    }else if(date('m',strtotime($datedp)) == 7){
                        $month = 'JULY'; 
                    }else if(date('m',strtotime($datedp)) == 8){
                        $month = 'AUGUST'; 
                    }else if(date('m',strtotime($datedp)) == 9){
                        $month = 'SEPTEMBER'; 
                    }else if(date('m',strtotime($datedp)) == 10){
                        $month = 'OCTOBER'; 
                    }else if(date('m',strtotime($datedp)) == 11){
                        $month = 'NOVEMBER'; 
                    }else if(date('m',strtotime($datedp)) == 12){
                        $month = 'DECEMBER'; 
                    }
                // if($event_type=='Date'){
                //     $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Event'){
                //     $dateinfo='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Tithi'){
                //     $dateinfo='0'; $eventdp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Nakshathra'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Masa'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Rashi'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $gothradp='0'; }
                // if($event_type=='Gothra'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; }
                   
                $eventInfo = array('devotee_id'=>$devotee_id,
                'event_type'=>$event_type,
                'date'=>$dateinfo,
                'month' =>$month,
                'event_id'=>$eventdp,
                'tithi_id'=>$tithidp,
                'nakshathra_id'=>$nakshathradp,
                'amount'  =>$amount,
                'masa_id'=>$masadp,
                'rashi_id'=>$rashidp,
                'gothra_id'=>$gothradp,
                'occation_id' =>$occation_id,
                'paksha_id' =>$paksha_id,
                 'remarks'  =>$remarks,
                'updated_date_time' =>date('Y-m-d H:i:s'),
                'updated_by' =>$this->company_id,
                'company_id'=>$this->company_id);
               
                $result = $this->DailyPooja_model->updateDailyPooja($eventInfo,$row_id);

                if($result > 0){
                    $this->session->set_flashdata('success', 'Daily Pooja updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Daily Pooja update failed');
                }
                redirect('DailyPoojaListing');
            }
      
    }

    public function deleteDailyPooja()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $eventsInfo = array('is_deleted' => 1);
            $result = $this->DailyPooja_model->deleteDailyPooja($row_id,$eventsInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
   
    public function viewDailyPooja($row_id = null)
    {
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('DailyPoojaListing');
            }
            $data['dpInfo'] = $this->DailyPooja_model->getDPDetails($row_id);
            // $data['committeeBillInfo'] = $this->bill->getBillInfoByCommitteeId($row_id);
            // $data['billPaidInfo'] = $this->bill->getBillPaidInfoByCommitteeId($row_id);
            $this->global['pageTitle'] = $this->company_name.': View Daily Pooja';
            $this->loadViews("dailyDetails/viewDailyDetails", $this->global, $data, null);
        }
    } 

    public function viewPanchangaPooja($row_id = null)
    {
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('DailyPoojaListing');
            }
            $data['dpInfo'] = $this->DailyPooja_model->getDPDetails($row_id);
            // $data['committeeBillInfo'] = $this->bill->getBillInfoByCommitteeId($row_id);
            // $data['billPaidInfo'] = $this->bill->getBillPaidInfoByCommitteeId($row_id);
            $this->global['pageTitle'] = $this->company_name.': View Daily Pooja';
            $this->loadViews("dailyDetails/viewPanchangaPoojaDetails", $this->global, $data, null);
        }
    } 



    
    public function feePaymentReceiptPrint($row_id = NULL){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            error_reporting(0); 
            $data['dpInfo'] = $this->DailyPooja_model->getDPDetails($row_id);
           $data['companyLogo'] = $this->company_logo;
                      
            $this->global['pageTitle'] = ''.TAB_TITLE.' : Pooja Receipt';
            // $this->loadViews("fees/feeReceiptPrint", $this->global, $data, null); 
            $mpdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf','default_font' => 'timesnewroman','format' => 'A4-L']);
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;
                        $mpdf->AddPage('P','','','','',7,7,7,7,8,8);
            $mpdf->SetTitle('Pooja Receipt');

            $data['receipt_title_mgmt'] = EXCEL_TITLE;
            $html = $this->load->view('DailyPooja/dailyPoojaReciept',$data,true);
            $mpdf->WriteHTML($html);            
           
            $mpdf->Output('Pooja_Receipt.pdf', 'I'); 
        } 
    }

    public function panchangaReceiptPrint($row_id = NULL){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            error_reporting(0); 
            $data['dpInfo'] = $this->DailyPooja_model->getDPDetails($row_id);
           $data['companyLogo'] = $this->company_logo;
                      
            $this->global['pageTitle'] = ''.TAB_TITLE.' : Pooja Receipt';
            // $this->loadViews("fees/feeReceiptPrint", $this->global, $data, null); 
            $mpdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf','default_font' => 'timesnewroman','format' => 'A4-L']);
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;
                        $mpdf->AddPage('P','','','','',7,7,7,7,8,8);
            $mpdf->SetTitle('Pooja Receipt');

            $data['receipt_title_mgmt'] = EXCEL_TITLE;
            $html = $this->load->view('DailyPooja/panchangaPoojaReciept',$data,true);
            $mpdf->WriteHTML($html);            
           
            $mpdf->Output('Pooja_Receipt.pdf', 'I'); 
        } 
    }




    function PanchangaPoojaListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {   
            $data['poojaInfo'] =$this->DailyPooja_model->getDailyPoojaInfo($this->company_id); 
            $data['eventInfo'] =$this->DailyPooja_model->getEventInfo($this->company_id); 
            $data['tithiInfo'] =$this->DailyPooja_model->getTithiInfo($this->company_id); 
            $data['nakshathraInfo'] =$this->DailyPooja_model->getNakshathraInfo($this->company_id);
            $data['masaInfo'] =$this->DailyPooja_model->getMasaInfo($this->company_id);  
            $data['rashiInfo'] =$this->DailyPooja_model->getRashiInfo($this->company_id); 
            $data['gothraInfo'] =$this->DailyPooja_model->getGothraInfo($this->company_id); 
            $data['occationInfo'] = $this->setting_model->getAllOccationInfo($this->company_id);
            $data['pakshaInfo'] = $this->setting_model->getAllPakshaInfo($this->company_id);
            $data['subscriptionInfo'] = $this->setting_model->getAllSubscriptionInfo($this->company_id);
            $data['panchangaPoojaCount'] = $this->DailyPooja_model->PanchangaPoojaCount($this->company_id);

            // $data['committeeTypeInfo'] =$this->Event_model->getCommitteeTypeInfo($this->company_id);  
            $this->global['pageTitle'] = $this->company_name.' :DailyPooja Details ';
            $this->loadViews("DailyPooja/panchangaPooja", $this->global, $data, NULL);
        }
    }



    function getPanchangaPoojaDetails()
    {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->DailyPooja_model->PanchangaPoojaList($this->company_id);
        
       
        foreach($data_array as $r) {
            $viewButton ='<a class="btn  btn-sm btn-primary" href="'.site_url('viewPanchangaPooja/'.$r->row_id).'"title="View"><i class="fa fa-eye"></i></a>';
             if($this->role == ROLE_ADMIN ) {
             $editButton = '<a class="btn  btn-sm btn-info" href="'.site_url('editPanchangaPooja/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
             $deleteButton = '<a class="btn btn-sm btn-danger deleteDailyPooja" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
             $recieptButton = '<a href="'.site_url('panchangaReceiptPrint/'.$r->row_id).'" target="_blank">Receipt</a>';
            }else{
                $editButton='';
                $deleteButton='' ;
            }

            $data_array_new[] = array(
                // $r->row_id,
                 $r->devotee_name,
                 $r->event_type,
                 $r->masa,
                 $viewButton.' '.$editButton.' '.$deleteButton.' '.$recieptButton
            );
       }
   
       $count = count($data_array);
        $result = array(
             "draw" => $draw,
              "recordsTotal" => $count,
              "recordsFiltered" => $count,
              "data" => $data_array_new
         );
   echo json_encode($result);
   exit();
    }


    function editPanchangaPooja($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            if($row_id == null){
                redirect('eventListing');
            }
            $data['dpInfo'] = $this->DailyPooja_model->getDPDetails($row_id);
            $data['poojaInfo'] =$this->DailyPooja_model->getDailyPoojaInfo($this->company_id); 
            $data['eventInfo'] =$this->DailyPooja_model->getEventInfo($this->company_id); 
            $data['tithiInfo'] =$this->DailyPooja_model->getTithiInfo($this->company_id); 
            $data['nakshathraInfo'] =$this->DailyPooja_model->getNakshathraInfo($this->company_id);
            $data['masaInfo'] =$this->DailyPooja_model->getMasaInfo($this->company_id);  
            $data['rashiInfo'] =$this->DailyPooja_model->getRashiInfo($this->company_id); 
            $data['gothraInfo'] =$this->DailyPooja_model->getGothraInfo($this->company_id); 
            $data['occationInfo'] = $this->setting_model->getAllOccationInfo($this->company_id);
            $data['pakshaInfo'] = $this->setting_model->getAllPakshaInfo($this->company_id);
            $data['subscriptionInfo'] = $this->setting_model->getAllSubscriptionInfo($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit Panchanga Pooja ';
            $this->loadViews("DailyPooja/editPanchangaPooja", $this->global, $data, NULL);
        }
    }




     
    function donationListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      

            // $devotee_id = $this->security->xss_clean($this->input->post('devotee_id'));  
            $devotee_name = $this->security->xss_clean($this->input->post('devotee_name'));
            $amount = $this->security->xss_clean($this->input->post('amount'));
            $payment_type_filter = $this->security->xss_clean($this->input->post('payment_type_filter'));

            // $data['devotee_id'] = $devotee_id;
            $data['devotee_name'] = $devotee_name;
            $data['amount'] = $amount;
            $data['payment_type_filter'] = $payment_type_filter;

            $filter['devotee_name'] = $devotee_name;
            $filter['amount'] = $amount;
            $filter['payment_type_filter'] = $payment_type_filter;
            
            // $data['purposeInfo'] = $this->setting_model->getAllPurposeInfo($this->company_id);
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->DailyPooja_model->donationListingCount($filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ( "donationListing/", $count, 100 );
            $data['donationRecords'] = $this->DailyPooja_model->donationListing($filter,$this->company_id, $returns["page"], $returns["segment"]);
            $data['committeeInfo'] = $this->committee_model->committeeListing($this->company_id);
            $data['purposeInfo'] = $this->settings->getAllPurposeInfo($this->company_id);

            $this->global['pageTitle'] = $this->company_name.' :Donation Details ';
            $this->loadViews("DailyPooja/donation", $this->global, $data, NULL);
        }
    }



    public function addDonationDetails(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
             
                $in_date = $this->security->xss_clean($this->input->post('in_date'));
           
                $devotee_name = $this->security->xss_clean($this->input->post('devotee_name'));
                $amount = $this->security->xss_clean($this->input->post('amount'));
                $devotee_address = $this->security->xss_clean($this->input->post('devotee_address'));
                $purpose = $this->security->xss_clean($this->input->post('purpose'));    
                $payment_type = $this->security->xss_clean($this->input->post('payment_type'));    
                $donation_from = $this->security->xss_clean($this->input->post('donation_from'));    
                $committee_name = $this->security->xss_clean($this->input->post('committee_name')); 
                if(!empty($committee_name)){
                $committee_info = $this->committee_model->getCommitteeNameById($committee_name);
                }
     
                if($donation_from=='Devotee'){
                    $name = $devotee_name;
                }else{
                    $name = $committee_info->committee_name;  
                }
              
                $donationInfo = array(
                    'date'=>date('Y-m-d',strtotime($in_date)),
                    'name'=>$name,
                    'committee_id'=>$committee_name,
                    'amount' =>$amount,
                    'address' =>$devotee_address,
                    'purpose' =>$purpose,
                    'payment_type' =>$payment_type,
                    'created_by'=> $this->company_id, 
                    'company_id'=> $this->company_id, 
                    'created_date_time'=>date('Y-m-d H:i:s'));

                  $return_id = $this->DailyPooja_model->addDonationInfoToDB($donationInfo);

                  $incomeInfo = array(
                    'income_date'=>date('Y-m-d',strtotime($in_date)),
                    'income_name'=>'DONATION',
                    'donation_id'    =>$return_id,
                    'amount' =>$amount,
                    'income_by' =>$devotee_name,
                    'payment_type' =>$payment_type,
                    'created_by'=> $this->company_id, 
                    'company_id'=> $this->company_id, 
                    'created_date_time'=>date('Y-m-d H:i:s'));

                  $this->income_model->addIncome($incomeInfo);

                    
                if($return_id > 0){

                    $this->session->set_flashdata('success', 'Donation added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Donation adding failed');
                }   
                redirect('donationListing');
            
        }
    }


    public function deleteDonationDetail(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $sevaInfo = array('is_deleted' => 1);
            $result = $this->DailyPooja_model->updateDonationDetail($sevaInfo, $row_id);
             $this->DailyPooja_model->updateIncomeDetail($sevaInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }


    public function deletePurpose(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $sevaInfo = array('is_deleted' => 1);
            $result = $this->DailyPooja_model->updatePurposeDetail($sevaInfo, $row_id);
             $this->DailyPooja_model->updateIncomeDetail($sevaInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }
    public function donationReceiptPrint($row_id = NULL){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            error_reporting(0); 
            $data['donationInfo'] = $this->DailyPooja_model->getdonationInfoById($row_id);
            $data['companyLogo'] = $this->company_logo;
                      
            $this->global['pageTitle'] = ''.TAB_TITLE.' : Donation Receipt';
            // $this->loadViews("fees/feeReceiptPrint", $this->global, $data, null); 
            $mpdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf','default_font' => 'timesnewroman','format' => 'A4-L']);
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;
                        $mpdf->AddPage('P','','','','',7,7,7,7,8,8);
            $mpdf->SetTitle('Donation Receipt');

            $data['receipt_title_mgmt'] = EXCEL_TITLE;
            $html = $this->load->view('DailyPooja/donationReceipt',$data,true);
            $mpdf->WriteHTML($html);            
           
            $mpdf->Output('Donation_Receipt.pdf', 'I'); 
        } 
    }

}

?>