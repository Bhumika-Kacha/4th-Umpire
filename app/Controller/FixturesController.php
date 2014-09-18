<?php 
	class FixturesController extends AppController{
		public $name = 'Fixtures';
		public $helpers= array('Html' , 'Form');
		public $uses=array('Fixture','Player','FixtureBall','FixtureBat');

		public function index()
		{
			$teamid='1';
			$find=$this->Fixture->getdata($teamid);
			//echo "<pre>"; print_r($find); exit;
			$this->set('fixture',$find);
		}

		public function fixture_stat($fixtureid)
		{
			
			$this->Fixture->unbindModel(array('hasOne'=>array('Result')));
			$fixture_stat=$this->Fixture->getfixture_ball($fixtureid);
			$f_ball=$this->FixtureBall->getballinfo($fixtureid);
			$f_bat=$this->FixtureBat->getbatinfo($fixtureid);



			foreach ($fixture_stat as $key => $value) {
				if(empty($value['Team']['team_name']))
				{
					$away_team_name=$value['NonMemberTeam']['team_name'];
				}
				else
				{
					$away_team_name=$value['Team']['team_name'];	
				}
				$home_team_name=$value['Team1']['team_name'];
				
			}
			foreach ($f_ball as $key => $value) {

				if($value['FixtureBall']['team_id']=='1')
				{
					$home_team_ball[]=$value;
				}
				else
				{
					
					$away_team_ball[]=$value;
				}

			}

			foreach ($f_bat as $key => $value) {
				if($value['FixtureBat']['team_id']=='1')
				{
					$home_team_bat[]=$value;
				}
				else
				{
					$away_team_bat[]=$value;
				}
			}

		

			$this->set('home_team_name',$home_team_name);
			$this->set('away_team_name',$away_team_name);
			$this->set('home_team_ball',$home_team_ball);
			$this->set('away_team_ball',$away_team_ball);
			$this->set('home_team_bat',$home_team_bat);
			$this->set('away_team_bat',$away_team_bat);
		}


		

		

	}
?>