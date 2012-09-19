<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends BF_Model {

	protected $table		= "news";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;
	
	/*
		Функция count_all() 
		Подсщитывает общее количество записей в базе, для определения [total_rows] класса Pagination
	*/
	
	function count_all() 
   { 
   		
		return $this->db->count_all($this->table); 
			
		
   } 
   
	/*
		Функция get_img() 
		Возвращает название изображения (включая расширение) из таблицы bf_image 
	*/
	
	function get_img()
	{
		$query = $this->db->get_where('bf_image', array('id' => 1));
		foreach ($query->result() as $row)
			{
    			return $row->img_path;
			}
	}
	
	/*
		Функция edit_img() 
		Возвращает название изображения из таблицы bf_news (в случае, если таблица  bf_image пуста)
	*/
	
	function edit_img($id)
	{
	
		$query = $this->db->get_where('bf_news', array('id' => $id));
		foreach ($query->result() as $row)
			{
    			return $row->news_img_path;
			}
	}
	
	
	/*
		function, that shows only notes with chosen category
	*/
	public function get_news($slug)
{	
		$query = $this->db->get_where('bf_news',array('news_category'=>$slug));
		return $query->result_array();
	
}
	/*
		function, that shows only chosen note	
	*/ 	
	public function get_note($slug) 
{	
	
	$query = $this->db->get_where('bf_news',array('id'=>$slug));	
	return $query->result_array();	
		
}
	
 	/* 
		function, that shows only notes with defined offset and limit
	*/
	public function list_news($limit,$offset,$cat) {
		
		$this->db->limit($limit,$offset); 
		if (!$cat) {
			$query = $this->db->order_by('news_date', 'desc')->get($this->table); 
		} else {
			$query = $this->db->order_by('news_date', 'desc')->get_where('bf_news',array('news_category'=>$cat));	
		}
						
		return $query->result(); 
		
	}
	
	
}
