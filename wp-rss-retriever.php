<?php
/**
 * Plugin Name: RSS Retriever
 * Plugin URI: http://wordpress.org/plugins/wp-rss-retriever/
 * Description: A lightweight RSS fetch plugin which uses the shortcode [wp_rss_retriever] to fetch and display an RSS feed in an unordered list.
 * Version: 1.1.1
 * Author: Travis Taylor
 * Author URI: http://travistaylor.com/
 * License: GPL2
 */

add_action( 'wp_enqueue_scripts', 'wp_rss_retriever_css');

function wp_rss_retriever_css() {
    global $post;
    if( has_shortcode( $post->post_content, 'wp_rss_retriever') ) {
        wp_enqueue_style('rss-retriever', plugin_dir_url( __FILE__) . 'inc/css/rss-retriever.css');
    }
}

add_shortcode( 'wp_rss_retriever', 'wp_rss_retriever_func' );

function wp_rss_retriever_func( $atts, $content = null ){
	extract( shortcode_atts( array(
		'url' => '#',
		'items' => '10',
        'orderby' => 'default',
        'title' => 'true',
		'excerpt' => '0',
		'read_more' => 'true',
		'new_window' => 'true',
        'thumbnail' => 'false',
        'source' => 'true',
        'date' => 'true',
        'cache' => '43200'
	), $atts ) );

    update_option( 'wp_rss_cache', $cache );

    //multiple urls
    $urls = explode(',', $url);

    add_filter( 'wp_feed_cache_transient_lifetime', 'wp_rss_retriever_cache' );

    $rss = fetch_feed( $urls );

    remove_filter( 'wp_feed_cache_transient_lifetime', 'wp_rss_retriever_cache' );

    if ( ! is_wp_error( $rss ) ) :

        if ($orderby == 'date' || $orderby == 'date_reverse') {
            $rss->enable_order_by_date(true);
        }
        $maxitems = $rss->get_item_quantity( $items ); 
        $rss_items = $rss->get_items( 0, $maxitems );
        if ( $new_window != 'false' ) {
            $newWindowOutput = 'target="_blank" ';
        } else {
            $newWindowOutput = NULL;
        }

        if ($orderby == 'date_reverse') {
            $rss_items = array_reverse($rss_items);
        }

    endif;
    $output = '<div class="wp_rss_retriever">';
        $output .= '<ul class="wp_rss_retriever_list">';
            if ( !isset($maxitems) ) : 
                $output .= '<li>' . _e( 'No items', 'wp-rss-retriever' ) . '</li>';
            else : 
                //loop through each feed item and display each item.
                foreach ( $rss_items as $item ) :
                    //variables
                    $content = $item->get_content();
                    $the_title = $item->get_title();
                    $enclosure = $item->get_enclosure();

                    //build output
                    $output .= '<li class="wp_rss_retriever_item"><div class="wp_rss_retriever_item_wrapper">';
                        //title
                        if ($title == 'true') {
                            $output .= '<a class="wp_rss_retriever_title" ' . $newWindowOutput . 'href="' . esc_url( $item->get_permalink() ) . '"
                                title="' . $the_title . '">';
                                $output .= $the_title;
                            $output .= '</a>';   
                        }
                        //thumbnail
                        if ($thumbnail != 'false' && $enclosure) {
                            $thumbnail_image = $enclosure->get_thumbnail();                     
                            if ($thumbnail_image) {
                                //use thumbnail image if it exists
                                $resize = wp_rss_retriever_resize_thumbnail($thumbnail);
                                $class = wp_rss_retriever_get_image_class($thumbnail_image);
                                $output .= '<div class="wp_rss_retriever_image"' . $resize . '><img' . $class . ' src="' . $thumbnail_image . '" alt="' . $title . '"></div>';
                            } else {
                                //if not than find and use first image in content
                                preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $first_image);
                                if ($first_image){    
                                    $resize = wp_rss_retriever_resize_thumbnail($thumbnail);                                
                                    $class = wp_rss_retriever_get_image_class($first_image["src"]);
                                    $output .= '<div class="wp_rss_retriever_image"' . $resize . '><img' . $class . ' src="' . $first_image["src"] . '" alt="' . $title . '"></div>';
                                }
                            }
                        }
                        //content
                        $output .= '<div class="wp_rss_retriever_container">';
                        if ( $excerpt != 'none' ) {
                            if ( $excerpt > 0 ) {
                                $output .= esc_html(implode(' ', array_slice(explode(' ', strip_tags($content)), 0, $excerpt))) . "...";
                            } else {
                                $output .= $content;
                            }
                            if( $read_more == 'true' ) {
                                $output .= ' <a class="wp_rss_retriever_readmore" ' . $newWindowOutput . 'href="' . esc_url( $item->get_permalink() ) . '"
                                        title="' . sprintf( __( 'Posted %s', 'wp-rss-retriever' ), $item->get_date('j F Y | g:i a') ) . '">';
                                        $output .= __( 'Read more &raquo;', 'wp-rss-retriever' );
                                $output .= '</a>';
                            }
                        }
                        //metadata
                        if ($source == 'true' || $date == 'true') {
                            $output .= '<div class="wp_rss_retriever_metadata">';
                                $source_title = $item->get_feed()->get_title();
                                $time = $item->get_date('F j, Y - g:i a');
                                if ($source == 'true' && $source_title) {
                                    $output .= '<span class="wp_rss_retriever_source">' . sprintf( __( 'Source: %s', 'wp-rss-retriever' ), $source_title ) . '</span>';
                                }
                                if ($source == 'true' && $date == 'true') {
                                    $output .= ' | ';
                                }
                                if ($date == 'true' && $time) {
                                    $output .= '<span class="wp_rss_retriever_date">' . sprintf( __( 'Published: %s', 'wp-rss-retriever' ), $time ) . '</span>';
                                }
                            $output .= '</div>';
                        }
                    $output .= '</div></div></li>';
                endforeach;
            endif;
        $output .= '</ul>';
    $output .= '</div>';

    return $output;
}

add_option( 'wp_rss_cache', 43200 );

function wp_rss_retriever_cache() {
    //change the default feed cache
    $cache = get_option( 'wp_rss_cache', 43200 );
    return $cache;
}

function wp_rss_retriever_get_image_class($image_src) {
    list($width, $height) = getimagesize($image_src);
    if ($height > $width) {
        $class = ' class="portrait"';
    } else {
        $class = '';
    }
    return $class;
}

function wp_rss_retriever_resize_thumbnail($thumbnail) {
    if (is_numeric($thumbnail)){
        $resize = ' style="width:' . $thumbnail . 'px; height:' . $thumbnail . 'px;"';
    } else {
        $resize = '';
    }
    return $resize;
}