<fieldset class="link_type">
			<ul class='link_type'>
				<li><span>Pages</span>					
					<ul class="sub">
						<li><li><?php echo $this->Html->link('Home Page', array('action' => 'add',$itemId, $menuTypeId, 'home'), array('target' => '_parent'));?></li></li>
					</ul>
				</li>
				<li><span>Articles</span>					
					<ul class="sub">
						<li><?php echo $this->Html->link('Single Article', array('action' => 'add',$itemId, $menuTypeId, 'Single_Article'), array('target' => '_parent'));?></li>
						<li><?php echo $this->Html->link('Featured Articles', array('action' => 'add',$itemId, $menuTypeId, 'Featured_Articles'), array('target' => '_parent'));?></li>
						<li class="last"><?php echo $this->Html->link('Submit Article', array('action' => 'edit',$itemId, $menuTypeId, 'Submit_Article'), array('target' => '_parent'));?></li>
					</ul>
					
				</li>				
				<li><span>Categories</span>
					<ul class="sub">
						<li>List All Categories</li>
						<li><?php echo $this->Html->link(__('Category Blog'), array('action' => 'add',$itemId, $menuTypeId, 'category_blog'), array('target' => '_parent'));?></li>
						<li class="last">Category List</li>
					</ul>
				</li>
				<li><span>Blogs</span></li>
			</ul>
</fieldset>