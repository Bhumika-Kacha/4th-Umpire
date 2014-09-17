<?php
	class NonMemberTeam extends AppModel {
		public $useTable = 'non_member_team';
		public $name='NonMemberTeam';

		public function getteam()
		{
			$find_team=$this->find('all');
			return $find_team;
		}
	}
?>