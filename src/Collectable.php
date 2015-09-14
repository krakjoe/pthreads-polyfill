<?php
if (!extension_loaded("pthreads")) {

	class Collectable extends Threaded {

		public function isGarbage() { return $this->garbage; }
		public function setGarbage() {
			if ($this->garbage) {
				throw new \RuntimeException();
			}
			$this->garbage = true;
		}

		protected $garbage = false;
	}
}
