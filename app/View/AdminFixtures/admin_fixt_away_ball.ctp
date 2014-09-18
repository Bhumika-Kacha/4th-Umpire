<?php
	/*echo "<pre>"; print_r($away_team); 
	echo "<pre>"; print_r($away_id);
	echo "<pre>"; print_r($players); */

	$j=0;
	$p_name[]='select';
	foreach ($players as $key => $value) {
		$j++;
		$p_name[$value]=$value;
	}
?>
<h2><?php echo $away_team." "."Balling Statistics"; ?></h2>
<table id="myTable">
		<tr>
			<th>Player Name</th>
			<th>Over(O)</th>
			<th>Match(M)</th>
			<th>Run(R)</th>
			<th>Wickets(W)</th>
			<th>Extras</th>
		</tr>

		<?php for ($i=0; $i < $j ; $i++) { ?>
			<tr class=<?php echo $i;?>>
			<td><?php echo $this->Form->input('Away'.$i.'playername',array('label'=>false,'type'=>'select','options'=>$p_name)); ?></td>
			<td><?php echo $this->Form->input('Away'.$i.'over',array('label'=>false,'type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('Away'.$i.'match',array('label'=>false,'type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('Away'.$i.'run',array('label'=>false,'type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('Away'.$i.'wickets',array('label'=>false,'type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('Away'.$i.'extra',array('label'=>false,'type'=>'text')); ?></td>


		</tr>
		 <?php } ?>
		<?php echo $this->Form->input('id',array('label'=>false,'type'=>'hidden','value'=>$away_id)); ?>
		<?php echo $this->Form->input('team',array('label'=>false,'type'=>'hidden','value'=>$team)); ?>

 </table>
