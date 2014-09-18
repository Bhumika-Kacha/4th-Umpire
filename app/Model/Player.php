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
		public $hasOne = array('Image' => array(
			       'className' => 'Image',
			       'foreignKey'=>'playerid',
			       'dependent'=> true),
					'TeamPlayer'=>array(
						'className'=>'TeamPlayer',
						'foreignKey'=>'playerid',
						'dependent'=> true)
		        
		   );

		public function getplayerinfo($teamid)
		{
			
			$this->recursive=0;
			$find=$this->find('all');
			foreach ($find as $key => $value) {
				if($value['TeamPlayer']['teamid']==$teamid)
				{
					$data[]=$value;
				}
			}

			return $data;
		}

		public function getplayer($teamid)
		{

			$find=$this->TeamPlayer->find('all',array('conditions'=>array('TeamPlayer.teamid'=>$teamid)));
			foreach ($find as $key => $value) {
				if($value['player']['role']=='player')
				{
					$find_p[]=$value;
				}
			}
			
			return $find_p;
		}
		

		public function player_desc($pid){

		    $conditions = array('Player.id' => $pid);
   	        return $this->find('first',compact('conditions'));		
		}


		public function delete_player($playerid)
		{
			$this->delete($playerid,true);
		}

		public function edit_player($playerid)
		{
			$this->recursive=0;
			$find=$this->find('first',array('conditions'=>array('Player.id'=>$playerid)));
			return $find;
		}
		public function addplayer($team_id,$data,$path){


				$player_data['Player']['teamid']=$team_id;
	            $player_data['Player']['first_name']=$data['Player']['fname'];
	            $player_data['Player']['last_name']=$data['Player']['lname'];
   	            $player_data['Player']['bday']=$data['Player']['birthdate'];
	            $player_data['Player']['email']=$data['Player']['email'];
	            $player_data['Player']['phone_number']=$data['Player']['contact'];

	            $this->save($player_data);


	            $imagedata['Image']['url']=$path;
	            $imagedata['Image']['playerid']=$this->getLastInsertID();
	            $this->Image->save($imagedata);

	            $this->updateAll(
   					array('Player.imageid' => $this->Image->getLastInsertID()),
    				array('Player.id' => $this->getLastInsertID()));
	           
	            $data['TeamPlayer']['teamid'] = $team_id;
				$data['TeamPlayer']['playerid'] = $this->getLastInsertID();
	            $data['TeamPlayer']['season'] = '2014';
	            $this->TeamPlayer->save($data);


		}


		public function getimage(){
			   
			  	$path = "img/playerphoto/";
			    $valid_formats = array("jpg", "png", "gif", "bmp","JPG");
			           if(isset($_FILES)){
			                $name = $_FILES['data']['name']['Player']['image'];
			             	 $size = $_FILES['data']['size']['Player']['image'];
			             	
			            if(strlen($name)){
			                    list($txt, $ext) = explode(".", $name);

			                    if(in_array($ext,$valid_formats)){
			                     
			                        if($size<(1024*1024)){
			                            $actual_image_name =$ext;
			                            $tmp = $_FILES['data']['tmp_name']['Player']['image'];
			                            if(move_uploaded_file($tmp, $path.$actual_image_name)){
			                                $uploadedfile = $path.$actual_image_name;
			                                list($width,$height)=getimagesize($uploadedfile);
			                                if($width < 100)
			                                    $newwidth = 100;
			                               else
			                                    $newwidth=100;
			                               if($height < 300)
			                                    $newheight = 100;
			                               else
			                                   $newheight=100;
			                                if($ext=="jpg" || $ext=="jpeg" || $ext=="JPG"){
			                                     $src = imagecreatefromjpeg($uploadedfile);
			                                  }else if($ext=="png") {
			                                      $src = imagecreatefrompng($uploadedfile);
			                                  }else {
			                                      $src = imagecreatefromgif($uploadedfile);
			                                  }
			                                  $tmp1 = @imagecreatetruecolor($newwidth,$newheight)
			                                     or die('Cannot Initialize new GD image stream');
			                                  imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			                                  $filename1 = $path.$name;
			                                  if($ext=="jpg" || $ext=="jpeg" ||$ext=="JPG"){
			                                      imagejpeg($tmp1,$filename1,100);
			                                  }else if($ext=="png") {
			                                      imagepng($tmp1,$filename1);
			                                  }else {
			                                      imagegif($tmp1,$filename1);
			                                  }
			                                  imagedestroy($src);
			                                  imagedestroy($tmp1);
			                                  unlink($path.$actual_image_name);	
			                                  return $path.$name; 
			                                   

			                             }
			                             else
			                                 echo "failed";
			                         }
			                         else
			                             echo "Image file size max 1 MB";
			                     }
			                   else
			                       echo "Invalid file format..";
			               }
			               else
			                   echo "Please select image..!";
			               exit;
			           }
			  }
		
		
	

	}
?>