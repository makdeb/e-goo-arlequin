<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_news extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`id` int(11) NOT NULL AUTO_INCREMENT');
			$this->dbforge->add_field("`news_category` TEXT NOT NULL");
			$this->dbforge->add_field("`news_title` TEXT NOT NULL");
			$this->dbforge->add_field("`news_img_path` TEXT NOT NULL");
			$this->dbforge->add_field("`news_text` LONGTEXT NOT NULL");
			$this->dbforge->add_field("`news_author` VARCHAR(45) NOT NULL");
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