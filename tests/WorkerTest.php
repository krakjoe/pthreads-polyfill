<?php
class WorkerTestWork extends Threaded {
	public function run() {
		$this->synchronized(function() {
			$this->hasWorker =
				$this->worker instanceof Worker;
			$this->notify();
		});
	}
}

class WorkerTest extends PHPUnit_Framework_TestCase {

	public function testWorkerStack() {
		$worker = new Worker();
		$work = new WorkerTestWork();
		$worker->start();
		$worker->stack($work);
		$worker->shutdown();

		$this->assertTrue($work->hasWorker);
	}

	public function testWorkerGc() {
		$worker = new Worker();
		$work = new WorkerTestWork();
		$worker->start();
		$worker->stack($work);
		$worker->shutdown();
		$this->assertEquals(1, $worker->collect(function ($task){
			return false;
		}));
		$this->assertEquals(0, $worker->collect(function ($task){
			return $task->isGarbage();
		}));
	}

	public function testGetStacked()
	{
		$worker = new Worker();
		$work = new WorkerTestWork();

		$worker->stack($work);
		$this->assertEquals(1, $worker->getStacked());

		$worker->stack($work);
		$this->assertEquals(2, $worker->getStacked());
	}
}
