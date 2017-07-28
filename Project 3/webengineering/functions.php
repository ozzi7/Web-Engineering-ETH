<?php

function customizer_setup( $wp_customize ) {

	// add new section
	$wp_customize->add_section( 'theme_colors', array(
		'title' => 'Theme Colors',
		'priority' => 100,
	) );

	// add color picker setting
	$wp_customize->add_setting( 'background_color', array(
		'default' => 'ff0000'
	) );

	// add color picker control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
		'label' => 'Background Color',
		'section' => 'theme_colors',
		'settings' => 'background_color',
	) ) );

	// technical skills section
	$wp_customize->add_section( 'technical_skills', array(
		'title' => 'Technical Skills',
		'priority' => 100,
	) );

	$wp_customize->add_setting( 'html_skill_percentage', array(
		'default' => '95'
	) );

	$wp_customize->add_setting( 'css_skill_percentage', array(
		'default' => '80'
	) );

	$wp_customize->add_setting( 'javascript_skill_percentage', array(
		'default' => '90'
	) );

	$wp_customize->add_setting( 'wordpress_skill_percentage', array(
		'default' => '80'
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'html_skill_percentage', array(
		'label' => 'HTML skills',
		'section' => 'technical_skills',
		'settings' => 'html_skill_percentage',
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'css_skill_percentage', array(
		'label' => 'CSS skills',
		'section' => 'technical_skills',
		'settings' => 'css_skill_percentage',
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'javascript_skill_percentage', array(
		'label' => 'JavaScript skills',
		'section' => 'technical_skills',
		'settings' => 'javascript_skill_percentage',
	) ) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wordpress_skill_percentage', array(
		'label' => 'Wordpress skills',
		'section' => 'technical_skills',
		'settings' => 'wordpress_skill_percentage',
	) ) );

	// contact info section
	$wp_customize->add_section( 'contact_info', array(
		'title' => 'Contact Information',
		'priority' => 100,
	) );

	$wp_customize->add_setting( 'location_info', array(
		'default' => 'Paradeplatz, Zürich'
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'location_info', array(
		'label' => 'Location',
		'section' => 'contact_info',
		'settings' => 'location_info',
	) ) );

	$wp_customize->add_setting( 'phone_info', array(
		'default' => '+0041 9884 4893'
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'phone_info', array(
		'label' => 'Phone number',
		'section' => 'contact_info',
		'settings' => 'phone_info',
	) ) );

	$wp_customize->add_setting( 'fax_info', array(
		'default' => '+0041 9884 8893'
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fax_info', array(
		'label' => 'Fax number',
		'section' => 'contact_info',
		'settings' => 'fax_info',
	) ) );

	$wp_customize->add_setting( 'mail_info', array(
		'default' => 'mrdesignrobot@inf.co'
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'mail_info', array(
		'label' => 'E-mail',
		'section' => 'contact_info',
		'settings' => 'mail_info',
	) ) );

	$wp_customize->add_setting( 'twitter_info', array(
		'default' => '@mrdesignrobot'
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_info', array(
		'label' => 'Twitter handle',
		'section' => 'contact_info',
		'settings' => 'twitter_info',
	) ) );

	$wp_customize->add_setting( 'name_info', array(
		'default' => 'Mr Design Luigi'
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'name_info', array(
		'label' => 'Name',
		'section' => 'contact_info',
		'settings' => 'name_info',
	) ) );
}
add_action( 'customize_register', 'customizer_setup' );

function customizer_background_colors() {
	$background_color = get_theme_mod( 'background_color' );

	?>
		<style type="text/css">
			#about, #blog, #portfolio, #technicalSkills, #contact {
				background-color: #<?php echo $background_color; ?> !important;
			}
		</style>
	<?php
}
add_action( 'wp_head', 'customizer_background_colors' );

function customizer_html_skill() {
	$html_skill_percentage = get_theme_mod('html_skill_percentage');
	?>
		<style type="text/css">
		#barHTML {
				height: <?php echo $html_skill_percentage; ?>% !important;
				top: <?php echo (100 - $html_skill_percentage); ?>% !important;
			}
		</style>
	<?php
}
add_action( 'wp_head', 'customizer_html_skill');

function customizer_css_skill() {
	$css_skill_percentage = get_theme_mod('css_skill_percentage');
	?>
		<style type="text/css">
		#barCSS {
				height: <?php echo $css_skill_percentage; ?>% !important;
				top: <?php echo (100 - $css_skill_percentage); ?>% !important;
			}
		</style>
	<?php
}
add_action( 'wp_head', 'customizer_css_skill');

function customizer_javascript_skill() {
	$javascript_skill_percentage = get_theme_mod('javascript_skill_percentage');
	?>
		<style type="text/css">
		#barJS {
				height: <?php echo $javascript_skill_percentage; ?>% !important;
				top: <?php echo (100 - $javascript_skill_percentage); ?>% !important;
			}
		</style>
	<?php
}
add_action( 'wp_head', 'customizer_javascript_skill');

function customizer_wordpress_skill() {
	$wordpress_skill_percentage = get_theme_mod('wordpress_skill_percentage');
	?>
		<style type="text/css">
		#barWP {
				height: <?php echo $wordpress_skill_percentage; ?>% !important;
				top: <?php echo (100 - $wordpress_skill_percentage); ?>% !important;
			}
		</style>
	<?php
}
add_action( 'wp_head', 'customizer_wordpress_skill');


// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Portfolios', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Portfolios', 'text_domain' ),
		'name_admin_bar'        => __( 'Portfolio', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio', 'text_domain' ),
		'description'           => __( 'Portfolio Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
        'supports'              => array( 'title', 'excerpt', 'thumbnail')
	);
	register_post_type( 'portfolio', $args );

}

add_action( 'init', 'custom_post_type', 0 );
add_theme_support( 'post-thumbnails', array( 'portfolio' ) );

add_action( 'wp_ajax_pffilter', 'pffilter' );
add_action( 'wp_ajax_nopriv_pffilter', 'pffilter' );

function pffilter() {

				if ($_POST['filter'] == 'ALL') {
					$args = array('post_type' => 'portfolio');
				}
				else {
					$args = array('post_type' => 'portfolio',
												'category_name' => $_POST['filter']);
				}

				$portfolio_query = new WP_Query($args);

		    echo '  <ul class="portfolioList" >';
		    $counter = 1;
		    while ( $portfolio_query->have_posts() ) {
		      $portfolio_query->the_post();
		      echo '<li class = "portfolioImageContainer" >
		          <figure>
		             <img  src="';
		      echo the_post_thumbnail_url();
		      echo '" alt="">
		             <figcaption>
		                <h5>' . get_the_title() . '</h5>
		                <a data-toggle="modal" href="#myModal'.$counter.'" >Take a Look</a>
		             </figcaption>
		          </figure>
		       </li>';
		       $counter = $counter + 1;
		    }
		    echo '</ul>';
				echo  '<div id = modals>';

				if ($_POST['filter'] == 'ALL') {
					$args = array('post_type' => 'portfolio');
				}
				else {
					$args = array('post_type' => 'portfolio',
												'category_name' => $_POST['filter']);
				}
			    $counter = 1;
			   	while ( $portfolio_query->have_posts() ) {
			   		$portfolio_query->the_post();
			      echo '<div id="myModal' .$counter . '" class="popupBackground">
			            <div class="popup">
			               <h2>' . get_the_title() . '.</h2>
			               <a class="close" href="#dummy">x</a>
			               <div class="content">
			                   <img  src="';
			      echo the_post_thumbnail_url();
			      echo '" alt="">
			                  <p>' .get_the_excerpt() . '</p>
			               </div>
			            </div>
			         </div>';
			       $counter = $counter + 1;
			     }
				 echo  '</div>';

wp_die(); // this is required to terminate immediately and return a proper response
}

?>
