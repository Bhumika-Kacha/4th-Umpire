<?php
	class FixtureBat extends AppModel {
		public $useTable = 'fixture_bat_details';
		public $name='FixtureBat';

		public $hasOne= array('Team'=>array(
			 					'className'=>'Team',
			 					'foreignKey'=>'team_id'
			 				 					));

		public $belongsTo=array('Player'=>array(
									'className'=>'Player',
									'foreignKey'=>'playerid'),
								'NonMemberPlayer'=>array(
									'className'=>'NonMemberPlayer',
									'foreignKey'=>'non_member_player_id'),
								'Fixture'=>array(
									'className'=>'Fixture',
									'foreignKey'=>'fixtureid'));


		public function home_bat_stat($home,$fixtureid,$teamid)
		{
			
			$i=0;
			$j=0;
			foreach ($home as $key => $value) {
				if($i%6==0)
				{
					if(!empty($value))
					{
						
						$find_pid=$this->Player->find('first',array('conditions'=>array('Player.first_name'=>$home[$key]),
																	'fields'=>array('Player.id')));
						$data[$j]['team_id']=$teamid;
						$data[$j]['fixtureid']=$fixtureid;
						$data[$j]['playerid']=$find_pid['Player']['id'];
						$detail='Home'.$j.'desc';
						$data[$j]['detail']=$home[$detail];
						$run='Home'.$j.'run';
						$data[$j]['run']=$home[$run];
						$ball='Home'.$j.'ball';
						$data[$j]['balls']=$home[$ball];
						$four='Home'.$j.'4s';
						$data[$j]['4s']=$home[$four];
						$six='Home'.$j.'6s';
						$data[$j]['6s']=$home[$six];
						$sr=round(($home[$run]/$home[$ball])*100,2);
						$data[$j]['sr']=$sr;

						$this->create();
						$this->save($data[$j]);
						$j++;
					}

				}
				$i++;

			} 
			
		}

		public function away_bat_stat($away,$fixtureid,$teamid,$team)
		{
			$i=0;
			$j=0;
			foreach ($away as $key => $value) {
				if($i%6==0)
				{
					if(!empty($value))
					{
						
						if($team=="non_member")
						{
							$find_pid=$this->NonMemberPlayer->find('first',array('conditions'=>array('NonMemberPlayer.name'=>$away[$key]),
																		'fields'=>array('NonMemberPlayer.id')));
							$data[$j]['non_member_player_id']=$find_pid['NonMemberPlayer']['id'];
							$data[$j]['non_member_id']=$teamid;

						}
						elseif($team="member")
						{
							$find_pid=$this->Player->find('first',array('conditions'=>array('Player.first_name'=>$away[$key]),
																	'fields'=>array('Player.id')));
							$data[$j]['playerid']=$find_pid['Player']['id'];
							$data[$j]['team_id']=$teamid;

							
						}
						$data[$j]['fixtureid']=$fixtureid;
						$detail='Away'.$j.'desc';
						$data[$j]['detail']=$away[$detail];
						$run='Away'.$j.'run';
						$data[$j]['run']=$away[$run];
						$ball='Away'.$j.'ball';
						$data[$j]['balls']=$away[$ball];
						$four='Away'.$j.'4s';
						$data[$j]['4s']=$away[$four];
						$six='Away'.$j.'6s';
						$data[$j]['6s']=$away[$six];
						$sr=round(($away[$run]/$away[$ball])*100,2);

						$data[$j]['sr']=$sr;
						$this->create();
						$this->save($data[$j]);
						
						$j++;
					}

				}
				$i++;

			}
		}

		public function getbatinfo($fixtureid)
		{
			$this->unbindModel(array('hasOne' => array('Team')));
			// $this->Fixture->unbindModel(array('belongsTo' => array('Team')));

			// $this->Fixture->unbindModel(array('belongsTo' => array('Team')));
			// echo "<pre>"; print_r($fixturestat); exit;
			 $find = $this->find('all', array('conditions' => array('FixtureBat.fixtureid' => $fixtureid)));

			 return $find;	
		}

		public function edit_bat($fixtureid,$data)
		{
			$i=0;
			$j=0;
			foreach ($data as $key => $value) {
				if($i%8==0)
				{

					if(!empty($value))
					{

						$find_pid=$this->Player->find('first',array('conditions'=>array('Player.first_name'=>$data[$key]),
																		'fields'=>array('Player.id')));
						$player=$find_pid['Player']['id'];
						$detail=$j.'detail';
						$run=$j.'run';
						$balls=$j.'balls';
						$fours=$j.'4s';
						$sixs=$j.'6s';
						$teamid=$j.'teamid';
						$id=$j.'id';
						$sr=round(($data[$run]/$data[$balls])*100,2);
						$data1[$j]['playerid']=$player;
						$data1[$j]['detail']=$data[$detail];
						$data1[$j]['run']=$data[$run];
						$data1[$j]['balls']=$data[$balls];
						$data1[$j]['4s']=$data[$fours];
						$data1[$j]['6s']=$data[$sixs];
						$data1[$j]['team_id']=$data[$teamid];
						$data1[$j]['sr']=$sr;
						$data1[$j]['fixtureid']=$fixtureid;

							if(!empty($data[$id]))
							{
								$this->id=$data[$id];
								$this->save($data1[$j]);	
							}
						
						
						$j++;

					}
					
				}	 $i++;
				 	
			}  
		}

		public function edit_bat_away($fixtureid,$data)
		{
			// echo "<pre>"; print_r($data); exit;
			$i=0;
			$j=0;
			foreach ($data as $key => $value) {
				if($i%9==0)
				{

					if(!empty($value))
					{

						$pid=$j.'team';
						if($data[$pid]=="non_member")
						{
							$find_pid=$this->NonMemberPlayer->find('first',array('conditions'=>array('NonMemberPlayer.name'=>$data[$key]),
																				'fields'=>array('NonMemberPlayer.id')));
							$p_id=$find_pid['NonMemberPlayer']['id'];
							
						}
						else
						{
							$find_pid=$this->Player->find('first',array('conditions'=>array('Player.first_name'=>$data[$key]),
																		'fields'=>array('Player.id')));
							$p_id=$find_pid['Player']['id'];

						}

						$player=$p_id;
						$detail=$j.'detail';
						$run=$j.'run';
						$balls=$j.'balls';
						$fours=$j.'4s';
						$sixs=$j.'6s';
						$teamid=$j.'teamid';
						$id=$j.'id';
						$sr=round(($data[$run]/$data[$balls])*100,2);
						$data1[$j]['playerid']=$player;
						$data1[$j]['detail']=$data[$detail];
						$data1[$j]['run']=$data[$run];
						$data1[$j]['balls']=$data[$balls];
						$data1[$j]['4s']=$data[$fours];
						$data1[$j]['6s']=$data[$sixs];
						$data1[$j]['team_id']=$data[$teamid];
						$data1[$j]['sr']=$sr;
						$data1[$j]['fixtureid']=$fixtureid;


							if(!empty($data[$id]))
							{
								$this->id=$data[$id];
								$this->save($data1[$j]);	
							}

						
						$j++;

					}
					
				}	 $i++;
				 	
			}   						
						
		}
	}
?>