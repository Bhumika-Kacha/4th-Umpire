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
		<?php for ($i=0; $i <11 ; $i++) { ?>
			<tr class=<?php echo $i;?>>
			<td><?php echo $this->Form->input('Away'.$i.'playername',array('label'=>false,'type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('Away'.$i.'over',array('label'=>false,'type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('Away'.$i.'match',array('label'=>false,'type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('Away'.$i.'run',array('label'=>false,'type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('Away'.$i.'wickets',array('label'=>false,'type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('Away'.$i.'extra',array('label'=>false,'type'=>'text')); ?></td>






			<!-- <td><input name=<?php echo 'Away'.$i."playername" ?> value="" type="text"></td>
			<td><input name=<?php echo 'Away'.$i."over" ?> value="" type="text"></td>
			<td><input name=<?php echo 'Away'.$i."match" ?> value="" type="text"></td>
			<td><input name=<?php echo 'Away'.$i."run" ?> value="" type="text"></td>
			<td><input name=<?php echo 'Away'.$i."wickets" ?> value="" type="text"></td>
			<td><input name=<?php echo 'Away'.$i."extra" ?> value="" type="text"></td> -->


		</tr>
		 <?php } ?>
<!-- 		<input name=<?php echo 'id' ?> value=<?php echo $away_id;  ?> type="hidden">  -->
		<?php echo $this->Form->input('id',array('label'=>false,'type'=>'hidden','value'=>$away_id)); ?>

 </table>
