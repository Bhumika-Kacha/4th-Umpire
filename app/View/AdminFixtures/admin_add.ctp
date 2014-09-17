<script type="text/javascript">
 $(document).ready(function() {
       // $( "#datepicker" ).datepicker();
        $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });

        $('#pother_team').css("display","none");
        $('#padd_other').css("display","none");

        $( "#opponant_team" ).change(function() {
            
                name=$( "#opponant_team option:selected" ).text();
                if(name=="others")
                {
                 $("#pother_team").css('display','block');
                }
                else
                {
                    $('#pother_team').css("display","none");
                    $('#padd_other').css("display","none");

                }
                
        });

        $('#other_team').change(function(){
                  name=$("#other_team option:selected").text();
                  if(name=="No Team Found" || name=="others")
                  {
                    $("#padd_other").css('display','block');
                  }
                  else
                  {
                    $('#padd_other').css("display","none");

                  }
        });
                
        });

</script>
<?php
    $home['select']='select';
    if(!empty($home_team)){
         
        foreach ($home_team as $key => $value) {
            
            $home[$value['Team']['team_name']]=$value['Team']['team_name'];
        }
        $home['others']='others';
    }
    else
    {
        $home['No Team Found']='No Team Found';
    }
    $away['select']='select';
    if(!empty($away_team))
    {
        
        foreach ($away_team as $key => $value) {
            $away[$value['NonMemberTeam']['team_name']]=$value['NonMemberTeam']['team_name'];
        }
        $away['others']='others';
    }
    else
    {
        $away['No Team Found']='No Team Found';
    }

?>

<div>
	<?php 
            echo $this->Form->create("fixture", array(
                                                  'url' => array('controller' => 'AdminFixtures', 
                                                                  'action' => 'admin_add')
                                    ));
       ?>

	<fieldset>
        <div>
             <p>
                <label>Date :</label>
                <?php echo $this->Form->input('datepicker',array('label'=>False,'type'=>'text','id'=>'datepicker')); ?>
             </p> 
             <p>
                <label>Venue :</label>
                <?php echo $this->Form->input('venue',array('label'=>False,'type'=>'text')); ?>
             </p>
             <p>
                <label>Opponant Team :</label>
                <?php echo $this->Form->input('opponant_team',array('label'=>False,'type'=>'select','options'=>$home,'id'=>'opponant_team')); ?>
             </p> 
             <div id="pother_team">
                 <p>
                    <label>Other Team:</label>
                    <?php echo $this->Form->input('other_team',array('label'=>False,'type'=>'select','options'=>$away,'id'=>'other_team')); ?>
                 </p>
            </div>
            <div id="padd_other">
                 <p>
                    <label>Add Other Team:</label>
                    <?php echo $this->Form->input('add_other',array('label'=>False,'type'=>'text')); ?>
                 </p>
            </div>
             <p>
                <label>Result :</label>
                <?php echo $this->Form->input('result',array('label'=>False,'type'=>'text')); ?>
             </p> 
             <p>
                <label>Winner Team :</label>
                <?php echo $this->Form->input('winner',array('label'=>False,'type'=>'text')); ?>
             </p>
             <p>
                <input type="submit" value="Save" class="submit"/>
             </p>
               
        </div>
    </fieldset>
</form>
</div>

