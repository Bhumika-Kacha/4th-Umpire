<?php if($this->Session->check('admin')){ ?>
	<?php echo $this->Html->link("ADD",array('controller'=>'AdminFixtures','action'=>'admin_add')); }	?>
<div>
	<table class="table table-hover">
	
			<tr>
				<th>Date</th>
				<th>Opponant Team</th>
				<th>Venue</th>
				<th>Result</th>
			</tr>
			<?php
		foreach ($fixture as $key => $value) { ?>
			<tr>
				<td><?php echo $value['Fixture']['datetime'];  ?></td>
				<?php
					if(empty($value['Team']['team_name'])){ ?>
						<td><?php echo $value['NonMemberTeam']['team_name'];  ?></td>
					<?php }
					else{ ?>
							<td><?php echo $value['Team']['team_name'];  ?></td>
						<?php }	
				?>
				
				<td><?php echo $value['Fixture']['venue'];  ?></td>
				<td><?php echo $this->Html->link($value['Fixture']['result'],array('controller'=>'Fixtures','action'=>'fixture_stat',$value['Fixture']['id'])); ?></td>
				<?php if($this->Session->check('admin')){ ?>

				<td>	<p><?php echo $this->Html->link("Edit",array('controller'=>'AdminFixtures','action'=>'edit_index',$value['Fixture']['id'])); ?></p>
						<p><?php echo $this->Form->postLink(__('Delete'), array('controller'=>'AdminFixtures',
                               'action' => 'admin_delete',
                                $value['Fixture']['id']),
                                null, 
                                __('Are you sure you want to delete # %s?', 
                                $value['Fixture']['id']));  ?></p></td>
				<?php  }?>
			</tr>


	<?php
		}
	?>
	</table>
</div>