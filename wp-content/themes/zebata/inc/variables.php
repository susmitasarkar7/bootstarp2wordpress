<?php

$zebataPostsPagesArray = array(
	'select' => __('Select a post/page', 'zebata'),
);

$zebataPostsPagesArgs = array(
	
	// Change these category SLUGS to suit your use.
	'ignore_sticky_posts' => 1,
	'post_type' => array('post', 'page'),
	'orderby' => 'date',
	'posts_per_page' => -1,
	'post_status' => 'publish',
	
);
$zebataPostsPagesQuery = new WP_Query( $zebataPostsPagesArgs );
	
if ( $zebataPostsPagesQuery->have_posts() ) :
							
	while ( $zebataPostsPagesQuery->have_posts() ) : $zebataPostsPagesQuery->the_post();
			
		$zebataPostsPagesId = get_the_ID();
		if(get_the_title() != ''){
				$zebataPostsPagesTitle = get_the_title();
		}else{
				$zebataPostsPagesTitle = get_the_ID();
		}
		$zebataPostsPagesArray[$zebataPostsPagesId] = $zebataPostsPagesTitle;
	   
	endwhile; wp_reset_postdata();
							
endif;

$zebataYesNo = array(
	'select' => __('Select', 'zebata'),
	'yes' => __('Yes', 'zebata'),
	'no' => __('No', 'zebata'),
);

$zebataSliderType = array(
	'select' => __('Select', 'zebata'),
	'header' => __('WP Custom Header', 'zebata'),
	'owl' => __('Owl Slider', 'zebata'),
);

$zebataServiceLayouts = array(
	'select' => __('Select', 'zebata'),
	'one' => __('One', 'zebata'),
	'two' => __('Two', 'zebata'),
);

$zebataAvailableCats = array( 'select' => __('Select', 'zebata') );

$zebata_categories_raw = get_categories( array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => 0, ) );

foreach( $zebata_categories_raw as $category ){
	
	$zebataAvailableCats[$category->term_id] = $category->name;
	
}

$zebataBusinessLayoutType = array( 
	'select' => __('Select', 'zebata'), 
	'three' => __('Three', 'zebata'),
	'woo-one' => __('Woocommerce One', 'zebata'),
);
