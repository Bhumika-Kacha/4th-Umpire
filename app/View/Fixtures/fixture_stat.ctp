<?php
	// echo "<pre>"; print_r($home_team_ball);
	//echo "<pre>"; print_r($home_team_bat); exit;
	// echo "<pre>"; print_r($away_team_ball);
	// echo "<pre>"; print_r($away_team_bat);
	// echo "<pre>"; print_r($home_team_name);
	// echo "<pre>"; print_r($away_team_name); exit;
?>
<div>
	<h2><?php echo $home_team_name; ?> </h2>
	<h3>Batting Statistics</h3>
	<table class="table table-hover">
		<tr>
				<th>Players</th>
				<th></th>
				<th>R</th>
				<th>B</th>
				<th>4s</th>
				<th>6s</th>
				<th>SR</th>
		</tr>
		<?php foreach ($home_team_bat as $key => $value) {?>
		 <tr>
		 	<td><?php echo $value['Player']['first_name']; ?></td>
		 	<td><?php echo $value['FixtureBat']['detail'];?></td>
		 	<td><?php echo $value['FixtureBat']['run']?></td>
		 	<td><?php echo $value['FixtureBat']['balls']?></td>
		 	<td><?php echo $value['FixtureBat']['4s']?></td>
		 	<td><?php echo $value['FixtureBat']['6s']?></td>
		 	<td><?php echo $value['FixtureBat']['sr']?></td>
		 </tr>
		<?php } ?>
	</table>
	<h3>Balling Statistics</h3>
	<table class="table table-hover">
		<tr>
				<th>Players</th>
				<th>O</th>
				<th>M</th>
				<th>R</th>
				<th>W</th>
				<th>Econ</th>
				<th>Extras</th>
		</tr>
		<?php foreach ($home_team_ball as $key => $value) {?>
		 <tr>
		 	<td><?php echo $value['Player']['first_name']; ?></td>
		 	<td><?php echo $value['FixtureBall']['o'];?></td>
		 	<td><?php echo $value['FixtureBall']['m']?></td>
		 	<td><?php echo $value['FixtureBall']['r']?></td>
		 	<td><?php echo $value['FixtureBall']['w']?></td>
		 	<td><?php echo $value['FixtureBall']['econ']?></td>
		 	<td><?php echo $value['FixtureBall']['extra']?></td>
		 </tr>
		<?php }?>
	</table>


	<h2><?php echo $away_team_name; ?> </h2>
	<h3>Batting Statistics</h3>

	<table class="table table-hover">
		<tr>
				<th>Players</th>
				<th></th>
				<th>R</th>
				<th>B</th>
				<th>4s</th>
				<th>6s</th>
				<th>SR</th>
		</tr>
		<?php foreach ($away_team_bat as $key => $value) {
		 ?>
		 <tr>
		 	<?php if(empty($value['Player']['first_name'])){ ?>
		 		<td><?php echo $value['NonMemberPlayer']['name']; ?></td>
		 	<?php  } else {?>
		 		<td><?php echo $value['Player']['first_name']; ?></td>
		 	<?php }  ?>
		 	
		 	<td><?php echo $value['FixtureBat']['detail'];?></td>
		 	<td><?php echo $value['FixtureBat']['run']?></td>
		 	<td><?php echo $value['FixtureBat']['balls']?></td>
		 	<td><?php echo $value['FixtureBat']['4s']?></td>
		 	<td><?php echo $value['FixtureBat']['6s']?></td>
		 	<td><?php echo $value['FixtureBat']['sr']?></td>
		 </tr>
		<?php } ?>
	</table>
		<h3>Balling Statistics</h3>

	<table class="table table-hover">
		<tr>
				<th>Players</th>
				<th>O</th>
				<th>M</th>
				<th>R</th>
				<th>W</th>
				<th>Econ</th>
				<th>Extras</th>
		</tr>
		<?php foreach ($away_team_ball as $key => $value) {?>
		 <tr>
		 	<?php if(empty($value['Player']['first_name'])){ ?>
		 		<td><?php echo $value['NonMemberPlayer']['name']; ?></td>
		 	<?php  } else {?>
		 		<td><?php echo $value['Player']['first_name']; ?></td>
		 	<?php }  ?>
		 	
		 	<td><?php echo $value['FixtureBall']['o'];?></td>
		 	<td><?php echo $value['FixtureBall']['m']?></td>
		 	<td><?php echo $value['FixtureBall']['r']?></td>
		 	<td><?php echo $value['FixtureBall']['w']?></td>
		 	<td><?php echo $value['FixtureBall']['econ']?></td>
		 	<td><?php echo $value['FixtureBall']['extra']?></td>
		 </tr>
		<?php }?>
	</table>
</div>