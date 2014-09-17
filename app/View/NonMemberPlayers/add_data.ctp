<div>
<?php   
			echo $this->Form->create(null, array(
                                            'url' => array('controller' => 'NonMemberPlayers', 
                                                             'action' => 'add_data',$fixtureid,$nonid)
                                    ));
?>

<table id="myTable">
		<tr>
			<th>Player Name</th>
		</tr>
		<?php for ($i=0; $i <11 ; $i++) { ?>
		<tr class=<?php echo $i;?>>
			<td><?php echo $this->Form->inupt($i.'playername',array('label'=>false,'type'=>'text')); ?></td>

		</tr>
		 <?php } ?>

		

 </table>
 		<?php echo $this->Form->end('Save');  ?>

 </div>
