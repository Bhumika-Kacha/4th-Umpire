 <?php
        

  /*if ($this->Session->read('User.position') =='teamadmin') {*/

 /* } */
?>

<button type="button">
                          <a href="<?php echo $this->Html->url(array(
                          'controller' => 'News',
                          'action' => 'addnews')); ?>">
                          Add news</a></button>

<table table table-hover>
<tr>
 	<td rowspan="2">Image path</td>
 	<td>Title</td>
</tr>
<tr>
	<td>Description</td>
</tr>

<?php foreach ($data as $data) :?>

<tr>
	<td rowspan="3"> <?php echo  $data['Image']['url'] ;?>	</td>
	<td> <?php echo  $data['News']['title'] ;?> </td>
</tr>

<tr>
	<td><?php echo  $data['News']['desc'] ;?>
		<a href="<?php echo $this->Html->url(array(
                          'controller' => 'News',
                          'action' => 'view_news_desc',$data['News']['id'])); ?>">
                          Read More...</a></td>
</tr>
<tr>
	<td>
		<a href="<?php echo $this->Html->url(array(
                          'controller' => 'News',
                          'action' => 'removenews',$data['News']['id'])); ?>">Remove</a>

                     
        <a href="<?php echo $this->Html->url(array(
                          'controller' => 'News',
                          'action' => 'updatenews',$data['News']['id'])); ?>">Update</a>
                     
	</td>
</tr>

<?php endforeach ;?>

</table>







