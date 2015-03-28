<?php

// Add Schema.org support to the theme
// http://schema.org/WebPage
// Use with html_tag_schema();

  function body_tag_schema() {

    $base = 'http://schema.org/';

    //
    // WordPress page types
    //   

    // Is author page
    if( is_author() ) :    
      $type = 'ProfilePage';    

    // Is search results page
    elseif( is_search() ) :    
      $type = 'SearchResultsPage';    

    //
    // Theme page types
    //

    // Contact page ID
    //elseif( is_page( 0 ) ) :    
    //  $type = 'ContactPage';

    // About page ID
    //elseif( is_page( 0 ) ) :    
    //  $type = 'AboutPage';

    // FAQs page ID
    //elseif( is_page( 0 ) ) :    
    //  $type = 'QAPage';

    // Gallery page ID
    //elseif( is_page( 0 ) ) :    
    //  $type = 'ImageGallery';

    // add custom post types that describe a single item to this array
    //elseif( is_singular( array( 'book', 'movie' ) ) ) :    
    //  $type = 'ItemPage';

    //
    // WooCommerce page types
    //

    // Is single product page
    //elseif( is_product() ) :    
    //  $type = 'ItemPage';

    // Is checkout page
    //elseif( is_checkout() ) :    
    //  $type = 'CheckoutPage';

    //
    // Default page type
    //

    else :    
      $type = 'WebPage';

    endif;    

    return 'itemscope itemtype="' . $base . $type . '"';

  }

?>