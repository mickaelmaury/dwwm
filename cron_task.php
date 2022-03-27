<?php

/**
 * Plugin Name: VWF WP cron task
 * Description: Création de tâches CRON via WordPress
 * Version: 1.0
 * Author: Mickaël Maury
 * Author URI: https://mickael-maury.fr
*/

class cronTask {

    protected $adminEmail;

    public function __construct() {

        // cron task
        add_action('vwf_cron_task', array($this, 'cron_task_callback'));

        // activation du plugin
        register_activation_hook(__FILE__, array($this, 'activate_cron_task'));

        // désactivation du plugin
        register_deactivation_hook(__FILE__, array($this, 'desactivate_cron_task'));

        $this->adminEmail = get_option('admin_email', '');
    }

    // activation de la tâche cron (exécution toutes les heures)
    public function activate_cron_task() {
        wp_mail($this->adminEmail, 'Activation de la tâche cron', 'Activation de la tâche cron');

        if (!wp_next_scheduled('vwf_cron_task')) {
            wp_schedule_event(time(), 'hourly', 'vwf_cron_task');
        }
    }

    // désactivation de la tâche cron
    public function desactivate_cron_task() {
        wp_mail($this->adminemail, 'Déctivation de la tâche cron', 'Déctivation de la tâche cron');

        if (wp_next_scheduled('vwf_cron_task')) {
            $timeStamp = wp_next_scheduled('vwf_cron_task');
            wp_unschedule_event($timeStamp, 'vwf_cron_task');
        }
    }

    public function cron_task_callback() {
        // Faire quelque chose (ex. envoyer un e-mail)
        wp_mail($this->adminEmail, 'Tâche Cron exécutée', 'Tâche Cron exécutée');
    }
}

new cronTask;

// Fichier à renommer en index.php et à placer dans un répertoire cron-task situé dans /wp-content/plugins/ pour pouvoir l'activer en tant qu'extension WordPress //
