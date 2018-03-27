<?php
class Compteur
{•
	private $_counterAllBlack;
	private $_counterAllColor;
	private $_counterScanBlack;
	private $_counterScanColor;

	public function setCounterAllBlack($couterAllBlack){
		$this->_counterAllBlack = $counterAllBlack;
	}
	public function setCounterAllColor($counterAllColor){
		$this->_counterAllColor = $counterAllColor;
	}
	public function setCounterScanBlack($counterScanBlack){
		$this->_counterScanBlack = $counterScanBlack;
	}
	public function setCounterScanColor($counterScanColor){
		$this->_counterScanColor = $counterScanColor;
	}
}