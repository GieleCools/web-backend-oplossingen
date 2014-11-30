<?php

	class Message
	{
		private $text;
		private $type;

		public function __construct($messageText, $messageType)
		{
			$this->text = $messageText;
			$this->type = $messageType;
			$this->AddMessageToSession();
		}

		private function AddMessageToSession()
		{
			if (isset($this->text) && isset($this->type)) 
			{
				$_SESSION['message']['text'] = $this->text;
				$_SESSION['message']['type'] = $this->type;
			}
		}

		private function RemoveMessageFromSession()
		{
			unset($_SESSION['message']);
		}

		public static function GetMessageOutSession()
		{
			$arrMessage = false;

			if (isset($_SESSION['message']['text']) && isset($_SESSION['message']['type'])) 
			{
				$arrMessage = $_SESSION['message'];

				self::removeMessageFromSession(); //Static function, dus self::functionName(); ipv $this->functionName();
			}
			return $arrMessage;
		}
	}

?>