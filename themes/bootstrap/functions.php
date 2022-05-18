<?php

require_once(get_stylesheet_directory() . '/inc/portfolio-type.php');
require_once(get_stylesheet_directory() . '/inc/team-type.php');
require_once(get_stylesheet_directory() . '/inc/testimonial-type.php');

/* Chargement des styles du parent / enfant. */
add_action('wp_enqueue_scripts', 'wpchild_enqueue_styles');

function wpchild_enqueue_styles()
{
  // Enfant
  wp_enqueue_style('bootstrap-child-style-child', get_stylesheet_directory_uri() . '/style.css', array('bootstrap-css'));

  wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');

  wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css');

  wp_enqueue_style('font-awesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css');

  wp_enqueue_script('jquery');

  wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('jquery'));
}

/* Chargement des fichiers de langue. */
function bootstrap_child_setup()
{

  load_theme_textdomain('bootstrap', get_template_directory() . '/languages');

  // Laisser WordPress s'occuper des titres, sans ce soucier d'ajouter une balise <title></title>
  add_theme_support('title-tag');

  // Permettre de paramétrer un logo personnalisé (récupérée par the_custom_logo())
  add_theme_support('custom-logo', array(
    'height' => 50,
    'width' => 50
  ));

  // Permettre de paramétrer une image d'en-tête personnalisée (récupérée par header_image())
  add_theme_support('custom-header');

  // Permettre de paramétrer l'image à la une
  add_theme_support('post-thumbnails');

  // Permettre de paramétrer les menus
  add_theme_support('menus');

  // Permettre de paramétrer les widgets
  add_theme_support('widgets');

  add_theme_support('html5', array('comment-list'));

  if (function_exists('add_image_size')) {
    add_image_size('logo-thumb', 50, 50, true); //(cropped)
  }

  // On ajoute une classe php permettant de gérer les menus Bootstrap
  require_once get_template_directory() . '/assets/class-wp-bootstrap-navwalker.php';

  // On ajoute une classe php permettant de gérer les commentaires Bootstrap
  require_once get_template_directory() . '/assets/wp-bootstrap-comment-walker.php';

  // On ajoute une classe php permettant de gérer la pagination Bootstrap
  require_once get_template_directory() . '/assets/wordpress-bootstrap-4-pagination.php';
}

add_action('after_setup_theme', 'bootstrap_child_setup');

if (!function_exists('bootstrap_register_nav_menu')) {

  function bootstrap_register_nav_menu()
  {
    register_nav_menus(array(
      'primary_menu' => __('Primary Menu', 'bootstrap'),
      'footer_menu'  => __('Footer Menu', 'bootstrap'),
    ));
  }

  add_action('after_setup_theme', 'bootstrap_register_nav_menu', 0);
}

function add_menuclass($ulclass)
{
  return preg_replace('/<a /', '<a class="nav-link px-lg-3 py-3 py-lg-4 text-white"', $ulclass);
}

add_filter('wp_nav_menu', 'add_menuclass');

function add_menuclass_li($ulclass)
{
  return preg_replace('/<li /', '<li class="list-inline-item menu-item menu-item-type-post_type menu-item-object-page nav-item"', $ulclass);
}

add_filter('wp_nav_menu', 'add_menuclass_li');

function my_customizer_social_media_array()
{

  /* Liste des réseaux sociaux à gérer */
  $social_sites =
    array(
      'twitter',
      'facebook',
      'github'
    );

  return $social_sites;
}

function theme_customize($wp_customize)
{
  // Ajout d'une section / volet dans l'interface de personnalisation
  $wp_customize->add_section('mon_theme_responsive_section', array(
    'title' => 'Options du thème',
    'description' => 'Personnalisation du thème',
    'priority' => 200, // Ordre d'affichage
  ));

  $social_sites = my_customizer_social_media_array();

  foreach ($social_sites as $social_site) {
    $wp_customize->add_setting(
      "$social_site",
      array(
        'capability' => 'edit_theme_options', // droits utilisateurs nécessaires
        'type' => 'theme_mod', // avec theme_mod, utilisation possible de get_theme_mod() pour obtenir l'URL du réseau social
        'transport' => 'refresh', // méthode utilisée pour générer l'aperçu en direct, 'refresh' ne nécessite pas de développements supplémentaires
      )
    );

    $social_site_label = ucfirst($social_site);

    // Ajout d'un contrôle
    $wp_customize->add_control(
      "$social_site",
      array(
        'label' => __("$social_site_label URL :", 'bootstrap'), // nom du contrôle dans l'interface
        'section' => 'mon_theme_responsive_section', // identifiant de la section
        'type'  => 'text',
      )
    );

    // Ajout d'un réglage
    $wp_customize->add_setting('couleur_titre', array(
      'default' => 'ffffff', // code hexa de la couleur par défaut
      'sanitize_callback' => 'sanitize_hex_color',
      'capability' => 'edit_theme_options', // droits utilisateurs nécessaires
      'type' => 'theme_mod', // avec theme_mod, utilisation possible de get_theme_mod() pour obtenir la couleur à appliquer
      'transport' => 'refresh', // méthode utilisée pour générer l'aperçu en direct, 'refresh' ne nécessite pas de développements supplémentaires
    ));

    // Ajout d'un contrôle
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'color_title',
        array(
          'label' => 'Couleur de titre <h1></h1>', // nom du contrôle dans l'interface
          'section' => 'mon_theme_responsive_section', // identifiant de la section
          'settings' => 'couleur_titre', // identifiant du réglage
        )
      )
    );
  }

  $wp_customize->add_setting(
    "numero_telephone",
    array(
      'capability' => 'edit_theme_options', // droits utilisateurs nécessaires
      'type' => 'theme_mod', // avec theme_mod, utilisation possible de get_theme_mod() pour obtenir l'URL du réseau social
      'transport' => 'refresh', // méthode utilisée pour générer l'aperçu en direct, 'refresh' ne nécessite pas de développements supplémentaires
    )
  );

  // Ajout d'un contrôle
  $wp_customize->add_control(
    "numero_telephone",
    array(
      'label' => __("Phone :", 'bootstrap'), // nom du contrôle dans l'interface
      'section' => 'mon_theme_responsive_section', // identifiant de la section
      'type'  => 'text',
    )
  );

  $wp_customize->add_setting(
    "adresse_email",
    array(
      'capability' => 'edit_theme_options', // droits utilisateurs nécessaires
      'type' => 'theme_mod', // avec theme_mod, utilisation possible de get_theme_mod() pour obtenir l'URL du réseau social
      'transport' => 'refresh', // méthode utilisée pour générer l'aperçu en direct, 'refresh' ne nécessite pas de développements supplémentaires
    )
  );

  // Ajout d'un contrôle
  $wp_customize->add_control(
    "adresse_email",
    array(
      'label' => __("E-mail address :", 'bootstrap'), // nom du contrôle dans l'interface
      'section' => 'mon_theme_responsive_section', // identifiant de la section
      'type'  => 'text',
    )
  );

  $wp_customize->add_setting(
    "adresse_postale",
    array(
      'capability' => 'edit_theme_options', // droits utilisateurs nécessaires
      'type' => 'theme_mod', // avec theme_mod, utilisation possible de get_theme_mod() pour obtenir l'URL du réseau social
      'transport' => 'refresh', // méthode utilisée pour générer l'aperçu en direct, 'refresh' ne nécessite pas de développements supplémentaires
    )
  );

  // Ajout d'un contrôle
  $wp_customize->add_control(
    "adresse_postale",
    array(
      'label' => __("Address :", 'bootstrap'), // nom du contrôle dans l'interface
      'section' => 'mon_theme_responsive_section', // identifiant de la section
      'type'  => 'text',
    )
  );

  // Ajout d'un réglage
  $wp_customize->add_setting('texte_boite_alerte', array(
    'default' => 'Saisissez votre texte',
    'capability' => 'edit_theme_options', // droits utilisateurs nécessaires
    'type' => 'theme_mod', // avec theme_mod, utilisation possible de get_theme_mod() pour obtenir le texte à appliquer
    'transport' => 'refresh', // méthode utilisée pour générer l'aperçu en direct, 'refresh' ne nécessite pas de développements supplémentaires
  ));

  // Ajout d'un contrôle
  $wp_customize->add_control(
    'alert_text',
    array(
      'label' => __("Alert content :", 'bootstrap'), // nom du contrôle dans l'interface
      'section' => 'mon_theme_responsive_section', // identifiant de la section
      'type'  => 'text',
      'settings' => 'texte_boite_alerte', // identifiant du réglage
    )
  );

  // Ajout d'un réglage
  $wp_customize->add_setting('voir_texte_boite_alerte', array(
    'default' => false,
    'capability' => 'edit_theme_options', // droits utilisateurs nécessaires
    'type' => 'theme_mod', // avec theme_mod, utilisation possible de get_theme_mod() pour obtenir s'il faut ou non afficher la boîte d'alerte
    'transport' => 'refresh', // méthode utilisée pour générer l'aperçu en direct, 'refresh' ne nécessite pas de développements supplémentaires
  ));

  // Ajout d'un contrôle
  $wp_customize->add_control(
    'show_alert_text',
    array(
      'label' => __("Show alert box", 'bootstrap'), // nom du contrôle dans l'interface
      'section' => 'mon_theme_responsive_section', // identifiant de la section
      'type'  => 'checkbox',
      'settings' => 'voir_texte_boite_alerte', // identifiant du réglage
    )
  );

  // Ajout d'un réglage
  $wp_customize->add_setting('alignement_texte_boite_alerte', array(
    'default' => 'center',
    'capability' => 'edit_theme_options', // droits utilisateurs nécessaires
    'type' => 'theme_mod', // avec theme_mod, utilisation possible de get_theme_mod() pour obtenir l'alignement du texte de la boîte d'alerte
    'transport' => 'refresh', // méthode utilisée pour générer l'aperçu en direct, 'refresh' ne nécessite pas de développements supplémentaires
  ));

  // Ajout d'un contrôle
  $wp_customize->add_control(
    'alignment_alert_text',
    array(
      'label' => __("Alert box alignment :", 'bootstrap'), // nom du contrôle dans l'interface
      'section' => 'mon_theme_responsive_section', // identifiant de la section
      'type'  => 'radio',
      'choices' => array(
        'left' => 'Gauche',
        'center' => 'Centré',
        'right' => 'Droit',
      ),
      'settings' => 'alignement_texte_boite_alerte', // identifiant du réglage
    )
  );

  // Ajout d'un réglage
  $wp_customize->add_setting('couleur_etiquette_categorie', array(
    'default' => '6c757d', // code hexa de la couleur par défaut
    'sanitize_callback' => 'sanitize_hex_color',
    'capability' => 'edit_theme_options', // droits utilisateurs nécessaires
    'type' => 'theme_mod', // avec theme_mod, utilisation possible de get_theme_mod() pour obtenir la couleur à appliquer
    'transport' => 'refresh', // méthode utilisée pour générer l'aperçu en direct, 'refresh' ne nécessite pas de développements supplémentaires
  ));

  // Ajout d'un contrôle
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'category_color',
      array(
        'label' => __("Categories background color :", 'bootstrap'), // nom du contrôle dans l'interface
        'section' => 'mon_theme_responsive_section', // identifiant de la section
        'settings' => 'couleur_etiquette_categorie', // identifiant du réglage
      )
    )
  );
}

add_action('customize_register', 'theme_customize');


/* Création de la règle CSS */
function theme_customize_css()
{
?>
  <style type="text/css">
    header h1 {
      color: <?php echo get_theme_mod('couleur_titre'); ?> !important;
    }

    .badge {
      background-color: <?php echo get_theme_mod('couleur_etiquette_categorie', '#6c757d'); ?> !important;
    }

    #page_full_width_card p {
      text-align: <?php echo get_theme_mod('alignement_texte_boite_alerte', 'text-center'); ?>;
    }

    #header_background {
      background-image: url('<?php echo get_theme_mod('image_arriere_plan_fullwidth', 'none'); ?>');
    }
  </style>
<?php
}

add_action('wp_head', 'theme_customize_css');

function search_filter($query)
{
  if ($query->is_search) {
    $query->set('post_type', 'post');
  }
  return $query;
}

add_filter('pre_get_posts', 'search_filter');

function sidebar_widgets_init()
{
  register_sidebar(array(
    'name' => 'Sidebar',
    'id' => 'sidebar-content',
    'before_widget' => '<div class="card mb-4">',
    'after_widget' => '</div>',
    'before_title' => '<div class="card-header">',
    'after_title' => '</div>',
  ));

  register_sidebar(array(
    'name' => '404 Page',
    'id' => '404-page',
    'before_widget' => '<div id="error-box">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
  ));
}

add_action('widgets_init', 'sidebar_widgets_init');


// Intercepter les données d'un formulaire
function give_form_redirect()
{

  if (isset($_POST['give-send']) && isset($_POST['give-check'])) {

    // Vérification de la présence du NONCE
    if (wp_verify_nonce($_POST['give-check'], 'do-give')) {

      $give = intval($_POST['give']);

      if ($give <= 0) {

        /* Si la valeur est inférieure à 0, on ajotue une variable GET ?error=radin dans l'URL grâce à add_query_arg()
          afin de pouvoir afficher un message */

        // wp_get_referer() permet d'obtenir l'URL d'origine de la requête
        $url = esc_url(add_query_arg('error_message', 'stingy', wp_get_referer()));
      } else {

        // Récupération de la valeur en base de données (ou zéro si non défini)
        $current_give_value = intval(get_option('current_give_value', 0));
        $new_give_value = $current_give_value + $give;

        // Mise à jour de la valeur en base de données
        update_option('current_give_value', $new_give_value);

        // wp_get_referer() permet d'obtenir l'URL d'origine de la requête
        $url = esc_url(add_query_arg('error_message', 'success', wp_get_referer()));
      }

      // On redirige sur l'URL
      wp_safe_redirect($url);

      exit();
    }
  }
}

add_action('template_redirect', 'give_form_redirect');

add_action('init','add_my_error');

// Référencer le paramètre utilisé
function add_my_error() { 
    global $wp; 
    $wp->add_query_var('error_message'); 
}
