<?php
/*
* Twiter widget - allows you to show you latest tweet based on my-recent-tweets
*/

add_action( 'widgets_init', 'twidget_widget' );

function twidget_widget() {
	register_widget( 'Twidget_Widget' );
}


class Twidget_Widget extends WP_Widget {

	function Twidget_Widget() {
	
		 parent::WP_Widget(false, 'Twitter Widget');
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'twidget-widget', 'description' => 'Twidget widget - allows you to show your latest tweet (based on my-recent-tweets widget)' );

		/* Widget control settings. */
		$control_ops = array( 'username' => '');

		/* Create the widget. */
		$this->WP_Widget( 'twidget-widget', 'Twidget Widget', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		
		$atts = array('user'=>$instance['username']);
		
		//echo $instance['username'];
		
		    echo '<div id="twidget">
<span id="twi_auth">@<a href="http://twitter.com/'.$instance['username'].'">'.$instance['username'].'</a>:</span>
<span id="twitter_update_list">
</span>
<script type="text/javascript">
jQuery.getJSON("http://api.twitter.com/1/statuses/user_timeline/'.$instance['username'].'.json?callback=?&include_rts=true&count=1",
       function(data){jQuery("#twitter_update_list").hide();jQuery.each(data, function(i,item){jQuery("#twitter_update_list").append(item.text);});jQuery("#twitter_update_list").fadeIn("slow");});</script>
</div>
';
		
		
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $new_instance;

		/* Strip tags (if needed) and update the widget settings. */
		
		
		return $instance;
	}
	
	function form( $instance ) {

		$defaults = array( 'username' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>">Twitter Username:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" style="width:50px" />
		</p>
		
						
			<?php
	}
	
	
	
}


?>