<?php 
	class AdminFixturesController extends AppController{
		public $name = 'AdminFixtures';
		public $helpers= array('Html' , 'Form');
		public $uses=array('Fixture','Player','Team','FixtureBall','FixtureBat','NonMemberTeam','NonMemberPlayer');

		public function admin_add()
		{
			$home_team=$this->Team->getteam();
			$away_team=$this->NonMemberTeam->getteam();
			$this->set('home_team',$home_team);
			$this->set('away_team',$away_team);
		
			if(!empty($this->request->data))
			{
				if($this->request->data['fixture']['other_team']=="select"){
					$oppont_team=$this->Fixture->adddata($this->request->data);	
				}	
				
				elseif(!empty($this->request->data['fixture']['other_team'] || $this->request->data['fixture']['add_other']))
				{
					$oppont_team=$this->Fixture->addnonmember($this->request->data);
				}
				
				if(!empty($oppont_team))
				{
					 //echo "<pre>"; print_r($this->request->data); exit;
					$this->Session->setFlash("Data Saved");
					$fixture_id=$this->Fixture->getLastInsertId();
						if($this->request->data['fixture']['opponant_team']=='others')
						{
							if($this->request->data['fixture']['other_team'] != 'others')
							{
								$search_player=$this->NonMemberPlayer->getdata($this->request->data['fixture']['other_team']);
								//echo "<pre>"; print_r($search_player); exit;

							}
							elseif(!empty($this->request->data['fixture']['add_other']))
							{
								$search_player=$this->NonMemberPlayer->getdata($this->request->data['fixture']['add_other']);
							}
						
							foreach ($search_player as $key => $value) {
								//echo "<pre>"; print_r($value); exit;
								$nonid=$value['1'];
								$val=$value['0'];

							}
							//echo "<pre>"; print_r($val); exit;
							if($val=="nodata")
							{
								$this->redirect(array('controller' =>'NonMemberPlayers','action' => 'add_data',$fixture_id,$nonid));
							}
							else
							{
								$this->redirect(array('controller' =>'NonMemberPlayers','action' => 'search_add',$fixture_id,$nonid));
							}
						}
					
					$this->redirect(array('controller' =>'AdminFixtures','action' => 'admin_fixt_ball_stat',$fixture_id));	
				}
				

			}	
		}


		public function admin_edit($fixtureid)
		{
			$find=$this->Fixture->editdata($fixtureid);
			$this->set('fixturedata',$find);
			$this->set('fixtureid',$fixtureid);
			if(!empty($this->request->data))
			{
				
				$this->Fixture->updatedata($fixtureid,$this->request->data);
				$this->redirect(array('controller' =>'AdminFixtures','action' => 'admin_editfixt_ball_stat',$fixtureid));	

			}

		}

		public function admin_editfixt_ball_stat($fixtureid)
		{
			$find=$this->Fixture->edit_ball_view($fixtureid);
			$home_team=$this->FixtureBall->getballinfo($fixtureid);
			foreach ($find as $key => $value) {
				$home_team_name=$value['Team1']['team_name'];
				$homeid=$value['Fixture']['team_id'];
			}
			$this->set('homeid',$homeid);
			$this->set('home_team_name',$home_team_name);
			$this->set('fixtureid',$fixtureid);
			$this->set('home_team',$home_team);
			if(!empty($this->request->data))
			{
				$this->FixtureBall->edit_ball($fixtureid,$this->request->data);
				$this->redirect(array('controller' =>'AdminFixtures','action' => 'edit_index',$fixtureid));
			}

		}

		public function admin_edit_away_ball($fixtureid)
		{
			$find=$this->Fixture->edit_ball_view($fixtureid);
			$away_team=$this->FixtureBall->getballinfo($fixtureid);
			foreach ($find as $key => $value) {
				$awayid=$value['Fixture']['opponent_id'];
				$awayname=$value['Team']['team_name'];	
			}
			$this->set('away_team_name',$awayname);
			$this->set('awayid',$awayid);
			$this->set('fixtureid',$fixtureid);
			$this->set('away_team',$away_team);
			if(!empty($this->request->data))
			{
				//echo "<pre>"; print_r($this->request->data); exit;
				$this->FixtureBall->edit_ball($fixtureid,$this->request->data);
				$this->redirect(array('controller' =>'AdminFixtures','action' => 'edit_index',$fixtureid));
			}
		}

		public function admin_edit_home_bat($fixtureid)
		{
			$find=$this->Fixture->edit_ball_view($fixtureid);
			$home_team=$this->FixtureBat->getbatinfo($fixtureid);

			foreach ($find as $key => $value) {
				$home_team_name=$value['Team1']['team_name'];
				$homeid=$value['Fixture']['team_id'];
			}
			$this->set('homeid',$homeid);
			$this->set('home_team_name',$home_team_name);
			$this->set('fixtureid',$fixtureid);
			$this->set('home_team',$home_team);
			if(!empty($this->request->data))
			{
				//echo "<pre>"; print_r($this->request->data); exit;
				$this->FixtureBat->edit_bat($fixtureid,$this->request->data);
				$this->redirect(array('controller' =>'AdminFixtures','action' => 'edit_index',$fixtureid));
			}


		}

		public function admin_edit_away_bat($fixtureid)
		{
			$find=$this->Fixture->edit_ball_view($fixtureid);
			$away_team=$this->FixtureBat->getbatinfo($fixtureid);

			foreach ($find as $key => $value) {
				$away_team_name=$value['Team']['team_name'];
				$awayid=$value['Fixture']['opponent_id'];
			}
			$this->set('awayid',$awayid);
			$this->set('away_team_name',$away_team_name);
			$this->set('fixtureid',$fixtureid);
			$this->set('away_team',$away_team);
			if(!empty($this->request->data))
			{
				$this->FixtureBat->edit_bat($fixtureid,$this->request->data);
				$this->redirect(array('controller' =>'AdminFixtures','action' => 'edit_index',$fixtureid));
			}


		}

		public function admin_fixt_ball_stat($fixture_id)
		{
				echo "<pre>"; print_r($fixture_id); exit;
				$this->set('fixtureid',$fixture_id);
				$home_team=$this->Team->find('first',array('conditions'=>array('Team.id'=>'1'),
															'fields'=>array('Team.team_name,Team.id')));
				$tid=$home_team['Team']['id'];
				$find_player_home=$this->Player->getplayer($tid);
				//echo "<pre>"; print_r($find_player_home); exit;
				$this->set('playername_home',$find_player_home);
				$this->set('home_team',$home_team);
				if(!empty($this->request->data))
				{
					echo "<pre>"; print_r($this->request->data); exit;
					foreach ($this->request->data['Fixture'] as $key => $value) {
						$substr=substr($key,0,4);
						if($substr=="Home")
						{
							$home[$key]=$value;
						} 
					}
						//echo "<pre>"; print_r($value); exit;
					foreach ($this->request->data as $key => $value) {
						$substr=substr($key,0,4);
						if($substr=="Away")
						{
							$away[$key]=$value;
						}

					}
						
					
					$this->FixtureBall->home_ball_stat($home,$fixture_id,$home_team['Team']['id']);
				
					$this->FixtureBall->away_ball_stat($away,$fixture_id,$this->request->data['id']);
					$this->redirect(array('controller' =>'AdminFixtures','action' => 'admin_fixt_home_bat',$fixture_id));	


				//	echo "<pre>"; print_r($home_stat); exit;
				}
				
		}

		public function admin_fixt_away_ball()
		{
			$this->layout = 'ajax';
			$find=$this->Fixture->findaway($this->request->data['fixtureid']);
			
			
			$away_team=$this->Team->find('first',array('conditions'=>array('Team.id'=>$find['Fixture']['opponent_id']),
															'fields'=>array('Team.team_name,Team.id')));
			$this->set('away_team',$away_team['Team']['team_name']);
			$this->set('away_id',$away_team['Team']['id']);
		}


		public function admin_fixt_home_bat($fixtureid)
		{
			$this->set('fixtureid',$fixtureid);
			$home_team=$this->Team->find('first',array('conditions'=>array('Team.id'=>'1'),
															'fields'=>array('Team.team_name,Team.id')));
			$tid=$home_team['Team']['id'];
			$find_player_home=$this->Player->getplayer($tid);

			$this->set('playername_home',$find_player_home);

			$this->set('home_team',$home_team);
			if(!empty($this->request->data))
			{
				foreach ($this->request->data['Fixture'] as $key => $value) {
						$substr=substr($key,0,4);
						if($substr=="Home")
						{
							$home[$key]=$value;
						} 
												
				}
				foreach ($this->request->data as $key => $value) {
						$substr=substr($key,0,4);

						if($substr=="Away")
						{
							$away[$key]=$value;
						}
				}
				
				$this->FixtureBat->home_bat_stat($home,$fixtureid,$home_team['Team']['id']);
				
				$this->FixtureBat->away_bat_stat($away,$fixtureid,$this->request->data['id']);
				$this->Session->setFlash('Fixtures Saved Succesfully');
				$this->redirect(array('controller' =>'Fixtures','action' => 'index'));	

			}
		}

		public function admin_fixt_away_bat()
		{
			$this->layout="ajax";
			$find=$this->Fixture->findaway($this->request->data['fixtureid']);
			$away_team=$this->Team->find('first',array('conditions'=>array('Team.id'=>$find['Fixture']['opponent_id']),
															'fields'=>array('Team.team_name,Team.id')));

			$this->set('away_team',$away_team['Team']['team_name']);
			$this->set('away_id',$away_team['Team']['id']);

		}

		public function edit_index($fixtureid)
		{

			$find=$this->Fixture->editdata($fixtureid);
			foreach ($find as $key => $value) {
				$home_team=$value['Team1']['team_name'];
				$away_team=$value['Team']['team_name'];
			}

			$this->set('home_team',$home_team);
			$this->set('away_team',$away_team);
			$this->set('fixtureid',$fixtureid);

		}

		public function admin_delete($fixtureid)
		{
			
			if($this->Fixture->delete($fixtureid,true))
			{
				$this->Session->setFlash('Recored deleted');	
				$this->redirect(array('controller' =>'Fixtures','action' => 'index'));
			}
			
		}


	}
?>