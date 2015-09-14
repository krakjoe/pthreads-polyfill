<?php
if (!extension_loaded("pthreads")) {

	class Thread extends Threaded {
		const NOTHING = (0);
		const RUNNING = (1<<0);	
		const ERROR = (1<<1);
		const JOINED = (1<<2);
		const STARTED = (1<<3);

		public function isStarted() { return $this->state & THREAD::STARTED; }
		public function isRunning() { return $this->state & Thread::RUNNING; }
		public function isTerminated() { return $his->state & Thread::ERROR; }
		public function isJoined() { return $this->state & Thread::JOINED; }
		public static function getCurrentThreadId() { return 1; }
		public function getThreadId() { return 1; }

		public function start() {
			$this->state |= THREAD::STARTED;		
			$this->state |= THREAD::RUNNING;
			try {
				$this->run();
			} catch(Throwable $t) {
				$this->state |= THREAD::ERROR;
			}
			$this->state &= ~THREAD::RUNNING;
		}
	
		public function join() {
			if ($this->state & THREAD::JOINED) {
				throw new \RuntimeException();
			}

			$this->state |= THREAD::JOINED;
		}

		public function run() {}
	}
}
