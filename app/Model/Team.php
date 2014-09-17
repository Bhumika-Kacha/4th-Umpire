<?php
	class Team extends AppModel {
		public $useTable = 'team';
		public $name='Team';

		public function getteam()
		{
			$find_team=$this->find('all');
			return $find_team;
		}
	}
?>