<?php
	if (!class_exists("Plum_Code_Box_Admin")) {
		class Plum_Code_Box_Admin {
			function add_post_meta_boxes() {
				add_meta_box('Plum_Code_Box','Plum Code Box',array(&$this, 'menu_post_meta'),'post','normal','high');
				add_meta_box('Plum_Code_Box','Plum Code Box',array(&$this, 'menu_post_meta'),'page','normal','high');
			}
			
			function menu_post_meta() {
				require(WP_PLUGIN_DIR."/plum-code-box/interfaces/admin_post.php");
			}
			
			function save_post_meta_boxes($post_id) {
				if (!wp_verify_nonce($_POST["Plum_Code_Box_nonce"], "Plum_Code_Box"))
					return $post_id;
					
				if ( 'page' == $_POST['post_type'] ) {
					if (!current_user_can( 'edit_page', $post_id))
						return $post_id;
				} else {
					if (!current_user_can( 'edit_post', $post_id))
						return $post_id;
				}
				
				foreach($_POST as $key => $value) {
					if(substr($key,0,strlen("Plum_Code_Box")) == "Plum_Code_Box" && $key != "Plum_Code_Box_nonce" && $value != "") {
						$data[$key] = $value;
					}
				}
						
				update_post_meta($post_id, "Plum_Code_Box_data", $data);
				
				return true;
			}
		}
	}
	
	if (class_exists("Plum_Code_Box_Admin")) {
		$Plum_Code_Box_Admin = new Plum_Code_Box_Admin();
	}
	
	add_action('add_meta_boxes', array(&$Plum_Code_Box_Admin, 'add_post_meta_boxes'));
	add_action('save_post', array(&$Plum_Code_Box_Admin, 'save_post_meta_boxes'));
?>