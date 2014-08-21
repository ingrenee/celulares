<?php

/*  	
* Google Maps with address widget
* Allows to show contact information including address and shows the location specified in address on the map 
*/	
	
	class Googaddress_Widget extends WP_Widget {  
	    function Googaddress_Widget() {  
	        parent::WP_Widget(false, 'Address Widget');  
	    }  
		
		function form($instance) {  
	        $defaults = array( 'title' => 'Location' );
			$instance = wp_parse_args( (array) $instance, $defaults ); 
			?>
			<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
		</p>

			<?php
	    }  
		
		function update($new_instance, $old_instance) {  
	       
	        return $new_instance;  
	    }  
		
		function widget($args, $instance) {  
	    
	        extract( $args );

			$title = apply_filters('widget_title', $instance['title'] );
			echo $before_widget;
			
			
			if ( $title )
				echo $before_title . $title . $after_title;
				
				?>
				<ul class="address">
						<?php $ph = get_option('cphone'); if($ph != '' ) : ?> <li class="cphone"><?php echo $ph; ?></li><?php endif; ?>
						<?php $fx = get_option('cfax'); if($fx != '' ) : ?> <li class="cfax"> <?php echo $fx; ?></li><?php endif; ?>
						<?php $email = get_option('cgemail'); if($email != '' ) : ?> <li class="cemail"> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li><?php endif; ?>
						<?php $add = get_option('caddress'); if($add != '' ) : ?> <li class="caddress"> <?php echo $add; ?></li><?php endif; ?>
						
					</ul>
				
				
				
				<?php
			
			echo $after_widget;

	    }  
	} 


register_widget('Googaddress_Widget');  
?>