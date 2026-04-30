# Test Starter Theme v2.0

A modern WordPress theme built for Gutenberg with full site editing support and custom block development capabilities.

## Features

- ✅ **Gutenberg Ready** - Full block editor support with custom block framework
- ✅ **ACF Pro Blocks** - Custom blocks built with Advanced Custom Fields Pro
- ✅ **Tailwind CSS** - Utility-first CSS framework with automatic tree-shaking and compilation
- ✅ **Theme JSON Support** - Modern theming with color palettes, typography scales, and spacing
- ✅ **Custom Blocks** - Pre-built structure for developing custom Gutenberg blocks
- ✅ **Block Patterns** - Multiple block patterns for common layouts
- ✅ **Modern PHP** - Following WordPress coding standards and best practices
- ✅ **REST API Ready** - Prepared for headless WordPress development
- ✅ **Accessibility** - Built with a11y in mind

## Directory Structure

```
test-starter-theme/
├── assets/
│   ├── css/
│   │   ├── tailwind.css       # Tailwind source file
│   │   ├── main.css           # Compiled output (generated)
│   │   └── theme.css          # Optional additional styles
│   └── js/
│       └── main.js
├── blocks/                    # Custom Gutenberg blocks
│   ├── hero/                  # Example hero block
│   │   ├── block.json
│   │   └── render.php
│   └── README.md
├── template-parts/            # Reusable template components
│   └── hero-section.php
├── inc/
│   ├── acf-fields.php         # ACF field group exports
│   ├── block-patterns.php     # Registered block patterns
│   ├── blocks.php             # Custom block registration
│   ├── custom-post-types.php  # Custom post types
│   ├── enqueue.php            # Asset enqueueing
│   ├── theme-support.php      # Theme features
│   └── utilities.php          # Helper functions
├── footer.php
├── functions.php              # Main theme file
├── header.php
├── index.php
├── page.php
├── style.css                  # Theme metadata
├── theme.json                 # Gutenberg theme settings
├── tailwind.config.js         # Tailwind CSS configuration
├── postcss.config.js          # PostCSS configuration
├── webpack.config.js          # Webpack configuration
├── package.json               # NPM dependencies and scripts
├── .editorconfig              # Editor consistency
├── .gitignore                 # Git ignore patterns
├── README.md                  # This file
├── TAILWIND-SETUP.md          # Tailwind CSS guide
├── MODERN-WORDPRESS-GUIDE.md  # Development best practices
└── CHANGELOG.md               # Version history
```

## Installation

1. Upload the theme to `/wp-content/themes/test-starter-theme/`
2. In WordPress admin, go to **Appearance > Themes**
3. Activate "Test Starter Theme"

## Configuration

### theme.json
The `theme.json` file contains all your theme settings:
- **Color Palettes** - Define your brand colors
- **Typography** - Font families and sizes
- **Spacing** - Standard spacing units
- **Layout** - Content and wide sizes

### Customizer
Extend the WordPress customizer in `inc/theme-support.php`:
```php
add_theme_support('custom-logo');
add_theme_support('custom-colors');
```

## Usage

### Tailwind CSS

This theme uses **Tailwind CSS** for rapid utility-first styling.

#### Quick Start

```bash
# Install dependencies
npm install

# Start development (watch mode)
npm run dev

# Build for production
npm run build
```

The CSS is compiled from `assets/css/tailwind.css` to `assets/css/main.css` using PostCSS.

#### Using Tailwind in Templates

```php
<div class="flex items-center justify-center bg-primary-600 text-white p-8 rounded-lg">
    <h1 class="text-4xl font-bold">Welcome</h1>
</div>
```

#### Example Block with Tailwind

```php
<section class="py-20 md:py-32 bg-gradient-to-r from-primary-600 to-secondary-600">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            <?php echo wp_kses_post( $title ); ?>
        </h2>
    </div>
</section>
```

#### Configuration

- **tailwind.config.js** - Theme colors, fonts, spacing, and plugins
- **postcss.config.js** - PostCSS processing pipeline
- **assets/css/tailwind.css** - Source file with custom utilities

For detailed setup and usage, see [TAILWIND-SETUP.md](TAILWIND-SETUP.md).

### Using Block Patterns
Patterns are available in the block editor's Pattern panel:
- Hero Section
- Testimonial
- Call to Action

### Creating Custom Blocks
See `blocks/README.md` for detailed instructions on creating custom blocks.

### Helper Functions
Common functions are available in `inc/utilities.php`:
```php
test_get_site_logo()           // Get site logo
test_get_primary_menu()        // Get primary menu
test_is_gutenberg_available()  // Check Gutenberg support
test_enqueue_google_fonts()    // Enqueue Google Fonts
```

## Theme Support

### Enabled Features
- `title-tag` - Dynamic title tag
- `post-thumbnails` - Featured images
- `menus` - Navigation menus
- `html5` - HTML5 markup
- `wp-block-styles` - Gutenberg block styles
- `responsive-embeds` - Responsive embed scaling
- `align-wide` - Wide alignment in blocks
- `editor-styles` - Editor stylesheet
- `fonts` - Font management
- `appearance` - Appearance menu

## Custom Post Types

Define custom post types in `inc/custom-post-types.php`:
```php
function register_my_cpt() {
    register_post_type( 'my-cpt', [
        'public'       => true,
        'show_in_rest' => true,
        'supports'     => [ 'title', 'editor' ],
    ]);
}
add_action( 'init', 'register_my_cpt' );
```

## ACF Integration

## ACF Pro Blocks Integration

This theme uses **Advanced Custom Fields Pro** for block development. All custom blocks are registered with `acf_register_block_type()`.

### Hero Block (Example)

The hero block is fully configured with ACF:

```php
// Fields configured in inc/acf-fields.php
$title = get_field( 'hero_title' );
$subtitle = get_field( 'hero_subtitle' );
$background_image = get_field( 'hero_background_image' );
$background_color = get_field( 'hero_background_color' );
```

Block output:
- **Location:** `blocks/hero/render.php`
- **Registration:** `inc/blocks.php`
- **Fields:** `inc/acf-fields.php`
- **Config:** `blocks/hero/block.json`

### Creating New ACF Blocks

1. Register block in `inc/blocks.php` with `acf_register_block_type()`
2. Create field group in `inc/acf-fields.php`
3. Create `render.php` in block directory
4. Query ACF fields with `get_field()`

For complete guide, see [ACF-BLOCKS-GUIDE.md](ACF-BLOCKS-GUIDE.md).

### ACF Setup Requirements

- **ACF Pro 6.0+** - Required for block registration
- **License Key** - Add in WordPress admin
- Field groups can be exported/imported via JSON

### Example: Creating a Testimonial Block

```php
// In inc/blocks.php
acf_register_block_type([
    'name'            => 'testimonial',
    'title'           => 'Testimonial',
    'render_callback' => 'render_testimonial_block',
    'category'        => 'media',
]);

// In testimonial/render.php
<?php
$quote = get_field( 'testimonial_quote' );
$author = get_field( 'testimonial_author' );
?>
<blockquote class="border-l-4 border-primary-600 pl-4">
    <p><?php echo wp_kses_post( $quote ); ?></p>
    <footer>— <?php echo esc_html( $author ); ?></footer>
</blockquote>
```

## Asset Enqueuing

Assets are enqueued in `inc/enqueue.php` with proper versioning:
- Tailwind-compiled main stylesheet
- Main JavaScript
- Block editor styles
- Localized JavaScript data

## Security Practices

This theme follows WordPress security best practices:
- All output is properly escaped
- Nonces for form submissions
- Input validation and sanitization
- Prepared database queries

## Performance Tips

1. **Use theme.json** instead of customizer for settings (faster)
2. **Minimize custom JS** in block editor
3. **Lazy load images** using native lazy loading
4. **Use CSS custom properties** from theme.json
5. **Enable caching** with a caching plugin

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Internet Explorer 11 (basic support)

## Customization

### Changing Colors
Edit the color palette in `theme.json`:
```json
"palette": [
  {"slug": "primary", "color": "#0073aa", "name": "Primary"}
]
```

### Changing Fonts
Add font families in `theme.json`:
```json
"fontFamilies": [
  {"fontFamily": "Georgia, serif", "slug": "serif", "name": "Serif"}
]
```

### Adding Menus
Register new nav menus in `inc/theme-support.php`:
```php
register_nav_menus([
    'primary' => 'Primary Menu',
    'secondary' => 'Secondary Menu'
]);
```

## Recommended Plugins

- **Advanced Custom Fields (ACF)** - For flexible content fields
- **WP Super Cache** - For performance
- **Yoast SEO** - For SEO optimization
- **Wordfence** - For security

## Development

### Running Tests
```bash
# Add your test commands here
```

### Building Assets
If you use build tools, add commands here:
```bash
npm install
npm run dev    # Development build
npm run build  # Production build
```

## Documentation & Resources

- [WordPress Theme Developer Handbook](https://developer.wordpress.org/themes/)
- [Gutenberg Developer Handbook](https://developer.wordpress.org/block-editor/)
- [theme.json Documentation](https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/)
- [Block.json Specification](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/)

## Troubleshooting

### Blocks not showing in editor?
- Ensure `inc/blocks.php` is loaded in `functions.php`
- Check browser console for JavaScript errors
- Verify `block.json` is valid JSON

### Theme styles not applying?
- Clear WordPress cache
- Check `main.css` is enqueued
- Verify editor styles with `add_editor_style()`

### Custom blocks not rendering?
- Check `render.php` syntax
- Verify attributes in `block.json`
- Use `wp_kses_post()` to properly escape output

## License

This theme is licensed under the [GPL v2 or later](https://www.gnu.org/licenses/gpl-2.0.html).

## Support

For issues, questions, or contributions, please refer to the theme documentation or create an issue in the repository.

---

**Version:** 2.0  
**Last Updated:** 2026-04-28  
**Author:** Your Name  
**Requires:** WordPress 5.9+, PHP 8.0+
