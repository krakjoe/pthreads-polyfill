<?php
class TestThread extends Thread { # This should be more than one anon class, PHP5 sucks ass!

	public function run() {
		$this->member = "something";
		$this->running =
			$this->isRunning();
	}

	public $member;
}

class ThreadTest extends PHPUnit_Framework_TestCase {

	public function testThreadStartAndJoin() {
		$thread = new TestThread();
		$this->assertTrue($thread->start());
		$this->assertTrue($thread->isStarted());
		$this->assertTrue($thread->join());
		$this->assertTrue($thread->isJoined());
		$this->assertEquals("something", $thread->member);
	}

	/**
	* @expectedException RuntimeException
	*/
	public function testThreadAlreadyStarted() {
		$thread = new Thread();
		$this->assertTrue($thread->start());
		$this->assertFalse($thread->start());
	}

	/**
	* @expectedException RuntimeException
	*/
	public function testThreadAlreadyJoined() {
		$thread = new Thread();
		$this->assertTrue($thread->start());
		$this->assertTrue($thread->join());
		$this->assertFalse($thread->join());
	}

	public function testThreadIsRunning() {
		$thread = new TestThread();
		$this->assertTrue($thread->start());
		$this->assertTrue($thread->join());
		$this->assertTrue((bool) $thread->running);
	}

	public function testThreadIds() {
		$thread = new Thread();
		$this->assertInternalType("int", $thread->getThreadId());
		$this->assertInternalType("int", Thread::getCurrentThreadId());
	}
}
?>
