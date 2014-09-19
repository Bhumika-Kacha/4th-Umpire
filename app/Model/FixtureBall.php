<?php
	class FixtureBall extends AppModel {
		public $useTable = 'fixture_ball_details';
		public $name='FixtureBall';
		//public $recursive=1;

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
									'foreignKey'=>'fixtureid')
		);



		public function home_ball_stat($home,$fixtureid,$teamid)
		{
			$i=0;
			$j=0;
			foreach ($home as $key => $value) {

				if($i%6==0)
				{
					if(!empty($value)){

						$find_pid=$this->Player->find('first',array('conditions'=>array('Player.first_name'=>$home[$key]),
																	'fields'=>array('Player.id')));
						$data[$j]['team_id']=$teamid;
						$data[$j]['fixtureid']=$fixtureid;
						$data[$j]['playerid']=$find_pid['Player']['id'];
						$over = 'Home'.$j.'over';
						$data[$j]['o']=$home[$over];
						$match='Home'.$j.'match';
						$data[$j]['m']=$home[$match];
						$run='Home'.$j.'run';
						$data[$j]['r']=$home[$run];
						$wickets='Home'.$j.'wickets';
						$data[$j]['w']=$home[$wickets];
						$econ=round($home[$run]/$home[$over],2);
						$data[$j]['econ']=$econ;
						$extra='Home'.$j.'extra';
						$data[$j]['extra']=$home[$extra];

						$this->create();
						$this->save($data[$j]);

						
						$j++;
					}
				}
				$i++;
			}
			return true;		

		}

		public function away_ball_stat($away,$fixtureid,$teamid,$team)
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
						
						$over = 'Away'.$j.'over';
						$data[$j]['o']=$away[$over];
						$match='Away'.$j.'match';
						$data[$j]['m']=$away[$match];
						$run='Away'.$j.'run';
						$data[$j]['r']=$away[$run];
						$wickets='Away'.$j.'wickets';
						$data[$j]['w']=$away[$wickets];
						$econ=round($away[$run]/$away[$over],2);
						$data[$j]['econ']=$econ;
						$extra='Away'.$j.'extra';
						$data[$j]['extra']=$away[$extra];
						$this->create();
						$this->save($data[$j]); 

					
						$j++;
					}
				}$i++;
			}
		}

		public function getballinfo($fixtureid)
		{

			$this->unbindModel(array('hasOne' => array('Team')));
			$find1 = $this->find('all', array('conditions' => array('FixtureBall.fixtureid' => $fixtureid)));
			return $find1;			
		}

		public function edit_ball($fixtureid,$data)
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
						$over=$j.'over';
						$match=$j.'match';
						$run=$j.'run';
						$wickets=$j.'wickets';
						$extra=$j.'extra';
						$teamid=$j.'teamid';
						$id=$j.'id';
						$econ=round($data[$run]/$data[$over],2);
						$data1[$j]['playerid']=$player;
						$data1[$j]['o']=$data[$over];
						$data1[$j]['m']=$data[$match];
						$data1[$j]['r']=$data[$run];
						$data1[$j]['w']=$data[$wickets];
						$data1[$j]['extra']=$data[$extra];
						$data1[$j]['teamid']=$data[$teamid];
						$data1[$j]['econ']=$econ;
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

		public function edit_ball_away($fixtureid,$data)
		{
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
						$over=$j.'over';
						$match=$j.'match';
						$run=$j.'run';
						$wickets=$j.'wickets';
						$extra=$j.'extra';
						$teamid=$j.'teamid';
						$id=$j.'id';
						$econ=round($data[$run]/$data[$over],2);
						$data1[$j]['playerid']=$player;
						$data1[$j]['o']=$data[$over];
						$data1[$j]['m']=$data[$match];
						$data1[$j]['r']=$data[$run];
						$data1[$j]['w']=$data[$wickets];
						$data1[$j]['extra']=$data[$extra];
						$data1[$j]['teamid']=$data[$teamid];
						$data1[$j]['econ']=$econ;
						$data1[$j]['fixtureid']=$fixtureid;

						//echo "<pre>"; print_r($data1[$j]); 

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