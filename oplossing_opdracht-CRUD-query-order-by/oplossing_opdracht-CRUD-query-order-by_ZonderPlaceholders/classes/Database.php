<?php

	class Database
	{
		private $db;

		public function __construct($database)
		{
			$this->db = $database;
		}

		public function Query($query, $placeholders = false)
		{
			$result = $this->db->prepare($query);
			if ($placeholders) 
			{
				foreach ($placeholders as $placeholder => $value) 
				{
					//$result->bindValue($placeholder, $value);
					//testen of de placeholders en hun values wel gebonden worden
					$gebonden = $result->bindValue($placeholder, $value); 		
					echo " DE PLACEHOLDERS UIT DATABASEKLASSE: PLACEHOLDER: ".$placeholder." - VALUE: ".$value.", GEBONDEN: ".$gebonden;
				}
			}

			//$result->execute();
			//Testen of het effectief uitgevoerd wordt:
			$uitgevoerd = $result->execute();
			echo " IS DE EXECUTE CORRECT CORRECT UITGEVOERD --> ".$uitgevoerd;

			$columnNames = array();
			for ($columnNumber = 0; $columnNumber < $result->columnCount(); $columnNumber++) 
			{ 
				$columnNames[] = $result->getColumnMeta($columnNumber)['name']; //Naam vd kolom id array met kolomnamen steken
			}

			$data = array();
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
			{
				$data[] = $row;
			}

			$returnArray['columNames']	=	$columnNames;
			$returnArray['data']		=	$data;

			return $returnArray;
		}
	}

?>
