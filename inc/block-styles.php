<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_register_block_styles() {
		// Columns: Overlap.
		register_block_style(
			'core/columns',
			array(
				'name'  => 'iyl-columns-overlap',
				'label' => esc_html__( 'Overlap', 'iyl' ),
			)
		);

		// Cover: Borders.
		register_block_style(
			'core/cover',
			array(
				'name'  => 'iyl-border',
				'label' => esc_html__( 'Borders', 'iyl' ),
			)
		);

		// Group: Borders.
		register_block_style(
			'core/group',
			array(
				'name'  => 'iyl-border',
				'label' => esc_html__( 'Borders', 'iyl' ),
			)
		);

		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'iyl-border',
				'label' => esc_html__( 'Borders', 'iyl' ),
			)
		);

		// Image: Frame.
		register_block_style(
			'core/image',
			array(
				'name'  => 'iyl-image-frame',
				'label' => esc_html__( 'Frame', 'iyl' ),
			)
		);

		// Latest Posts: Dividers.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'iyl-latest-posts-dividers',
				'label' => esc_html__( 'Dividers', 'iyl' ),
			)
		);

		// Latest Posts: Borders.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'iyl-latest-posts-borders',
				'label' => esc_html__( 'Borders', 'iyl' ),
			)
		);

		// Media & Text: Borders.
		register_block_style(
			'core/media-text',
			array(
				'name'  => 'iyl-border',
				'label' => esc_html__( 'Borders', 'iyl' ),
			)
		);

		// Separator: Thick.
		register_block_style(
			'core/separator',
			array(
				'name'  => 'iyl-separator-thick',
				'label' => esc_html__( 'Thick', 'iyl' ),
			)
		);

		// Social icons: Dark gray color.
		register_block_style(
			'core/social-links',
			array(
				'name'  => 'iyl-social-icons-color',
				'label' => esc_html__( 'Dark gray', 'iyl' ),
			)
		);
	}
	add_action( 'init', 'twenty_twenty_one_register_block_styles' );
}
