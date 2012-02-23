<?php
foreach ($allCategories as $category) {
  	echo '<h3>' .$category['Category']['title'].'</h3>';
	echo '<br />'.$category['Category']['description'];
	echo '<ul class="child">';
	foreach ($category['Childcategory'] as $Childcategory) {
		echo '<li><h3>' . $Childcategory['title'].'</h3>';
		echo '<br />'.$Childcategory['description'].'</li>';
	}
	echo '</ul>';
}
?>