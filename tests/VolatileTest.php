<?php
class VolatileTest extends PHPUnit_Framework_TestCase {

	public function testVolatileObjects() {
		$volatile = new Volatile();

		$this->assertEquals(is_object($volatile), true);	
	}
}
