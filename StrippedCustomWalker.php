<?php

class Stripped_Custom_Walker extends Walker_Nav_Menu {

    private $item_index = 0;

	public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {

        // Indent of the HTML
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : "";

        // Breake line if index 0
        $breake_first_line = ($this->item_index === 0) ? "\n" : "";

        // Menu item ID
        $item_id = esc_attr( $data_object->ID );

        // Check if menu item has children
        $has_children = ( in_array( 'menu-item-has-children', $data_object->classes ) ) ? " menu-item--has-children" : "";

        // Check if page is current
        $is_current = ( $data_object->current ) ? " menu-item--current" : "";

        // Check if home page
        $is_home = ( in_array( 'menu-item-home', $data_object->classes ) ) ? " menu-item--home" : "";

        // Menu item level, if the menu item is in a sub menu and in what level
        $is_sub_menu_item_level =  " menu-item--level-{$depth}";

        // Parent item id
        $parent_item_data_id = esc_attr( $data_object->menu_item_parent );

        // Check if post type is page or post (NOT IN USE IN THIS SETUP)
        $item_type = esc_attr( $data_object->object );
        
        // The target page url
        $page_url = esc_url( $data_object->url );

        // The target page title
        $page_title = esc_html( $data_object->title );

        // Post ID of target page or post (NOT IN USE IN THIS SETUP)
        $page_id = esc_attr( $data_object->object_id );

        // Get the target post excerpt or a trimed version of the content (NOT IN USE IN THIS SETUP)
        $target_excerpt = get_the_excerpt( $page_id );

        // Get the target page or post featured image of size 'medium' (NOT IN USE IN THIS SETUP)
        $target_featured_image = ( has_post_thumbnail( $page_id ) ) ? get_the_post_thumbnail( $page_id, 'medium' ) : "";

        // Get the array of all default menu item classes
        $default_classes = implode( ' ', $data_object->classes );
        
        // Output the starting tag for the list item
        if ($depth > 0) {
            $classes = "menu-item{$has_children}{$is_current}{$is_home}{$is_sub_menu_item_level}";
            // $classes = $default_classes; // Uncomment this to bringing back Wordpress default classes
            $output .= $indent . "<li id=\"menu-item-{$item_id}\" class=\"{$classes}\" role=\"presentation\" data-parent-id=\"menu-item-{$parent_item_data_id}\">";
        } else {
            $classes = "menu-item{$has_children}{$is_current}{$is_home}";
            // $classes = $default_classes; // Uncomment this to bringing back Wordpress default classes
            $output .=  $breake_first_line . $indent . "<li id=\"menu-item-{$item_id}\" class=\"{$classes}\" role=\"presentation\">";
        }

        // Output the link and title
        $output .= "<a href=\"{$page_url}\">{$page_title}</a>";
        $this->item_index++;
    }

    public function end_el(&$output, $data_object, $depth = 0, $args = null) {
        // Output the closing tag for the list item
        $output .= "</li>\n";
    }

    public function start_lvl(&$output, $depth = 0, $args = null) {
        // Add a class to the sub-menu based on the depth
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul class=\"sub-menu\" role=\"navigation\">\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        // Output the closing tag for the sub-menu
        $indent = str_repeat( "\t", $depth );
        $output .= "{$indent}</ul>\n";
    }
}
