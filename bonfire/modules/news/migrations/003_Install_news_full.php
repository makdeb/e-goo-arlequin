<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_news_full extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;
		$this->dbforge->drop_table('news');
		
		$this->dbforge->add_field('`id` int(20) NOT NULL AUTO_INCREMENT');
		$this->dbforge->add_field('`news_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP');
			$this->dbforge->add_field("`news_category` VARCHAR(45) NOT NULL");
			$this->dbforge->add_field("`news_title` VARCHAR(100) NOT NULL");
			$this->dbforge->add_field("`news_img_path` VARCHAR(20) DEFAULT NULL");
			$this->dbforge->add_field("`news_short` TEXT NOT NULL");
			$this->dbforge->add_field("`news_text` LONGTEXT NOT NULL");
			$this->dbforge->add_field("`news_author` VARCHAR(45) DEFAULT NULL");
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('news');

	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('news');

	}
	
	//--------------------------------------------------------------------
	
}