<?php

class TestModelPublishers extends PHPUnit_Framework_TestCase
{
	public static function setUpBeforeClass()
	{
		TestModelPublishers::clearTable();
	}
	
	public function testInsert()
	{
		$yamlFile = path('app') . '/tests/fixt/1.yml';
		$data = Symfony\Component\Yaml\Yaml::parse($yamlFile);
		foreach ($data['publishers'] as $row) {
			Publishers::insert($row);
		}
	}
	
	/**
	 * @depends testInsert
	 */
	public function testAll()
	{
		$all = Publishers::all();
		$this->assertEquals(2, count($all), 'get all books');		
	}
	
	/**
	 * @depends testAll
	 */
	public function testGetId()
	{
		$publisher = Publishers::get_id('0');
		$this->assertEquals(0, count($publisher), 'no book id #0');
		
		$publisher = Publishers::get_id('1');
		$this->assertEquals(1, count($publisher), 'get book id #1');
		
		$publisher = Publishers::get_id('2');
		$this->assertEquals(1, count($publisher), 'get book id #2');
	}
	
	/**
	 * @depends testGetId
	 */
	public function testGetViewIndex()
	{
		$publishers = Publishers::get_view_index();
		$this->assertEquals(2, count($publishers), 'get all books view index');
		$this->assertEquals(0, $publishers[0]->book_count, 'book count is zero');
	}
	
	/**
	 * @depends testGetViewIndex
	 */
	public function testDelete()
	{
		Publishers::delete(1);
		$all = Publishers::all();
		$this->assertEquals(1, count($all), 'delete first row');
		
		Publishers::delete(2);
		$all = Publishers::all();
		$this->assertEquals(0, count($all), 'delete second row');
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
	
	public static function tearDownAfterClass()
	{
		TestModelPublishers::clearTable();
	}
}
