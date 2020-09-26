<?php
/**
 * Plugin Name: RoadThemes Helper
 * Plugin URI: http://roadthemes.com/
 * Description: The helper plugin for RoadThemes themes.
 * Version: 1.0.0
 * Author: RoadThemes
 * Author URI: http://roadthemes.com/
 * Text Domain: flaton
 * License: GPL/GNU.
 /*  Copyright 2015  RoadThemes  (email : roadthemez@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if ( file_exists( ABSPATH . 'wp-admin/includes/file.php' ) ) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
}    
require_once('slider-setting.php');
require_once('road-products.php');
//Add less compiler
function compileLessFile($input, $output, $params) {
   require_once( plugin_dir_path( __FILE__ ).'less/lessc.inc.php' );
   
    $less = new lessc;
    $less->setVariables($params);
    //$less->setFormatter("compressed"); // compressed format
    
    // input and output location
    $inputFile = get_template_directory().'/less/'.$input;
    $outputFile = get_template_directory().'/css/'.$output;

    try {
        $less->compileFile($inputFile, $outputFile);
    } catch (Exception $ex) {
        echo "lessphp fatal error: ".$ex->getMessage();
    }
}
function compileChildLessFile($input, $output, $params) {
    require_once( plugin_dir_path( __FILE__ ).'less/lessc.inc.php' );
    $less = new lessc;
    $less->setVariables($params);
    $less->setFormatter("compressed");
    
    // input and output location
    $inputFile = get_stylesheet_directory().'/less/'.$input;
    $outputFile = get_stylesheet_directory().'/css/'.$output;

    try {
        $less->compileFile($inputFile, $outputFile);
    } catch (Exception $ex) {
        echo "lessphp fatal error: ".$ex->getMessage();
    }
}
//Shortcodes 
add_shortcode( 'roadmainmenu', 'junko_mainmenu_shortcode' );
add_shortcode( 'roadstickymenu', 'junko_stickymenu_shortcode' );
add_shortcode( 'roadmobilemenu', 'junko_mobilemenu_shortcode' );
add_shortcode( 'roadcategoriesmenu', 'junko_roadcategoriesmenu_shortcode' );  
add_shortcode( 'roadminicart', 'junko_roadminicart_shortcode' );
add_shortcode( 'roadwishlist', 'junko_roadwishlist_shortcode' );
add_shortcode( 'roadproductssearch', 'junko_roadproductssearch_shortcode' ); 
add_shortcode( 'roadproductssearchdropdown', 'junko_roadproductssearchdropdown_shortcode' );
add_shortcode( 'ourbrands', 'junko_brands_shortcode' );
add_shortcode( 'image_slider', 'junko_imageslider_shortcode' );
add_shortcode( 'junko_counter', 'junko_counter_shortcode' );
add_shortcode( 'popular_categories', 'junko_popular_categories_shortcode' ); 
add_shortcode( 'latestposts', 'junko_latestposts_shortcode' );
add_shortcode( 'testimonials', 'junko_testimonials_shortcode' );
add_shortcode( 'magnifier_image', 'junko_magnifier_options' );
add_shortcode( 'timesale', 'junko_timesale_shortcode' );
add_shortcode( 'roadthemes_title', 'junko_heading_title_shortcode' );
add_shortcode( 'roadthemes_newsletter', 'junko_newsletter_shortcode' );
add_shortcode( 'roadsocialicons', 'junko_roadsocialicons_shortcode' );
add_shortcode( 'roadthemes_countdown', 'junko_countdown_shortcode' );
add_shortcode( 'roadlogo', 'junko_logo_shortcode' );
add_shortcode( 'roadthemes_menu', 'junko_roadthemes_menu' );
add_shortcode( 'roadthemes_policy', 'junko_roadthemes_policy' );
add_shortcode( 'roadthemes_static_1', 'junko_roadthemes_static_block_1' );
add_shortcode( 'roadthemes_static_2', 'junko_roadthemes_static_block_2' );
function junko_blog_sharing() {
    global $post;

    $junko_opt = get_option( 'junko_opt' );
    
    $share_url = get_permalink( $post->ID );
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
    $postimg = $large_image_url[0];
    $posttitle = get_the_title( $post->ID );
    ?>
    <div class="widget widget_socialsharing_widget"> 
        <h3 class="widget-title"><?php if(isset($junko_opt['blog_share_title']) && $junko_opt['blog_share_title']!='') { echo esc_html($junko_opt['blog_share_title']); } else { esc_html_e('Share this post', 'junko'); } ?></h3>
        <ul class="social-icons">
            <li><a class="facebook social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.$share_url; ?>'); return false;" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter social-icon" href="#" title="Twitter" onclick="javascript: window.open('<?php echo 'https://twitter.com/home?status='.$posttitle.'&nbsp;'.$share_url; ?>'); return false;" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a class="pinterest social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://pinterest.com/pin/create/button/?url='.$share_url.'&amp;media='.$postimg.'&amp;description='.$posttitle; ?>'); return false;" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
            <li><a class="gplus social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://plus.google.com/share?url='.$share_url; ?>'); return false;" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            <li><a class="linkedin social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.$share_url.'&amp;title='.$posttitle; ?>'); return false;" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>
    <?php
}
function junko_product_sharing() {
    $junko_opt = get_option( 'junko_opt' );
    
    if(isset($_POST['data'])) { // for the quickview
        $postid = intval( $_POST['data'] );
    } else {
        $postid = get_the_ID();
    }
    
    $share_url = get_permalink( $postid );

    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'large' );
    $postimg = $large_image_url[0];
    $posttitle = get_the_title( $postid );
    ?>
    <div class="widget widget_socialsharing_widget"> 
        <h3 class="widget-title"><?php if(isset($junko_opt['product_share_title']) && $junko_opt['product_share_title']!='') { echo esc_html($junko_opt['product_share_title']); } else { esc_html_e('Share this product', 'junko'); } ?></h3>
        <ul class="social-icons">
            <li><a class="facebook social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.$share_url; ?>'); return false;" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter social-icon" href="#" title="Twitter" onclick="javascript: window.open('<?php echo 'https://twitter.com/home?status='.$posttitle.'&nbsp;'.$share_url; ?>'); return false;" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a class="pinterest social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://pinterest.com/pin/create/button/?url='.$share_url.'&amp;media='.$postimg.'&amp;description='.$posttitle; ?>'); return false;" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
            <li><a class="gplus social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://plus.google.com/share?url='.$share_url; ?>'); return false;" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            <li><a class="linkedin social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.$share_url.'&amp;title='.$posttitle; ?>'); return false;" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>
    <?php
}
add_action( 'add_meta_boxes', 'junko_add_meta_box');
add_action( 'save_post', 'junko_save_meta_box_data');
function junko_meta_box_callback( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'junko_meta_box', 'junko_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta( $post->ID, '_junko_post_intro', true );

    echo '<label for="junko_post_intro">';
    esc_html_e( 'This content will be used to replace the featured image, use shortcode here', 'junko' );
    echo '</label><br />';
    wp_editor( $value, 'junko_post_intro', $settings = array() );
}
function junko_custom_sidebar_callback( $post ) {
    global $wp_registered_sidebars;

    $junko_opt = get_option( 'junko_opt' );

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'junko_meta_box', 'junko_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */

    //show sidebar dropdown select
    $csidebar = get_post_meta( $post->ID, '_junko_custom_sidebar', true );

    echo '<label for="junko_custom_sidebar">';
    esc_html_e( 'Select a custom sidebar for this post/page', 'junko' );
    echo '</label><br />';

    echo '<select id="junko_custom_sidebar" name="junko_custom_sidebar">';
        echo '<option value="">'.esc_html__('- None -', 'junko').'</option>';
        foreach($wp_registered_sidebars as $sidebar){
            $sidebar_id = $sidebar['id'];
            if($csidebar == $sidebar_id){
                echo '<option value="'.$sidebar_id.'" selected="selected">'.$sidebar['name'].'</option>';
            } else {
                echo '<option value="'.$sidebar_id.'">'.$sidebar['name'].'</option>';
            }
        }
    echo '</select><br />';

    //show custom sidebar position
    $csidebarpos = get_post_meta( $post->ID, '_junko_custom_sidebar_pos', true );

    echo '<label for="junko_custom_sidebar_pos">';
    esc_html_e( 'Sidebar position', 'junko' );
    echo '</label><br />';

    echo '<select id="junko_custom_sidebar_pos" name="junko_custom_sidebar_pos">'; ?>
        <option value="left" <?php if($csidebarpos == 'left') {echo 'selected="selected"';}?>><?php echo esc_html__('Left', 'junko'); ?></option>
        <option value="right" <?php if($csidebarpos == 'right') {echo 'selected="selected"';}?>><?php echo esc_html__('Right', 'junko'); ?></option>
    <?php echo '</select>';
}

function junko_add_meta_box() {

    $screens = array( 'post', 'page' );

    foreach ( $screens as $screen ) {
        if($screen == 'post'){
            add_meta_box(
                'junko_post_intro_section',
                esc_html__( 'Post featured content', 'junko' ),
                'junko_meta_box_callback',
                $screen
            );
            add_meta_box(
                'junko_custom_sidebar',
                esc_html__( 'Custom Sidebar', 'junko' ),
                'junko_custom_sidebar_callback',
                $screen
            );
        }
        if($screen == 'page'){
            add_meta_box(
                'junko_custom_sidebar',
                esc_html__( 'Custom Sidebar', 'junko' ),
                'junko_custom_sidebar_callback',
                $screen
            );
        }
    }
}
function junko_save_meta_box_data( $post_id ) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['junko_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['junko_meta_box_nonce'], 'junko_meta_box' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */
    
    // Make sure that it is set.
    if ( ! ( isset( $_POST['junko_post_intro'] ) || isset( $_POST['junko_custom_sidebar'] ) ) )  {
        return;
    }

    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['junko_post_intro'] );
    // Update the meta field in the database.
    update_post_meta( $post_id, '_junko_post_intro', $my_data );

    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['junko_custom_sidebar'] );
    // Update the meta field in the database.
    update_post_meta( $post_id, '_junko_custom_sidebar', $my_data );

    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['junko_custom_sidebar_pos'] );
    // Update the meta field in the database.
    update_post_meta( $post_id, '_junko_custom_sidebar_pos', $my_data );
    
} 
?>
<?php
class junko_widgets extends WP_Widget {
    function __construct() {
        parent::__construct(
            'junko_widgets', 
            esc_html__('Roadthemes Widgets', 'junko'), 
            // Widget description
            array( 'description' => esc_html__( 'Display recent posts, comments, popular posts', 'junko' ), ) 
        );
    }
    // Creating widget front-end
    public function widget( $args, $instance ) {
        global $post;
        $junko_opt = get_option( 'junko_opt' );
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after widget arguments are defined by themes
        echo wp_kses($args['before_widget'], array(
            'aside'=> array(
                'id'=>array(),
                'class'=>array()
            )
        ));
        if ( ! empty( $title ) )
            echo wp_kses($args['before_title'] . $title . $args['after_title'], array(
                'aside'=> array(
                    'id'=>array(),
                    'class'=>array()
                ),
                'h3'=> array(
                    'class'=>array()
                ),
                'span'=> array(
                    'class'=>array()
                )
            ));
        switch ($instance['type']) {
            case 'recent_posts':
                $postargs = array( 'posts_per_page' => $instance['amount'], 'order'=> 'DESC', 'orderby' => 'post_date' );
                $postslist = get_posts( $postargs );
                $thumbsize = explode(',', $instance['size']);
                $thumbsize[0] = (int)$thumbsize[0];
                $thumbsize[1] = (int)$thumbsize[1];
                ?>
                <div class="recent-posts">
                    <ul>
                        <?php
                        foreach ( $postslist as $post ) :
                            setup_postdata( $post ); ?> 
                            <li>
                                <div class="post-wrapper">
                                    <?php if ( has_post_thumbnail( $post->ID ) ) { ?>
                                        <div class="post-thumb">
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumbsize); ?></a>
                                        </div>
                                    <?php } ?>
                                    <div class="post-info">
                                        <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="post-date">
                                            <?php echo get_the_date(); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                </div>
                <?php
                wp_reset_postdata();
            break;
            case 'popular_posts':
                $postargs = array( 'posts_per_page' => $instance['amount'], 'order'=> 'DESC', 'orderby' => 'comment_count' );
                $postslist = get_posts( $postargs );
                $thumbsize = explode(',', $instance['size']);
                $thumbsize[0] = (int)$thumbsize[0];
                $thumbsize[1] = (int)$thumbsize[1];
                ?>
                <div class="recent-posts">
                    <ul>
                        <?php
                        foreach ( $postslist as $post ) :
                            setup_postdata( $post ); ?> 
                            <li>
                                <div class="post-wrapper">
                                    <?php if ( has_post_thumbnail( $post->ID ) ) { ?>
                                        <div class="post-thumb">
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumbsize); ?></a>
                                        </div>
                                    <?php } ?>
                                    <div class="post-info">
                                        <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="post-date">
                                            <?php echo get_the_date(); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                </div>
                <?php
                wp_reset_postdata();
            break;
            case 'recent_comments':
                $thumbsize = explode(',', $instance['size']);
                $thumbsize[0] = (int)$thumbsize[0];
                $commentargs = array(
                    'status' => 'approve',
                    'post_type' => 'post',
                    'number' => $instance['amount']
                );
                $comments = get_comments($commentargs); ?>
                <ul>
                    <?php foreach($comments as $comment) : ?>
                    <li>
                        <div class="post-wrapper">
                            <div class="post-thumb">
                                <?php echo get_avatar( $comment, $thumbsize[0], '', '' ); ?>
                            </div>
                            <div class="post-info">
                                <p><span class="comment-author"><?php echo esc_html($comment->comment_author); ?></span> <?php esc_html_e('says', 'junko');?>:</p>
                                <a href="<?php echo get_comments_link( $comment->comment_post_ID ); ?>" title="<?php echo esc_attr($comment->comment_author) .' on '. get_the_title( $comment->comment_post_ID );?>"><?php echo Junko_Class::junko_limitStringByWord($comment->comment_content, 30, '...'); ?></a>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>   
                <?php   
            break;
        }
        echo wp_kses($args['after_widget'], array(
            'aside'=> array(
                'id'=>array(),
                'class'=>array()
            ),
            'h3'=> array(
                'class'=>array()
            ),
            'span'=> array(
                'class'=>array()
            )
        ));
    }
    // Widget Backend 
    public function form( $instance ) {
        // Widget admin form
        if( $instance) {
            $title = $instance[ 'title' ];
            $amount = esc_attr($instance['amount']);
            $size = esc_attr($instance['size']);
            $type = esc_attr($instance['type']);
        } else {
            $title = '';
            $amount = '12';
            $size = '50,50';
            $type = 'recent_posts';
        }
        ?>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'junko' ); ?></label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'amount' )); ?>"><?php esc_html_e( 'Amount:', 'junko' ); ?></label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'amount' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'amount' )); ?>" type="text" value="<?php echo esc_attr($amount); ?>" />
        </p>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'size' )); ?>"><?php esc_html_e( 'Image size (example: 50,50):', 'junko' ); ?></label> 
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'size' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'size' )); ?>" type="text" value="<?php echo esc_attr($size); ?>" />
        </p>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'type' )); ?>"><?php esc_html_e( 'Widget Type:', 'junko' ); ?></label> 
        <select id="<?php echo esc_attr($this->get_field_id( 'amount' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>">
            <option value="recent_posts" <?php if($type=='recent_posts') echo 'selected="selected"';?>><?php esc_html_e('Recent Posts', 'junko');?></option>
            <option value="popular_posts" <?php if($type=='popular_posts') echo 'selected="selected"';?>><?php esc_html_e('Popular Posts', 'junko');?></option>
            <option value="recent_comments" <?php if($type=='recent_comments') echo 'selected="selected"';?>><?php esc_html_e('Recent Comments', 'junko');?></option>
        </select>
        </p>
    <?php 
    }
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['amount'] = ( ! empty( $new_instance['amount'] ) ) ? strip_tags( $new_instance['amount'] ) : '3';
        $instance['size'] = ( ! empty( $new_instance['size'] ) ) ? strip_tags( $new_instance['size'] ) : '50,50';
        $instance['type'] = ( ! empty( $new_instance['type'] ) ) ? strip_tags( $new_instance['type'] ) : 'recent_posts';
        return $instance;
    }
}
//Override woocommerce widgets
function junko_override_woocommerce_widgets() {
    //Show mini cart on all pages
    if ( class_exists( 'WC_Widget_Cart' ) && file_exists(get_template_directory().'/woocommerce/class-wc-widget-cart.php')) {
        unregister_widget( 'WC_Widget_Cart' ); 
        include_once( get_template_directory().'/woocommerce/class-wc-widget-cart.php' );
        register_widget( 'Custom_WC_Widget_Cart' );
    }
}
add_action( 'widgets_init', 'junko_override_woocommerce_widgets' );
// Register and load the widget
function junkotheme_load_junko_widgets() {
    register_widget( 'junko_widgets' );
}
add_action( 'widgets_init', 'junkotheme_load_junko_widgets' );