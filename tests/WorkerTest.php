<?php
class Work extends Collectable {
	public function run() {
		$this->hasWorker = 
			$this->worker instanceof Worker;
		$this->setGarbage();
	}
}

class WorkerTest extends PHPUnit_Framework_TestCase {

	public function testWorkerStack() {
		$worker = new Worker();
		$work = new Work();
		$worker->start();
		$worker->stack($work);
		$worker->shutdown();

		$this->assertEquals($work->hasWorker, true);
	}

	public function testWorkerGc() {
		$worker = new Worker();
		$work = new Work();
		$worker->start();
		$worker->stack($work);
		$this->assertEquals($worker->collect(function ($task){
			return false;
		}), 1);	
		$this->assertEquals($worker->collect(function ($task){
			return $task->isGarbage();
		}), 0);
	}
}
