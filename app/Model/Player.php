<?php
	class Player extends AppModel {
		public $useTable = 'players';
		public $name='Player';

		public $hasMany= array('FixtureBall'=>array(
			 						'className'=>'FixtureBall',
			 						'foreignKey'=>'playerid'),
								'FixtureBat'=>array(
									'className'=>'FixtureBat',
									'foreignKey'=>'playerid')
								);	
	}
?>