			</main><!-- #main -->
		</div><!-- #primary -->
<aside class="widget-area" id="sidebar" role="complementary">	
<?php if ( is_home() && is_active_sidebar( 'home' ) ) : ?>
	<?php dynamic_sidebar( 'home' ); ?>
<?php elseif (is_single() && is_active_sidebar( 'single' )) : ?>
	<?php dynamic_sidebar( 'single' ); ?>
<?php elseif (is_page() && is_active_sidebar( 'page' )) : ?>
	<?php dynamic_sidebar( 'page' ); ?>
<?php elseif (is_404() && is_active_sidebar( 'error' )) : ?>
	<?php dynamic_sidebar( 'error' ); ?>
<?php else : ?>
	<?php dynamic_sidebar( 'other' ); ?>
<?php endif; ?>
</aside><!-- .widget-area -->
	</div><!-- #content -->