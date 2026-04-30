# ACF Block Setup Guide — Modern ACF 6.0+ Approach

This theme uses **ACF Pro 6.0+** block development conventions.
Blocks are registered via `register_block_type()` + `block.json`.
No `acf_register_block_type()` needed.

---

## How Blocks Work (ACF 6.0+)

```
blocks/
└── hero/
    ├── block.json      ← block definition + ACF config
    ├── render.php      ← template ACF calls directly
    └── acf-json/       ← local JSON sync (version control)
inc/
├── blocks.php          ← auto-registers every block/ directory
└── acf-fields.php      ← PHP field group + local JSON paths
```

### Registration Flow

1. `inc/blocks.php` loops over every `blocks/*/block.json` and calls `register_block_type( $block_path )`.
2. ACF reads the `"acf.renderTemplate"` key in `block.json` and wires up `render.php`.
3. `inc/acf-fields.php` registers field groups via `acf_add_local_field_group()` and sets local JSON save/load paths.
4. WordPress calls `render.php` at render time; ACF fields are available via `get_field()`.

---

## Hero Block — Field Reference

| Field Name | ACF Type | Required | Default |
|---|---|---|---|
| `hero_title` | Text | ✅ | "Welcome to Our Site" |
| `hero_subtitle` | Textarea | — | "Your tagline goes here" |
| `hero_show_button` | True/False | — | Off |
| `hero_button_text` | Text | — | "Get Started" |
| `hero_button_url` | URL | — | — |
| `hero_background_image` | Image | — | — |
| `hero_background_color` | Color Picker | — | #0073aa |
| `hero_text_color` | Color Picker | — | #ffffff |
| `hero_min_height` | Text | — | "400px" |

Button text + URL appear only when **Show CTA Button** is toggled on (conditional logic).

---

## Creating a New Block

### 1. Create the block directory

```
blocks/
└── your-block/
    ├── block.json
    ├── render.php
    └── acf-json/
```

### 2. Write `block.json`

```json
{
  "$schema": "https://schemas.wp.org/trunk/block.json",
  "apiVersion": 3,
  "name": "acf/your-block",
  "title": "Your Block",
  "category": "layout",
  "description": "Description here.",
  "keywords": ["your", "keywords"],
  "textdomain": "test-starter-theme",
  "acf": {
    "renderTemplate": "render.php",
    "mode": "preview"
  },
  "supports": {
    "align": ["full", "wide"],
    "anchor": true,
    "jsx": true
  }
}
```

> **Key point:** the `"acf"` object replaces `acf_register_block_type()`.
> ACF 6.0+ reads this and sets up the block automatically.

### 3. Write `render.php`

```php
<?php
defined( 'ABSPATH' ) || exit;

$title   = get_field( 'your_title' );
$content = get_field( 'your_content' );

if ( $is_preview ) {
    echo '<div style="padding:2rem;background:#f0f0f0;text-align:center;">Your Block Preview</div>';
    return;
}

$wrapper = get_block_wrapper_attributes( [ 'class' => 'your-block' ] );
?>
<div <?php echo $wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
    <?php if ( $title ) : ?>
        <h2><?php echo wp_kses_post( $title ); ?></h2>
    <?php endif; ?>
    <?php if ( $content ) : ?>
        <div><?php echo wp_kses_post( $content ); ?></div>
    <?php endif; ?>
</div>
```

### 4. Register field group in `inc/acf-fields.php`

```php
function test_starter_register_your_block_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group([
        'key'   => 'group_your_block',
        'title' => 'Your Block Fields',
        'fields' => [
            [
                'key'   => 'field_your_title',
                'label' => 'Title',
                'name'  => 'your_title',
                'type'  => 'text',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/your-block',
                ],
            ],
        ],
    ]);
}
add_action( 'acf/init', 'test_starter_register_your_block_fields' );
```

That's it — `inc/blocks.php` auto-discovers the new directory.

---

## Local JSON Sync (Version Control)

ACF saves field group changes as JSON files.
This theme configures ACF to save JSON to `acf-json/` in the theme root.

To keep JSON alongside each block:
1. After editing fields in the ACF UI, copy the generated JSON from `acf-json/` to `blocks/your-block/acf-json/`.
2. Commit both `inc/acf-fields.php` and the JSON file.
3. On other environments, ACF loads from JSON automatically (faster than PHP registration).

---

## Key Differences: Legacy vs. Modern

| | Legacy (`acf_register_block_type`) | Modern ACF 6.0+ (`block.json`) |
|---|---|---|
| Registration | PHP function call on `acf/init` | `register_block_type( $block_path )` on `init` |
| Config location | PHP array | `block.json` → `"acf"` key |
| Render wiring | `render_callback` PHP function | `"acf.renderTemplate"` in block.json |
| Auto-discovery | Manual, one call per block | Loop once, picks up all blocks |
| WP alignment | Custom | Follows WordPress block standards |

---

## Output Escaping Quick Reference

```php
echo wp_kses_post( get_field( 'rich_text' ) );   // HTML content
echo esc_html( get_field( 'plain_text' ) );       // Plain text
echo esc_attr( get_field( 'class_name' ) );       // HTML attributes
echo esc_url( get_field( 'link_url' ) );          // URLs

// Block wrapper — already safe, no extra escaping needed
$wrapper = get_block_wrapper_attributes( [ 'class' => 'my-block' ] );
echo $wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
```

---

## Requirements

- **ACF Pro 6.0+** — Free does not support ACF blocks
- **WordPress 6.0+**
- **PHP 8.0+**

---

**Last Updated:** 2026-04-28
