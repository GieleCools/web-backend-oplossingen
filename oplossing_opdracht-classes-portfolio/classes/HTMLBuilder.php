<?php
	class HTMLBuilder
	{
		public function __construct($header, $body, $footer)
		{
			require_once $header;
			require_once $body;
			require_once $footer;
		}
	}
?>