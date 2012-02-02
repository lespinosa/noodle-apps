<?php 
class TreeHelper extends Helper
{

    var $tab = "";
    var $helpers = array('Html');
	var $nFields;

    // Main Function
    function show($title, $data, $style='')
    {
        list($modelName, $fieldName) = explode('/', $title);
        if ($style=='options') {
            $output = $this->selecttag_options_array($data, $modelName, $fieldName, $style, 0);
        } else {
            //$style='';
            $output = $this->list_element($data, $modelName, $fieldName, $style, 0);
        }
        return $this->output($output);
    } 
	function showLink($data, $modelName, $fieldName, $style=''){
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
      
        foreach ($data as $key=>$val)
        {	
            $output .=  $this->getStyle($val[$modelName], $modelName, $fieldName, $style);
echo $val['children']['title'];
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
	function list_element($data, $modelName, $fieldName, $style, $level)
    {
        $tabs = "\n" . str_repeat($this->tab, $level * 2);
        $li_tabs = $tabs . $this->tab;

        $output = $tabs. "<ul>";
        foreach ($data as $key=>$val)
        {
            $output .= $li_tabs . "<li>".$this->style_print_item($val[$modelName], $modelName, $style);
			echo $val[$modelName]['title'];
            if(isset($val['children'][0]))
            {	$output .=  "<span class='ch'>";
                $output .= $this->list_element($val['children'], $modelName, $fieldName, $style, $level+1);
                $output .=  "</li>";
            }
            else
            {
                $output .= "</span></li>";
            }
        }
        $output .= "</ul>";
        return $output;
    }
	

    // this handles the formatting of the links if there necessary
    function style_print_item($item, $modelName, $style='')
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
                $output = $item['title'];
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
			$output = '<tr>';			
				for($i = 0; $i < $this->nFields; $i++){
					if($item['parent_id'] > 1){
						$output .= '<td><div id="children" class='.$fieldName[$i].'>'.$item[$fieldName[$i]].'</div></td>';
					} else {
						$output .= '<td><div class='.$fieldName[$i].'>'.$item[$fieldName[$i]].'</div></td>';
					}
					
				
				}
			$output .= '</tr>';                
        }
    return $output;
    }
	function getStyle2($item, $modelName, $fieldName, $style='')
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
	
					if($item['parent_id'] > 1){
						$output = '<div id="children" class='.$fieldName.'>'.$item[$fieldName].'</div>';
					} else {
						$output = '<div class='.$fieldName.'>'.$item[$fieldName].'</div>';
					}
					
				
			             
        }
    return $output;
    }
    
    // recursively reduces deep arrays to single-dimensional arrays
    // $preserve_keys: (0=>never, 1=>strings, 2=>always)
    // Source: http://php.net/manual/en/function.array-values.php#77671
    function array_flatten($array, $preserve_keys = 1, &$newArray = Array()) 
    {
          foreach ($array as $key => $child) 
          {
            if (is_array($child)) 
            {
                  $newArray =& $this->array_flatten($child, $preserve_keys, $newArray);
            } 
            elseif ($preserve_keys + is_string($key) > 1) 
            {
                  $newArray[$key] = $child;
            } 
            else 
            {
                  $newArray[] = $child;
            }
          }
          return $newArray;
    }

    // for formatting selecttag options into an associative array (id, title)
    function selecttag_options_array($data, $modelName, $fieldName, $style, $level)
    {
        // html code does not work here
        // tried using " " and it didn't work
        $tabs = "-";
        
        foreach ($data as $key=>$val)
        {
            $output[] = array($val[$modelName]['id'] => str_repeat($tabs, $level*2) . ' ' . $val[$modelName]['title']);
        
            if(isset($val['children'][0]))
            {
                $output[] = $this->selecttag_options_array($val['children'], $modelName, $fieldName, $style, $level+1);
            }
        }
        
        $output = $this->array_flatten($output, 2);
        return $output;
    }
} 