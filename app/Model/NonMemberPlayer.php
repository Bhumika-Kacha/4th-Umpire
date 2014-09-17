<?php
	class NonMemberPlayer extends AppModel {
		public $useTable = 'non_member_players';
		public $name='NonMemberPlayer';

		public $belongsTo= array('NonMemberTeam'=>array(
			 						'className'=>'NonMemberTeam',
			 						'foreignKey'=>'non_member_teamid'));

		public function getdata($teamname)
		{

			$find=$this->NonMemberTeam->find('first',array('conditions'=>array('NonMemberTeam.team_name'=>$teamname)));
			$teamid=$find['NonMemberTeam']['id'];

			$findplayer=$this->find('all',array('conditions'=>array('NonMemberPlayer.non_member_teamid'=>$teamid)));
			$ndata[]=array('nodata',$find['NonMemberTeam']['id']);
			$ydata[]=array('data',$find['NonMemberTeam']['id']);
			if(empty($findplayer))
			{
				return $ndata;
			}
			else
			{
				return $ydata;
			}
		}

		public function adddata($data,$nonid)
		{
			// echo "<pre>"; print_r($data); exit;
			foreach ($data['NonMemberPlayer'] as $key => $value) {
				$data1['NonMemberPlayer']['name']=$value;
				$data1['NonMemberPlayer']['non_member_teamid']=$nonid;

				$this->create();
				$this->save($data1); 
			}
		}

		public function searchdata($nonid)
		{
			$this->recursive=-1;
			$find=$this->find('all',array('conditions'=>array('NonMemberPlayer.non_member_teamid'=>$nonid)));
			return $find;
		}

		public function saveanother($data,$nonid)
		{
			 
			foreach ($data as $key => $value) {
				// echo "<pre>"; print_r($key); exit;
				$start=substr($key,0,3);
				// echo "<pre>"; print_r($start); exit;
				if($start!="old")
				{
					if(!empty($value))
					{
						$data1['NonMemberPlayer']['name']=$value;
						$data1['NonMemberPlayer']['non_member_teamid']=$nonid;

						$this->create();
						$this->save($data1);
					}
					
				}
			}
		}
	}
?>