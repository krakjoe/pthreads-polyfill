<?php
class ThreadedTest extends PHPUnit_Framework_TestCase {
	public function testThreadedArrayAccessSet() {
		$threaded = new Threaded();
		$threaded[] = "something";
		$this->assertEquals("something", $threaded[0]);
	}

	public function testThreadedOverloadSetUnset() {
		$threaded = new Threaded();
		$threaded->something = "something";
		$this->assertEquals("something", $threaded->something);
	}

	public function testThreadedArrayAccessExistsUnset() {
		$threaded = new Threaded();
		$threaded[] = "something";
		$this->assertTrue(isset($threaded[0]));
		unset($threaded[0]);
		$this->assertFalse(isset($threaded[0]));
	}

	public function testThreadedOverloadExistsUnset() {
		$threaded = new Threaded();
		$threaded->something = "something";
		$this->assertTrue(isset($threaded->something));
		unset($threaded->something);
		$this->assertFalse(isset($threaded->something));
	}

	public function testThreadedCountable() {
		$threaded = new Threaded();
		$threaded[] = "something";
		$this->assertEquals(1, count($threaded));
	}

	public function testThreadedShift() {
		$threaded = new Threaded();
		$threaded[] = "something";
		$threaded[] = "else";
		$this->assertEquals("something", $threaded->shift());
		$this->assertEquals(1, count($threaded));
	}

	public function testThreadedChunk() {
		$threaded = new Threaded();
		while (count($threaded) < 10) {
			$threaded[] = count($threaded);
		}
		$this->assertEquals([0, 1, 2, 3, 4], $threaded->chunk(5));
		$this->assertEquals(5, count($threaded));
	}

	public function testThreadedPop() {
		$threaded = new Threaded();
		$threaded[] = "something";
		$threaded[] = "else";
		$this->assertEquals("else", $threaded->pop());
		$this->assertEquals(1, count($threaded));
	}

	public function testThreadedMerge() {
		$threaded = new Threaded();
		$threaded->merge([0, 1, 2, 3, 4]);
		$this->assertEquals(5, count($threaded));
	}

	public function testThreadedIterator() {
		$threaded = new Threaded();
		while (count($threaded) < 10) {
			$threaded[] = count($threaded);
		}

		foreach ($threaded as $idx => $value)
			$this->assertEquals($idx, $value);
	}

	public function testThreadedSynchronized() {
		$threaded = new Threaded();
		$threaded->synchronized(function($self, ...$args){
			$self->assertEquals([1, 2, 3, 4, 5], $args);
		}, $this, 1, 2 ,3 ,4 , 5);
	}

	/**
	* @expectedException RuntimeException
	*/
	public function testThreadedImmutabilityWrite() {
		$threaded = new Threaded();
		$threaded->test = new Threaded();
		$threaded->test = new Threaded();
	}

	/**
	* @expectedException RuntimeException
	*/
	public function testThreadedImmutabilityUnset() {
		$threaded = new Threaded();
		$threaded->test = new Threaded();
		unset($threaded->test);
	}
}
?>
