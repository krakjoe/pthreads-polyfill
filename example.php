<?php
require_once("vendor/autoload.php");

$pool = new Pool(4);
$pool->submit(new class extends Collectable {
	public function run() {
		echo "Hello World\n";
		$this->setGarbage();
	}
});

while ($pool->collect(function($task){
	return $task->isGarbage();
})) continue;

$pool->shutdown();
?>
