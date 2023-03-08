<?php
// 此主题仅支持5.3版本以后.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'hjyl_setup' ) ) {
	function hjyl_setup() {
		// 支持语言包
		load_theme_textdomain( 'iyl', get_template_directory() . '/languages' );

		// 在头部添加默认文章和评论链接
		add_theme_support( 'automatic-feed-links' );

		// 标题
		add_theme_support( 'title-tag' );

		// 评论回复添加@某人
		add_filter( 'comment_text' , 'hjyl_comment_add_at', 20, 2);

		// 文章底部版权说明
		add_filter('the_content', 'hjyl_copyright');

		// 文章格式
		add_theme_support(
			'post-formats',
			array(
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
			)
		);

		// 文章缩略图
		add_theme_support( 'post-thumbnails' );

		// 菜单
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'iyl' ),
				'mobile'  => __( 'Mobile menu', 'iyl' ),
			)
		);

		//支持HTML5
		$args = array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
		);
		add_theme_support('html5', $args);

		// 自定义logo
		$args = array(
				'height'               => 100,
				'width'                => 100,
				'flex-width'           => true,
				'flex-height'          => true,
				'header-text'		   => array( 'site-title'),
		);
		add_theme_support('custom-logo', $args);

		//Add custom-header for AD
		$iyl_logo = array(
			'default-image'          => null,
			'random-default'         => false,
			'width'                  => 600,
			'height'                 => 150,
			'header-text'            => false,
			'uploads'                => true,
	        'flex-width'			 => true,
	        'flex-height'			 => true,
		);
		add_theme_support( 'custom-header', $iyl_logo );

		//Add background for theme
		add_theme_support('custom-background');

		//editor style
		add_editor_style('css/editor.css');

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );


	}
}
add_action( 'after_setup_theme', 'hjyl_setup' );

// 标题自定义
function hjyl_title_separator_to_line(){
    return '|';
}
function hjyl_document_title_parts( $title ){
	if( is_home() && isset( $title['tagline'] ) ) unset( $title['tagline'] );
	if(is_singular() && '' === get_the_title()) { 
		$title['title'] = sprintf(__('Untitled #%s', 'iyl'),get_the_date('Y-m-d'));
	};
	return $title;
}
add_filter( 'document_title_separator', 'hjyl_title_separator_to_line' );
add_filter( 'document_title_parts', 'hjyl_document_title_parts' );

// 评论回复添加@某人
function hjyl_comment_add_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '@<a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
  }

  return $comment_text;
}

// 自定义菜单链接
function hjyl_wp_list_pages(){
	echo "<ul>";
	echo wp_list_pages('title_li=&depth=1');
	echo "</ul>";
}

// 文章底部版权说明
function hjyl_copyright($content) {
  if (is_singular() || is_feed()) {
    $content .=
      '<div id="content-copyright"><span style="font-weight:bold;text-shadow:0 1px 0 #ddd;font-size: 13px;">'.
	  __('CopyRights: ','iyl').
	  '</span><span style="font-size: 13px;">'.
	  __('The Post by ','iyl').
	  '<a rel="nofollow" href="https://creativecommons.org/licenses/by-nc-sa/3.0/" title="'.
	  __('CC BY-NC-SA 3.0','iyl').
	  '">BY-NC-SA</a> '.
	  __('For Authorization，Original If Not Noted，Reprint Please Indicate From ','iyl').
	  '<a href="' .
      home_url() .
      '">' .
      get_bloginfo('name') .
      '</a><br>'.
	  __('Post Link: ','iyl').
	  '<a rel="bookmark" title="' .
      get_the_title() .
      '" href="' .
      get_permalink() .
      '">' .
      get_the_title() .
      '</a></span></div>';
  }
	return $content;
}

//时间格式 "xxxx 前"
function time_ago($type = 'commennt', $day = 365) {
    $d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
    //if (time() - $d('U') > 60 * 60 * 24 * $day) return;
	echo sprintf(__('%s ago','iyl'), human_time_diff($d('U') , strtotime(current_time('mysql', 0))));
}
function timeago($ptime) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if ($etime < 1) return __('Just Now','iyl');
    $interval = array(
        12 * 30 * 24 * 60 * 60 => __('years ago', 'iyl'),
        30 * 24 * 60 * 60 => __('month ago', 'iyl'),
        7 * 24 * 60 * 60 => __('weeks ago', 'iyl'),
        24 * 60 * 60 => __('days ago', 'iyl'),
        60 * 60 => __('hours ago', 'iyl'),
        60 => __('minutes ago', 'iyl'),
        1 => __('seconds ago', 'iyl')
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}

// 注册边栏函数
function hjyl_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Home', 'iyl' ),
			'id'            => 'home',
			'description'   => esc_html__( 'Add widgets here to appear in Home page.', 'iyl' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Single', 'iyl' ),
			'id'            => 'single',
			'description'   => esc_html__( 'Add widgets here to appear in Single page.', 'iyl' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Page', 'iyl' ),
			'id'            => 'page',
			'description'   => esc_html__( 'Add widgets here to appear in Page page.', 'iyl' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( '404', 'iyl' ),
			'id'            => 'error',
			'description'   => esc_html__( 'Add widgets here to appear in Error 404.', 'iyl' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Other', 'iyl' ),
			'id'            => 'other',
			'description'   => esc_html__( 'Add widgets here to appear in Other page.', 'iyl' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'hjyl_widgets_init' );

// 这是官方默认保持最小文章宽度
function hjyl_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hjyl_content_width', 750 );
}
add_action( 'after_setup_theme', 'hjyl_content_width', 0 );

function hjyl_scripts() {
	wp_enqueue_script( 'jquery' );
	// 支持评论嵌套
	wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script( 'ajax-comment', get_template_directory_uri() . '/js/comments-ajax.js', array('jquery'), wp_get_theme()->get( 'Version' ), true);
	wp_localize_script( 'ajax-comment', 'ajaxcomment', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'order' => get_option('comment_order'),
		'formpostion' => 'top',
		'txt1' => __('Wait a moment...','iyl'),
		'txt2' => __('Good Comment','iyl'),
	) );
	
	wp_enqueue_script( 'iyl-js', get_template_directory_uri() . '/js/iyl.js', array(), wp_get_theme()->get( 'Version' ), true);
	wp_enqueue_script( 'html5-js', get_template_directory_uri() . '/js/html5.js', array(), wp_get_theme()->get( 'Version' ), true);
	wp_script_add_data( 'html5-js', 'conditional', 'lt IE 9' );

	//阿里巴巴图标css
	wp_enqueue_style('icon', get_template_directory_uri() . '/css/font.css', array(), wp_get_theme()->get( 'Version' ), 'all');

	wp_enqueue_style( 'style', get_stylesheet_uri(),  array(), wp_get_theme()->get( 'Version' ), 'all');
	wp_enqueue_style( 'Play', '//fonts.googleapis.com/css?family=Play', array(), wp_get_theme()->get( 'Version' ));

	if( is_page('archives') ){
		wp_enqueue_script( 'iyl-archives', get_template_directory_uri() . '/js/archives.js', array(), wp_get_theme()->get( 'Version' ), true);
		wp_enqueue_style( 'iyl-archives', get_template_directory_uri() . '/css/archives.css', array(), wp_get_theme()->get( 'Version' ), 'all');
	};
	if(is_404()){
		wp_enqueue_style( 'iyl-4041', '//fonts.googleapis.com/css?family=Press+Start+2P', array(), wp_get_theme()->get( 'Version' ), 'all');
		wp_enqueue_style( 'iyl-4042', '//fonts.googleapis.com/css?family=Oxygen:700', array(), wp_get_theme()->get( 'Version' ), 'all');
		wp_enqueue_style( 'iyl-4043', get_template_directory_uri() . '/css/404.css', array(), wp_get_theme()->get( 'Version' ), 'all');
	}
}
add_action( 'wp_enqueue_scripts', 'hjyl_scripts' );


function twenty_twenty_one_add_sub_menu_toggle( $output, $item, $depth, $args ) {
	if ( 0 === $depth && in_array( 'menu-item-has-children', $item->classes, true ) ) {

		// Add toggle button.
		$output .= '<button class="sub-menu-toggle" aria-expanded="false">';
		$output .= '<i class="hjylfont hjyl-jump_to_bottom"></i>';
		$output .= '<i class="hjylfont hjyl-jump_to_top" style="display:none;"></i>';
		$output .= '<span class="screen-reader-text">' . esc_html__( 'Open menu', 'iyl' ) . '</span>';
		$output .= '</button>';
	}
	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'twenty_twenty_one_add_sub_menu_toggle', 10, 4 );

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// 加载主题设置
require_once ( get_stylesheet_directory() . '/inc/theme-options.php' );
if ( ! function_exists( 'hjyl_theme_options' ) ) :
 function hjyl_theme_options( $name, $default = false ) {
	 $options = get_option( 'bb10_theme_options' );
	 if ( isset( $options[$name] ) ) {
	 return $options[$name];
	 }
	 return $default;
 }
endif;

// 评论模板
require get_template_directory() . '/inc/hjyl-comment.php';

