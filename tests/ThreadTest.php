<?php
class TestThread extends Thread {

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
		$this->assertEquals($thread->start(), true);
		$this->assertEquals($thread->isStarted(), true);
		$this->assertEquals($thread->join(), true);
		$this->assertEquals($thread->isJoined(), true);
		$this->assertEquals($thread->member, "something");
	}

	public function testThreadIsRunning() {
		$thread = new TestThread();
		$this->assertEquals($thread->start(), true);
		$this->assertEquals($thread->join(), true);
		$this->assertEquals($thread->running, true);
	}

	public function testThreadIsKilled() {
		$thread = new TestThread();
		$this->assertEquals($thread->start(), true);
		$this->assertEquals($thread->kill(), true);
		$this->assertEquals($thread->join(), true);
		$this->assertEquals($thread->isTerminated(), true);
	}
}
?>
