<?php
if (!extension_loaded("pthreads")) {

	class Pool {

		public function __construct($size, $class = \Worker::class, $ctor = []) {
			$this->size = $size;
			$this->clazz = $class;
			$this->ctor = $ctor;
		}

		public function submit(Collectable $collectable) {
			if ($this->last > $this->size) {
				$this->last = 0;
			}

			if (!isset($this->workers[$this->last])) {
				$this->workers[$this->last] = 
					new $this->clazz(...$this->ctor);
				$this->workers[$this->last]->start();
			}

			$this->workers[$this->last++]->stack($collectable);
		
		}

		public function submitTo(int $worker, Collectable $collectable) {
			if (isset($this->workers[$worker])) {
				$this->workers[$worker]->stack($collectable);
			}
		}

		public function collect(Closure $collector) {
			$total = 0;
			foreach ($this->workers as $worker)
				$total += $worker->collect($collector);
			return $total;
		}

		public function shutdown() {
			unset($this->workers);
		}

		protected $workers;
		protected $size;
		protected $last;
		protected $clazz;
		protected $ctor;
	}
}


