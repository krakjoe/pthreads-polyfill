<?php
class ThreadedTest extends PHPUnit_Framework_TestCase {
	public function testThreadedArrayAccessSetUnset() {
		$threaded = new Threaded();
		$threaded[] = "something";
		$this->assertEquals($threaded[0], "something");
	}

	public function testThreadedArrayAccessExistsUnset() {
		$threaded = new Threaded();
		$threaded[] = "something";	
		$this->assertEquals(isset($threaded[0]), true);
		unset($threaded[0]);
		$this->assertEquals(isset($threaded[0]), false);
	}

	public function testThreadedCountable() {
		$threaded = new Threaded();
		$threaded[] = "something";
		$this->assertEquals(count($threaded), 1);
	}

	public function testThreadedShift() {
		$threaded = new Threaded();
		$threaded[] = "something";
		$threaded[] = "else";
		$this->assertEquals($threaded->shift(), "something");
		$this->assertEquals(count($threaded), 1);
	}

	public function testThreadedChunk() {
		$threaded = new Threaded();
		while (count($threaded) < 10) {
			$threaded[] = count($threaded);
		}
		$this->assertEquals($threaded->chunk(5), [0, 1, 2, 3, 4]);
		$this->assertEquals(count($threaded), 5);
	}

	public function testThreadedPop() {
		$threaded = new Threaded();
		$threaded[] = "something";
		$threaded[] = "else";
		$this->assertEquals($threaded->pop(), "else");
		$this->assertEquals(count($threaded), 1);
	}

	public function testThreadedMerge() {
		$threaded = new Threaded();
		$threaded->merge([0, 1, 2, 3, 4]);
		$this->assertEquals(count($threaded), 5);
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
		$threaded->synchronized(function(...$args){
			$this->assertEquals($args, [1, 2, 3, 4, 5]);
		}, 1, 2 ,3 ,4 , 5);
	}
}
?>
