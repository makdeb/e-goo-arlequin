<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keys_model extends BF_Model {

	protected $table		= "bf_keys";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;
        
        public function find_all() {
            if (empty($this->selects))
            {
                $this->select($this->table .'.*, first_name,last_name');
            }                        
            
            $this->db->join('users', 'users.id = keys.key_owner', 'left');
            
            return parent::find_all();
        }

        public function get_keys ($user_id) {
            $keys=$this->find_all_by('key_owner',$user_id);
            if ($keys) {
                foreach ($keys as $key) {
                    if ((bool)$key->is_paid) {
                        $user_keys[]=array("key"=>$key->key,"valid_untill"=>$key->valid_untill);
                    }
                }
            }
            else {
                $user_keys=$keys;
            }
            if (isset($user_keys)){
                return $user_keys;
            }
            else {
                return false;
            }
        } 
                
}
