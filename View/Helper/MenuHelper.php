<?php 
class MenuHelper extends Helper
{

    var $tab = "";
    var $helpers = array('Html', 'Form');
	var $nFields;

    // Main Function

	function show($data, $modelName, $fieldName, $style=''){
		$this->nFields = count($fieldName);
		 if ($style=='options') {
            $output = $this->selecttag_options_array($data, $modelName, $fieldName, $style, 0);
        } else {
        	$output = $this->getElement($data, $modelName, $fieldName, $style, 0);
		}
		return $this->output($output);
	}

    // This creates a list with optional links attached to it
    function getElement($data, $modelName, $fieldName, $style, $level)
    {
        $tabs = "_" . str_repeat($this->tab, $level * 2);
        $li_tabs = $tabs;
		$output = '';
        $i = 0;
        foreach ($data as $key=>$val)
        {	$this->class = null;
		
			if ($i++ % 2 == 1) {
				$this->class = ' class="altrow"';
			}
				
            $output .=  $this->getStyle($val[$modelName], $modelName, $fieldName, $style);

            if(isset($val['children'][0]))
            {
				
                $output .=  $this->getElement($val['children'], $modelName, $fieldName, $style, $level+1);			
	
            }
            else
            {
            	//$output .= "</span>";
            }
			
        }
  		
        return $output;
    }
	function getStyle($item, $modelName, $fieldName, $style='')
    {
        switch ($style)
        {
            case "link":
                $output = $this->Html->link($item['title'], "view/".$item['id']);
            break;
            
            case "admin":
                $output = $item['title'];
                $output .= $this->Html->link(" edit", "edit/".$item['id']);
                $output .= " ";
                $output .= $this->Html->link(" del", "delete/".$item['id']);
            break;
    
            default:
			$output = '<tr '.$this->class.'>';	
			$output .= '<td>'.$this->Form->checkbox('').'</td>';		
				for($i = 0; $i < $this->nFields; $i++){
				
					if($item['parent_id'] > 1){
						$output .= '<td><div id="children" class='.$fieldName[$i].'>'.$item[$fieldName[$i]].'</div></td>';
					} else {
						$output .= '<td><div class='.$fieldName[$i].'>'.$item[$fieldName[$i]].'</div></td>';
					}
					
				
				}
			$output .= '<td>'.$this->Form->checkbox('').'</td>';
			$output .= '</tr>';                
        }
    return $output;
    }
	
} 