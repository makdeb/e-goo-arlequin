<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prices_model extends BF_Model {

	protected $table		= "prices";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;
        
        public function get_vip_price ($key_type,$currency=null) {
            $currency=strtoupper($currency);
            switch ($currency) {
                case 'UAH':
                    $this->db->select('prices_uah as price');
                    break;
                case 'USD':
                    $this->db->select('prices_usd as price');
                    break;
                case 'RUR':
                    $this->db->select('prices_rur as price');
                    break;
                default:    
                    $this->db->select('prices_usd as price');
            }
            $price=$this->find_all_by('prices_key_type',$key_type);
            if (!empty($price)){
                return $price[0]->price;
            }
            else {
                return -1;
            }
            
        }
}
