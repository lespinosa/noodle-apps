<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array(
			'reset',
			'960_12_col',
            'admin/layout',
            'admin/vertical-tabs',
            'forms',
            'ui/redmond/jquery.ui.all'
        ));
		echo $this->Html->script(array(
				'jquery-1.6.4.min',
				'ui/jquery.ui.core',
				'ui/jquery.ui.widget',
				'ui/jquery.ui.tabs',
				'ui/jquery.ui.mouse',
				'ui/jquery.ui.button',
				'ui/jquery.ui.draggable',
				'ui/jquery.ui.position',
				'ui/jquery.ui.dialog',
				'ui/jquery.ui.datepicker',
				'../ckeditor/ckeditor',
				
		));
		echo $scripts_for_layout;
	?>
</head>

<body>

	 <div id="wrapper">
        <?php echo $this->element('admin/header'); ?>
         <div class="clear"></div>
        <div id="main">
        	<ul class="crumbs">
	      	  <li><?php echo $this->Html->getCrumbs(' > ','Home Site'); ?></li>     
	        </ul> 

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth');?>

			<?php echo $content_for_layout; ?>

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
<script type="text/javascript">
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
		var _imageR = "/noodleapps/img/admin/icons/calendar.gif";
		$(function() {
			$( ".datepicker" ).datepicker({			
				showOn: "button",
				buttonImage: _imageR,
				buttonImageOnly: true,
				dateFormat: 'yy-mm-dd'
			});
		
		});
		$("input#ContentTitle, input#CategoryTitle").keyup(function () {
      	var value = $(this).val();
      		$("input.slug").val(value.replace(/ /g, "_"));
    	}).keyup();
    	
    	  $("select#ContentRoleId").change(function () {
          var str = "";
          $("select#ContentRoleId option:selected").each(function () {
                str += $(this).text() + " ";
              });
          $("input#ContentAccess").val(str);
        })
        .change();
        $("select#ContentUserId").change(function (){
        	var str = "";
        	$("select#ContentUserId option:selected").each(function(){
        		str += $(this).text() + " ";
        	});
        	$("input#ContentCreatedBy").val(str);
        })
        .change()
	//top menu 
	var site = function() {
		this.navLi = $('#nav li').children('ul').hide().end();
		this.init();
	};
		
</script>
<?php echo $this->Js->writeBuffer();?>
</body>
</html>