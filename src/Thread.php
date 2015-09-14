<?php
if (!extension_loaded("pthreads")) {

	class Thread extends Threaded {
		public function isStarted() { return $this->state & THREAD::STARTED; }
		public function isJoined() { return $this->state & THREAD::JOINED; }
		public function kill() { 
			$this->state |= THREAD::ERROR;
			return true;  
		}

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

		private $state;
	}
}
