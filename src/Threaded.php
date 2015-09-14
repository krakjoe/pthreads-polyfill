<?php
if (!extension_loaded("pthreads")) {

	class Threaded implements ArrayAccess, Countable {

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

		public function synchronized(Closure $closure, ... $args) {
			$closure(...$args);
		}

		public function run() {}

		private $data;
	}
}
