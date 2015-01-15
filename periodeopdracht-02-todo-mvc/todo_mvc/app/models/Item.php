<?php
	
	class Item extends Eloquent
	{
		public function toggleStatus()
		{
			//status vh item instellen - omkeren -> done naar undone en undone naar done
			$done = true;
			if ($this->done) 
			{
				$done = false;
			}

			//status vh item instellen voor item in db en opslaan in db
			$this->done = $done;
			$this->save();
		}
	}

?>