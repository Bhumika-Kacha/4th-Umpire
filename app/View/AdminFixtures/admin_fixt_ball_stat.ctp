<?php

	//echo "<pre>"; print_r($playername_home); exit;
	$p_name[]='select';
	foreach ($playername_home as $key => $value) {
		//echo "<pre>"; print_r($value['player']); exit;
		$k=$value['player']['first_name'];
		$p_name[$k]=$k;
	}
	// echo "<pre>"; print_r($p_name); exit;
  ?>
<div>
	<?php 
            echo $this->Form->create(null, array(
                                                  'url' => array('controller' => 'AdminFixtures', 
                                                                  'action' => 'admin_fixt_ball_stat',$fixtureid)
                                    ));
       ?>
     <h2><?php echo $home_team['Team']['team_name'].' '.'Balling Statistics'; ?></h2>
    <div id="HomeTeam">
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
			<td><?php echo $this->Form->input('Home'.$i.'playername',array('label'=>false,'type'=>'select','options'=>$p_name)); ?></td>
			<td><?php echo $this->Form->input('Home'.$i.'over',array('label'=>false,'type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('Home'.$i.'match',array('label'=>false,'type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('Home'.$i.'run',array('label'=>false,'type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('Home'.$i.'wickets',array('label'=>false,'type'=>'text')); ?></td>
			<td><?php echo $this->Form->input('Home'.$i.'extra',array('label'=>false,'type'=>'text')); ?></td>




	<!-- 			<td><input name=<?php //echo 'Home'.$i."playername" ?> value="" type="text"></td> -->
 			<!-- <td><input name=<?php //echo 'Home'.$i."over" ?> value="" type="text"></td>
			<td><input name=<?php //echo 'Home'.$i."match" ?> value="" type="text"></td>
			<td><input name=<?php //echo 'Home'.$i."run" ?> value="" type="text"></td>
			<td><input name=<?php //echo 'Home'.$i."wickets" ?> value="" type="text"></td>
			<td><input name=<?php //echo 'Home'.$i."extra" ?> value="" type="text"></td> -->
		</tr>
		 <?php } ?>
	</table>
	<input type="hidden" value=<?php echo $fixtureid; ?> id="fid" />
	<div id="AwayTeam">
	

	</div>
	<input type="submit" value="Submit" class="submit"/>
</form>
	<div class="add_table">ADD Away Team Data</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	var ajaxurl = '<?php echo Router::Url(array('controller' => 'AdminFixtures', 'action' => 'admin_fixt_away_ball')); ?>';
	$('.add_table').click(function (){
		fixtureid=$('#fid').val();	
		data="fixtureid="+fixtureid;
		//url="admin_fixt_away_ball";
		$.ajax({
			url:ajaxurl,
			data:data,
			dataType:"html",
			type:"post",
			success:function(response){
				$('#AwayTeam').append(response);
				$(".add_table").css("display", "none");
			},
			error:function(response){}
		});
	});

	 

});
</script>

<STYLE TYPE="text/css">
.add_table
{
	background-color: windowframe;
    color: white;
    display: block;
    height: 40px;
    line-height: 40px;
    text-decoration: none;
    width: 100px;
    text-align: center;
    margin-top: 9px;
}
</STYLE>