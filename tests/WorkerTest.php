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

		$this->assertEquals($work->hasWorker, true);
	}

	public function testWorkerGc() {
		$worker = new Worker();
		$work = new WorkerTestWork();
		$worker->start();
		$worker->stack($work);
		$worker->shutdown();
		$this->assertEquals($worker->collect(function ($task){
			return false;
		}), 1);	
		$this->assertEquals($worker->collect(function ($task){
			return $task->isGarbage();
		}), 0);
	}
}
