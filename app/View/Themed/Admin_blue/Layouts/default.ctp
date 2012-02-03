<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array(
			'reset',
			'960_12_col',
            'admin/layout',
            'forms',
            'admin/vertical-tabs',           
            'ui/redmond/jquery.ui.all',
            'colorbox'
        ));
		echo $this->Html->script(array(
				'jquery-1.6.4.min',
				'ui/jquery-ui-1.8.16.custom',
				'ui/jquery-ui-timepicker-addon',
				/*'ui/jquery.ui.core',
				'ui/jquery.ui.widget',
				'ui/jquery.ui.tabs',
				'ui/jquery.ui.mouse',
				'ui/jquery.ui.button',
				'ui/jquery.ui.draggable',
				'ui/jquery.ui.position',
				'ui/jquery.ui.dialog',
				'ui/jquery.ui.datepicker',*/
				'../ckeditor/ckeditor',
				'jquery.colorbox'
		));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		//echo $this->fetch('script');
	?>
</head>
<body>
<div id="wrapper">
		<?php echo $this->element('admin/header'); ?>
         <div class="clear"></div>         
		<div id="main">

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth');?>

			<?php echo $this->fetch('content'); ?>
		</div>
		
	</div>
	  <div class="clear"></div>
    <?php echo $this->element('admin/footer'); ?>
    <!-- JS Tabs -->
<script>
	$(function() {
		$( ".vertical-tabs" ).tabs().addClass( "ui-helper-clearfix" ).removeClass("ui-corner-all").removeClass("ui-tabs");
	});
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>
		
<script>
		
		$(document).ready(function()
		{
			$("#paradigm_all").click(function()				
			{
				var checked_status = this.checked;
				$("input[name=id]").each(function()
				{
					this.checked = checked_status;
				});
			});					
		});
		$(function() {
			$( ".datetimepicker" ).datetimepicker({			
				timeFormat: 'h:mm',
				dateFormat: 'yy-mm-dd'
			});
		
		});
		$("input#ContentTitle, input#CategoryTitle, input#MenuTitle").keyup(function () {
      	var value = $(this).val().toLowerCase();
      		$("input.slug").val(value.replace(/ /g, "_"));
    	}).keyup();
    	$("input:checkbox:checked").keyup(function () {
      	var value = $(this).val();
      		$("span").value;
    	}).keyup();
    	
    
    	  $("select#ContentRoleId, select#MenuRoleId").change(function () {
          var str = "";
          $("select#ContentRoleId option:selected, select#MenuRoleId option:selected").each(function () {
                str += $(this).text() + " ";
              });
          $("input#ContentAccess, input#MenuAccess").val(str);
        })
        .change();
        $("select#ContentUserId, select#MenuUserId").change(function (){
        	var str = "";
        	$("select#ContentUserId option:selected, select#MenuUserId option:selected").each(function(){
        		str += $(this).text() + " ";
        	});
        	$("input#ContentCreatedBy, input#MenuCreatedBy").val(str);
        })
        .change();
        $(".list-type").colorbox({iframe:true, width:"70%", height: "60%", opacity: "0.7"});
         $("a.colorbox").colorbox({iframe:true, width:"70%", height: "60%", opacity: "0.7"});
        
	/*top menu 
	var site = function() {
		this.navLi = $('#nav li').children('ul').hide().end();
		this.init();
	};*/
</script>
<!--
<script>
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 100;
</script>
-->
<?php 
echo $this->fetch('scriptBottom');
echo $this->Js->writeBuffer();?>
?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
