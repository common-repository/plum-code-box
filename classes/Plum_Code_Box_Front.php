<?php
	if (!class_exists("Plum_Code_Box_Front")) {
		class Plum_Code_Box_Front {
			function Plum_Code_Box_Front() {
				$url = plugins_url().'/plum-code-box';
				wp_register_script('chili', $url.'/chili/jquery.chili-2.2.js', array( 'jquery' ), '2.2');
				wp_enqueue_script('chili');
				wp_register_script('chili_recipes', $url.'/chili/recipes.js', array( 'chili' ), '2.2');
				wp_enqueue_script('chili_recipes');
			}
		
			function insert_code($content) {
				global $id;
	
				$Plum_Code_Box_data = get_post_meta($id, 'Plum_Code_Box_data');
				$Plum_Code_Box_data =$Plum_Code_Box_data[0];
				
				//echo "<pre>".print_r($Plum_Code_Box_data,true)."</pre>";	//debug
				
				for($i = 1; $i <=10; $i++) {
					$code = $Plum_Code_Box_data['Plum_Code_Box_code_'.$i.'_code'];
					$type = $Plum_Code_Box_data['Plum_Code_Box_code_'.$i.'_type'];
					
					if($code != "") {
						$code_insert =
							"<p>
								<pre class=\"Plum_Code_Box\">".
									"<code class=\"".$type."\">".
									str_replace("\t","  ",htmlspecialchars(stripslashes($code))).
									"</code>
									</pre>
							</p>";
						
						if(strpos($content, "[codebox ".$i."]")) {
							$content = str_replace("[codebox ".$i."]",$code_insert,$content);
						}
					}
				}
				
				return $content;
			}
		}
	}
	
	if (class_exists("Plum_Code_Box_Front")) {
		$Plum_Code_Box_Front = new Plum_Code_Box_Front();
		
		add_filter('the_content', array(&$Plum_Code_Box_Front, 'insert_code'));
	}
?>