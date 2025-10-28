# Directorist - Custom Map Styles

A WordPress plugin extension for Directorist that provides custom Google Maps styling capabilities and allows you to override the default map implementation with your own configurations.

## Description

This plugin extends the Directorist directory plugin by providing enhanced Google Maps functionality. It allows you to:

- Override default Directorist map styles
- Implement custom map configurations
- Add custom Google Map ID settings
- Replace the default map script with your custom implementation

## Features

- **Custom Map Styling**: Override Directorist's default Google Maps styling
- **Script Replacement**: Replace the default map script with your custom implementation
- **Admin Integration**: Seamlessly integrates with Directorist's admin settings
- **Google Map ID Support**: Configure custom Google Map ID through admin panel
- **WordPress Standards**: Built following WordPress coding standards and best practices

## Requirements

- WordPress 5.2 or higher
- Directorist plugin (active)
- PHP 7.4 or higher

## Installation

1. Download the plugin files
2. Upload the `directorist-custom-map-styles` folder to your `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Ensure Directorist plugin is installed and active

## Configuration

### Creating a Google Map ID for Custom Styles

Before configuring the plugin, you need to create a Google Map ID with custom styling:

#### Step 1: Create a Map ID in Google Cloud Console

1. Go to the [Google Cloud Console](https://console.cloud.google.com/)
2. Select your project or create a new one
3. Navigate to **APIs & Services > Credentials**
4. Click **+ CREATE CREDENTIALS** and select **Map ID**
5. Fill in the details:
   - **Map ID name**: Enter a descriptive name (e.g., "Directorist Custom Map")
   - **Map type**: Select "JavaScript"
   - **Styling**: Choose "Custom styling" and click **CREATE**

#### Step 2: Configure Map Styling

1. After creating the Map ID, click on it to edit
2. In the **Styling** section, you can:
   - Use the **Map Styling Wizard** for visual customization
   - Import **JSON styling** for advanced customization
   - Choose from **predefined themes**

#### Step 3: Get Your Map ID

1. Copy the generated Map ID (it looks like: `1234567890abcdef`)
2. Note this ID for plugin configuration

#### Step 4: Enable Required APIs

Make sure these APIs are enabled in your Google Cloud project:
- **Maps JavaScript API**
- **Places API** (if using places functionality)
- **Geocoding API** (if using geocoding)

### Google Map ID Setting

1. Go to **Directorist > Settings > Listings > Map Settings**
2. Find the **Google Map ID** field
3. Enter your custom Google Map ID (from Step 3 above)
4. Save settings

### Custom Map Styling Examples

#### Basic Dark Theme JSON
```json
[
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#212121"
      }
    ]
  },
  {
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  }
]
```

#### Minimalist Style JSON
```json
[
  {
    "featureType": "all",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#ffffff"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#2c5aa0"
      }
    ]
  }
]
```

### Custom Map Script

The plugin automatically replaces Directorist's default map script with your custom implementation located at:
```
assets/google-map.js
```

You can modify this file to implement your custom map styling and functionality.

## File Structure

```
directorist-custom-map-styles/
├── directorist-custom-map-styles.php    # Main plugin file
├── inc/
│   └── functions.php                    # Helper functions
├── assets/
│   └── google-map.js                   # Custom map implementation
├── .gitignore                          # Git ignore file
└── README.md                           # This file
```

## Development

### Plugin Structure

- **Main Class**: `Directorist_Custom_Map_Styles` - Handles plugin initialization
- **Helper Functions**: Located in `inc/functions.php`
- **Custom Script**: `assets/google-map.js` - Your custom map implementation

### Hooks and Filters

The plugin uses the following WordPress hooks:

- `wp_print_scripts` - To dequeue default Directorist map script
- `wp_enqueue_scripts` - To enqueue custom map script
- `atbdp_listing_type_settings_field_list` - To add Google Map ID field
- `atbdp_listing_settings_map_sections` - To add field to map settings section

### Constants

- `DIRECTORIST_CUSTOM_MAP_STYLES_URI` - Plugin URL
- `DIRECTORIST_CUSTOM_MAP_STYLES_DIR` - Plugin directory path
- `DIRECTORIST_CUSTOM_MAP_STYLES_VERSION` - Plugin version

## Customization

### Adding Custom Map Styles

Edit the `assets/google-map.js` file to implement your custom map styling. The plugin provides access to Directorist options through the `directorist_options` JavaScript object.

### Adding New Settings

You can extend the plugin by adding new settings fields in the `inc/functions.php` file using Directorist's filter hooks.

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Changelog

### Version 1.0.0
- Initial release
- Custom Google Maps styling support
- Google Map ID configuration
- Script replacement functionality
- WordPress admin integration

## Support

For support, feature requests, or bug reports, please:

1. Check the [Issues](https://github.com/your-username/directorist-custom-map-styles/issues) page
2. Create a new issue if your problem isn't already reported
3. Provide detailed information about your WordPress version, Directorist version, and the issue you're experiencing

## License

This plugin is licensed under the GPL v2 or later.

```
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
```

## Credits

- **Author**: wpXplore
- **Author URI**: https://wpxplore.com/plugins/directorist-custom-map-styles
- **Requires**: Directorist plugin
- **Tested up to**: WordPress 6.4
- **Requires PHP**: 7.4

## Acknowledgments

- Built for the Directorist community
- Extends the functionality of the Directorist directory plugin
- Follows WordPress coding standards and best practices
