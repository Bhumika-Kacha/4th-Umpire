<?php
 // echo "<pre>"; print_r($away_team); exit;

?>
<div>
<?php	 echo $this->Form->create("fixtureball", array(
                                                  'url' => array('controller' => 'AdminFixtures', 
                                                                  'action' => 'admin_edit_away_ball',$awayid,$fixtureid)
                                    ));
?>
<h2><?php echo $away_team_name;  ?></h2>
<h3>Balling Statistics</h3>
	<table class="table table-hover">
		<tr>
				<th>Players</th>
				<th>O</th>
				<th>M</th>
				<th>R</th>
				<th>W</th>
				<th>Extras</th>
		</tr>

		<?php  $i=0;
			foreach ($away_team as $key => $value) {
				if($value['FixtureBall']['team_id']==$awayid || $value['FixtureBall']['non_member_id']==$awayid ){ ?>	

		<tr>
				<?php if(empty($value['Player']['first_name'])){ ?> 
				<td><input name=<?php echo $i.'player'; ?> id="player" value='<?php echo $value['NonMemberPlayer']['name'];  ?>' type="text"></td>					

				<?php } else {?>
					<td><input name=<?php echo $i.'player'; ?> id="player" value='<?php echo $value['Player']['first_name'];  ?>' type="text"></td>
				<?php } ?>
				
				<td><input name=<?php echo $i.'over'; ?> id="over" value='<?php echo $value['FixtureBall']['o'];  ?>' type="text"></td>
				<td><input name=<?php echo $i.'match'; ?> id="match" value='<?php echo $value['FixtureBall']['m'];  ?>' type="text"></td>
				<td><input name=<?php echo $i.'run'; ?> id="run" value='<?php echo $value['FixtureBall']['r'];  ?>' type="text"></td>
				<td><input name=<?php echo $i.'wickets'; ?> id="wickets" value='<?php echo $value['FixtureBall']['w'];  ?>' type="text"></td>
				<td><input name=<?php echo $i.'extra'; ?> id="extra" value='<?php echo $value['FixtureBall']['extra'];  ?>' type="text"></td>
				<input name=<?php echo $i.'teamid'; ?> value='<?php echo $awayid; ?>' type="hidden">

				<input name=<?php echo $i.'id'; ?> value='<?php echo $value['FixtureBall']['id']; ?>' type="hidden">

				<?php if(empty($value['FixtureBall']['teamid'])){ ?>
					<input name=<?php echo $i.'team'; ?> value='non_member' type="hidden">
				<?php } else{?>
					<input name=<?php echo $i.'team'; ?> value='member' type="hidden">
				<?php } ?>
		</tr>				
		<?php $i++; } } ?>
	</table>
	<input type="submit" value="Submit" class="submit"/>

</form>
</div>