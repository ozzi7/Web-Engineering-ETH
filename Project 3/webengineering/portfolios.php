<?php
if(isset($_POST['portfolioaction']) && !empty($_POST['portfolioaction'])) {
     echo 'BLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
    $action = $_POST['portfolioaction'];    
    $portfolio_query = new WP_Query( array( 'post_type' => 'portfolio', 'post_title' => $action));
    if ( $portfolio_query->have_posts() ) {
    	echo '  <ul class="portfolioList" >';
    	while ( $the_query->have_posts() ) {
    		$portfolio_query->the_post();
    		echo '<li class = "portfolioImageContainer" >
            <figure>
               <img  src="' .the_post_thumbnail_url() . '" alt="">
               <figcaption>
                  <h5>' . get_the_title() . '</h5>
                  <a data-toggle="modal" href="#' . $portfolio_query.modalName . '>Take a Look</a>
               </figcaption>
            </figure>
         </li>';
    	}
    	echo '</ul>';
    }


   $portfolio_query = new WP_Query( array( 'post_type' => 'portfolio', 'post_title' => $action));
    
    if ( $portfolio_query->have_posts() ) {
    	echo '<ul class="portfolioList" >';
    	while ( $the_query->have_posts() ) {
    		$portfolio_query->the_post();
               echo '<div id="' .$portfolio_query.modalName . '." class="popupBackground">
             <div class="popup">
                <h2>' . get_the_title() . '.</h2>
                <a class="close" href="#dummy">x</a>
                <div class="content">
                    <img  src="' .the_post_thumbnail_url() . '" alt="">
                   <p>' .get_the_excerpt() . '</p>
                </div>
             </div>
          </div>';
        }
     }
}
?>