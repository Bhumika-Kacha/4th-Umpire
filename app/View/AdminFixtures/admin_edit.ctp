<?php
	// /echo "<pre>"; print_r($fixturedata); exit;

?>
<script type="text/javascript">
 $(document).ready(function() {
       // $( "#datepicker" ).datepicker();
        $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
});

</script>
<div>

<?php 
            echo $this->Form->create("fixture", array(
                                                  'url' => array('controller' => 'AdminFixtures', 
                                                                  'action' => 'admin_edit',$fixtureid)
                                    ));
?>
			<fieldset>
				<div>
					<?php foreach ($fixturedata as $key => $value) {
						//echo "<pre>"; print_r($value); exit;
					 ?>
					<p>
						<label>Date :</label>
						<input name="datepicker" id="datepicker" value='<?php echo $value['Fixture']['datetime'];  ?>' type="text">
					</p>
					<p>
                		<label>Venue :</label>
                		<input name="venue" id="venue" value='<?php echo $value['Fixture']['venue']; ?>'  type="text">
					</p>
					<p>
						<label>Opponant Team :</label>
					<?php  if(empty($value['Team']['team_name'])){ ?>
						<input name="opponant_team" id="opponant_team" value='<?php echo $value['NonMemberTeam']['team_name'];  ?>' type="text" readonly>

					<?php } else { ?>

						<input name="opponant_team" id="opponant_team" value='<?php echo $value['Team']['team_name'];  ?>' type="text" readonly>
					<?php } ?>   
					
                		
					</p>
					<p>
						<label>Result :</label>
                		<input name="result" id="result" value='<?php echo $value['Fixture']['result'];  ?>' type="text">
					</p>
					<p>
						<label>Winner Team :</label>
						<?php  if(empty($value['Winner']['team_name'])){ ?>
						<input name="winner" id="winner" value='<?php echo $value['NonMemberWinner']['team_name'];  ?>' type="text">

					<?php } else { ?>

						<input name="winner" id="winner" value='<?php echo $value['Winner']['team_name'];  ?>' type="text">
					<?php } ?>
                		
					</p>	
					
					<?php } ?>
					<p>
                		<input type="submit" value="Update" class="submit"/>
             		</p>
				</div>
			</fieldset>	
			</form>
</div>	