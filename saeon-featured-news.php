<?php
/**
 * Plugin Name: SAEON Featured News
 * Description: Use a shortcode to display latest posts
 * Author: SAEON
 * Author URI: https://wordpress.org/plugins/saeon/
 * Plugin URI: https://wordpress.org/plugins/saeon-featured-news/
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: saeon-featured-news
 */




/* Recent Posts Shortcocde */
function saeon_featured_news()
 {
  global $post;

  $html = "<div class='sn-row sn-news-block'>";

  $my_query = new WP_Query( array(
       'post_type' => 'post',
       'posts_per_page' => 3
  ));

  if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();

        $html .= "<div class=\"sn-col-4\">";
        $html .= "<div class='sn-wrapper'><a href=\"" . get_the_permalink() . "\" class=\"sn-image\" ";
        $html .= "style='background-image:url(\"" . get_the_post_thumbnail_url() . "\")'></a>";
        $html .= "<h2>" . mb_strimwidth(get_the_title(), 0, 44, '...') . " </h2>";
        $html .= "<p class='sn-excerpt'>" . mb_strimwidth(get_the_excerpt(), 0, 250, '...') . "</p>";
        $html .= "<a href=\"" . get_permalink() . "\" class=\"elementor-button-link elementor-button elementor-size-sm\">Read more</a></div>";
        $html .= "</div>";

  endwhile; 
  wp_reset_postdata();
    endif;
    $html .= "</div>";
  return $html;
 }
 add_shortcode( 'saeon-featured-news', 'saeon_featured_news' );

/* Include files */
function p_support_files() {
    wp_register_style('p_support_files', plugins_url('style.css',__FILE__ ));
    wp_enqueue_style('p_support_files');
    // wp_register_script( 'p_support_files', plugins_url('your_script.js',__FILE__ ));
    // wp_enqueue_script('p_support_files');
}

add_action( 'wp_enqueue_scripts','p_support_files'); //admin_init instead of wp_
/* Admin area */
 function saeon_featured_news_admin_menu()
{
    add_menu_page('SAEON Featured News','Featured News','manage_options','saeon-featured-news-admin-menu','saeon_featured_news_scripts_page',plugins_url('saeon-featured-news/img/admin-icon.png'),6);
}

add_action('admin_menu','saeon_featured_news_admin_menu');

/* Admin Scripts Page */
function saeon_featured_news_scripts_page()
{
    ?>
    <div class="wrap">
        <h2>SAEON Featured News Shortcode</h2>
        <p>Paste the following shortcode on any page to display latest news</p>
        <p style="border: 1px solid #ccd0d4;background: #fff;padding: 10px 20px;font-size: 16px;display: inline-block;">[saeon-featured-news]</p>
    </div>

    <?php
}
 ?>