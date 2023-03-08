<form role="search" method="get" class="h-l search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for='s'><?php _e( 'Search', 'iyl' ); ?></label>
	<input type="search" id="s" class="search-field" value="<?php echo trim( get_search_query() ); ?>" name="s" placeholder="<?php _e( 'Search...Enter', 'iyl'); ?>" required="required" />
	<button type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'iyl' ); ?>" />
        <i type="submit" value="" class="hjylfont hjyl-search"></i>
    </button>
</form>
