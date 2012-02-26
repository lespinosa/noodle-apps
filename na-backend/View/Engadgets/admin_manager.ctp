<div class="engadgats manager">

	<?php echo $this->Form->create('Engadget', array('action' => 'batch_process'));?>
	<?php echo $this->Layout->toolBar('engadget');?>
	
<div id="table-content">
	<table>
		<tr class="header">
			<th><input type="checkbox" id="paradigm_all"></th>
			<th><h3><?php echo $this->Paginator->sort(__('id'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('title'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('location'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('status'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('type'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('version'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('date'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('author'));?></h3></th>
			<th><h3><?php echo $this->Paginator->sort(__('action'));?></h3></th>
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
			<td class="select-all">
			<?php $id = $engadget['Engadget']['id'];
			echo $this->Form->checkbox('Engadget.'.$id.'.id', array('class' => 'select_all'));?></td>
			<td class="id"><?php echo $engadget['Engadget']['id'];?></td>
			<td><?php echo $engadget['Engadget']['title'];?></td>
			<td><?php echo $engadget['Engadget']['location'];?></td>
			<td><?php echo $this->Layout->getStatus(null, null, $engadget['Engadget']['status'], 'img');?></td>
			<td><?php echo $engadget['Engadget']['type'];?></td>
			<td><?php echo $engadget['Engadget']['version'];?></td>
			<td><?php echo $engadget['Engadget']['date'];?></td>
			<td><?php echo $engadget['Engadget']['author'];?></td>
			<td>
					<?php echo $this->Html->link(
							$this->Html->image('admin/icons/canc_icon.png', array('alt' => 'Uninstall')), 
							array('action' => 'uninstall', $engadget['Engadget']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to uninstall Engadget '.$engadget['Engadget']['name'], true), 'class' => ''));?>
			</td>
			
		</tr>
		<?php endforeach;?>
	</table>
</div>
 <?php
        echo $this->Form->input('Engadget.action', array(
            'label' => false,
            'style' => 'display:none',
            'options' => array(
                'publish' => __('Publish'),
                'unpublish' => __('Unpublish'),
                'delete' => __('Delete'),
            ),
            'empty' => true,
        ));?>
	<?php echo $this->Form->end(array('type' => 'hidden'));?>
	
</div>
<div class="clear"></div>