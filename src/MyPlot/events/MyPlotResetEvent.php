<?php
declare(strict_types=1);
namespace MyPlot\events;

use JetBrains\PhpStorm\Pure;
use MyPlot\Plot;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;

class MyPlotResetEvent extends MyPlotPlotEvent implements Cancellable {
	use CancellableTrait;

	/**
	 * MyPlotClearEvent constructor.
	 *
	 * @param Plot $plot
	 */
	public function __construct(Plot $plot) {
		parent::__construct($plot);
	}
}