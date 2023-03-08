<div class="clear"></div>
<footer id="footer" class="site-footer" role="contentinfo">
	<div class="copyright">
		<p><?php _e('CopyRight', 'iyl'); ?>&nbsp;&copy;&nbsp;<?php echo date("Y"); ?>&nbsp;<a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>. <?php printf(__('%1$s Powered by %2$s', 'iyl'), '<a href="'.esc_url( __( 'https://hjyl.org/', 'iyl' ) ).'" title="Designed by hjyl.org">iyl Theme</a>', '<a href="'.esc_url( __( 'https://wordpress.org/', 'iyl' ) ).'">WordPress</a>'); ?></p>
		<p><?php echo hjyl_theme_options('stat_code'); ?></p>
		<?php if ( function_exists( 'zh_cn_l10n_icp_num' ) ): ?>
		<p><?php echo esc_html( zh_cn_l10n_icp_num( 'zh_cn_l10n_icp_num' ) ); ?></p>
		<?php endif; ?>
	</div>
	<div id="hjylUp">
		<i class="hjylfont hjyl-retop"></i>
	</div>
</footer>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>