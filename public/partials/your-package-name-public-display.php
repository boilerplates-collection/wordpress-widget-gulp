<?php
/**
 * Provide a public-facing view for the widget
 *
 * This file is used to markup the public-facing aspects of the widget.
 *
 * @package Your_Package_Name
 * @link    https://github.com/your/repo
 * @since   0.0.1
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$yourprefix_default_title = __( 'Your widget name', 'yourTextDomain' );
$yourprefix_title         = ! empty( $instance['title'] ) ? $instance['title'] : $yourprefix_default_title;
$yourprefix_title         = apply_filters( 'widget_title', $yourprefix_title, $instance, $this->id_base );

echo wp_kses_post( $args['before_widget'] );
if ( ! empty( $yourprefix_title ) ) {
	echo wp_kses_post( $args['before_title'] ) . esc_html( $yourprefix_title ) . wp_kses_post( $args['after_title'] );
}
?>
<!-- Your widget content here. -->
<?php
echo wp_kses_post( $args['after_widget'] );
