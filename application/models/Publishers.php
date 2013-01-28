<?php

class Publishers
{
	public static function get_options($options = array())
	{
		if (isset($options['view']) && 'index' == $options['view']) {
			return Publishers::get_view_index();
		}
		if(isset($options['id'])) {
			return Publishers::get_id($options['id']);
		}
		return Publishers::all();
	}
	
	public static function get_id($id)
	{
		return DB::table('publishers')
			->where('id', '=', $id)->first();
	}
	
	public static function get_view_index()
	{
		$publishers = DB::query(
			'SELECT publishers.eng_name, publishers.thai_name,
				(SELECT COUNT(*)
					FROM book_publisher
				    WHERE book_publisher.publisher_id = publishers.id
				) AS "book_count"
			FROM publishers
			ORDER BY publishers.thai_name'
		);
		return $publishers;
	}
	
	public static function all()
	{
		return DB::table('publishers')->get();
	}
	
	public static function insert($publishers = array())
	{
		DB::table('publishers')->insert($publishers);
	}
	
	public static function update($id, $publishers = array())
	{
		DB::table('pubilshers')->where('id', '=', $id)
			->update($publishers);
	}
	
	public static function delete($id)
	{
		DB::table('publishers')->delete($id);
	}
}
