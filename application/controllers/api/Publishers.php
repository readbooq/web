<?php

class Api_Publishers_Controller extends Base_Controller
{
	/*
	protected $publishers;
	
	public function __contruct(Publishers $publishers)
	{
		$this->publishers = $publishers;
	}
	 
	*/
	
	public function get_index()
	{
		// $publishers = $this->publishers->get_view_index();
		$publishers = Publishers::get_view_index();
		return msgpack_pack(json_encode($publishers));
	}
}
