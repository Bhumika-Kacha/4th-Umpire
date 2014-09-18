<?php
	class Fixture extends AppModel {
		public $useTable = 'fixture';
		public $name='Fixture';
		/*public $hasOne= array('Result'=>array(
			 					'className'=>'Result',
			 					'foreignKey'=>'fixture_id'
			 				 					));*/
			

		public $belongsTo= array('Team'=>array(
									'className'=>'Team',
									'foreignKey'=>'opponent_id'
									),
								'Team1'=>array(
									'className'=>'Team',
									'foreignKey'=>'team_id'
									),
								'Winner'=>array(
									'className'=>'Team',
									'foreignKey'=>'winner_id'),
								'NonMemberTeam'=>array(
									'className'=>'NonMemberTeam',
									'foreignKey'=>'non_member_id'),
								'NonMemberWinner'=>array(
									'className'=>'NonMemberTeam',
									'foreignKey'=>'non_member_winner'));


		

		public $hasMany=array('FixtureBall'=>array(
									'className'=>'FixtureBall',
									'foreignKey'=>'fixtureid',
									'dependent'=> true,),
							  'FixtureBat'=>array(
							  		'className'=>'FixtureBat',
							  		'foreignKey'=>'fixtureid',
							  		'dependent'=> true,));



		public function getdata($teamid)
		{
		
			 $n=$this->find('all',array('conditions'=>array('Fixture.team_id'=>$teamid)));
			 return $n;

		}

		public function getfixture_ball($fixtureid)
		{
			//echo "<pre>"; print_r($fixtureid); exit;
			/*$fixture_data=$this->find('all',array(
				'joins'=>array(
					array(
						'table'=>'fixture_ball_details',
						'alias'=>'fixtureBall',
						'type'=>'INNER',
						'conditions'=>array(
							'Fixture.id=fixtureBall.fixtureid'
						)
					)),
				'conditions'=>array('fixtureBall.fixtureid'=>$fixtureid),
				'fields'=>array('fixtureBall.*','Team.*')
				));*/
				//echo "<pre>"; print_r($this->recursive); exit;
	// $this->recursive=2;
			 $fixture_data=$this->find('all',array('conditions'=>array('Fixture.id'=>$fixtureid)));
				// App::import('Model','FixtureBall');
				// $fixtureBall = new FixtureBall;
				// $n=$fixtureBall->find('all');
				// $n=$this->FixtureBall->Player->find('all');
				// echo "<pre>"; print_r($n);
				// $this->recursive=2;
				//$fixture_data=$this->find('all');
				
				return $fixture_data;
		}


		public function editdata($fixtureid)
		{
			
			$find=$this->find('all',array('conditions'=>array('Fixture.id'=>$fixtureid)));
			return $find;
		}

		public function updatedata($fixtureid,$data)
		{
			$find_winner=$this->Team->find('first',array('conditions'=>array('Team.team_name'=>$data['winner'])));
			if(empty($find_winner))
			{
				$find_winner=$this->NonMemberTeam->find('first',array('conditions'=>array('NonMemberTeam.team_name'=>$data['winner'])));
				// echo "<pre>"; print_r($find_winner); exit;
				$win_team=$find_winner['NonMemberTeam']['team_name'];
			}
			else
			{
				$win_team=$find_winner['Team']['id'];
			}
			$this->updateAll(array('Fixture.datetime'=>'"'.$data['datepicker'].'"',
									'Fixture.result'=>'"'.$data['result'].'"',
									'Fixture.venue'=>'"'.$data['venue'].'"',
									// 'Fixture.opponent_id'=>'"'.$find_opponant['Team']['id'].'"',
									'Fixture.winner_id'=>'"'.$win_team.'"'),
								array('Fixture.id'=>$fixtureid));
		}

		public function adddata($data)
		{
			$this->recursive=-1;
			//echo "<pre>"; print_r($data);
			
			$find_opponant=$this->Team->find('first',array('conditions'=>array('Team.team_name'=>$data['fixture']['opponant_team'])));
			$find_winner=$this->Team->find('first',array('conditions'=>array('Team.team_name'=>$data['fixture']['winner'])));
			//echo "<pre>"; print_r($find_winner); exit;
			$value['Fixture']['team_id']='1';
			$value['Fixture']['datetime']=$data['fixture']['datepicker'];
			$value['Fixture']['venue']=$data['fixture']['venue'];
			$value['Fixture']['opponent_id']=$find_opponant['Team']['id'];
			$value['Fixture']['result']=$data['fixture']['result'];
			$value['Fixture']['winner_id']=$find_winner['Team']['id'];
			//echo "<pre>"; print_r($value); exit;
			if($this->save($value))
			{
				return $find_opponant['Team']['team_name'];
					
			}
			
			 
		}

		public function addnonmember($data)
		{
			$find_opponant=$this->NonMemberTeam->find('first',array('conditions'=>array('NonMemberTeam.team_name'=>$data['fixture']['other_team'])));
			//echo "<pre>"; print_r($find_opponant); exit;
			if(empty($find_opponant))
			{
				$data1['NonMemberTeam']['team_name']=$data['fixture']['add_other'];
				$this->NonMemberTeam->save($data1);
				
				$find_opponant=$this->NonMemberTeam->find('first',array('conditions'=>array('NonMemberTeam.team_name'=>$data['fixture']['add_other'])));

			}
			$find_winner=$this->NonMemberTeam->find('first',array('conditions'=>array('NonMemberTeam.team_name'=>$data['fixture']['winner'])));
				if(!empty($find_winner))
				{
					$value1['Fixture']['non_member_winner']=$find_winner['NonMemberTeam']['id'];	
				}
				else
				{
					$find_winner=$this->Team->find('first',array('conditions'=>array('Team.team_name'=>$data['fixture']['winner'])));
					$value1['Fixture']['winner_id']=$find_winner['Team']['id'];
				}
				$value1['Fixture']['non_member_id']=$find_opponant['NonMemberTeam']['id'];		
				$value1['Fixture']['team_id']='1';
				$value1['Fixture']['datetime']=$data['fixture']['datepicker'];
				$value1['Fixture']['venue']=$data['fixture']['venue'];
				$value1['Fixture']['result']=$data['fixture']['result'];
				
				if($this->save($value1))
				{
					return $find_opponant['NonMemberTeam']['team_name'];
				}

			
			
		}
		public function findaway($fid)
		{
			// echo "<pre>"; print_r($fid); exit;
			
			$find=$this->find('first',array('conditions'=>array('Fixture.id'=>$fid),
											'fields'=>array('Fixture.opponent_id','Fixture.non_member_id')));
			

			if(!empty($find['Fixture']['opponent_id']))
			{
				$find_opponant_team[]='member';
				$find_opponant_team[]=$this->Team->find('first',array('conditions'=>array(
														'Team.id'=>$find['Fixture']['opponent_id'])));

			}
			else
			{
				$find_opponant_team[]='non_member';
				$find_opponant_team[]=$this->NonMemberTeam->find('first',array('conditions'=>array(
																			'NonMemberTeam.id'=>$find['Fixture']['non_member_id'])));
			}
			
			return $find_opponant_team;
		}

		public function edit_ball_view($fixtureid)
		{

			$this->unbindModel(array('hasMany' => array('FixtureBall','FixtureBat')));

			$find=$this->find('all',array('conditions'=>array('Fixture.id'=>$fixtureid)));
			return $find;
		}

		public function fixture_delete($fixtureid)
		{
			$this->delete($fixtureid,true);
		}

		public function getteamid($fixtureid)
		{
		
		}
		
	}
?>