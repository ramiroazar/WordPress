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
        elseif(get_theme_mod('page_display_contact') && is_page( get_theme_mod('page_display_contact') ) ) :
            $type = 'ContactPage';

        // About page ID
        elseif(get_theme_mod('page_display_about') && is_page( get_theme_mod('page_display_about') ) ) :
            $type = 'AboutPage';

        // FAQs page ID
        elseif(get_theme_mod('page_display_faqs') && is_page( get_theme_mod('page_display_faqs') ) ) :
            $type = 'QAPage';

        // Gallery page ID
        elseif(get_theme_mod('page_display_gallery') && is_page( get_theme_mod('page_display_gallery') ) ) :
            $type = 'ImageGallery';

        // add custom post types that describe a single item to this array
        //elseif( is_singular( array( 'book', 'movie' ) ) ) :
        //  $type = 'ItemPage';

        //
        // WooCommerce page types
        //

        // Is single product page
        elseif( function_exists('is_product') && is_product() ) :
         $type = 'ItemPage';

        // Is checkout page
        elseif( function_exists('is_checkout') && is_checkout() ) :
         $type = 'CheckoutPage';

        //
        // Default page type
        //

        else :
          $type = 'WebPage';

        endif;

        return 'itemscope itemtype="' . $base . $type . '"';

    }

?>
