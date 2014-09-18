<div>
	<table>
	<tr>
		<td><?php echo $this->Html->link("Fixture list",array('controller'=>'AdminFixtures','action'=>'admin_edit',$fixtureid)); 	?></td>
	</tr>
	</table>
<h2><?php echo $home_team; ?></h2>
<table>
	<tr>
		<td><?php echo $this->Html->link("Balling Statistics",array('controller'=>'AdminFixtures','action'=>'admin_editfixt_ball_stat',$home_id,$fixtureid)); ?></td>
		<td><?php echo $this->Html->link("Batting Statistics",array('controller'=>'AdminFixtures','action'=>'admin_edit_home_bat',$home_id,$fixtureid)); ?></td>
	</tr>
</table>
<h2><?php echo $away_team; ?></h2>
<table>
	<tr>
		<td><?php echo $this->Html->link("Balling Statistics",array('controller'=>'AdminFixtures','action'=>'admin_edit_away_ball',$away_id,$fixtureid)); ?></td>
		<td><?php echo $this->Html->link("Batting Statistics",array('controller'=>'AdminFixtures','action'=>'admin_edit_away_bat',$away_id,$fixtureid)); ?></td>	
</tr>
</table>
</div>