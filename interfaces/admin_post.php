<?php
	global $post;
	
	wp_nonce_field("Plum_Code_Box","Plum_Code_Box_nonce");
	
	$Plum_Code_Box_data = get_post_meta($post->ID, 'Plum_Code_Box_data');
	$Plum_Code_Box_data = $Plum_Code_Box_data[0];
	
	//echo "<pre>".print_r($Plum_Code_Box_data,true)."</pre>";	//debug
	
	$Plum_Code_Box_type_array = array(
		"cplusplus" => "C++",
		"csharp" => "C#",
		"delphi" => "Delphi",
		"html" => "HTML",
		"java" => "Java",
		"javascript" => "Javascript",
		"php" => "PHP",
		"mysql" => "MySQL"
	);
	
	$Plum_Code_Box_number_of_boxes = $Plum_Code_Box_data['Plum_Code_Box_number_of_boxes'];
	
	echo
		"Number of boxes:
			<select id=\"Plum_Code_Box_number_of_boxes\" name=\"Plum_Code_Box_number_of_boxes\" onChange=\"Plum_Code_Box_display_boxes();\">";
	
	for($i = 1; $i <=10; $i++) {
		if($Plum_Code_Box_number_of_boxes == $i) {
			$selected = " selected";
		} else {
			$selected = "";
		}
	
		echo "<option value=\"".$i."\"".$selected.">".$i."</option>";
	}
	
	echo "</select>";
	
	for($i = 1; $i <=10; $i++) {
		$Plum_Code_Box_code[$i] = $Plum_Code_Box_data['Plum_Code_Box_code_'.$i.'_code'];
		$Plum_Code_Box_type[$i] = $Plum_Code_Box_data['Plum_Code_Box_code_'.$i.'_type'];
		
		echo
			"<div id=\"Plum_Code_Box_".$i."\"><h2>Codebox ".$i."</h2>
				<div style=\"float: right;\">
					<b>Shortcode:</b> [codebox ".$i."]
				</div>
				<select name=\"Plum_Code_Box_code_".$i."_type\">
				<option value=\"\"></option>";
			
		foreach($Plum_Code_Box_type_array as $key => $value) {
			if($Plum_Code_Box_type[$i] == $key) {
				$selected = " selected";
			} else {
				$selected = "";
			}
		
			echo "<option value=\"".$key."\"".$selected.">".$value."</option>";
		}

		echo			
				"</select>
				<textarea name=\"Plum_Code_Box_code_".$i."_code\" style=\"width: 100%; height: 100px;\">".$Plum_Code_Box_code[$i]."</textarea>
			</div>";
	}
?>
<script>
	function Plum_Code_Box_display_boxes() {
		var number_of_boxes = document.getElementById('Plum_Code_Box_number_of_boxes').value;
	
		for(i = 1; i <= 10; i++) {
			document.getElementById('Plum_Code_Box_' + i).style.display = 'none';
		}
		
		for(i = 1; i <= number_of_boxes; i++) {
			document.getElementById('Plum_Code_Box_' + i).style.display = 'block';
		}
	}
	
	Plum_Code_Box_display_boxes();
</script>