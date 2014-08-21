<?php
/*
Plugin Name: e-Commerce Product Slider
Plugin URI: http://ecommercewp.com/wpec-product-slider
Description: Customizable slider designed to work with WP e-Commerce to showcase selected products
Version: 1.0
Author: ecommercewp.com
Author URI: http://ecommercewp.com/
*/


if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => '506474baa588a',
        'title' => 'Slider Details',
        'fields' =>
        array (
            0 =>
            array (
                'key' => 'field_5064706780344',
                'label' => 'Use in Slider',
                'name' => 'use_in_slider',
                'type' => 'true_false',
                'instructions' => 'Check to use this product in the slider',
                'required' => '0',
                'message' => '',
                'order_no' => '0',
            ),
            1 =>
            array (
                'key' => 'field_505301aa3a035',
                'label' => 'Product Image',
                'name' => 'product_image',
                'type' => 'image',
                'instructions' => '',
                'required' => '0',
                'save_format' => 'object',
                'preview_size' => 'full',
                'order_no' => '1',
            ),
            2 =>
            array (
                'key' => 'field_506471e2c78d2',
                'label' => 'Description',
                'name' => 'description',
                'type' => 'textarea',
                'instructions' => 'Short catchy description of the product',
                'required' => '0',
                'default_value' => '',
                'formatting' => 'br',
                'order_no' => '2',
            ),
            3 =>
            array (
                'key' => 'field_5060698214392',
                'label' => 'Product Image Position',
                'name' => 'product_image_position',
                'type' => 'radio',
                'instructions' => '',
                'required' => '0',
                'choices' =>
                array (
                    'left' => 'Left',
                    'right' => 'Right',
                ),
                'default_value' => 'right',
                'layout' => 'horizontal',
                'order_no' => '3',
            ),
            4 =>
            array (
                'key' => 'field_505305213d5f4',
                'label' => 'Slide Background',
                'name' => 'slide_background',
                'type' => 'image',
                'instructions' => '',
                'required' => '0',
                'save_format' => 'object',
                'preview_size' => 'full',
                'order_no' => '4',
            ),
            5 =>
            array (
                'key' => 'field_505305213d8bd',
                'label' => 'Heading Color',
                'name' => 'heading_color',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => '0',
                'default_value' => '#eeeeee',
                'order_no' => '5',
            ),
            6 =>
            array (
                'key' => 'field_505311f440616',
                'label' => 'Heading Hover Color',
                'name' => 'heading_hover_color',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => '0',
                'default_value' => '#ffffff',
                'order_no' => '6',
            ),
            7 =>
            array (
                'key' => 'field_5053124dc2ab8',
                'label' => 'Description Color',
                'name' => 'description_color',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => '0',
                'default_value' => '#eeeeee',
                'order_no' => '7',
            ),
            8 =>
            array (
                'key' => 'field_505312b0a2149',
                'label' => 'Price Color',
                'name' => 'price_color',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => '0',
                'default_value' => '#eeeeee',
                'order_no' => '8',
            ),
            9 =>
            array (
                'key' => 'field_50604af0397ea',
                'label' => 'Add to Cart Button Background',
                'name' => 'add_to_cart_button',
                'type' => 'image',
                'instructions' => 'Upload your custom background image for the Add to Cart button of this slide',
                'required' => '0',
                'save_format' => 'object',
                'preview_size' => 'full',
                'order_no' => '9',
            ),
            10 =>
            array (
                'key' => 'field_506069821fd0a',
                'label' => 'Add to Cart Button Text Color',
                'name' => 'add_to_cart_button_text_color',
                'type' => 'color_picker',
                'instructions' => 'You can override the default white color here',
                'required' => '0',
                'default_value' => '#ffffff',
                'order_no' => '10',
            ),
            11 =>
            array (
                'key' => 'field_505349f9b3d07',
                'label' => 'Description Width',
                'name' => 'description_width',
                'type' => 'number',
                'instructions' => 'You may specify here desired width for the description section in percent. By default it\'s 50% of the full slider width. ',
                'required' => '0',
                'default_value' => '50',
                'order_no' => '11',
            ),
            12 =>
            array (
                'key' => 'field_50608a29ec36d',
                'label' => 'Left Margin',
                'name' => 'left_margin',
                'type' => 'number',
                'instructions' => 'The setting in pixels. You may want to adjust it depending on your image or description',
                'required' => '0',
                'default_value' => '62',
                'order_no' => '12',
            ),
            13 =>
            array (
                'key' => 'field_50608a29ec64a',
                'label' => 'Right Margin',
                'name' => 'right_margin',
                'type' => 'number',
                'instructions' => 'The setting in pixels. You may want to adjust it depending on your image or description',
                'required' => '0',
                'default_value' => '62',
                'order_no' => '13',
            ),
        ),
        'location' =>
        array (
            'rules' =>
            array (
                0 =>
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'wpsc-product',
                    'order_no' => '0',
                ),
            ),
            'allorany' => 'all',
        ),
        'options' =>
        array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' =>
            array (
            ),
        ),
        'menu_order' => 0,
    ));
} else {
    add_action('admin_notices', 'admin_warnings');
    function admin_warnings()
    {
        ?>
    <div class="error">
        <p>
            <?php echo __('<b>e-Commerce Product Slider</b> requires <a href="http://wordpress.org/extend/plugins/advanced-custom-fields/">Advanced Custom Fields</a> plugin to be installed', 'wpec-product-slider'); ?>
        </p>
    </div>
        <?php

    }
}

/**
 * Hide ACF menu item from the admin menu
 */

function hide_admin_menu()
{
    global $current_user;
    get_currentuserinfo();

    if ($current_user->user_login != 'admin') {
        echo '<style type="text/css">#toplevel_page_edit-post_type-acf{display:none;}</style>';
    }
}

add_action('admin_head', 'hide_admin_menu');

function add_media(){
	if (!is_admin()) {
	    wp_enqueue_style('jQueryUI', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/themes/base/jquery-ui.css');
	    wp_enqueue_style('wpecSlider', plugins_url('wpec-slider/css/wpec-slider.css', __FILE__));
	    wp_enqueue_script('jQueryEasing', plugins_url('wpec-slider/js/jquery.easing.1.2.js', __FILE__), array('jquery'));
	    wp_enqueue_script('jQueryTransform2D', plugins_url('wpec-slider/js/jquery.transform2d.js', __FILE__), array('jquery'));
	    wp_enqueue_script('jQueryUIResizable', plugins_url('wpec-slider/js/jquery-ui-1.8.23.resizable.min.js', __FILE__), array('jquery'));
	    wp_enqueue_script('spinner', plugins_url('wpec-slider/js/spin.min.js', __FILE__));
	    wp_enqueue_script('wpecSlider', plugins_url('wpec-slider/js/jquery.wpec-slider.js', __FILE__), array('jquery'));
	}
	
}

add_action( 'init', 'add_media');

if (is_admin()) {
    function wpec_ps_install()
    {
        if (!get_option('wpec_ps_image_height'))
            add_option('wpec_ps_image_height', 320);

        if (!get_option('wpec_ps_startSlide'))
            add_option('wpec_ps_startSlide');

        if (!get_option('wpec_ps_pagination'))
            add_option('wpec_ps_pagination', 1);

        if (!get_option('wpec_ps_dirNav'))
            add_option('wpec_ps_dirNav', 1);

        if (!get_option('wpec_ps_dirNavHide'))
            add_option('wpec_ps_dirNavHide', 1);

        if (!get_option('wpec_ps_autoplay'))
            add_option('wpec_ps_autoplay', 1);

        if (!get_option('wpec_ps_pauseTime'))
            add_option('wpec_ps_pauseTime', 2500);

        if (!get_option('wpec_ps_pauseOnHover'))
            add_option('wpec_ps_pauseOnHover', 1);

        if (!get_option('wpec_ps_animSpeed'))
            add_option('wpec_ps_animSpeed', 550);
    }

    register_activation_hook(__FILE__, 'wpec_ps_install');
    add_action('admin_menu', 'wpec_ps_admin_menu');

}

add_action('wpec_edit_product', 'wpec_ps_edit_product');

function wpec_ps_admin_menu()
{
    add_options_page('e-Commerce Product Slider', 'e-Commerce Slider', 'administrator', 'product-slider', 'product_slider_html_page');
}


function product_slider_html_page()
{
    switch ($_POST['action']) {

        case 'update':
            update_option('wpec_ps_image_height', $_POST['wpec_ps_image_height']);
            update_option('wpec_ps_startSlide', $_POST['wpec_ps_startSlide']);
            update_option('wpec_ps_pagination', $_POST['wpec_ps_pagination']);
            update_option('wpec_ps_dirNav', $_POST['wpec_ps_dirNav']);
            update_option('wpec_ps_dirNavHide', $_POST['wpec_ps_dirNavHide']);
            update_option('wpec_ps_autoplay', $_POST['wpec_ps_autoplay']);
            update_option('wpec_ps_pauseTime', $_POST['wpec_ps_pauseTime']);
            update_option('wpec_ps_pauseOnHover', $_POST['wpec_ps_pauseOnHover']);
            update_option('wpec_ps_animSpeed', $_POST['wpec_ps_animSpeed']);

            $message = __('Settings saved', 'wpec-product-slider');
            $output = '<div class="updated settings-error"><p><strong>' . $message . '</strong></p></div>';
            echo $output;
            wpec_ps_options_form();
            break;

        default:
            wpec_ps_options_form();
            break;
    }
}

function wpec_ps_options_form()
{
    ?><div class="wrap">
            <div id="icon-options-general" class="icon32"><br/></div>
            <h2><?php echo __('e-Commerce Product Slider', 'wpec-product-slider'); ?></h2>

            <form action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post">
                <p style="border-top: 1px solid #DFDFDF;">
                    <br><?php echo __('To add the slider use this shortcode in your page/post:', 'wpec-product-slider'); ?>
                <code>[wpec_product_slider]</code><br>
                <br><?php echo __('<i>or</i> use the following PHP tag in one of your theme files', 'wpec-product-slider'); ?>
                <code>&lt;?php if ( function_exists('wpec_product_slider') ) wpec_product_slider(); ?&gt;</code>
                </p>

                <div style="border-top: 1px solid #DFDFDF;">
                    <br>
                    <table class="form-table">
                        <tbody>
                        <tr>
                            <th scope="row"><label for="wpec_ps_image_height">Height</label></th>
                            <td>
                                <input type="text" class="small-text" value="<?php echo get_option('wpec_ps_image_height'); ?>" id="wpec_ps_image_height" name="wpec_ps_image_height">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">
                                <label for="sart-slide"><?php echo __('Initial slide will show this product', 'wpec-product-slider'); ?></label></th>
                            <td>
                                <?php
                                $posts = get_posts(array(
                                    'numberposts' => -1,
                                    'post_type' => 'wpsc-product',
                                    'meta_key' => 'use_in_slider',
                                    'meta_value' => 1
                                ));
                                if ($posts): ?>
                                    <select id="sart-slide" name="wpec_ps_startSlide" style="min-width: 25em">
                                        <?php foreach ($posts as $post): ?>
                                        <option value="<?php echo $post->ID; ?>" <?php if (get_option('wpec_ps_startSlide') == $post->ID) {
                                            echo 'selected="true"';
                                        } ?>><?php echo get_the_title($post->ID); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php endif; ?>
                                <span class="description"></span></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php echo __('Pagination', 'wpec-product-slider'); ?></th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text">
                                        <span><?php echo __('Show pagination controls', 'wpec-product-slider'); ?></span>
                                    </legend>
                                    <label for="pagination_ctrls">
                                        <input type="checkbox" value="1" id="pagination_ctrls" name="wpec_ps_pagination" <?php checked('1', get_option('wpec_ps_pagination')); ?>>
                                        <?php echo __('Show pagination controls', 'wpec-product-slider'); ?></label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php echo __('Directional Navigation', 'wpec-product-slider'); ?></th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text"><span><?php echo __('Directional Navigation', 'wpec-product-slider'); ?></span>
                                    </legend>
                                    <label for="dir-nav">
                                        <input type="checkbox" value="1" id="dir-nav" name="wpec_ps_dirNav" <?php checked('1', get_option('wpec_ps_dirNav')); ?>>
                                        <?php echo __('Use previous/next buttons', 'wpec-product-slider'); ?></label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php echo __('Hidden Directional Navigation', 'wpec-product-slider'); ?></th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text">
                                        <span><?php echo __('Hidden Directional Navigation', 'wpec-product-slider'); ?></span></legend>
                                    <label for="dir_nav_hide">
                                        <input type="checkbox" value="1" id="dir_nav_hide" name="wpec_ps_dirNavHide" <?php checked('1', get_option('wpec_ps_dirNavHide')); ?>>
                                        <?php echo __('Show previous/next buttons on mouse hover', 'wpec-product-slider'); ?></label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php echo __('Autoplay', 'wpec-product-slider'); ?></th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text"><span><?php echo __('Autoplay', 'wpec-product-slider'); ?></span></legend>
                                    <label for="wpec_ps_autoplay">
                                        <input type="checkbox" value="1" id="wpec_ps_autoplay" name="wpec_ps_autoplay" <?php checked('1', get_option('wpec_ps_autoplay')); ?>>
                                        <?php echo __('Slides will change automatically', 'wpec-product-slider'); ?></label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><label for="pause-time"><?php echo __('Pause Time', 'wpec-product-slider'); ?></label></th>
                            <td>
                                <input type="text" class="regular-text" value="<?php echo get_option('wpec_ps_pauseTime'); ?>" id="pause-time" name="wpec_ps_pauseTime">
                                <span class="description"></span></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php echo __('Pause on Hover', 'wpec-product-slider'); ?></th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text"><span><?php echo __('Pause on Hover', 'wpec-product-slider'); ?></span></legend>
                                    <label for="pause-on-hover">
                                        <input type="checkbox" value="1" id="pause-on-hover" name="wpec_ps_pauseOnHover" <?php checked('1', get_option('wpec_ps_pauseOnHover')); ?>>
                                        <?php echo __('Slider will pause on mouseover, resume on mouseout', 'wpec-product-slider'); ?></label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><label for="anim-speed"><?php echo __('Animation Speed', 'wpec-product-slider'); ?></label></th>
                            <td>
                                <input type="text" class="regular-text" value="<?php echo get_option('wpec_ps_animSpeed'); ?>" id="anim-speed" name="wpec_ps_animSpeed">
                                <span class="description"></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <p class="submit">
                    <input class="button-primary" name="Submit" type="submit" value="<?php esc_attr_e('Save Changes', 'wpec-product-slider'); ?>"/>
                    <input type="hidden" name="action" value="update"/>
            </form>
        </div>
    <?php

}
     if (!function_exists('changeSign')) {
    function changeSign($str){
        
          //  var_dump($str);
          $str = preg_replace("/^.*(".(wpsc_get_currency_symbol() == '$' ? '\\'.wpsc_get_currency_symbol():wpsc_get_currency_symbol())."){1}.*?/", '<span class="csymb">'.wpsc_get_currency_symbol().'</span>', $str);
  
      return $str;
    }
}
function wpec_product_slider_gen()
{
    $args = array('post_type' => 'wpsc-product', 'meta_key' => 'use_in_slider', 'meta_value' => 1);
    $wp_query = new WP_Query($args);

    $html = '<div id="wpec-slider"><ul>';
    $class_first = '';
    while ($wp_query->have_posts()) {
        $wp_query->the_post();
        $bg = get_field('slide_background');
        if($bg['url']){
            $slide_backdrop = 'style="background:url(\'' . $bg['url'] . '\') center center no-repeat"';
        } else {
            $slide_backdrop = '';
        }
        if ((get_field('product_image_position') == 'left')) {
            $pim_alignment_class = 'pim-left';
            $marginImg = (get_field('left_margin') != null) ? ('left:' . get_field('left_margin') . 'px;') : ('');
            $marginAbout = (get_field('right_margin') != null) ? ('right:' . get_field('right_margin') . 'px;') : ('');
        } else {
            $pim_alignment_class = 'pim-right';
            $marginImg = (get_field('right_margin') != null) ? ('right:' . get_field('right_margin') . 'px;') : ('');
            $marginAbout = (get_field('left_margin') != null) ? ('left:' . get_field('left_margin') . 'px;') : ('');
        }

        $pim_attachment = get_field('product_image');
        $attachment_id = $pim_attachment['id'];
        $prod_image = wp_get_attachment_image_src($attachment_id, 'full');

        $add_to_cart_button = get_field('add_to_cart_button');
        if ($add_to_cart_button) {
            $add_to_cart_button_bg = 'background:url(\'' . $add_to_cart_button['url'] . '\') center center no-repeat;';
        } else {
            $add_to_cart_button_bg = '';
        }

        if (get_option('wpec_ps_startSlide') == get_the_ID()) {
            $class_first = ' first';
        } else {
            $class_first = '';
        }

        $html .= '<li class="' . $pim_alignment_class . $class_first . '" '.$slide_backdrop.'><a class="product-image" href="' . get_permalink() . '" ' . $marginImg . '">';
        $html .= '<img src="' . $prod_image[0] . '" width="' . $prod_image[1] . '" height="' . $prod_image[2] . '">';
        $html .= '</a>
            <div class="about" style="width:' . get_field('description_width') . '%; ">
                <a class="product-name wpsc-product-' . get_the_ID() . '" href="' . get_permalink() . '" style="color:' . get_field('heading_color') . '" onmouseover="this.style.color=\'' . get_field('heading_hover_color') . '\'" onmouseout="this.style.color=\'' . get_field('heading_color') . '\'"><h1>' . get_the_title() . '</h1></a>
                <div class="description" style="color:' . get_field('description_color') . '">' . get_field('description') . '
                </div>';
        $html .= '<div class="buyit">';
        $price = changeSign(wpsc_the_product_price());
        


        $html .= '<span class="price" style="color:' . get_field('price_color') . ';">'.__('price &nbsp;', 'wpsc'). $price . '</span>';

        if (wpsc_product_external_link(wpsc_the_product_id()) != '') {
            $action = wpsc_product_external_link(wpsc_the_product_id());
        } else {
            $action = wpsc_this_page_url();
        }
        $html .= '<form class="product_form" id="product_' . wpsc_the_product_id() . '" enctype="multipart/form-data" action="' . $action . '" method="post" name="product_' . wpsc_the_product_id() . '">';
        $html .= '<input type="hidden" value="add_to_cart" name="wpsc_ajax_action" />';
        $html .= '<input type="hidden" value="' . wpsc_the_product_id() . '" name="product_id" />';
        if (wpsc_product_has_stock()) {

            $html .= '<div class="wpsc_buy_button_container">';
            $html .= '<div class="wpsc_loading_animation" style="height:42px;width:42px;">';
            $html .= '</div><!--close wpsc_loading_animation-->';
            if (wpsc_product_external_link(wpsc_the_product_id()) != '') {
                $action = wpsc_product_external_link(wpsc_the_product_id());
                $html .= '<input style="' . $add_to_cart_button_bg . '" class="wpsc_buy_button" type="button" value="' . wpsc_product_external_link_text(wpsc_the_product_id(), __('Buy Now', 'wpsc')) . '" onclick="return gotoexternallink(\'' . $action . '\', \'' . wpsc_product_external_link_target(wpsc_the_product_id()) . '\')">';
            } else {
                $html .= '<input style="' . $add_to_cart_button_bg . '" type="submit" value="' . __('Add To Cart', 'wpsc') . '" name="Buy" class="wpsc_buy_button" id="product_' . wpsc_the_product_id() . '_submit_button" />';
            }

            $html .= '</div><!--close wpsc_buy_button_container-->';
        } else {
            $html .= '<p class="soldout">' . __('This product has sold out.', 'wpsc') . '</p>';
        }

        $html .= '</form>';
        $html .= '</div><!--buyit-->
            </div>
            </li>';

    }
    wp_reset_query();

    $html .= '</ul>
    </div>';
    global $effects;
    $html .= "<script>
                    jQuery(window).load(function(){
                        jQuery('.about').each(function(){
                            
                        });
                        jQuery('#wpec-slider').wpecSlider({
                            directionalNav:" . (get_option('wpec_ps_dirNav') ? 'true' : 'false') . ",
                            hiddenDirNav:" . (get_option('wpec_ps_dirNavHide') ? 'true' : 'false') . ",
                            autoplay:" . (get_option('wpec_ps_autoplay') ? get_option('wpec_ps_pauseTime') : (0)) . ",
                            pagination: " . (get_option('wpec_ps_pagination') ? 'true' : 'false') . ",
                            pauseOnHover: " . (get_option('wpec_ps_pauseOnHover') ? 'true' : 'false') . ",
                            animationSpeed: ".(get_option('wpec_ps_animSpeed') ? (get_option('wpec_ps_animSpeed')) : (550)).",
                            current: jQuery('#wpec-slider > ul > li').index(jQuery('.first'))
                        });
                        
                        jQuery('#wpec-slider > ul > li').each(function(i){
                            if(jQuery(this).hasClass('first')){
                                jQuery('#wpec-slider .pagination li:eq('+ i +')').addClass('curr');
                            }
                            var opts = {
                              lines: 11,
                              length: 3,
                              width: 2,
                              radius: 4,
                              corners: 0,
                              rotate: 90,
                              color: jQuery(this).find('.price').css('color'),
                              speed: 2.2,
                              trail: 50,
                              shadow: false,
                              hwaccel: true,
                              className: 'spinner',
                              zIndex: 200,
                              top: '23px',
                              left: '0'
                            };
                            var target = jQuery(this).find('.wpsc_loading_animation');
                            var spinner = new Spinner(opts).spin(target);
                            target.append(spinner.el);
                        });
                        jQuery('#wpec-slider').resizable({ handles: \"s\", minHeight: 100, maxHeight: 320 });


                    });
              </script>";
    return $html;
}

add_shortcode('wpec_product_slider', 'wpec_product_slider_gen');


function wpec_product_slider() // Template tag
{
    echo wpec_product_slider_gen();
}


/* Featured Products Widget */
add_action('widgets_init', 'wpec_product_slider_widget');

function wpec_product_slider_widget()
{
    register_widget('eCommerce_Slider');
}


class eCommerce_Slider extends WP_Widget
{

    /**
     * Widget setup.
     */
    function eCommerce_Slider()
    {
        /* Widget settings. */
        $widget_ops = array('classname' => 'example', 'description' => __('Showcase of selected products', 'ti-featuredrotator'));

        /* Widget control settings. */
        $control_ops = array('width' => 250, 'height' => 350, 'id_base' => 'wpec-slider-widget');

        /* Create the widget. */
        $this->WP_Widget('wpec-slider-widget', __('eCommerce Slider', 'wpec-product-slider'), $widget_ops, $control_ops);
    }

    /**
     * How to display the widget on the screen.
     * @param $args
     * @param $instance
     */
    function widget($args, $instance)
    {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        echo '
        	<section class="black_texture">
        	<div class="container_12">
        		<div class="grid_12">';
        wpec_product_slider();
        echo '</div>
        	</div>
        	</section>';
        

    }

    /**
     * Update the widget settings.
     * @param $new_instance
     * @param $old_instance
     * @return array
     */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    /**
     * Displays the widget settings controls on the widget panel.
     * Make use of the get_field_id() and get_field_name() function
     * when creating your form elements. This handles the confusing stuff.
     * @param $instance
     */
    function form($instance)
    {
        /* Set up some default widget settings. */
        $defaults = array('title' => __('What\'s hot', 'wpec-product-slider'));
        $instance = wp_parse_args((array)$instance, $defaults); ?>

    <!-- Widget Title: Text Input -->
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'hybrid'); ?></label><input
        id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>"
        value="<?php echo $instance['title']; ?>" class="widefat"/></p>
    <?php
    }
}
