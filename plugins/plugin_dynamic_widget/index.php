<?php
/*
  Plugin Name: VWF Widget Location
  Description: Création d'un widget avec affichage des coordonnées de contact
  Author: Mickaël Maury
  Version: 1.0.0
 */

add_action('widgets_init', 'register_vmw_location');

function register_vmw_location()
{
    register_widget('vmw_location');
}

class vmw_location extends WP_Widget
{
    private $widget_fields = array(
        array(
            'label' => 'Nom',
            'id' => 'nom_text',
            'type' => 'text',
        ),
        array(
            'label' => 'Adresse',
            'id' => 'adresse_text',
            'type' => 'text',
        ),
        array(
            'label' => 'Email',
            'id' => 'email_email',
            'type' => 'email',
        ),
        array(
            'label' => 'Téléphone',
            'id' => 'telephone_tel',
            'type' => 'tel',
        ),
    );

    function __construct()
    {
        parent::__construct(
            'vmw_location',
            esc_html__('Location by Votre Webmaster Freelance', 'vwf_widget'),
            array('description' => esc_html__('Displays location', 'vwf_widget'),)
        );
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

        echo $args['before_widget'];

        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        // Affichage de la valeur des champs de paramètres
        echo '<div class="card-body">';
        echo '<p>' . $instance['nom_text'] . '</p>';
        echo '<p>' . $instance['adresse_text'] . '</p>';
        echo '<p><a href="mailto:'. $instance['email_email'] . '">' . $instance['email_email'] . '</a></p>';
        echo '<p><a href="tel:'. $instance['telephone_tel'] . '">' . $instance['telephone_tel'] . '</a></p>';
        echo '</div>';

        echo $args['after_widget'];
    }

    // Gestion de l'affichage des champs de paramètres dans le Tableau de bord WordPress
    public function field_generator($instance)
    {
        $output = '';
        foreach ($this->widget_fields as $widget_field) {
            $default = '';

            if (isset($widget_field['default'])) {
                $default = $widget_field['default'];
            }

            $widget_value = !empty($instance[$widget_field['id']]) ? $instance[$widget_field['id']] : esc_html__($default, 'vwf_widget');

            switch ($widget_field['type']) {
                default:
                    $output .= '<p>';
                    $output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'vwf_widget') . ':</label> ';
                    $output .= '<input class="vwf_widget" id="' . esc_attr($this->get_field_id($widget_field['id'])) . '" name="' . esc_attr($this->get_field_name($widget_field['id'])) . '" type="' . $widget_field['type'] . '" value="' . esc_attr($widget_value) . '">';
                    $output .= '</p>';
            }
        }
        echo $output;
    }

    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Location', 'vwf_widget');
        }

?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title :', 'vwf_widget'); ?></label>
            <input class="vwf_widget_title" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
<?php

        $this->field_generator($instance);
    }

    // Gestion de la mise à jour de la valeur des champs de paramètres en base de données
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        foreach ($this->widget_fields as $widget_field) {
            switch ($widget_field['type']) {
                default:
                    $instance[$widget_field['id']] = (!empty($new_instance[$widget_field['id']])) ? strip_tags($new_instance[$widget_field['id']]) : '';
            }
        }

        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }
}

// Fichier à renommer en index.php et à placer dans un répertoire mes-widgets situé dans /wp-content/plugins/ pour pouvoir l'activer en tant qu'extension WordPress //
