<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class DailyPooja_model extends CI_Model
{
  
    /**
     * This function is used to get the Event listing 
     */
    

    function poojaList($company_id)
    {
        $this->db->select('dailypooja.row_id,dailypooja.devotee_id,dailypooja.event_type,devotee.devotee_name');
        $this->db->from('tbl_dailypooja_management_info as dailypooja');
        $this->db->join('tbl_devotee as devotee','devotee.row_id=dailypooja.devotee_id','left');
        $this->db->where('dailypooja.company_id',$company_id);
        $this->db->where('dailypooja.is_deleted', 0);
        $this->db->order_by('dailypooja.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new Event to system
     */
    function addPooja($eventInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_dailypooja_management_info', $eventInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }


    
    // /**
    //  * This function is used to update the Event information
    //  */
    function updateDailyPooja($eventInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_dailypooja_management_info', $eventInfo);
        return TRUE;
    }
    
    

    //  /**
    //  * This function is used to get  committee information by row_id
    //  */

    function getDPDetails($row_id)
    {
        $this->db->select('dailypooja.row_id,dailypooja.remarks,dailypooja.created_date_time,dailypooja.amount,occation.occation,paksha.paksha,dailypooja.paksha_id,dailypooja.occation_id,dailypooja.devotee_id,dailypooja.event_type,dailypooja.event_id,dailypooja.tithi_id,dailypooja.nakshathra_id,dailypooja.masa_id,dailypooja.rashi_id,dailypooja.gothra_id,dailypooja.date,devotee.devotee_name,events.events,tithi.tithi,nakshathra.nakshathra,masa.masa,rashi.rashi,gothra.gothra');
        $this->db->from('tbl_dailypooja_management_info as dailypooja');
        $this->db->join('tbl_devotee as devotee','devotee.row_id=dailypooja.devotee_id','left');
        $this->db->join('tbl_events as events','events.row_id=dailypooja.event_id','left');
        $this->db->join('tbl_tithi as tithi','tithi.row_id=dailypooja.tithi_id','left');
        $this->db->join('tbl_nakshathra as nakshathra','nakshathra.row_id=dailypooja.nakshathra_id','left');
        $this->db->join('tbl_masa as masa','masa.row_id=dailypooja.masa_id','left');
        $this->db->join('tbl_rashi as rashi','rashi.row_id=dailypooja.rashi_id','left');
        $this->db->join('tbl_gothra as gothra','gothra.row_id=dailypooja.gothra_id','left');
        $this->db->join('tbl_paksha as paksha','paksha.row_id=dailypooja.paksha_id','left');
        $this->db->join('tbl_occation as occation','occation.row_id=dailypooja.occation_id','left');
        $this->db->where('dailypooja.row_id', $row_id);
        $this->db->where('dailypooja.is_deleted', 0);
        $query = $this->db->get();      
        return $query->row();
    }    


    function getDPDetailsForReport()
    {
        $this->db->select('dailypooja.row_id,dailypooja.remarks,dailypooja.created_date_time,dailypooja.amount,occation.occation,paksha.paksha,dailypooja.paksha_id,dailypooja.occation_id,dailypooja.devotee_id,dailypooja.event_type,dailypooja.event_id,dailypooja.tithi_id,dailypooja.nakshathra_id,dailypooja.masa_id,dailypooja.rashi_id,dailypooja.gothra_id,dailypooja.date,devotee.devotee_name,events.events,tithi.tithi,nakshathra.nakshathra,masa.masa,rashi.rashi,gothra.gothra');
        $this->db->from('tbl_dailypooja_management_info as dailypooja');
        $this->db->join('tbl_devotee as devotee','devotee.row_id=dailypooja.devotee_id','left');
        $this->db->join('tbl_events as events','events.row_id=dailypooja.event_id','left');
        $this->db->join('tbl_tithi as tithi','tithi.row_id=dailypooja.tithi_id','left');
        $this->db->join('tbl_nakshathra as nakshathra','nakshathra.row_id=dailypooja.nakshathra_id','left');
        $this->db->join('tbl_masa as masa','masa.row_id=dailypooja.masa_id','left');
        $this->db->join('tbl_rashi as rashi','rashi.row_id=dailypooja.rashi_id','left');
        $this->db->join('tbl_gothra as gothra','gothra.row_id=dailypooja.gothra_id','left');
        $this->db->join('tbl_paksha as paksha','paksha.row_id=dailypooja.paksha_id','left');
        $this->db->join('tbl_occation as occation','occation.row_id=dailypooja.occation_id','left');
        $this->db->where('dailypooja.is_deleted', 0);
        $query = $this->db->get();      
        return $query->result();
    }  

    function getDailyPoojaInfo($company_id)
    { 
        $this->db->from('tbl_devotee as devotee');
        $this->db->where('devotee.is_deleted', 0);
        $this->db->where('devotee.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function getEventInfo($company_id)
    { 
        $this->db->from('tbl_events as event');
        $this->db->where('event.is_deleted', 0);
        $this->db->where('event.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function getTithiInfo($company_id)
    { 
        $this->db->from('tbl_tithi as tithi');
        $this->db->where('tithi.is_deleted', 0);
        $this->db->where('tithi.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function getNakshathraInfo($company_id)
    { 
        $this->db->from('tbl_nakshathra as nakshathra');
        $this->db->where('nakshathra.is_deleted', 0);
        $this->db->where('nakshathra.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function getMasaInfo($company_id)
    { 
        $this->db->from('tbl_masa as masa');
        $this->db->where('masa.is_deleted', 0);
        $this->db->where('masa.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function getRashiInfo($company_id)
    { 
        $this->db->from('tbl_rashi as rashi');
        $this->db->where('rashi.is_deleted', 0);
        $this->db->where('rashi.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function getGothraInfo($company_id)
    { 
        $this->db->from('tbl_gothra as gothra');
        $this->db->where('gothra.is_deleted', 0);
        $this->db->where('gothra.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }


  function deleteDailyPooja($row_id,$eventsInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_dailypooja_management_info', $eventsInfo);
        return $this->db->affected_rows();
    }

//   function getRoleNameById($row_id){
//     $this->db->select('committee.row_id,committee.role');
//     $this->db->from('tbl_committee_role as committee');
//     $this->db->where('committee.row_id', $row_id);
//     $this->db->where('committee.is_deleted', 0);
//     $query = $this->db->get();
//     return $query->row();

    
// }



}

  