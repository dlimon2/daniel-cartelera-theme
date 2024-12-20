<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

if ( is_archive() && class_exists( 'TP_Education' ) && is_tp_education() ) {
	return false;
}
?>
<!--
<aside id="secondary" class="widget-area" role="complementary">
	<?php //dynamic_sidebar( 'sidebar-1' ); ?>
</aside>-->
