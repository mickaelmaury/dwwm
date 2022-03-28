<?php 
function cptui_register_my_cpts() {

	/**
	 * Post Type: Films.
	 */

	$labels = [
		"name" => __( "Films", "bootstrap-child" ),
		"singular_name" => __( "Film", "bootstrap-child" ),
		"menu_name" => __( "Films", "bootstrap-child" ),
		"all_items" => __( "Tous les Films", "bootstrap-child" ),
		"add_new" => __( "Ajouter un nouveau", "bootstrap-child" ),
		"add_new_item" => __( "Ajouter un nouveau Film", "bootstrap-child" ),
		"edit_item" => __( "Modifier Film", "bootstrap-child" ),
		"new_item" => __( "Nouveau Film", "bootstrap-child" ),
		"view_item" => __( "Voir Film", "bootstrap-child" ),
		"view_items" => __( "Voir Films", "bootstrap-child" ),
		"search_items" => __( "Recherche de Films", "bootstrap-child" ),
		"not_found" => __( "Aucun Films trouvé", "bootstrap-child" ),
		"not_found_in_trash" => __( "Aucun Films trouvé dans la corbeille", "bootstrap-child" ),
		"parent" => __( "Film parent :", "bootstrap-child" ),
		"featured_image" => __( "Image mise en avant pour ce Film", "bootstrap-child" ),
		"set_featured_image" => __( "Définir l’image mise en avant pour ce Film", "bootstrap-child" ),
		"remove_featured_image" => __( "Retirer l’image mise en avant pour ce Film", "bootstrap-child" ),
		"use_featured_image" => __( "Utiliser comme image mise en avant pour ce Film", "bootstrap-child" ),
		"archives" => __( "Archives de Film", "bootstrap-child" ),
		"insert_into_item" => __( "Insérer dans Film", "bootstrap-child" ),
		"uploaded_to_this_item" => __( "Téléverser sur ce Film", "bootstrap-child" ),
		"filter_items_list" => __( "Filtrer la liste de Films", "bootstrap-child" ),
		"items_list_navigation" => __( "Navigation de liste de Films", "bootstrap-child" ),
		"items_list" => __( "Liste de Films", "bootstrap-child" ),
		"attributes" => __( "Attributs de Films", "bootstrap-child" ),
		"name_admin_bar" => __( "Film", "bootstrap-child" ),
		"item_published" => __( "Film publié", "bootstrap-child" ),
		"item_published_privately" => __( "Film publié en privé.", "bootstrap-child" ),
		"item_reverted_to_draft" => __( "Film repassé en brouillon.", "bootstrap-child" ),
		"item_scheduled" => __( "Film planifié", "bootstrap-child" ),
		"item_updated" => __( "Film mis à jour.", "bootstrap-child" ),
		"parent_item_colon" => __( "Film parent :", "bootstrap-child" ),
	];

	$args = [
		"label" => __( "Films", "bootstrap-child" ),
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
		"rewrite" => [ "slug" => "film", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
		"show_in_graphql" => false,
	];

	register_post_type( "film", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Acteurs.
	 */

	$labels = [
		"name" => __( "Acteurs", "bootstrap-child" ),
		"singular_name" => __( "Acteur", "bootstrap-child" ),
		"menu_name" => __( "Acteurs", "bootstrap-child" ),
		"all_items" => __( "Tous les Acteurs", "bootstrap-child" ),
		"edit_item" => __( "Modifier Acteur", "bootstrap-child" ),
		"view_item" => __( "Voir Acteur", "bootstrap-child" ),
		"update_item" => __( "Mettre à jour le nom de Acteur", "bootstrap-child" ),
		"add_new_item" => __( "Ajouter un nouveau Acteur", "bootstrap-child" ),
		"new_item_name" => __( "Nom du nouveau Acteur", "bootstrap-child" ),
		"parent_item" => __( "Parent dActeur", "bootstrap-child" ),
		"parent_item_colon" => __( "Acteur parent :", "bootstrap-child" ),
		"search_items" => __( "Recherche de Acteurs", "bootstrap-child" ),
		"popular_items" => __( "Acteurs populaires", "bootstrap-child" ),
		"separate_items_with_commas" => __( "Séparer les Acteurs avec des virgules", "bootstrap-child" ),
		"add_or_remove_items" => __( "Ajouter ou supprimer des Acteurs", "bootstrap-child" ),
		"choose_from_most_used" => __( "Choisir parmi les Acteurs les plus utilisés", "bootstrap-child" ),
		"not_found" => __( "Aucun Acteurs trouvé", "bootstrap-child" ),
		"no_terms" => __( "Aucun Acteurs", "bootstrap-child" ),
		"items_list_navigation" => __( "Navigation de liste de Acteurs", "bootstrap-child" ),
		"items_list" => __( "Liste de Acteurs", "bootstrap-child" ),
		"back_to_items" => __( "Retourner à Acteurs", "bootstrap-child" ),
		"name_field_description" => __( "The name is how it appears on your site.", "bootstrap-child" ),
		"parent_field_description" => __( "Assign a parent term to create a hierarchy. The term Jazz, for example, would be the parent of Bebop and Big Band.", "bootstrap-child" ),
		"slug_field_description" => __( "The slug is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.", "bootstrap-child" ),
		"desc_field_description" => __( "The description is not prominent by default; however, some themes may show it.", "bootstrap-child" ),
	];

	
	$args = [
		"label" => __( "Acteurs", "bootstrap-child" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'acteur', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "acteur",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "acteur", [ "film" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );