<fieldset class="link_type">
			<ul class='link_type'>
				<li><span>Pages</span></li>
				<li><span>Articles</span>					
					<ul class="sub">
						<li><?php echo $this->Html->link('Single Article', array('action' => 'edit',$itemId, $menuTypeId, 'Single_Article'), array('target' => '_parent'));?></li>
						<li><?php echo $this->Html->link('Featured Articles', array('action' => 'edit',$itemId, $menuTypeId, 'Featured_Articles'), array('target' => '_parent'));?></li>
						<li class="last"><?php echo $this->Html->link('Submit Article', array('action' => 'edit',$itemId, $menuTypeId, 'Submit_Article'), array('target' => '_parent'));?></li>
					</ul>
					
				</li>				
				<li><span>Categories</span>
					<ul class="sub">
						<li>List All Categories</li>
						<li>Category Blog</li>
						<li class="last">Category List</li>
					</ul>
				</li>
				<li><span>Blogs</span></li>
			</ul>
</fieldset>