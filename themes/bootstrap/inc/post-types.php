<?php 
function cptui_register_my_cpts() {

	/**
	 * Post Type: Projets.
	 */

	$labels = [
		"name" => __( "Projets", "bootstrap-child" ),
		"singular_name" => __( "Projet", "bootstrap-child" ),
		"menu_name" => __( "Projets", "bootstrap-child" ),
		"all_items" => __( "Tous les Projets", "bootstrap-child" ),
		"add_new" => __( "Ajouter un nouveau", "bootstrap-child" ),
		"add_new_item" => __( "Ajouter un nouveau Projet", "bootstrap-child" ),
		"edit_item" => __( "Modifier Projet", "bootstrap-child" ),
		"new_item" => __( "Nouveau Projet", "bootstrap-child" ),
		"view_item" => __( "Voir Projet", "bootstrap-child" ),
		"view_items" => __( "Voir Projets", "bootstrap-child" ),
		"search_items" => __( "Recherche de Projets", "bootstrap-child" ),
		"not_found" => __( "Aucun Projets trouvé", "bootstrap-child" ),
		"not_found_in_trash" => __( "Aucun Projets trouvé dans la corbeille", "bootstrap-child" ),
		"parent" => __( "Projet parent :", "bootstrap-child" ),
		"featured_image" => __( "Image mise en avant pour ce Projet", "bootstrap-child" ),
		"set_featured_image" => __( "Définir l’image mise en avant pour ce Projet", "bootstrap-child" ),
		"remove_featured_image" => __( "Retirer l’image mise en avant pour ce Projet", "bootstrap-child" ),
		"use_featured_image" => __( "Utiliser comme image mise en avant pour ce Projet", "bootstrap-child" ),
		"archives" => __( "Archives de Projet", "bootstrap-child" ),
		"insert_into_item" => __( "Insérer dans Projet", "bootstrap-child" ),
		"uploaded_to_this_item" => __( "Téléverser sur ce Projet", "bootstrap-child" ),
		"filter_items_list" => __( "Filtrer la liste de Projets", "bootstrap-child" ),
		"items_list_navigation" => __( "Navigation de liste de Projets", "bootstrap-child" ),
		"items_list" => __( "Liste de Projets", "bootstrap-child" ),
		"attributes" => __( "Attributs de Projets", "bootstrap-child" ),
		"name_admin_bar" => __( "Projet", "bootstrap-child" ),
		"item_published" => __( "Projet publié", "bootstrap-child" ),
		"item_published_privately" => __( "Projet publié en privé.", "bootstrap-child" ),
		"item_reverted_to_draft" => __( "Projet repassé en brouillon.", "bootstrap-child" ),
		"item_scheduled" => __( "Projet planifié", "bootstrap-child" ),
		"item_updated" => __( "Projet mis à jour.", "bootstrap-child" ),
		"parent_item_colon" => __( "Projet parent :", "bootstrap-child" ),
	];

	$args = [
		"label" => __( "Projets", "bootstrap-child" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "Projet", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
		"show_in_graphql" => false,
	];

	register_post_type( "projet", $args );


	$labels = [
		"name" => __( "Témoignages", "bootstrap-child" ),
		"singular_name" => __( "Témoignage", "bootstrap-child" ),
		"menu_name" => __( "Témoignages", "bootstrap-child" ),
		"all_items" => __( "Tous les Témoignages", "bootstrap-child" ),
		"add_new" => __( "Ajouter un nouveau", "bootstrap-child" ),
		"add_new_item" => __( "Ajouter un nouveau Témoignage", "bootstrap-child" ),
		"edit_item" => __( "Modifier Témoignage", "bootstrap-child" ),
		"new_item" => __( "Nouveau Témoignage", "bootstrap-child" ),
		"view_item" => __( "Voir Témoignage", "bootstrap-child" ),
		"view_items" => __( "Voir Témoignages", "bootstrap-child" ),
		"search_items" => __( "Recherche de Témoignages", "bootstrap-child" ),
		"not_found" => __( "Aucun Témoignages trouvé", "bootstrap-child" ),
		"not_found_in_trash" => __( "Aucun Témoignages trouvé dans la corbeille", "bootstrap-child" ),
		"parent" => __( "Témoignage parent :", "bootstrap-child" ),
		"featured_image" => __( "Image mise en avant pour ce Témoignage", "bootstrap-child" ),
		"set_featured_image" => __( "Définir l’image mise en avant pour ce Témoignage", "bootstrap-child" ),
		"remove_featured_image" => __( "Retirer l’image mise en avant pour ce Témoignage", "bootstrap-child" ),
		"use_featured_image" => __( "Utiliser comme image mise en avant pour ce Témoignage", "bootstrap-child" ),
		"archives" => __( "Archives de Témoignage", "bootstrap-child" ),
		"insert_into_item" => __( "Insérer dans Témoignage", "bootstrap-child" ),
		"uploaded_to_this_item" => __( "Téléverser sur ce Témoignage", "bootstrap-child" ),
		"filter_items_list" => __( "Filtrer la liste de Témoignages", "bootstrap-child" ),
		"items_list_navigation" => __( "Navigation de liste de Témoignages", "bootstrap-child" ),
		"items_list" => __( "Liste de Témoignages", "bootstrap-child" ),
		"attributes" => __( "Attributs de Témoignages", "bootstrap-child" ),
		"name_admin_bar" => __( "Témoignage", "bootstrap-child" ),
		"item_published" => __( "Témoignage publié", "bootstrap-child" ),
		"item_published_privately" => __( "Témoignage publié en privé.", "bootstrap-child" ),
		"item_reverted_to_draft" => __( "Témoignage repassé en brouillon.", "bootstrap-child" ),
		"item_scheduled" => __( "Témoignage planifié", "bootstrap-child" ),
		"item_updated" => __( "Témoignage mis à jour.", "bootstrap-child" ),
		"parent_item_colon" => __( "Témoignage parent :", "bootstrap-child" ),
	];

	$args = [
		"label" => __( "Témoignages", "bootstrap-child" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "Témoignage", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
		"show_in_graphql" => false,
	];

	register_post_type( "temoignage", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

function cptui_register_my_taxes_domaine_competences() {

	/**
	 * Taxonomy: Domaines de compétences.
	 */

	$labels = [
		"name" => __( "Domaines de compétences", "bootstrap-child" ),
		"singular_name" => __( "Domaine de compétence", "bootstrap-child" ),
		"menu_name" => __( "Domaines de compétences", "bootstrap-child" ),
		"all_items" => __( "Tous les Domaines de compétences", "bootstrap-child" ),
		"edit_item" => __( "Modifier Domaine de compétence", "bootstrap-child" ),
		"view_item" => __( "Voir Domaine de compétence", "bootstrap-child" ),
		"update_item" => __( "Mettre à jour le nom de Domaine de compétence", "bootstrap-child" ),
		"add_new_item" => __( "Ajouter un nouveau Domaine de compétence", "bootstrap-child" ),
		"new_item_name" => __( "Nom du nouveau Domaine de compétence", "bootstrap-child" ),
		"parent_item" => __( "Parent dDomaine de compétence", "bootstrap-child" ),
		"parent_item_colon" => __( "Domaine de compétence parent :", "bootstrap-child" ),
		"search_items" => __( "Recherche de Domaines de compétences", "bootstrap-child" ),
		"popular_items" => __( "Domaines de compétences populaires", "bootstrap-child" ),
		"separate_items_with_commas" => __( "Séparer les Domaines de compétences avec des virgules", "bootstrap-child" ),
		"add_or_remove_items" => __( "Ajouter ou supprimer des Domaines de compétences", "bootstrap-child" ),
		"choose_from_most_used" => __( "Choisir parmi les Domaines de compétences les plus utilisés", "bootstrap-child" ),
		"not_found" => __( "Aucun Domaines de compétences trouvé", "bootstrap-child" ),
		"no_terms" => __( "Aucun Domaines de compétences", "bootstrap-child" ),
		"items_list_navigation" => __( "Navigation de liste de Domaines de compétences", "bootstrap-child" ),
		"items_list" => __( "Liste de Domaines de compétences", "bootstrap-child" ),
		"back_to_items" => __( "Retourner à Domaines de compétences", "bootstrap-child" ),
		"name_field_description" => __( "The name is how it appears on your site.", "bootstrap-child" ),
		"parent_field_description" => __( "Assign a parent term to create a hierarchy. The term Jazz, for example, would be the parent of Bebop and Big Band.", "bootstrap-child" ),
		"slug_field_description" => __( "The slug is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.", "bootstrap-child" ),
		"desc_field_description" => __( "The description is not prominent by default; however, some themes may show it.", "bootstrap-child" ),
	];

	
	$args = [
		"label" => __( "Domaines de compétences", "bootstrap-child" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'domaine_competences', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "domaine_competences",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "domaine_competences", [ "projet" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_domaine_competences' );

