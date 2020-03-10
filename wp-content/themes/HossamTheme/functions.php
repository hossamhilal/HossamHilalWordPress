<?php
define('DIR_URI', get_template_directory_uri());
define('CSS_URI', get_template_directory_uri() . '/css/');
define('JS_URI', get_template_directory_uri() . '/js/');
define('Plugin_URI', get_template_directory_uri() . '/plugins/');
add_action('wp_enqueue_scripts', 'theme_files');
function theme_files()
{
    wp_enqueue_style('bootstrap', CSS_URI . 'bootstrap.min.css');
    wp_enqueue_style('jqyery_Ui_Css', Plugin_URI . 'jquery-ui/jquery-ui.min.css');
    wp_enqueue_style('icofont', CSS_URI . 'icofont.min.css');
    wp_enqueue_style('owlCarousel_Css', Plugin_URI . 'owlCarousel/owl.carousel.min.css');
    wp_enqueue_style('fancybox_Css', Plugin_URI . 'fancybox/jquery.fancybox.min.css');
    wp_enqueue_style('macy_Css', Plugin_URI . 'macy/macy.css');
    wp_enqueue_style('main-style', CSS_URI . 'style.css');
    wp_enqueue_style('style', DIR_URI);


    wp_enqueue_script('jqyery_Ui_Js', Plugin_URI . 'jquery-ui/jquery-ui.min.js', array('jquery'), 'null', true);
    wp_enqueue_script('popper', JS_URI . 'popper.min.js', array('jquery'), 'null', true);
    wp_enqueue_script('bootstrap-js', JS_URI . 'bootstrap.min.js', array('jquery'), 'null', true);
    wp_enqueue_script('owl_Js', Plugin_URI . 'owlCarousel/owl.carousel.min.js', array('jquery'), 'null', true);
    wp_enqueue_script('fancyJs', Plugin_URI . 'fancybox/jquery.fancybox.min.js', array('jquery'), 'null', true);
    wp_enqueue_script('macy_Js', Plugin_URI . 'macy/macy.js', array('jquery'), 'null', true);
    wp_enqueue_script('mixitup', Plugin_URI . 'mixitup/mixitup.min.js', array('jquery'), 'null', true);
    wp_enqueue_script('customUpload', JS_URI . 'custom.js', array('jquery'), 'null', true);
    wp_enqueue_script('customJs', JS_URI . 'custom.js', array('jquery'), 'null', true);
    if (is_singular()) {
        wp_enqueue_script("comment-reply");
    }
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////         add media upload window      ///////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
function load_admin_things()
{
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
}

add_action('admin_enqueue_scripts', 'load_admin_things');


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////         Register Admin css , js        //////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function my_scripts()
{
    if (is_admin()) {
        wp_enqueue_script('admin-js', get_template_directory_uri() . '/includes/admin-js.js');
        wp_enqueue_style('admin-css', get_template_directory_uri() . '/includes/admin-css.css');
    }
}

add_action('init', 'my_scripts');


////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////       Register Custom Navigation Walker   /////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';


////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////         REGISTER THE Nav Menu       ///////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_action('after_setup_theme', 'register_my_menus');
function register_my_menus()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header'),
            'footer' => __('footer')
        )
    );
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////         ADD ACTIVE CLASS TO NAV ITEM        ///////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

function special_nav_class($classes, $item)
{
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active ';
    }
    return $classes;
}


////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////   Header Details      ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function register_header_menu()
{
    add_menu_page (
        'Header Details',
        'Header Details',
        'administrator',
        'header_details',
        'header_details_Function' ,
        'dashicons-welcome-view-site',
        25
    );
}
add_action('admin_menu', 'register_header_menu');

// Add Fields To theme setting  Page
function header_details_Function()
{
    $header_data = get_option('header_details', true);
    ?>
    <div class="AdminCustomWrapper">
        <h1> Header Details </h1>
        <form method="post" action="">
            <?php settings_fields('header_details_page'); ?>
            <div class="FormWrapper">
                <?php if ($header_data['image'] != " ") { ?>
                    <div class="FieldImage displayImageField">
                        <div class="reviewImageBox">
                            <img src="<?php echo $header_data['image']; ?>" alt="image" class="reviewImage">
                        </div>
                        <input type="hidden" class="file_url" name="header_details[image]" value="<?php echo $header_data['image']; ?>"/>
                        <div class="FieldImageButtons">
                            <label class="uploadImageBtn"> Choose Icon </label>
                            <span class="removeImage"> Delete </span>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="FieldImage uploadImageField">
                        <div class="reviewImageBox" style="display:none;">
                            <img src="" alt="image" class="reviewImage">
                        </div>
                        <input type="hidden" class="file_url" name="header_details[image]" value=""/>
                        <div class="FieldImageButtons">
                            <label class="uploadImageBtn"> Choose Icon </label>
                            <span class="removeImage"> Delete </span>
                        </div>
                    </div>
                <?php } ?>

                <div class="FormField">
                    <label> Sub Title </label>
                    <input type="text" class="InputBox" name="header_details[sub_title]"  value="<?= $header_data['sub_title']; ?>">
                </div>

                <div class="FormField">
                    <label> Title </label>
                    <input type="text" class="InputBox" name="header_details[title]"  value="<?= stripslashes($header_data['title']); ?>">
                </div>

                <div class="FormField">
                    <label> Description </label>
                    <textarea type="text" class="InputBox" name="header_details[desc]" value="<?= $header_data['desc']; ?>"><?= $header_data['desc']; ?></textarea>
                </div>

                <div class="FormField">
                    <label> Get Started Link </label>
                    <input type="text" class="InputBox" name="header_details[get_started_link]"  value="<?= $header_data['get_started_link']; ?>">
                </div>

                <div class="FormField">
                    <label> ReadMore Link </label>
                    <input type="text" class="InputBox" name="header_details[read_more]"  value="<?= $header_data['read_more']; ?>">
                </div>

                <?php submit_button(); ?>
            </div>
        </form>
    </div>
<?php }

// save fields date
if ($_POST['option_page'] == 'header_details_page') {
    $header_data = array(
        'header_details',
    );
    foreach ($header_data as $header_dataa) {
        update_option($header_dataa, $_POST[$header_dataa]);
    }
}


////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////        Features      ///////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function create_Features()
{
    // register post
    register_post_type('Features',
        // CPT Options
        array(
            'labels' => array(
                'name' => 'Features',
                'singular_name' => 'Features',
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Features'),
            // remove supports from post
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-admin-appearance',
            'menu_position' => 26
        )
    );
}
add_action('init', 'create_Features');

//  ADD Sub Menu to Features
function register_features_submenu()
{
    add_submenu_page(
        'edit.php?post_type=features',
        'Features Details',
        'Features Details',
        'administrator',
        'features_details',
        'Features_Details_Function'
    );
}
add_action('admin_menu', 'register_features_submenu');

// Add Fields To features Details Page
function Features_Details_Function()
{
    // restore data from database
    $features_data = get_option('features_array', true);
    ?>
    <div class="AdminCustomWrapper">
        <h1> Features Details </h1>
        <form method="post" action="">
            <?php settings_fields('features_details_page'); ?>
            <div class="FormWrapper">
                <div class="FormField">
                    <label> Title</label>
                    <input type="text" class="InputBox" name="features_array[title]" value="<?= $features_data['title']; ?>">
                </div>
                <div class="FormField">
                    <label> Sub Title </label>
                    <input type="text" class="InputBox" name="features_array[sub_title]" value="<?= $features_data['sub_title']; ?>">
                </div>
                <div class="FormField">
                    <label> Description </label>
                    <textarea type="text" class="InputBox" name="features_array[desc]" value="<?= $features_data['desc']; ?>"> <?= $features_data['desc']; ?></textarea>
                </div>
                <?php submit_button(); ?>
            </div>
        </form>
    </div>
<?php }

if ($_POST['option_page'] == 'features_details_page') {
    // save data to array on database
    $features_details = array(
        'features_array',
    );
    foreach ($features_details as $features_detail) {
        update_option($features_detail, $_POST[$features_detail]);
    }
}


////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////   Discover       /////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function create_Discover()
{
    add_menu_page (
        'Discover',
        'Discover',
        'administrator',
        'Discover',
        'Discover_Details_Function' ,
        'dashicons-location',
        27
    );
}
add_action('admin_menu', 'create_Discover');

// Add Fields To discover Details Page
function Discover_Details_Function()
{
    $discover_data = get_option('discover_array', true);
    $discover_list = get_option('discover_list', true);
    ?>
    <div class="AdminCustomWrapper">
        <h1> Discover Details </h1>
        <form method="post" action="">
            <?php settings_fields('discover_details_page'); ?>
            <div class="FormWrapper">
                <?php if ($discover_data['image'] != " ") { ?>
                    <div class="FieldImage displayImageField">
                        <div class="reviewImageBox">
                            <img src="<?php echo $discover_data['image']; ?>" alt="image" class="reviewImage">
                        </div>
                        <input type="hidden" class="file_url" name="discover_array[image]" value="<?php echo $discover_data['image']; ?>"/>
                        <div class="FieldImageButtons">
                            <label class="uploadImageBtn"> Choose Icon </label>
                            <span class="removeImage"> Delete </span>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="FieldImage uploadImageField">
                        <div class="reviewImageBox" style="display:none;">
                            <img src="" alt="image" class="reviewImage">
                        </div>
                        <input type="hidden" class="file_url" name="discover_array[image]" value=""/>
                        <div class="FieldImageButtons">
                            <label class="uploadImageBtn"> Choose Icon </label>
                            <span class="removeImage"> Delete </span>
                        </div>
                    </div>
                <?php } ?>
                <div class="FormField">
                    <label> Title</label>
                    <input type="text" class="InputBox" name="discover_array[title]" value="<?= $discover_data['title']; ?>">
                </div>
                <div class="FormField">
                    <label> Sub Title </label>
                    <input type="text" class="InputBox" name="discover_array[sub_title]" value="<?= $discover_data['sub_title']; ?>">
                </div>
                <div class="FormField">
                    <label> Description </label>
                    <textarea type="text" class="InputBox" name="discover_array[desc]"  value="<?= $discover_data['desc']; ?>"> <?= stripslashes($discover_data['desc']); ?> </textarea>
                </div>
                <div class="list-box">
                    <?php if ($discover_list) {
                         foreach ( $discover_list as $key => $value) { ?>
                            <div class="list-box-item">
                                <input type="text" class="list-input" name="discover_list[]"  value="<?php echo $value; ?>">
                                <span class="delete-Btn"> Delete  </span>
                            </div>
                    <?php } ?>
                     <?php } else { ?>
                        <div class="list-box-item">
                            <input type="text" class="list-input" name="discover_list[]"  value="">
                        </div>
                    <?php } ?>
                    <span class="list-btn"> add more  </span>
                </div>
                <?php submit_button(); ?>
            </div>
        </form>
    </div>
<?php }

if ($_POST['option_page'] == 'discover_details_page') {
    $discovers_details = array(
        'discover_array',
        'discover_list',
    );
    foreach ($discovers_details as $discover_detail) {
        update_option($discover_detail, $_POST[$discover_detail]);
    }
}



////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////     Services          ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function create_Services()
{
    register_post_type('Services',
        array(
            'labels' => array(
                'name' => 'Services',
                'singular_name' => 'Services',
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Services'),
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-networking',
            'menu_position' => 28
        )
    );
}

add_action('init', 'create_Services');

//  ADD Sub Menu to Services
function register_services_submenu()
{
    add_submenu_page(
        'edit.php?post_type=services',
        'Details',
        'Services Details',
        'administrator',
        'services_details',
        'Services_Details_Function'
    );
}

add_action('admin_menu', 'register_services_submenu');

// Add Fields To services Details Page
function Services_Details_Function()
{
    $service_data = get_option('services_array', true);
    ?>
    <div class="AdminCustomWrapper">
        <h1>Services Details</h1>
        <form method="post" action="">
            <?php settings_fields('services_details_page'); ?>
            <div class="FormWrapper">
                <div class="FormField">
                    <label> Title</label>
                    <input type="text" class="InputBox" name="services_array[title]"  value="<?= $service_data['title']; ?>">
                </div>
                <div class="FormField">
                    <label> Sub Title </label>
                    <input type="text" class="InputBox" name="services_array[sub_title]" value="<?= $service_data['sub_title']; ?>">
                </div>
                <div class="FormField">
                    <label> Description </label>
                    <textarea type="text" class="InputBox" name="services_array[desc]" value="<?= $service_data['desc']; ?>"><?= $service_data['desc']; ?></textarea>
                </div>
                <?php submit_button(); ?>
            </div>
        </form>
    </div>
<?php }

if ($_POST['option_page'] == 'services_details_page') {
    $services_details = array(
        'services_array',
    );
    foreach ($services_details as $service_detail) {
        update_option($service_detail, $_POST[$service_detail]);
    }
}


////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////      Home Posts       ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function create_home_marketing()
{
    register_post_type('Home Marketing',
        array(
            'labels' => array(
                'name' => 'Home Marketing',
                'singular_name' => 'Home Marketing',
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'home_marketing'),
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-forms',
            'menu_position' => 29
        )
    );
}
add_action('init', 'create_home_marketing');


////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////      Portfolio       ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function create_portfolio()
{
    register_post_type('Portfolio',
        array(
            'labels' => array(
                'name' => 'Portfolio',
                'singular_name' => 'Portfolio',
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'portfolio'),
            'taxonomies'  => array( 'category' ),
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-id',
            'menu_position' => 30
        )
    );
}
add_action('init', 'create_portfolio');

//  ADD Sub Menu to Portfolio
function register_portfolio_submenu()
{
    add_submenu_page(
        'edit.php?post_type=portfolio',
        'Details',
        'Portfolio Details',
        'administrator',
        'portfolio_details',
        'Portfolio_Details_Function'
    );
}
add_action('admin_menu', 'register_portfolio_submenu');

// Add Fields To Portfolio Details Page
function Portfolio_Details_Function()
{
    $portfolio_details = get_option('portfolio_array', true);
    ?>
    <div class="AdminCustomWrapper">
        <h1>Portfolio Details</h1>
        <form method="post" action="">
            <?php settings_fields('portfolio_details_page'); ?>
            <div class="FormWrapper">
                <div class="FormField">
                    <label> Title</label>
                    <input type="text" class="InputBox" name="portfolio_array[title]"  value="<?= $portfolio_details['title']; ?>">
                </div>
                <div class="FormField">
                    <label> Sub Title </label>
                    <input type="text" class="InputBox" name="portfolio_array[sub_title]" value="<?= $portfolio_details['sub_title']; ?>">
                </div>
                <div class="FormField">
                    <label> Description </label>
                    <textarea type="text" class="InputBox" name="portfolio_array[desc]" value="<?= $portfolio_details['desc']; ?>"><?= $portfolio_details['desc']; ?></textarea>
                </div>
                <?php submit_button(); ?>
            </div>
        </form>
    </div>
<?php }

if ($_POST['option_page'] == 'portfolio_details_page') {
    $portfolio_details = array(
        'portfolio_array',
    );
    foreach ($portfolio_details as $portfolio_detail) {
        update_option($portfolio_detail, $_POST[$portfolio_detail]);
    }
}

// Assigned Fields to Portfolio Post
add_action('add_meta_boxes', function () {
    add_meta_box(
        'portfolio_Fields',
        'Portfolio Post',
        'portfolio_posts_function',
        'portfolio',
        'normal',
        'high'
    );
});

// Generate Fields
function portfolio_posts_function()
{
    global $post;
    $portfolio_post_avatar = get_post_meta($post->ID, 'portfolio_post_avatar', true);
    wp_nonce_field(__FILE__, 'jw_nonce');
?>
    <div class="AdminCustomWrapper">
        <form method="post" action="">
            <div class="FormWrapper">
                <?php if ($portfolio_post_avatar) { ?>
                    <div class="FieldImage displayImageField">
                        <div class="reviewImageBox">
                            <img src="<?= $portfolio_post_avatar; ?>" alt="image" class="reviewImage">
                        </div>
                        <input type="hidden" class="file_url" name="portfolio_post_avatar" accept="image/*" value="<?= $portfolio_post_avatar ?>"/>
                        <div class="FieldImageButtons">
                            <label class="uploadImageBtn"> Choose Icon </label>
                            <span class="removeImage"> Delete </span>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="FieldImage uploadImageField">
                        <div class="reviewImageBox" style="display:none;">
                            <img src="" alt="image" class="reviewImage">
                        </div>
                        <input type="hidden" class="file_url" name="portfolio_post_avatar" accept="image/*" value=""/>
                        <div class="FieldImageButtons">
                            <label  class="uploadImageBtn"> Choose Icon </label>
                            <span class="removeImage"> Delete </span>
                        </div>
                    </div>
                <?php } ?>
                <?php submit_button(__( 'Save' )); ?>
            </div>
        </form>
    </div>

<?php }

// Save Fields Data
add_action('save_post', function () {
    global $post;
    $post_type = get_post_type($post->ID);
    if ($post_type != 'portfolio') return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if ($_POST && wp_verify_nonce($_POST['jw_nonce'], __FILE__)) {
        $portfolio_fields = array(
            'portfolio_post_avatar'
        );

        foreach ($portfolio_fields as $portfolio_field) {
            update_post_meta($post->ID, $portfolio_field, $_POST[$portfolio_field]);
        }
    }
});


////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////     Client Opinions        /////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function create_opinions()
{
    register_post_type('opinions',
        array(
            'labels' => array(
                'name' => 'Opinions',
                'singular_name' => 'opinions',
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'opinions'),
            'supports' => array('title'),
            'menu_icon' => 'dashicons-buddicons-buddypress-logo',
            'menu_position' => 31
        )
    );
}
add_action('init', 'create_opinions');

//  ADD Sub Menu to Services
function register_opinions_submenu()
{
    add_submenu_page(
        'edit.php?post_type=opinions',
        'Details',
        'Opinions Details',
        'administrator',
        'opinions_details',
        'Opinions_Details_Function'
    );
}
add_action('admin_menu', 'register_opinions_submenu');

// Add Fields To services Details Page
function Opinions_Details_Function()
{
    $opinions_data = get_option('opinions_array', true);
    ?>
    <div class="AdminCustomWrapper">
        <h1>Opinions Details</h1>
        <form method="post" action="">
            <?php settings_fields('opinions_details_page'); ?>
            <div class="FormWrapper">
                <div class="FormField">
                    <label> Title</label>
                    <input type="text" class="InputBox" name="opinions_array[title]"  value="<?= $opinions_data['title']; ?>">
                </div>
                <div class="FormField">
                    <label> Sub Title </label>
                    <input type="text" class="InputBox" name="opinions_array[sub_title]" value="<?= $opinions_data['sub_title']; ?>">
                </div>
                <div class="FormField">
                    <label> Description </label>
                    <textarea type="text" class="InputBox" name="opinions_array[desc]" value="<?= $opinions_data['desc']; ?>"><?= $opinions_data['desc']; ?></textarea>
                </div>
                <?php submit_button(); ?>
            </div>
        </form>
    </div>
<?php }

if ($_POST['option_page'] == 'opinions_details_page') {
    $opinions_details = array(
        'opinions_array',
    );
    foreach ($opinions_details as $opinions_detail) {
        update_option($opinions_detail, $_POST[$opinions_detail]);
    }
}

// Assigned Fields to Post
add_action('add_meta_boxes', function () {
    add_meta_box(
        'client_opinions_Fields',
        'Client Opinion Post',
        'client_post',
        'opinions',
        'normal',
        'high'
    );
});

function client_post()
{
    global $post;
    $client_image = get_post_meta($post->ID, 'client_image', true);
    $client_name = get_post_meta($post->ID, 'client_name', true);
    $client_job = get_post_meta($post->ID, 'client_job', true);
    $client_opinion = get_post_meta($post->ID, 'client_opinion', true);
    wp_nonce_field(__FILE__, 'jw_nonce');
?>
    <div class="AdminCustomWrapper">
        <form method="post" action="">
            <div class="FormWrapper">
                <?php if ($client_image) { ?>
                    <div class="FieldImage displayImageField">
                        <div class="reviewImageBox">
                            <img src="<?= $client_image; ?>" alt="image" class="reviewImage">
                        </div>
                        <input type="hidden" class="file_url" name="client_image" accept="image/*" value="<?= $client_image ?>"/>
                        <div class="FieldImageButtons">
                            <label class="uploadImageBtn"> Choose Icon </label>
                            <span class="removeImage"> Delete </span>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="FieldImage uploadImageField">
                        <div class="reviewImageBox" style="display:none;">
                            <img src="" alt="image" class="reviewImage">
                        </div>
                        <input type="hidden" class="file_url" name="client_image" accept="image/*" value=""/>
                        <div class="FieldImageButtons">
                            <label  class="uploadImageBtn"> Choose Icon </label>
                            <span class="removeImage"> Delete </span>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($client_name) { ?>
                    <div class="FormField">
                        <label> Client Name  </label>
                        <input type="text" class="InputBox" name="client_name" value="<?= $client_name; ?>">
                    </div>
                <?php } else { ?>
                    <div class="FormField">
                        <label> Client Name  </label>
                        <input type="text" class="InputBox" name="client_name" value="">
                    </div>
                <?php } ?>
                <?php if ($client_job) { ?>
                    <div class="FormField">
                        <label> Client Job  </label>
                        <input type="text" class="InputBox" name="client_job" value="<?= $client_job; ?>">
                    </div>
                <?php } else { ?>
                    <div class="FormField">
                        <label> Client Job  </label>
                        <input type="text" class="InputBox" name="client_job" value="">
                    </div>
                <?php } ?>
                <?php if ($client_opinion) { ?>
                    <div class="FormField">
                        <label> Client Opinion </label>
                        <textarea type="text" class="InputBox" name="client_opinion" value="<?= $client_opinion; ?>"><?= $client_opinion; ?></textarea>
                    </div>
                <?php } else { ?>
                    <div class="FormField">
                        <label> Client Opinion </label>
                        <textarea type="text" class="InputBox" name="client_opinion" value=""></textarea>
                    </div>
                <?php } ?>

                <?php submit_button(__( 'Save' )); ?>
            </div>
        </form>
    </div>
 <?php
}

// Save Fields Data
add_action('save_post', function () {
    global $post;

    $post_type = get_post_type($post->ID);
    if ($post_type != 'opinions') return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if ($_POST && wp_verify_nonce($_POST['jw_nonce'], __FILE__)) {

        $client_post_fields = array(
            'client_image',
            'client_name',
            'client_job',
            'client_opinion',
        );
        foreach ($client_post_fields as $client_post_field) {
            update_post_meta($post->ID, $client_post_field, $_POST[$client_post_field]);
        }
    }
});


////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////        Blog           ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function create_blog()
{
    register_post_type('blog',
        array(
            'labels' => array(
                'name' => 'Blogs',
                'singular_name' => 'Blogs',
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'blog'),
            'taxonomies'  => array( 'post_tag' ),
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-text-page',
            'menu_position' => 32
        )
    );
}
add_action('init', 'create_blog');

//  ADD Sub Menu to Services
function register_blog_submenu()
{
    add_submenu_page(
        'edit.php?post_type=blog',
        'Details',
        'Blog Details',
        'administrator',
        'blog_details',
        'Blog_Details_Function'
    );
}
add_action('admin_menu', 'register_blog_submenu');

// Add Fields To services Details Page
function Blog_Details_Function()
{
    $blog_data = get_option('blog_array', true);
    ?>
    <div class="AdminCustomWrapper">
        <h1>Services Details</h1>
        <form method="post" action="">
            <?php settings_fields('blog_details_page'); ?>
            <div class="FormWrapper">
                <div class="FormField">
                    <label> Title</label>
                    <input type="text" class="InputBox" name="blog_array[title]"  value="<?= $blog_data['title']; ?>">
                </div>
                <div class="FormField">
                    <label> Sub Title </label>
                    <input type="text" class="InputBox" name="blog_array[sub_title]" value="<?= $blog_data['sub_title']; ?>">
                </div>
                <div class="FormField">
                    <label> Description </label>
                    <textarea type="text" class="InputBox" name="blog_array[desc]" value="<?= $blog_data['desc']; ?>"><?= $blog_data['desc']; ?></textarea>
                </div>
                <?php submit_button(); ?>
            </div>
        </form>
    </div>
<?php }

if ($_POST['option_page'] == 'blog_details_page') {
    $blog_details = array(
        'blog_array',
    );
    foreach ($blog_details as $blog_detail) {
        update_option($blog_detail, $_POST[$blog_detail]);
    }
}

//create a custom taxonomy name it "type" for your posts
function custom_taxonomy() {
    $labels = array(
        'name' => _x( 'Types', 'taxonomy general name' ),
        'singular_name' => _x( 'Type', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Types' ),
        'all_items' => __( 'All Types' ),
        'parent_item' => __( 'Parent Type' ),
        'parent_item_colon' => __( 'Parent Type:' ),
        'edit_item' => __( 'Edit Type' ),
        'update_item' => __( 'Update Type' ),
        'add_new_item' => __( 'Add New Type' ),
        'new_item_name' => __( 'New Type Name' ),
        'menu_name' => __( 'Types' ),
    );

    register_taxonomy('types',array('blog'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'type' ),
    ));
}
// Let us create Taxonomy for Custom Post Type
add_action( 'init', 'custom_taxonomy', 0 );


////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////    Contact       /////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function create_Contact()
{
    register_post_type('contact',
        array(
            'labels' => array(
                'name' => 'Contact',
                'singular_name' => 'Contact',
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'contact'),
            'taxonomies'  => array(""),
            'supports' => array('title'),
            'menu_icon' => 'dashicons-email-alt',
            'menu_position' => 33
        )
    );
}
add_action('init', 'create_Contact');

//  ADD Sub Menu to Services
function register_contact_submenu()
{
    add_submenu_page(
        'edit.php?post_type=contact',
        'Details',
        'Contact Details',
        'administrator',
        'contact_details',
        'Contact_Details_Function'
    );
}
add_action('admin_menu', 'register_contact_submenu');

// Add Fields To contact Details Page
function Contact_Details_Function()
{
    $contact_data = get_option('contact_data', true);
?>
    <div class="AdminCustomWrapper">
        <h1> Contact Details </h1>
        <form method="post" action="">
            <?php settings_fields('contact_details_page'); ?>
            <div class="FormWrapper">
                <?php if ($contact_data['image'] != " ") { ?>
                    <div class="FieldImage displayImageField">
                        <div class="reviewImageBox">
                            <img src="<?php echo $contact_data['image']; ?>" alt="image" class="reviewImage">
                        </div>
                        <input type="hidden" class="file_url" name="contact_data[image]" value="<?php echo $contact_data['image']; ?>"/>
                        <div class="FieldImageButtons">
                            <label class="uploadImageBtn"> Choose Icon </label>
                            <span class="removeImage"> Delete </span>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="FieldImage uploadImageField">
                        <div class="reviewImageBox" style="display:none;">
                            <img src="" alt="image" class="reviewImage">
                        </div>
                        <input type="hidden" class="file_url" name="contact_data[image]" value=""/>
                        <div class="FieldImageButtons">
                            <label class="uploadImageBtn"> Choose Icon </label>
                            <span class="removeImage"> Delete </span>
                        </div>
                    </div>
                <?php } ?>
                <div class="FormField">
                    <label> Title</label>
                    <input type="text" class="InputBox" name="contact_data[title]" value="<?= $contact_data['title']; ?>">
                </div>
                <div class="FormField">
                    <label> Description </label>
                    <textarea type="text" class="InputBox" name="contact_data[desc]"  value="<?= $contact_data['desc']; ?>"> <?= stripslashes($contact_data['desc']); ?> </textarea>
                </div>
                <?php submit_button(); ?>
            </div>
        </form>
    </div>
<?php }

if ($_POST['option_page'] == 'contact_details_page') {
    $contact_details = array(
        'contact_data'
    );
    foreach ($contact_details as $contact_detail) {
        update_option($contact_detail, $_POST[$contact_detail]);
    }
}

// Assigned Fields to Post
add_action('add_meta_boxes', function () {
    add_meta_box(
        'Contact_Fields',
        'Contact Post',
        'contact_post',
        'contact',
        'normal',
        'high'
    );
});

function contact_post()
{
    global $post;
    $website = get_post_meta($post->ID, 'website', true);
    $email   = get_post_meta($post->ID, 'email', true);
    $message = get_post_meta($post->ID, 'message', true);

    wp_nonce_field(__FILE__, 'jw_nonce');
    ?>
    <div class="AdminCustomWrapper">
        <form method="post" action="">
            <div class="FormWrapper">
                <?php if ($website) { ?>
                    <div class="FormField">
                        <label> Website </label>
                        <input type="text" class="InputBox" name="website" value="<?= $website; ?>">
                    </div>
                <?php } else { ?>
                    <div class="FormField">
                        <label> Website </label>
                        <input type="text" class="InputBox" name="website" value="">
                    </div>
                <?php } ?>
                <?php if ($email) { ?>
                    <div class="FormField">
                        <label> Email  </label>
                        <input type="email" class="InputBox" name="email" value="<?= $email; ?>">
                    </div>
                <?php } else { ?>
                    <div class="FormField">
                        <label> Email  </label>
                        <input type="email" class="InputBox" name="email" value="">
                    </div>
                <?php } ?>
                <?php if ($message) { ?>
                    <div class="FormField">
                        <label> Message  </label>
                        <textarea class="InputBox" name="message" value="<?= $message; ?>"><?= $message; ?></textarea>
                    </div>
                <?php } else { ?>
                    <div class="FormField">
                        <label> Message  </label>
                        <textarea class="InputBox" name="message" value=""></textarea>
                    </div>
                <?php } ?>

                <?php submit_button(__( 'Save' )); ?>
            </div>
        </form>
    </div>
    <?php
}

// Save Fields Data
add_action('save_post', function () {
    global $post;

    $post_type = get_post_type($post->ID);
    if ($post_type != 'contact') return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if ($_POST && wp_verify_nonce($_POST['jw_nonce'], __FILE__)) {
        $contact_fields = array(
            'website',
            'email' ,
            'message'
        );
        foreach ($contact_fields as $contact_field) {
            update_post_meta($post->ID, $contact_field, $_POST[$contact_field]);
        }
    }
});

// save contact post from contact form
function contact_message()
{
    if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == 'new_post') {

        $form_errors = array();
        $name = $_POST['name'];
        $website = $_POST['website'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // error list check
        if (empty ($name)) {
            $form_errors['name'] = 'Please enter Your name';
        }
        if (empty ($email)) {
           $form_errors['email'] = 'Please enter Your email';
        }
        if (empty ($message)) {
            $form_errors['email'] = 'Please enter Your Message';
        }

        if ( empty($form_errors)) {
            $new_post = array(
                'post_title' => $name,
                'post_content' => $_POST['message'],
                'post_status' => 'publish',    // Choose: publish, preview, future, draft, etc.
                'post_type' => 'contact'
            );
            $pid = wp_insert_post($new_post);

            //insert post meta
            update_post_meta($pid, 'name', $name);
            update_post_meta($pid, 'website', $website);
            update_post_meta($pid, 'email', $email);
            update_post_meta($pid, 'message', $message);

            $_SESSION['errors'] = '';

//            wp_redirect(home_url().'/'.get_bloginfo('language').'/#new_post');
            wp_redirect(home_url('/success'));
            exit;

        } else {
            $_SESSION['errors'] = $form_errors;
            wp_redirect(home_url().'/'.get_bloginfo('language').'/#new_post');

        }

    }

}
add_action('wp_loaded','contact_message');

// Start Session
function sess_start() {
    if (!session_id())
        session_start();
}
add_action('init','sess_start');


////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////    NewsLetter       //////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function create_Newsletter()
{
    add_menu_page (
        'NewsLetter',
        'NewsLetter',
        'administrator',
        'newsLetter',
        'Newsletter_Details_Function' ,
        'dashicons-megaphone',
        34
    );
}
add_action('admin_menu', 'create_Newsletter');

// Add Fields To discover Details Page
function Newsletter_Details_Function()
{
    $newsletter_data = get_option('newsletter_data', true);
    ?>
    <div class="AdminCustomWrapper">
        <h1> Contact Details </h1>
        <form method="post" action="">
            <?php settings_fields('newsletter_details_page'); ?>
            <div class="FormWrapper">
                <div class="FormField">
                    <label> Title</label>
                    <input type="text" class="InputBox" name="newsletter_data[title]"  value="<?= $newsletter_data['title']; ?>">
                </div>
                <div class="FormField">
                    <label> Sub Title </label>
                    <input type="text" class="InputBox" name="newsletter_data[sub_title]" value="<?= $newsletter_data['sub_title']; ?>">
                </div>
                <div class="FormField">
                    <label> Description </label>
                    <textarea type="text" class="InputBox" name="newsletter_data[desc]" value="<?= $newsletter_data['desc']; ?>"><?= $newsletter_data['desc']; ?></textarea>
                </div>
                <?php submit_button(); ?>
            </div>
        </form>
    </div>
<?php }

if ($_POST['option_page'] == 'newsletter_details_page') {
    $newsletter_details = array(
        'newsletter_data'
    );
    foreach ($newsletter_details as $newsletter_detail) {
        update_option($newsletter_detail, $_POST[$newsletter_detail]);
    }
}


////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////    Sponsors       ////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function create_sponsors ()
{
    register_post_type('Sponsors',
        array(
            'labels' => array(
                'name' => 'Sponsors',
                'singular_name' => 'Sponsors',
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'sponsors'),
            'supports' => array('title','thumbnail'),
            'menu_icon' => 'dashicons-groups',
            'menu_position' => 35
        )
    );
}
add_action('init', 'create_sponsors');


////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////    Theme Setting       ///////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function register_option_submenu()
{
    add_submenu_page(
        'options-general.php',
        'heme Setting',
        'Theme Setting',
        'administrator',
        'theme_setting',
        'theme_option_Function'
    );
}
add_action('admin_menu', 'register_option_submenu');

// Add Fields To theme setting  Page
function theme_option_Function()
{
    $theme_data = get_option('theme_setting_data', true);
    ?>
    <div class="AdminCustomWrapper">
        <h1> Theme Setting </h1>
        <form method="post" action="">
            <?php settings_fields('theme_setting_page'); ?>
            <div class="FormWrapper">

                <div class="imagesBlock">
                    <div class="block">
                        <h3> Header Logo </h3>
                        <?php if ($theme_data['headerLogo'] != " ") { ?>
                            <div class="FieldImage displayImageField">
                                <div class="reviewImageBox">
                                    <img src="<?php echo $theme_data['headerLogo']; ?>" alt="image" class="reviewImage">
                                </div>
                                <input type="hidden" class="file_url" name="theme_setting_data[headerLogo]"  value="<?php echo $theme_data['headerLogo']; ?>"/>
                                <div class="FieldImageButtons">
                                    <label class="uploadImageBtn"> Choose Icon </label>
                                    <span class="removeImage"> Delete </span>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="FieldImage uploadImageField">
                                <div class="reviewImageBox" style="display:none;">
                                    <img src="" alt="image" class="reviewImage">
                                </div>
                                <input type="hidden" class="file_url" name="theme_setting_data[headerLogo]" value=""/>
                                <div class="FieldImageButtons">
                                    <label class="uploadImageBtn"> Choose Icon </label>
                                    <span class="removeImage"> Delete </span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="block">
                        <h3> Footer Logo </h3>
                        <?php if ($theme_data['footerLogo'] != " ") { ?>
                            <div class="FieldImage displayImageField">
                                <div class="reviewImageBox">
                                    <img src="<?php echo $theme_data['footerLogo']; ?>" alt="image" class="reviewImage">
                                </div>
                                <input type="hidden" class="file_url" name="theme_setting_data[footerLogo]"  value="<?php echo $theme_data['footerLogo']; ?>"/>
                                <div class="FieldImageButtons">
                                    <label class="uploadImageBtn"> Choose Icon </label>
                                    <span class="removeImage"> Delete </span>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="FieldImage uploadImageField">
                                <div class="reviewImageBox" style="display:none;">
                                    <img src="" alt="image" class="reviewImage">
                                </div>
                                <input type="hidden" class="file_url" name="theme_setting_data[footerLogo]" value=""/>
                                <div class="FieldImageButtons">
                                    <label class="uploadImageBtn"> Choose Icon </label>
                                    <span class="removeImage"> Delete </span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="block">
                        <h3> Fav Icon </h3>
                        <?php if ($theme_data['favIcon'] != " ") { ?>
                            <div class="FieldImage displayImageField">
                                <div class="reviewImageBox">
                                    <img src="<?php echo $theme_data['favIcon']; ?>" alt="image" class="reviewImage">
                                </div>
                                <input type="hidden" class="file_url" name="theme_setting_data[favIcon]"
                                       value="<?php echo $theme_data['favIcon']; ?>"/>
                                <div class="FieldImageButtons">
                                    <label class="uploadImageBtn"> Choose Icon </label>
                                    <span class="removeImage"> Delete </span>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="FieldImage uploadImageField">
                                <div class="reviewImageBox" style="display:none;">
                                    <img src="" alt="image" class="reviewImage">
                                </div>
                                <input type="hidden" class="file_url" name="theme_setting_data[favIcon]" value=""/>
                                <div class="FieldImageButtons">
                                    <label class="uploadImageBtn"> Choose Icon </label>
                                    <span class="removeImage"> Delete </span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="imagesBlock">
                    <div class="block">
                        <h3> Service image </h3>
                        <?php if ($theme_data['serviceImage'] != " ") { ?>
                            <div class="FieldImage displayImageField">
                                <div class="reviewImageBox">
                                    <img src="<?php echo $theme_data['serviceImage']; ?>" alt="image" class="reviewImage">
                                </div>
                                <input type="hidden" class="file_url" name="theme_setting_data[serviceImage]"  value="<?php echo $theme_data['serviceImage']; ?>"/>
                                <div class="FieldImageButtons">
                                    <label class="uploadImageBtn"> Choose Icon </label>
                                    <span class="removeImage"> Delete </span>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="FieldImage uploadImageField">
                                <div class="reviewImageBox" style="display:none;">
                                    <img src="" alt="image" class="reviewImage">
                                </div>
                                <input type="hidden" class="file_url" name="theme_setting_data[serviceImage]" value=""/>
                                <div class="FieldImageButtons">
                                    <label class="uploadImageBtn"> Choose Icon </label>
                                    <span class="removeImage"> Delete </span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="block">
                        <h3> Team Image </h3>
                        <?php if ($theme_data['teamImage'] != " ") { ?>
                            <div class="FieldImage displayImageField">
                                <div class="reviewImageBox">
                                    <img src="<?php echo $theme_data['teamImage']; ?>" alt="image" class="reviewImage">
                                </div>
                                <input type="hidden" class="file_url" name="theme_setting_data[teamImage]"  value="<?php echo $theme_data['teamImage']; ?>"/>
                                <div class="FieldImageButtons">
                                    <label class="uploadImageBtn"> Choose Icon </label>
                                    <span class="removeImage"> Delete </span>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="FieldImage uploadImageField">
                                <div class="reviewImageBox" style="display:none;">
                                    <img src="" alt="image" class="reviewImage">
                                </div>
                                <input type="hidden" class="file_url" name="theme_setting_data[teamImage]" value=""/>
                                <div class="FieldImageButtons">
                                    <label class="uploadImageBtn"> Choose Icon </label>
                                    <span class="removeImage"> Delete </span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>


                <div class="FormField">
                    <label> Title </label>
                    <input type="text" class="InputBox" name="theme_setting_data[title]" value="<?= $theme_data['title']; ?>">
                </div>
                <div class="FormField">
                    <label> Description </label>
                    <textarea type="text" class="InputBox" name="theme_setting_data[desc]" value="<?= $theme_data['desc']; ?>"><?= $theme_data['desc']; ?></textarea>
                </div>
                <div class="FormField">
                    <label> Address  </label>
                    <input type="text" class="InputBox" name="theme_setting_data[address]" value="<?= $theme_data['address']; ?>">
                </div>
                <div class="FormField">
                    <label> Email </label>
                    <input type="text" class="InputBox" name="theme_setting_data[email]" value="<?= $theme_data['email']; ?>">
                </div>
                <div class="FormField">
                    <label> Phone </label>
                    <input type="text" class="InputBox" name="theme_setting_data[phone]" value="<?= $theme_data['phone']; ?> ">
                </div>

                <div class="linksField">
                    <label> Social </label>
                    <table class="table-bordered">
                        <tbody>
                            <tr>
                                <td> Facebook  </td>
                                <td> <input type="text" class="InputBox" name="theme_setting_data[facebook]" value="<?= $theme_data['facebook']; ?> "> </td>
                            </tr>
                            <tr>
                                <td> Twitter  </td>
                                <td> <input type="text" class="InputBox" name="theme_setting_data[twitter]" value="<?= $theme_data['twitter']; ?> "> </td>
                            </tr>
                            <tr>
                                <td> Instagram  </td>
                                <td> <input type="text" class="InputBox" name="theme_setting_data[instagram]" value="<?= $theme_data['instagram']; ?> "> </td>
                            </tr>
                            <tr>
                                <td> Behance  </td>
                                <td> <input type="text" class="InputBox" name="theme_setting_data[behance]" value="<?= $theme_data['behance']; ?> "> </td>
                            </tr>
                            <tr>
                                <td> Whatsapp  </td>
                                <td> <input type="text" class="InputBox" name="theme_setting_data[whatsapp]" value="<?= $theme_data['whatsapp']; ?> "> </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <?php submit_button(); ?>
            </div>
        </form>
    </div>
<?php }

// save fields date
if ($_POST['option_page'] == 'theme_setting_page') {
    $theme_settings = array(
        'theme_setting_data',
    );
    foreach ($theme_settings as $theme_setting) {
        update_option($theme_setting, $_POST[$theme_setting]);
    }
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////     Page Description         ////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

// Add Fields To services Details Page
add_action('add_meta_boxes', function () {
    add_meta_box(
        'Page_Fields',
        'Page Details',
        'Page_Function',
        'page',
        'normal',
        'high'
    );
});

function Page_Function()
{
    global $post;
    $page_description = get_post_meta($post->ID, 'page_description', true);

    wp_nonce_field(__FILE__, 'jw_nonce');
?>
    <div class="AdminCustomWrapper">
        <form method="post" action="">
            <div class="FormWrapper">
                <?php if ($page_description) { ?>
                    <div class="FormField">
                        <label> Description </label>
                        <textarea type="text" class="InputBox" name="page_description" value="<?= $page_description; ?>"><?= $page_description; ?></textarea>
                    </div>
                <?php } else { ?>
                    <div class="FormField">
                        <label> Description </label>
                        <textarea type="text" class="InputBox" name="page_description" value=""></textarea>
                    </div>
                <?php } ?>
                <?php submit_button(__( 'Save' )); ?>
            </div>
        </form>
    </div>
<?php }

// Save Fields Data
add_action('save_post', function () {
    global $post;

    $post_type = get_post_type($post->ID);
    if ($post_type != 'page') return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if ($_POST && wp_verify_nonce($_POST['jw_nonce'], __FILE__)) {
        $page_details = array(
            'page_description'
        );
        foreach ($page_details as $page_detail) {
            update_post_meta($post->ID, $page_detail , $_POST[$page_detail]);
        }
    }
});



////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////       Team          //////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function create_team ()
{
    register_post_type('Team',
        array(
            'labels' => array(
                'name' => 'Team',
                'singular_name' => 'Team',
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'team'),
            'supports' => array('title'),
            'menu_icon' => 'dashicons-groups',
            'menu_position' => 37
        )
    );
}
add_action('init', 'create_team');

function register_team_submenu()
{
    add_submenu_page(
        'edit.php?post_type=team',
        'Details',
        'Team Details',
        'administrator',
        'team_details',
        'team_Details_Function'
    );
}
add_action('admin_menu', 'register_team_submenu');

function team_Details_Function()
{
    $team_data = get_option('team_data', true);
    ?>
    <div class="AdminCustomWrapper">
        <h1> Contact Details </h1>
        <form method="post" action="">
            <?php settings_fields('team_details_page'); ?>
            <div class="FormWrapper">
                <div class="FormField">
                    <label> Title</label>
                    <input type="text" class="InputBox" name="team_data[title]" value="<?= $team_data['title']; ?>">
                </div>
                <div class="FormField">
                    <label> Sub Title</label>
                    <input type="text" class="InputBox" name="team_data[sub_title]" value="<?= $team_data['sub_title']; ?>">
                </div>
                <div class="FormField">
                    <label> Description </label>
                    <textarea type="text" class="InputBox" name="team_data[desc]"  value="<?= $team_data['desc']; ?>"> <?= stripslashes($team_data['desc']); ?> </textarea>
                </div>
                <?php submit_button(); ?>
            </div>
        </form>
    </div>
<?php }
if ($_POST['option_page'] == 'team_details_page') {
    $team_details = array(
        'team_data'
    );
    foreach ($team_details as $team_detail) {
        update_option($team_detail, $_POST[$team_detail]);
    }
}


add_action('add_meta_boxes', function () {
    add_meta_box(
        'Team_Fields',
        'Team Post',
        'team_post',
        'team',
        'normal',
        'high'
    );
});

function team_post()
{
    global $post;
    $job        = get_post_meta($post->ID, 'job', true);
    $facebook   = get_post_meta($post->ID, 'facebook', true);
    $twitter    = get_post_meta($post->ID, 'twitter', true);
    $behance    = get_post_meta($post->ID, 'behance', true);
    $instagram  = get_post_meta($post->ID, 'instagram', true);

    wp_nonce_field(__FILE__, 'jw_nonce');
    ?>
    <div class="AdminCustomWrapper">
        <form method="post" action="">
            <div class="FormWrapper">
                <?php if ($job) { ?>
                    <div class="FormField">
                        <label> Job </label>
                        <input type="text" class="InputBox" name="job"  value="<?= $job; ?>">
                    </div>
                <?php } else { ?>
                    <div class="FormField">
                        <label> Job </label>
                        <input type="text" class="InputBox" name="job"  value="">
                    </div>
                <?php } ?>
                <div class="linksField">
                    <label> Social </label>
                    <table class="table-bordered">
                        <tbody>
                            <tr>
                                <td> Facebook  </td>
                                <?php if ($facebook) { ?>
                                    <td> <input type="text" class="InputBox" name="facebook" value="<?= $facebook; ?> "> </td>
                                <?php } else { ?>
                                    <td> <input type="text" class="InputBox" name="facebook" value=""> </td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td> Twitter  </td>
                                <?php if ($twitter) { ?>
                                    <td> <input type="text" class="InputBox" name="twitter" value="<?= $twitter; ?> "> </td>
                                <?php } else { ?>
                                    <td> <input type="text" class="InputBox" name="twitter" value=""> </td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td> Instagram  </td>
                                <?php if ($instagram) { ?>
                                    <td> <input type="text" class="InputBox" name="instagram" value="<?= $instagram; ?>"> </td>
                                <?php } else { ?>
                                    <td> <input type="text" class="InputBox" name="instagram" value=""> </td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td> Behance  </td>
                                <?php if ($behance) { ?>
                                    <td> <input type="text" class="InputBox" name="behance" value="<?= $behance; ?>"> </td>
                                <?php } else { ?>
                                    <td> <input type="text" class="InputBox" name="behance" value=""> </td>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <?php submit_button(__( 'Save' )); ?>
            </div>
        </form>
    </div>
    <?php
}

// Save Fields Data
add_action('save_post', function () {
    global $post;

    $post_type = get_post_type($post->ID);
    if ($post_type != 'team') return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if ($_POST && wp_verify_nonce($_POST['jw_nonce'], __FILE__)) {
        $team_post_fields = array(
            'job',
            'facebook' ,
            'twitter' ,
            'instagram' ,
            'behance'
        );
        foreach ($team_post_fields as $team_post_field) {
            update_post_meta($post->ID, $team_post_field, $_POST[$team_post_field]);
        }
    }
});


//function create_post_header()
//{
//    register_post_type('header',
//        $values = array(
//            'public' => true,
//            'labels' => array('name' => 'header'),
//            'menu_icon' => 'dashicons-welcome-view-site',
//            'menu_position' => 25,
//            'supports' => array('')
//        )
//    );
//}
//add_action('init', 'create_post_header');



// Let us create Taxonomy for Custom Post Type
//add_action( 'init', 'crunchify_create_deals_custom_taxonomy', 0 );

//function crunchify_create_deals_custom_taxonomy() {
//
//    $labels = array(
//        'name' => _x( 'Types', 'taxonomy general name' ),
//        'singular_name' => _x( 'Type', 'taxonomy singular name' ),
//        'search_items' =>  __( 'Search Types' ),
//        'all_items' => __( 'All Types' ),
//        'parent_item' => __( 'Parent Type' ),
//        'parent_item_colon' => __( 'Parent Type:' ),
//        'edit_item' => __( 'Edit Type' ),
//        'update_item' => __( 'Update Type' ),
//        'add_new_item' => __( 'Add New Type' ),
//        'new_item_name' => __( 'New Type Name' ),
//        'menu_name' => __( 'Types' ),
//    );
//
//    register_taxonomy('types',array('post'), array(
//        'hierarchical' => true,
//        'labels' => $labels,
//        'show_ui' => true,
//        'show_admin_column' => true,
//        'query_var' => true,
//        'rewrite' => array( 'slug' => 'type' ),
//    ));
//}


//add_theme_support('category-thumbnails');


// Our custom post type news posts
//function create_NewsPosts() {
//    register_post_type( 'News',
//        // CPT Options
//        array(
//            'labels' => array(
//                'name' => __( 'News Posts' ),
//                'singular_name' => __( 'News Posts' )
//            ),
//            'public'      => true,
//            'has_archive' => true,
//            'rewrite'     => array('slug' => 'News'),
//            'supports'    => array( 'title', 'editor', 'author', 'thumbnail', 'comments'),
//            'menu_icon'   => 'dashicons-admin-site-alt3',
//            'menu_position' => 5 ,
//            'taxonomies' => array('post_tag')
//        )
//    );
//}
//add_action( 'init', 'create_NewsPosts' );


//function create_Supponsers() {
//    register_post_type( 'Supponsers',
//        // CPT Options
//        array(
//            'labels' => array(
//                'name' => __( 'Supponsers' ),
//                'singular_name' => __( 'Supponsers' )
//            ),
//            'public'      => true,
//            'has_archive' => true,
//            'rewrite'     => array('slug' => 'Supponsers'),
//            'supports'    => array( 'title','thumbnail'),
//            'menu_icon'   => 'dashicons-awards',
//            'menu_position' => 25
//        )
//    );
//}
//add_action( 'init', 'create_Supponsers' );



////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////       Comments      //////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

if (!function_exists('razz_comment')) {
    function razz_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                ?>
                <li <?php comment_class('single-comment base-box'); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php esc_html_e('Pingback:', 'razz');
                    comment_author_link();
                    edit_comment_link(esc_html__('(Edit)', 'razz'), '<span class="edit-link">', '</span>'); ?>
                </p>
                <?php
                break;
            default :
                global $wpdb;
                ?>
            <li <?php comment_class('single-comment'); ?> id="li-comment-<?php comment_ID(); ?>">
                <div id="comment-<?php comment_ID(); ?>" class="comment-wrap base-box">
                    <?php if ('0' == $comment->comment_approved) : ?>
                        <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'razz'); ?></em>
                    <?php endif; ?>
                    <div class="commentHead">
                        <div class="comment-h">
                            <div class="pic">
                                <?php echo get_avatar($comment); ?>
                            </div>
                            <div class="CommentHeadDetails data">
                                <ul>
                                    <?php
                                    printf('<li class="comment-author fn">%1$s %2$s</li>', get_comment_author_link(),
                                        // If current post author is also comment author, make it known visually.
                                        ($comment->user_id) ? '' : ''
                                    );
                                    printf('<li class="comment-meta commentmetadata "> </li> <li> <time datetime="%2$s">%3$s</time> </li>', esc_url(get_comment_link($comment->comment_ID)), get_comment_time('c'),
                                        /* translators: 1: date, 2: time */
                                        sprintf(esc_html__('%1$s at %2$s', 'razz'), get_comment_date(), get_comment_time())
                                    );
                                    ?>
                                </ul>
                                <?php comment_text(); ?>

                                <div class="CommentHeadLinks replay-btn">
                                    <?php

                                    comment_reply_link(array_merge($args, array(
                                        'reply_text' => esc_html__('رد', 'razz'),
                                        'before' => '<span>',
                                        'after' => '</span>',
                                        'depth' => $depth,
                                        'max_depth' => $args['max_depth']
                                    )));
                                    edit_comment_link(esc_html__('تعديل', 'razz')); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php
                break;
        endswitch;
    }
}






