# Modern WordPress Development Guide

This document outlines the modern WordPress and Gutenberg best practices implemented in this theme.

## Table of Contents

1. [Theme Structure](#theme-structure)
2. [Gutenberg Block Development](#gutenberg-block-development)
3. [Theme JSON Configuration](#theme-json-configuration)
4. [Security Best Practices](#security-best-practices)
5. [Performance Optimization](#performance-optimization)
6. [Accessibility Standards](#accessibility-standards)
7. [Code Standards](#code-standards)

---

## Theme Structure

### Modular Organization

The theme uses a modular structure with separate files for different concerns:

```
inc/
├── enqueue.php           # Asset loading
├── theme-support.php     # Feature registration
├── custom-post-types.php # CPT definitions
├── acf-fields.php        # ACF configuration
├── block-patterns.php    # Block pattern registration
├── blocks.php            # Custom block setup
└── utilities.php         # Helper functions
```

**Benefits:**
- Easier to maintain and debug
- Clear separation of concerns
- Reusable across projects

### Constant Definitions

All paths are defined as constants in `functions.php`:

```php
define( 'TEST_STARTER_THEME_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'TEST_STARTER_THEME_DIR', get_template_directory() );
define( 'TEST_STARTER_THEME_URI', get_template_directory_uri() );
```

**Benefits:**
- Easy to update URLs/paths globally
- Prevents magic strings
- Version management

---

## Gutenberg Block Development

### Modern Block.json Format

All blocks use the standardized `block.json` format:

```json
{
  "$schema": "https://schemas.wp.org/trunk/block.json",
  "apiVersion": 3,
  "name": "test-starter/hero",
  "title": "Hero Section",
  "render": "file:./render.php"
}
```

**Key Features:**
- Declarative block definition
- Auto-registration with WordPress
- Metadata-driven configuration

### Server-Side Rendering

Blocks use PHP rendering for better performance and SEO:

```php
<?php
// render.php
$title = wp_kses_post( $attributes['title'] ?? '' );
$wrapper_attrs = get_block_wrapper_attributes();
?>
<section <?php echo wp_kses_attr( $wrapper_attrs ); ?>>
    <h1><?php echo $title; ?></h1>
</section>
```

**Benefits:**
- Content is fully indexable by search engines
- Works without JavaScript
- Faster initial page load
- Better browser compatibility

### Attributes Pattern

All block attributes are properly typed:

```json
"attributes": {
  "title": {
    "type": "string",
    "default": "Welcome"
  },
  "backgroundColor": {
    "type": "string",
    "default": "#0073aa"
  }
}
```

---

## Theme JSON Configuration

### Design Tokens

All design values are centralized in `theme.json`:

```json
{
  "settings": {
    "color": {
      "palette": [{"slug": "primary", "color": "#0073aa"}]
    },
    "typography": {
      "fontSizes": [{"slug": "large", "size": "1.5rem"}]
    }
  }
}
```

**Benefits:**
- No hardcoded values
- Consistent across editor and frontend
- Available in CSS custom properties
- User-editable through editor UI

### CSS Custom Properties

All theme values are exposed as CSS variables:

```css
:root {
  --wp--preset--color--primary: #0073aa;
  --wp--preset--font-size--large: 1.5rem;
}
```

Use in your stylesheets:

```css
.button {
  background-color: var(--wp--preset--color--primary);
  font-size: var(--wp--preset--font-size--large);
}
```

---

## Security Best Practices

### Output Escaping

Always escape output based on context:

```php
// HTML attributes
echo esc_attr( $class );

// URLs
echo esc_url( $url );

// HTML content (allow some tags)
echo wp_kses_post( $content );

// Plain text
echo esc_html( $text );
```

### Input Sanitization

Validate all user input:

```php
$clean_input = sanitize_text_field( $_POST['input'] );
$safe_email = sanitize_email( $_POST['email'] );
```

### Nonce Verification

Use nonces for form submissions:

```php
// Form
wp_nonce_field( 'my_action', 'my_nonce' );

// Verification
check_admin_referer( 'my_action', 'my_nonce' );
```

---

## Performance Optimization

### Asset Versioning

All assets include version hashing:

```php
wp_enqueue_style(
    'test-starter-main',
    get_template_directory_uri() . '/assets/css/main.css',
    [],
    TEST_STARTER_THEME_VERSION  // Version string
);
```

### Lazy Loading

Enable native lazy loading:

```html
<img src="image.jpg" loading="lazy" alt="Description">
```

### Deferred Script Loading

JavaScript loads in footer (deferred):

```php
wp_enqueue_script(
    'script-name',
    'url',
    [],
    '1.0',
    true  // Load in footer
);
```

### Code Splitting

Block assets load only when needed:

```php
wp_enqueue_style( 'block-styles', $url, [], $version );
// Only loads when block is present
```

---

## Accessibility Standards

### Semantic HTML

Use proper HTML semantics:

```php
<header>Navigation</header>
<main>Content</main>
<article>Post content</article>
<footer>Site footer</footer>
```

### ARIA Labels

Add ARIA attributes when needed:

```html
<button aria-label="Close menu" aria-expanded="false">
  ☰
</button>
```

### Color Contrast

Ensure sufficient contrast ratios (WCAG AA):
- Normal text: 4.5:1
- Large text: 3:1

### Keyboard Navigation

All interactive elements should be keyboard accessible:

```html
<button tabindex="0">Submit</button>
<a href="#">Link</a>
```

---

## Code Standards

### PHP Standards

Follow [WordPress Coding Standards](https://developer.wordpress.org/plugins/php/):

```php
<?php
// Opening tag on new line
defined( 'ABSPATH' ) || exit;  // Security check

// Proper naming: snake_case for functions
function test_starter_function_name() {
    // 4-space indentation
    $variable_name = 'value';
    
    return $variable_name;
}

// Hooks use snake_case
do_action( 'test_starter_hook_name' );
add_filter( 'hook_name', 'callback_function' );
```

### JavaScript Standards

Use modern JavaScript (ES6+):

```javascript
// Use const/let instead of var
const handleClick = () => {
    console.log('Clicked');
};

// Use arrow functions
const items = data.map(item => item.id);

// Use template literals
const message = `Hello, ${name}!`;
```

### File Organization

- One class/namespace per file
- Filename matches class name (kebab-case)
- Group related functions together

### Docblock Comments

Include proper PHPDoc comments:

```php
/**
 * Get theme setting with fallback
 * 
 * @param string $setting Setting name
 * @param mixed  $default Default value
 * @return mixed Setting value
 */
function test_get_theme_mod( $setting, $default = '' ) {
    return get_theme_mod( $setting, $default );
}
```

---

## WordPress REST API

### Exposing Custom Post Types

Make CPTs available via REST API:

```php
function register_my_cpt() {
    register_post_type( 'my-cpt', [
        'public'       => true,
        'show_in_rest' => true,
        'rest_base'    => 'my-cpt-items',
    ]);
}
```

### REST Authentication

Secure REST endpoints:

```php
function my_rest_endpoint() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return new WP_Error( 'unauthorized', 'Unauthorized', 
            ['status' => 403]
        );
    }
    
    return rest_ensure_response( [ 'data' => 'value' ] );
}

add_action( 'rest_api_init', function() {
    register_rest_route( 'test-starter/v1', '/endpoint', [
        'methods'             => 'POST',
        'callback'            => 'my_rest_endpoint',
        'permission_callback' => '__return_true',
    ]);
});
```

---

## Full Site Editing (FSE)

### Block Templates

Create block-based templates in `/block-templates`:

```
block-templates/
├── index.html
├── single.html
├── archive.html
└── 404.html
```

### Template Parts

Reusable template sections in `/parts`:

```
parts/
├── header.html
└── footer.html
```

### Block Template Pattern

```html
<!-- wp:template-part {"slug":"header"} /-->
<!-- wp:group {"align":"full"} -->
<div class="wp-block-group">
    <!-- wp:post-title /-->
    <!-- wp:post-content /-->
</div>
<!-- /wp:group -->
<!-- wp:template-part {"slug":"footer"} /-->
```

---

## Testing

### Unit Testing

Test your PHP code:

```php
class TestThemeSetup extends WP_UnitTestCase {
    public function test_theme_support() {
        $this->assertTrue( current_theme_supports( 'post-thumbnails' ) );
    }
}
```

### Browser Testing

Test across browsers:
- Chrome, Firefox, Safari, Edge
- Mobile browsers
- Different viewport sizes

---

## Resources

- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [Gutenberg Handbook](https://developer.wordpress.org/block-editor/)
- [WCAG Accessibility Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)
- [Web Vitals](https://web.dev/vitals/)

---

**Last Updated:** 2026-04-28
