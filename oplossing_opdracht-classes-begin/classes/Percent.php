<?php

	class Percent
	{
		public $absolute;
		public $relative;
		public $hundred;
		public $nominal;

		public function __construct($new, $unit)
		{
			$this->absolute = $new/$unit;
			$this->relative = $this->absolute-1;
			$this->hundred = $this->relative*100;

			if ($this->absolute>1) 
			{
				$this->nominal = 'positive';
			}
			if ($this->absolute<1) 
			{
				$this->nominal = 'negative';
			}
			if ($this->absolute==1) 
			{
				$this->nominal = 'status-quo';
			}

			$this->absolute = $this->formatNumber($this->absolute);
			$this->relative= $this->formatNumber($this->relative);
			$this->hundred = $this->formatNumber($this->hundred);
		}

		public function formatNumber($number)
		{
			return number_format($number, 2, ',', ''); //nummer formatteren met 2 decimale plaatsen, gescheiden door een komma en duizendtallen scheiden met '', dus met niets.
		}

	

	}
	
?>