<?php
/*echo "<pre>"; print_r($fixtureid); 
echo "<pre>"; print_r($nonid); 
echo "<pre>"; print_r($player); exit;*/
?>
<div>
	<!-- <table>
		<tr>
			<th>Player Name</th>
		</tr>
		<?php
			foreach ($player as $key => $value) {
		?>
		<tr>
			<td><input name=<?php echo $key.'player'; ?> value='<?php echo $value['NonMemberPlayer']['name'];?>' type="text"  /></td>
		</tr>
		<?php
			   }   
		?>
	</table> -->
	<?php   
			echo $this->Form->create(null, array(
                                            'url' => array('controller' => 'NonMemberPlayers', 
                                                             'action' => 'search_add',$fixtureid,$nonid)
                                    ));
	?>
		<?php
			foreach ($player as $key => $value) {
		?>

		<input name=<?php echo 'old'.$key.'player'; ?> value='<?php echo $value['NonMemberPlayer']['name'];?>' type="text"  />
		<?php  } ?>
			<div id="p_scents">
			    
			</div>

			<input type="submit" value="Submit" class="submit"/>

</form>
<div class="add_input">ADD Input</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
		var scntDiv = $('#p_scents');
        var i = $('#p_scents p').size() + 1;
    
        
        $('.add_input').click(function() {
                $('<p><label for="p_scnts"><input type="text" id="p_scnt"  name="new_player' + i +'" value="" /></label> </p>').appendTo(scntDiv);
                i++;
                return false;
        });
        
        
});
</script>
<STYLE TYPE="text/css">
.add_input
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