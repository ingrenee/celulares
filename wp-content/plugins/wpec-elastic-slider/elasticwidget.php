<?php 
	
	class ElasticWidget extends WP_Widget {
		
		
		function ElasticWidget(){
			
			$widget_opts = array (
					'classname' => 'wpec-elastic', 
					'description' => __('Short description of the plugin goes here.', 'wpecelasitc')
				);	
				
			$this->WP_Widget('wpec-elastic', __('WPEC Elastic', 'wpecelasitc'), $widget_opts);
				
			
		}
		
		
		function widget($args, $instance){
			
			extract($args);
			
			echo $before_widget;
				
				echo Elastic::display_elastic();
				 				
			echo $after_widget;
			
			
		}
	
	
	}
	
	add_action('widgets_init', create_function('', 'register_widget("ElasticWidget");'));  
	
?>