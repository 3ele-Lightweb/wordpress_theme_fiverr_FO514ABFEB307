<?php

class Life_In_Balance_Video_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'life_in_balance_video_widget_widget', 'description' => __( 'Display a video from Youtube, Vimeo etc.', 'life_in_balance') );
        parent::__construct(false, $name = __('Life_In_Balance: Video', 'life_in_balance'), $widget_ops);
		$this->alt_option_name = 'life_in_balance_video_widget';
    }
	
	function form($instance) {
		$title     	= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$url    	= isset( $instance['url'] ) ? esc_url( $instance['url'] ) : '';
		$video_mode = isset( $instance['video_mode'] ) ? esc_attr( $instance['video_mode'] ) : '';
		$text 		= isset( $instance['text'] ) ? wp_kses_post( $instance['text'] ) : '';
		
	?>

	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'life_in_balance'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<p><label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Paste the URL of the video (only from a network that supports oEmbed, like Youtube, Vimeo etc.):', 'life_in_balance' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo $url; ?>" size="3" /></p>
	<p><label for="<?php echo $this->get_field_id('video_mode'); ?>"><?php _e('Video mode:', 'life_in_balance'); ?></label>
        <select name="<?php echo $this->get_field_name('video_mode'); ?>" id="<?php echo $this->get_field_id('video_mode'); ?>">		
			<option value="vid-normal" <?php if ( 'vid-normal' == $video_mode ) echo 'selected="selected"'; ?>><?php echo __('Normal', 'life_in_balance'); ?></option>
			<option value="vid-lightbox" <?php if ( 'vid-lightbox' == $video_mode ) echo 'selected="selected"'; ?>><?php echo __('Lightbox', 'life_in_balance'); ?></option>
       	</select>
    </p>  
	<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text before the play button (only for lightbox mode):', 'life_in_balance' ); ?></label>
	<textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea></p>

	<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] 		= strip_tags($new_instance['title']);
		$instance['url'] 		= esc_url_raw($new_instance['url']);
		$instance['video_mode'] = sanitize_text_field($new_instance['video_mode']);		
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = wp_kses_post( $new_instance['text'] );
		}

		return $instance;
	}
	
	function widget($args, $instance) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		extract($args);

		$title 	= ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title 	= apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$url   	= isset( $instance['url'] ) ? esc_url( $instance['url'] ) : '';
		$video_mode = isset( $instance['video_mode'] ) ? esc_html($instance['video_mode']) : 'vid-normal';
		$text 	= isset( $instance['text'] ) ? $instance['text'] : '';
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		
		if( ($url) ) {
			echo '<div class="life_in_balance-video ' . $video_mode . '">';
				echo '<div class="video-overlay">';
				echo '<div class="life_in_balance-video-inner"><span class="close-popup"><i class="fa fa-times"></i></span>' . wp_oembed_get($url) . '</div>';
				echo '</div>';
				echo '<div class="video-text">' . $text . '</div>';
				echo '<a href="#" class="toggle-popup"><i class="fa fa-play"></i></a>';
			echo '</div>';
		}
		echo $after_widget;

	}
	
}	