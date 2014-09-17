<?php 
	class NonMemberPlayersController extends AppController{
		public $name = 'NonMemberPlayers';
		public $helpers= array('Html' , 'Form');
		public $uses=array('NonMemberPlayer');


		public function add_data($fixtureid,$nonid)
		{
			$this->set('fixtureid',$fixtureid);
			$this->set('nonid',$nonid);

			if(!empty($this->request->data))
			{
				$this->NonMemberPlayer->adddata($this->request->data,$nonid);
				$this->Session->setFlash("Data Saved");
				$this->redirect(array('controller' =>'AdminFixtures','action' => 'admin_fixt_ball_stat',$fixtureid));
			}
		}

		public function search_add($fixtureid,$nonid)
		{
			// echo "<pre>"; print_r($nonid); exit;
			$this->set('fixtureid',$fixtureid);
			$this->set('nonid',$nonid);

			$find=$this->NonMemberPlayer->searchdata($nonid);
			foreach ($find as $key => $value) {
				$find_player[]=$value;
			}
			$this->set('player',$find_player);
			if(!empty($this->request->data))
			{
				$this->NonMemberPlayer->saveanother($this->request->data,$nonid);
				$this->Session->setFlash("Data Saved");
				$this->redirect(array('controller' =>'AdminFixtures','action' => 'admin_fixt_ball_stat',$fixtureid));				

			}

		}

	}

?>