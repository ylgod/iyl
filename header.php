<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if(get_background_image()) {?>
	<style>
		#content{
			background: #ffffff;
			display: inline-block;
		}
	</style>
	<?php } ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#content">
<?php _e( 'Skip to content', 'iyl' ); ?></a>
	<header id="header" role="banner" <?php if ( get_header_image() ) { ?> style="background-image: url(<?php header_image(); ?>);" <?php } ?>>
		<div id="open-menu">
			<button type="button" class="menu-toggle"><i class="hjylfont hjyl-menu1"></i></button>
			<button type="button" class="menu-close"><i class="hjylfont hjyl-close"></i></button>
		</div>
		<nav id="hjyl_menu" rol="navigation">
		<?php
			if(!wp_is_mobile()) {
				wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'hjyl_wp_list_pages', 'container' => false ) );
			}else{
				wp_nav_menu( array( 'theme_location' => 'mobile', 'fallback_cb' => 'hjyl_wp_list_pages', 'container' => false ) );
			}
		?>
		</nav>
		<div class="clear"></div>
		<h1 id="logo">
			<?php if (has_custom_logo()) { the_custom_logo(); }else{?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
		<?php } ?>
		</h1>
		<div class="header-footer">
			<div class="h-l header-rolls">
				<ul>
					<li class="rolls roll-red"></li>
					<li class="rolls roll-yellow"></li>
					<li class="rolls roll-green"></li>
				</ul>
			</div>
			<div class="h-l position">
				<ul>
					<li>
						<a href="<?php echo esc_url(home_url()); ?>"><i class="hjylfont hjyl-home"></i></a>
					</li>
					
					<?php if(is_single()) {?>
					<li>
						<?php the_category(', '); ?>
					</li>
					<?php } ?>						
					
					<?php
					/* If this is a tag archive */
					if(is_category()) {
						echo "<li>";
						single_cat_title();
						echo "</li>";
					/* If this is a search result */
					} elseif (is_search()) {
						echo "<li>";
						printf( __( 'Search Results for: %s', 'iyl' ), get_search_query() );
						echo "</li>";
					/* If this is a tag archive */
					} elseif(is_tag()) {
						echo "<li>";
						single_tag_title();
						echo "</li>";
					/* If this is a daily archive */
					} elseif (is_day()) {
						echo "<li>";
						the_time( 'Y, F jS' );
						echo "</li>";
					/* If this is a monthly archive */
					} elseif (is_month()) {
						echo "<li>";
						the_time( 'Y, F' );
						echo "</li>";
					/* If this is a yearly archive */
					} elseif (is_year()) {
						echo "<li>";
						the_time( 'Y' );
						echo "</li>";
					/* If this is a single */
					} elseif (is_singular()) {
						echo "<li>";
						if(""!==get_the_title() ) {
							the_title();
						}else{
							printf(__('Untitled #%s', 'iyl'),get_the_date('Y-m-d'));
						}
						echo "</li>";
					/* If this is Error 404 */
					} elseif (is_404()) {
						echo "<li>";
						_e('404 Error', 'iyl');	
						echo "</li>";
					} elseif ( is_author() ) {
						echo "<li>";
						printf(__( 'Author "%s" as followed', 'iyl' ), get_the_author_meta( 'display_name' ));
						echo "</li>";
					}
					$paged = get_query_var('paged'); if ( $paged > 1 ){
						echo "<li>";
						printf(__(' - Page %s - ', 'iyl'), $paged);
						echo "</li>";
					}
					?>
				</ul>
			</div>
			<?php get_search_form(); ?>
			<div class="header-right">
				<ul>
					<li>
						<?php if (hjyl_theme_options('weibo_url') != '') { ?>
						<a href="<?php echo hjyl_theme_options('weibo_url'); ?>" rel="bookmark" title="<?php echo hjyl_theme_options('weibo_name'); ?>"><span><i class="hjylfont hjyl-weibo"></i></span></a>
						<?php } ?>
					</li>
					<li>
						<?php if (hjyl_theme_options('twitter_url') != '') { ?>
						<a href="<?php echo hjyl_theme_options('twitter_url'); ?>" rel="bookmark" title="<?php echo hjyl_theme_options('twitter_name'); ?>"><span><i class="hjylfont hjyl-twitter"></i></span></a>
						<?php } ?>
					</li>
					<li>
						<?php if (hjyl_theme_options('email_url') != '') { ?>
						<a href="<?php echo hjyl_theme_options('email_url'); ?>" rel="bookmark" title="<?php echo hjyl_theme_options('email_name'); ?>"><span><i class="hjylfont hjyl-email"></i></span></a>
						<?php } ?>
					</li>
					<li>
						<?php if (hjyl_theme_options('rss_url') != '') { ?>
						<a href="<?php echo hjyl_theme_options('rss_url'); ?>" rel="bookmark" title="<?php echo hjyl_theme_options('rss_name'); ?>"><span><i class="hjylfont hjyl-feed"></i></span></a>
						<?php } ?>
					</li>
					<li>
						<?php if (hjyl_theme_options('qrcode_url') != '') { ?>
						<a class="qrcode" href="#"><i class="hjylfont hjyl-scanning"></i></a>
						<img src="<?php echo hjyl_theme_options('qrcode_url'); ?>" width="258" height="258" alt="<?php echo hjyl_theme_options('qrcode_name'); ?>" class="qrcodeimg" />
						<?php } ?>
					</li>
					<li>
						<a href="#" style="display: none;" class="layout show-sidebar" title="<?php _e('Close Sidebar', 'iyl'); ?>" ><i class="hjylfont hjyl-layout"></i></a>
						<a href="#" title="<?php _e('Show Sidebar', 'iyl'); ?>" class="layout close-sidebar" ><i class="hjylfont hjyl-layout-filling"></i></a>
					</li>
				</ul>
			</div>
		</div>
		
	</header>
	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">