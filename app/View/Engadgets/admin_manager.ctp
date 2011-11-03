<div class="engadgats manager">
	<h2><?php echo $title_layout;?></h2>
</div>
<div class="clear"></div>
<div id="table-content">
	<table  cellpadding="0" cellspacing="0">
		<tr>
			<th>
				<input type="checkbox" id="paradigm_all">
			</th>
			<th><h3><?php echo $this->Paginator->sort(__('name'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('location'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('status'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('type'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('version'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('date'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('author'));?></h3></th><br/>
			<th><h3><?php echo $this->Paginator->sort(__('folder'));?></h3></th>
		</tr>
		<?php
			$i =0;
			foreach ($engadgets as $engadget):
				$class = null;
				if($i++ % 2 == 1){
					$class= 'class="altrow"';
				}
		?>
		<tr <?php echo $class;?>>
			<td class="select-all"><?php echo $this->Form->checkbox('id', array('name'=> 'id', 'value' => $engadget['Engadget']['id']));?></td>

			<td><?php echo $engadget['Engadget']['name'];?></td>
			<td><?php echo $engadget['Engadget']['location'];?></td>
			<td><?php echo $this->Layout->getStatus($engadget['Engadget']['status'], 'img');?></td>
			<td><?php echo $engadget['Engadget']['type'];?></td>
			<td><?php echo $engadget['Engadget']['version'];?></td>
			<td><?php echo $engadget['Engadget']['date'];?></td>
			<td><?php echo $engadget['Engadget']['author'];?></td>
			<td><?php echo $engadget['Engadget']['folder'];?></td>
			
		</tr>
		<?php endforeach;?>
	</table>
</div>
<div class="clear"></div>