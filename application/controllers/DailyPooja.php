<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

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
            }else{
                $editButton='';
                $deleteButton='' ;
            }

            $data_array_new[] = array(
                $r->devotee_id,
                 $r->devotee_name,
                 $r->event_type,
                 $viewButton.' '.$editButton.' '.$deleteButton
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
                $dateinfo = date('y-m-d',strtotime($datedp));
                $eventdp = $this->security->xss_clean($this->input->post('event_id'));
                $tithidp = $this->security->xss_clean($this->input->post('tithi_id'));
                $nakshathradp = $this->security->xss_clean($this->input->post('nakshathra_id'));
                $masadp = $this->security->xss_clean($this->input->post('masa_id'));
                $rashidp = $this->security->xss_clean($this->input->post('rashi_id'));
                $gothradp = $this->security->xss_clean($this->input->post('gothra_id'));
                $occation_id = $this->security->xss_clean($this->input->post('occation_id'));
                $paksha_id = $this->security->xss_clean($this->input->post('paksha_id'));
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
                'company_id'=>$this->company_id);

                $result = $this->DailyPooja_model->addPooja($eventInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Event added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Event creation failed');
                }
                redirect('DailyPoojaListing');
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
                $dateinfo = date('y-m-d',strtotime($datedp));
                $eventdp = $this->security->xss_clean($this->input->post('event_id'));
                $tithidp = $this->security->xss_clean($this->input->post('tithi_id'));
                $nakshathradp = $this->security->xss_clean($this->input->post('nakshathra_id'));
                $masadp = $this->security->xss_clean($this->input->post('masa_id'));
                $rashidp = $this->security->xss_clean($this->input->post('rashi_id'));
                $gothradp = $this->security->xss_clean($this->input->post('gothra_id'));
                $paksha_id = $this->security->xss_clean($this->input->post('paksha_id'));
                $occation_id = $this->security->xss_clean($this->input->post('occation_id'));
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
                'tithi_id'=>$tithidp,
                'nakshathra_id'=>$nakshathradp,
                'masa_id'=>$masadp,
                'rashi_id'=>$rashidp,
                'gothra_id'=>$gothradp,
                'occation_id' =>$occation_id,
                'paksha_id' =>$paksha_id,
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

}

?>