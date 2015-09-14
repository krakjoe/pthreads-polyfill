<?php
if (!extension_loaded("pthreads")) {

	class Threaded implements ArrayAccess, Countable {
		const NOTHING = (0);
		const STARTED = (1<<0);	
		const RUNNING = (1<<1);
		const JOINED  = (1<<2);
		const ERROR   = (1<<3);

		public function offsetSet($offset, $value) { return $this->data[(string) $offset] = $value; }
		public function offsetGet($offset) { return $this->data[(string) $offset]; }
		public function offsetUnset($offset) { unset($this->data[(string) $offset]); }
		public function offsetExists($offset) { return isset($this->data[(string) $offset]); }

		public function count() { return count($this->data); }

		public function shift() { return array_shift($this->data); }
		public function chunk($size) { return array_chunk($this->data, $size); }
		public function pop() { return array_pop($this->data); }
		public function merge($data) {
			foreach ($merge as $k => $v) {
				$this->data[$k] = $v;
			}
		}
		
		public function wait(int $timeout = 0) { return true; }
		public function notify() { return true; }
		public function synchronized(Closure $closure, ... $args) {
			$closure(...$args);
		}

		public function isRunning() { return $this->state & THREAD::RUNNING; }
		public function isTerminated() { return $his->state & THREAD::ERROR; }

		public static function extend($class) { return true; }

		public function addRef() {}
		public function delRef() {}
		public function getRefCount() {}

		public function run() {}

		private $data;
		protected $state;
	}
}
