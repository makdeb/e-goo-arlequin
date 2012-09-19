<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_prices extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`id` int(11) NOT NULL AUTO_INCREMENT');
			$this->dbforge->add_field("`prices_name` VARCHAR(45) NOT NULL");
			$this->dbforge->add_field("`prices_uah` DECIMAL(6,2) NOT NULL");
			$this->dbforge->add_field("`prices_rur` DECIMAL(6,2) NOT NULL");
			$this->dbforge->add_field("`prices_usd` DECIMAL(6,2) NOT NULL");
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('prices');

	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('prices');

	}
	
	//--------------------------------------------------------------------
	
}