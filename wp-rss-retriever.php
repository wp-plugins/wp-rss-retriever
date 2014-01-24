<?php
/**
 * Plugin Name: RSS Retriever
 * Plugin URI: http://wordpress.org/plugins/wp-rss-retriever/
 * Description: A lightweight RSS fetch plugin which uses the shortcode [wp_rss_retriever] to fetch and display an RSS feed in an unordered list.
 * Version: 1.0
 * Author: Travis Taylor
 * Author URI: http://travistaylor.com/
 * License: GPL2
 */

add_shortcode( 'wp_rss_retriever', 'wp_rss_retriever_func' );

function wp_rss_retriever_func( $atts, $content = null ){
	extract( shortcode_atts( array(
		'url' => '#',
		'items' => '10',
		'excerpt' => '0',
		'read_more' => 'true',
		'new_window' => 'true'
	), $atts ) );

    $rss = fetch_feed( $url );

    if ( ! is_wp_error( $rss ) ) :

        $maxitems = $rss->get_item_quantity( $items ); 
        $rss_items = $rss->get_items( 0, $maxitems );
        if ( $new_window != 'false' ) {
            $newWindowOutput = 'target="_blank" ';
        } else {
            $newWindowOutput = NULL;
        }

    endif;
    $output = '<div class="wp_rss_retriever">';
        $output .= '<ul>';
            if ( $maxitems == 0 ) : 
                $output .= '<li>' . _e( 'No items', 'wp-rss-retriever' ) . '</li>';
            else : 
                // Loop through each feed item and display each item.
                foreach ( $rss_items as $item ) :
                    $output .= '<li>';
                        $output .= '<a ' . $newWindowOutput . 'href="' . esc_url( $item->get_permalink() ) . '"
                            title="' . sprintf( __( 'Posted %s', 'wp-rss-retriever' ), $item->get_date('j F Y | g:i a') ) . '">';
                            $output .= esc_html( $item->get_title() );
                        $output .= '</a>';
                        if ( $excerpt > 0 ) {
                            $content = $item->get_content();
                            $output .= '<p>' . esc_html(implode(' ', array_slice(explode(' ', strip_tags($content)), 0, $excerpt))) . "...";
                        } else {
                            $output .= '<p>' . $item->get_content();
                        }
                        if( $read_more == 'true' ) {
                            $output .= ' <a class="wp_rss_retriever_readmore" ' . $newWindowOutput . 'href="' . esc_url( $item->get_permalink() ) . '"
                                    title="' . sprintf( __( 'Posted %s', 'wp-rss-retriever' ), $item->get_date('j F Y | g:i a') ) . '">';
                                    $output .= __( 'Read more &raquo;', 'wp-rss-retriever' );
                            $output .= '</a></p>';
                        }
                    $output .= '</li>';
                endforeach;
            endif;
        $output .= '</ul>';
    $output .= '</div>';
    return $output;
}