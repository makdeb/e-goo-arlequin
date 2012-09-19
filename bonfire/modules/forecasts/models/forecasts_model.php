<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Forecasts_model extends BF_Model {

	protected $table		= "bf_forecasts";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;
        
        public function get_forecasts() {
            $sql='SELECT F.ID AS FORECAST_ID,
                         F.IS_VIP AS IS_VIP,
                         F.EVENT_NAME AS EVENT_NAME,
                         EC.EVENT_CATEGORY_NAME AS EVENT_CATEGORY_NAME,
                         EC.EVENT_CATEGORY_IMG AS EVENT_CATEGORY_IMG,
                         F.EVENT_CATEGORY AS EVENT_CATEGORY_ID,
                         F.EVENT_COEFF AS EVENT_COEFF,
                         F.EVENT_DATE AS EVENT_DATE                         
                 FROM bf_forecasts F JOIN bf_events_categories EC ON
                 (F.EVENT_CATEGORY=EC.ID)
                 WHERE F.EVENT_DATE>NOW()';
            $query=$this->db->query($sql);            
            return $query->result();
        }
        
        public function get_forecast_description ($forecast_id) {
            $forecast_desc['event_description']=$this->get_field($forecast_id,'event_description');
            $forecast_desc['event_result']=$this->get_field($forecast_id,'event_result');
            return $forecast_desc;
        }
        
        public function is_vip ($forecast_id) {
            if ((int)$this->get_field($forecast_id,'is_vip')==1) {
                return true;
            }
            else {
                return false;
            }
        }
                
        public function check_keys ($forecast_id,$keys) {
            $valid_key =false;
            if ($keys) {
                foreach ($keys as $key) {
                    switch (substr($key['key'],0,4)) {
                        case 'vips': 
                            if (str_replace('vips','',$key['key'])==(string)$forecast_id) {
                                $valid_key=true;
                            }   
                            break;
                        case 'vipp':
                            if (time()-strtotime($key['valid_untill'])<=0) {
                                $valid_key=true;
                            }                           
                            break;
                    }
                }
            }
            return $valid_key;
        }
}
