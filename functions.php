<?php

// Enqueue styles and scripts
function bc_styles() {
    wp_register_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7', 'all' );
    wp_register_style( 'bc-styles', get_template_directory_uri() . '/style.css', array(), 1.0, 'all' );
    wp_register_style( 'google-fonts',
        'https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic', array(), 1.0, 'all' );
    wp_register_style( 'ekko-lightbox-styles', 'https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.css', array(), '4.0.1', 'all' );
    wp_enqueue_style( 'bootstrap' );
    wp_enqueue_style( 'bc-styles' );
    wp_enqueue_style( 'google-fonts' );
    wp_enqueue_style( 'ekko-lightbox-styles' );
}
add_action( 'wp_enqueue_scripts', 'bc_styles' );

function bc_scripts() {
    wp_register_script( 'jquery-js', 'https://code.jquery.com/jquery-2.2.4.min.js', array(), '2.2.4' );
    wp_register_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(), '3.3.7', true );
    wp_register_script( 'global-js', get_template_directory_uri() . '/js/bc.js', array(), '1.0', true );
    wp_register_script( 'ekko-lightbox-js', 'https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.min.js', array(), '4.0.1', true );
    wp_enqueue_script( 'jquery-js' );
    wp_enqueue_script( 'bootstrap-js' );
    wp_enqueue_script( 'global-js' );
    wp_enqueue_script( 'ekko-lightbox-js' );
}
add_action( 'wp_enqueue_scripts', 'bc_scripts' );

add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'primary', __( 'Navigation Menu', 'blankcanvas' ) );
}

add_theme_support( 'post-thumbnails' );

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
    global $post;
    return '<br><a class="btn btn-default btn-xs" role="button" href="'. get_permalink($post->ID) . '">Read more &raquo;</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function bc_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name', 'display' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', 'bc_wp_title', 10, 2 );

function add_image_responsive_class($content) {
   global $post;
   $pattern ="/<img(.*?)class=\"(.*?)\"(.*?)>/i";
   $replacement = '<img$1class="$2 img-responsive"$3>';
   $content = preg_replace($pattern, $replacement, $content);
   return $content;
}
add_filter('the_content', 'add_image_responsive_class');

function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}

function add_categories_to_pages() {
    register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'add_categories_to_pages' );

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}

function page_meta_boxes() {
    $meta_boxes = array(
        // Level 1 page options
        array(
            'id' => 'tours_festivals',
            'title' => 'Tours and festivals',
            'pages' => 'page',
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => 'Tours and festivals content',
                    'desc' => '',
                    'id' => 'tours_festivals_content',
                    'type' => 'textarea',
                    'std' => ''
                )
            )
        ),
        array(
            'id' => 'bg_position',
            'title' => 'Feature image position',
            'pages' => 'page',
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => 'Position',
                    'desc' => '',
                    'id' => 'bg_img_position',
                    'type' => 'select',
                    'options' => array('center', 'top', 'bottom')
                )
            )
        )
    );
    // Adds meta boxes to Level 1 Landing page template
    foreach ( $meta_boxes as $meta_box ) {
        $page_box = new CreateMetaBox( $meta_box );
    }
}
add_action( 'init', 'page_meta_boxes' );

// Creates meta boxes from $meta_boxes[] = array()
// See http://www.deluxeblogtips.com/2010/05/howto-meta-box-wordpress.html for more info
// Edited from original for TNA purposes
class CreateMetaBox {
    protected $_meta_box;
    // create meta box based on given data
    function __construct( $meta_box ) {
        $this->_meta_box = $meta_box;
        add_action( 'admin_menu', array( &$this, 'add' ) );
        add_action( 'save_post', array( &$this, 'save' ) );
    }
    /// Add meta box
    function add() {
        add_meta_box( $this->_meta_box['id'], $this->_meta_box['title'], array( &$this, 'show' ), 'page',
            $this->_meta_box['context'], $this->_meta_box['priority'] );
    }
    // Callback function to show fields in meta box
    function show() {
        global $post;
        // Use nonce for verification
        echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce( basename( __FILE__ ) ), '" />';
        echo '<table class="form-table">';
        foreach ( $this->_meta_box['fields'] as $field ) {
            // get current post meta data
            $meta = get_post_meta( $post->ID, $field['id'], true );
            echo '<tr>',
            '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
            '<td>';
            switch ( $field['type'] ) {
                case 'text':
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                    '<br />', $field['desc'];
                    break;
                case 'textarea':
                    $field_value = get_post_meta( $post->ID, $field['id'], false );
                    if ( ! array_key_exists( 0, $field_value ) ) {
                        array_push( $field_value, '' );
                    }
                    $args        = array(
                        'media_buttons' => false,
                        'textarea_rows' => 4,
                        'tinymce'       => false,
                        'quicktags'     => array( 'buttons' => 'strong,em,ul,ol,li,link' ),
                        'wpautop'       => false
                    );
                    wp_editor( $field_value[0], $field['id'], $args );
                    // echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
                    echo '<br />', $field['desc'];
                    break;
                case 'select':
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    foreach ( $field['options'] as $option ) {
                        echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                    }
                    echo '</select>';
                    echo ' ', $field['desc'];
                    break;
                case 'radio':
                    foreach ( $field['options'] as $option ) {
                        echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                    }
                    break;
                case 'checkbox':
                    echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                    break;
            }
            echo '<td>',
            '</tr>';
        }
        echo '</table>';
    }
    // Save data from meta box
    function save( $post_id ) {
        // verify nonce
        if ( ! wp_verify_nonce( $_POST['mytheme_meta_box_nonce'], basename( __FILE__ ) ) ) {
            return $post_id;
        }
        // check autosave
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        // check permissions
        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
        foreach ( $this->_meta_box['fields'] as $field ) {
            $old = get_post_meta( $post_id, $field['id'], true );
            $new = $_POST[ $field['id'] ];
            if ( $new && $new != $old ) {
                update_post_meta( $post_id, $field['id'], $new );
            } elseif ( '' == $new && $old ) {
                delete_post_meta( $post_id, $field['id'], $old );
            }
        }
    }
}
