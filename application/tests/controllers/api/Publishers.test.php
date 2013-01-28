<?php

class TestControllerApiPublishers extends PHPUnit_Framework_TestCase
{
	public static function setUpBeforeClass()
	{
		TestControllerApiPublishers::clearTable();
		
		//TODO - should use injection - wait for laravel 4
		$yamlFile = path('app') . '/tests/fixt/1.yml';
		$data = Symfony\Component\Yaml\Yaml::parse($yamlFile);
		foreach ($data['publishers'] as $row) {
			Publishers::insert($row);
		}
	}
	
	public function testGetIndex()
	{
        Request::foundation()->setMethod('GET');
		$response = Controller::call('api.publishers@index');
		$this->assertEquals('200', $response->foundation->getStatusCode());
		
		$response = msgpack_unpack($response);
		$publishers = json_decode($response);
		$this->assertEquals(2, count($publishers));
	}
	
	protected static function clearTable()
	{
		DB::query('DELETE FROM book_publisher');
		DB::query('DELETE FROM books');
		DB::query('DELETE FROM publishers');
		DB::query('ALTER TABLE book_publisher AUTO_INCREMENT = 1');
		DB::query('ALTER TABLE books AUTO_INCREMENT = 1');
		DB::query('ALTER TABLE publishers AUTO_INCREMENT = 1');
	}
	
	public static function tearDownBeforeClass()
	{
		TestControllerApiPublishers::clearTable();
	}
}
