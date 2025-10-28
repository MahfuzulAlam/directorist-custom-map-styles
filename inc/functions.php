<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Plugin helper functions
 * 
 * This file contains utility functions for the Directorist Custom Map Styles plugin,
 * including option data retrieval and admin settings integration.
 */

/**
 * Get plugin option data for JavaScript localization
 * 
 * Retrieves Directorist plugin options needed for map configuration
 * and makes them available to the frontend JavaScript.
 * 
 * @return array Array of plugin options
 */
function dcms_get_option_data()
{
    $options = [];
    // Get script debugging option from Directorist
    $options['script_debugging'] = get_directorist_option('script_debugging', DIRECTORIST_LOAD_MIN_FILES, true);
    // Get Google Map ID option
    $options['google_map_id'] = get_directorist_option('google_map_id', false);
    return $options;
}

/**
 * Add Google Map ID field to Directorist listing type settings
 * 
 * This filter adds a custom field for Google Map ID configuration
 * in the Directorist admin settings panel.
 * 
 * @param array $fields Existing settings fields
 * @return array Modified fields array with Google Map ID field
 */
add_filter( 'atbdp_listing_type_settings_field_list', function( $fields ){
    $fields['google_map_id'] = [
        'label' => __('Google Map ID', 'directorist-custom-map-styles'),
        'type' => 'text',
        'value' => '',
    ];
    return $fields;
}, 20 );

/**
 * Add Google Map ID field to map settings section
 * 
 * This filter ensures the Google Map ID field appears in the
 * appropriate settings section within Directorist admin.
 * 
 * @param array $sections Settings sections configuration
 * @return array Modified sections with Google Map ID field added
 */
add_filter( 'atbdp_listing_settings_map_sections', function( $sections ){
    $sections['map_settings']['fields'][] = 'google_map_id';
    return $sections;
} );