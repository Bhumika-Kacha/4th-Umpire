<?php
	// echo "<pre>"; print_r($away_team); exit;
?>
<div>
<?php	 echo $this->Form->create("fixtureball", array(
                                                  'url' => array('controller' => 'AdminFixtures', 
                                                                  'action' => 'admin_edit_away_bat',$awayid,$fixtureid)
                                    ));
?>
<h2><?php echo $away_team_name;  ?></h2>
<h3>Batting Statistics</h3>
	<table class="table table-hover">
		<tr>
				<th>Players</th>
				<th></th>
				<th>R</th>
				<th>B</th>
				<th>4s</th>
				<th>6s</th>
				
		</tr>
		<?php $i=0;
		 foreach ($away_team as $key => $value) {
				if($value['FixtureBat']['team_id']==$awayid || $value['FixtureBat']['non_member_id']==$awayid ){  ?>	

		<tr>
				<?php if(empty($value['Player']['first_name'])){ ?> 
				<td><input name=<?php echo $i.'player'; ?> id="player" value='<?php echo $value['NonMemberPlayer']['name'];  ?>' type="text"></td>					

				<?php } else {?>
					<td><input name=<?php echo $i.'player'; ?> id="player" value='<?php echo $value['Player']['first_name'];  ?>' type="text"></td>
				<?php } ?>
				
				<td><input name=<?php echo $i.'detail'; ?> id="over" value='<?php echo $value['FixtureBat']['detail'];  ?>' type="text"></td>
				<td><input name=<?php echo $i.'run'; ?> id="match" value='<?php echo $value['FixtureBat']['run'];  ?>' type="text"></td>
				<td><input name=<?php echo $i.'balls'; ?> id="run" value='<?php echo $value['FixtureBat']['balls'];  ?>' type="text"></td>
				<td><input name=<?php echo $i.'4s'; ?> id="wickets" value='<?php echo $value['FixtureBat']['4s'];  ?>' type="text"></td>
				<td><input name=<?php echo $i.'6s'; ?> id="extra" value='<?php echo $value['FixtureBat']['6s'];  ?>' type="text"></td>
				<input name=<?php echo $i.'teamid'; ?> value='<?php echo $value['FixtureBat']['team_id']; ?>' type="hidden">
				<input name=<?php echo $i.'id'; ?> value='<?php echo $value['FixtureBat']['id']; ?>' type="hidden">
				<?php if(empty($value['FixtureBat']['teamid'])){ ?>
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