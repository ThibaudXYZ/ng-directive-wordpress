<?php
	/*
	Plugin Name: Angular Directive
	Plugin URI: NONE
	Description: Displays an Angular attribute directive
	Author: Fourwinged
	Version: 0.1
	Author URI: 
	*/

	// Block direct requests
	if ( !defined('ABSPATH') )
		die('-1');
	add_action( 'widgets_init', function(){
		register_widget( 'Angular_Directive_Widget' );
	});

	/**
	* Adds Angular_Directive_Widget widget.
	*/
	class Angular_Directive_Widget extends WP_Widget {

		/**
		* Register widget with WordPress.
		*/
		function __construct() {
			parent::__construct(
				'Angular_Directive_Widget', // Base ID
				__('Angular Directive', 'text_domain'), // Name
				array( 'description' => __( 'Display a directive !', 'text_domain' ), ) // Args
			);
		}

		/**
		* Front-end display of widget.
		*
		* @see WP_Widget::widget()
		*
		* @param array $args Widget arguments.
		* @param array $instance Saved values from database.
		*/
		public function widget( $args, $instance ) {
			echo $args['before_widget'];
			echo __( '<div ', 'text_domain' );
			if ( ! empty( $instance['directive'] ) ) {
				echo $args['before_directive'] . apply_filters( 'widget_directive', $instance['directive'] ). $args['after_directive'];
			}
			echo __( '></div>', 'text_domain' );
			echo $args['after_widget'];
		}

		/**
		* Back-end widget form.
		*
		* @see WP_Widget::form()
		*
		* @param array $instance Previously saved values from database.
		*/
		public function form( $instance ) {
			if ( isset( $instance[ 'directive' ] ) ) {
				$directive = $instance[ 'directive' ];
			}
			else {
				$directive = __( 'ng-example', 'text_domain' );
			}
			?>
			<p>
			<label for="<?php echo $this->get_field_id( 'directive' ); ?>"><?php _e( 'Directive:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'directive' ); ?>" name="<?php echo $this->get_field_name( 'directive' ); ?>" type="text" value="<?php echo esc_attr( $directive ); ?>">
			</p>
			<?php
		}

		/**
		* Sanitize widget form values as they are saved.
		*
		* @see WP_Widget::update()
		*
		* @param array $new_instance Values just sent to be saved.
		* @param array $old_instance Previously saved values from database.
		*
		* @return array Updated safe values to be saved.
		*/
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['directive'] = ( ! empty( $new_instance['directive'] ) ) ? strip_tags( $new_instance['directive'] ) : '';
			return $instance;
		}
	} // class Angular_Directive_Widget 
