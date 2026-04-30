# Test Starter Theme - Custom Blocks

This directory contains custom Gutenberg blocks for the Test Starter Theme.

## Block Structure

Each custom block should follow this structure:

```
blocks/
├── block-name/
│   ├── block.json          # Block configuration (required)
│   ├── render.php          # Server-side rendering (required)
│   ├── index.js            # Editor-side script
│   ├── editor.scss         # Editor-specific styles
│   └── style.scss          # Frontend styles
```

## Creating a New Block

### 1. Create Block Directory
```bash
mkdir blocks/my-custom-block
```

### 2. Create block.json
The `block.json` file is the block's manifest. It defines:
- Block name and title
- Supported features (colors, spacing, etc.)
- Attributes (editable properties)
- Where to find the render function

### 3. Create render.php
The `render.php` file handles server-side rendering. Always:
- Use `wp_kses_post()` for content
- Use `esc_attr()` for attributes
- Use `esc_url()` for URLs
- Use `get_block_wrapper_attributes()` for proper HTML

### 4. Create index.js (Optional)
For editor-specific functionality like custom controls.

## Block Registration

Blocks in the `/blocks` directory are automatically registered in:
`inc/blocks.php` via `register_block_type_from_metadata()`

To enable auto-registration, uncomment the registration code in `inc/blocks.php`.

## Best Practices

### Security
- Always escape output with appropriate WordPress functions
- Validate and sanitize all input attributes
- Use nonces for admin actions

### Performance
- Minimize editor JavaScript
- Use server-side rendering when possible
- Avoid loading unnecessary styles/scripts

### Accessibility
- Include proper ARIA labels
- Use semantic HTML
- Test with screen readers

### Styling
- Use CSS custom properties from theme.json
- Avoid hardcoded colors
- Make blocks responsive

## Example: Custom Button Block

See `hero/` for a complete example of a modern Gutenberg block with:
- Full attributes support
- Proper escaping
- Responsive design
- Background image support
