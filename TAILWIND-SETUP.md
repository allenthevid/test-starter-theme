# Tailwind CSS Setup Guide

## Overview

This WordPress theme uses **Tailwind CSS** for rapid utility-first styling. Tailwind is compiled from `assets/css/tailwind.css` to `assets/css/main.css` using PostCSS.

## Quick Start

### 1. Install Dependencies

```bash
npm install
```

### 2. Start Development Server

```bash
npm run dev
```

This runs PostCSS in watch mode, automatically recompiling `main.css` whenever you make changes to Tailwind files.

### 3. Build for Production

```bash
npm run build
```

This creates an optimized, minified version of your CSS with tree-shaking enabled (unused styles are removed).

## File Structure

```
assets/
├── css/
│   ├── tailwind.css    # Source file (imports Tailwind directives)
│   ├── main.css        # Compiled output (generated)
│   └── theme.css       # Optional: additional theme styles
└── js/
    └── main.js
```

## Configuration Files

### tailwind.config.js

Tailwind configuration file where you:
- Define custom colors and spacing
- Extend typography settings
- Configure plugin options
- Set content paths for PurgeCSS

```javascript
module.exports = {
  content: [
    './header.php',
    './footer.php',
    './blocks/**/*.php',
    // ... template files
  ],
  theme: {
    extend: {
      colors: {
        primary: { /* custom colors */ }
      }
    }
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
  ]
}
```

### postcss.config.js

PostCSS configuration for processing CSS:

```javascript
module.exports = {
  plugins: {
    'postcss-import': {},
    tailwindcss: {},
    autoprefixer: {},
    ...(process.env.NODE_ENV === 'production' ? { cssnano: {} } : {}),
  },
};
```

## Usage Examples

### Using Tailwind Classes in Templates

```php
<?php get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-6 text-primary-600">
        <?php the_title(); ?>
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                ?>
                <article class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-2">
                            <a href="<?php the_permalink(); ?>" class="text-primary-600 hover:text-primary-700">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        <p class="text-gray-600 line-clamp-3">
                            <?php the_excerpt(); ?>
                        </p>
                    </div>
                </article>
                <?php
            endwhile;
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>
```

### Custom Utility Classes

Custom Tailwind utilities are defined in `assets/css/tailwind.css`:

```css
@layer components {
  .btn-primary {
    @apply px-4 py-2 rounded-md bg-primary-600 text-white hover:bg-primary-700;
  }
}
```

Use in template:

```html
<button class="btn-primary">Click Me</button>
```

### Using Theme Colors

All theme colors are available as Tailwind classes:

```html
<!-- Primary color -->
<div class="bg-primary-600 text-primary-100">Primary</div>

<!-- Secondary color -->
<div class="bg-secondary-600 text-secondary-100">Secondary</div>

<!-- Accent color -->
<div class="bg-accent text-white">Accent</div>
```

### Responsive Design

```html
<div class="text-sm md:text-base lg:text-lg">
    Responsive text sizing
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    Grid responsive layout
</div>
```

### Dark Mode (Optional)

Enable dark mode in `tailwind.config.js`:

```javascript
module.exports = {
  darkMode: 'class', // or 'media'
  // ...
}
```

Use in templates:

```html
<div class="text-black dark:text-white">
    Light in light mode, dark in dark mode
</div>
```

## Available Plugins

### @tailwindcss/forms

Provides beautiful form element styles:

```html
<input type="text" class="block w-full rounded-md border-gray-300">
<button class="btn btn-primary">Submit</button>
```

### @tailwindcss/typography

Styles content from CMS:

```html
<article class="prose prose-sm md:prose">
    <?php the_content(); ?>
</article>
```

### @tailwindcss/aspect-ratio

Maintains aspect ratio for responsive media:

```html
<div class="aspect-video">
    <iframe src="..."></iframe>
</div>
```

## Performance Optimization

### PurgeCSS (Automatic)

Unused CSS is automatically removed in production builds. Tailwind scans all PHP files for class names:

```javascript
content: [
  './header.php',
  './blocks/**/*.php',
  // Template files where Tailwind classes are used
]
```

### File Size Comparison

- Development: ~150KB (unminified)
- Production: ~8-15KB (after purging and compression)

## Common Issues & Solutions

### Class Names Not Working

**Problem:** Tailwind classes don't apply.

**Solutions:**
1. Ensure `npm run dev` is running
2. Check `tailwind.config.js` includes your template files
3. Clear browser cache
4. Verify `main.css` is enqueued in WordPress

### Build Fails

**Problem:** PostCSS build errors

**Solutions:**
```bash
# Clear node_modules and reinstall
rm -rf node_modules package-lock.json
npm install

# Rebuild CSS
npm run build
```

### Colors Not Showing

**Problem:** Colors defined in config not applying

**Solutions:**
1. Rebuild with `npm run build`
2. Verify color names in `tailwind.config.js`
3. Check spelling of color classes
4. Restart PHP development server

## WordPress-Specific Tips

### Escaping with Tailwind

Always escape class attributes:

```php
<?php
$classes = implode( ' ', [
    'p-4',
    'rounded-md',
    'bg-primary-600'
] );
?>
<div class="<?php echo esc_attr( $classes ); ?>">
    Content
</div>
```

### Block Editor Styling

Tailwind styles apply in the block editor automatically. Add editor-specific styles in `assets/css/tailwind.css`:

```css
@layer utilities {
  /* Target editor styles */
  .editor-gradient {
    @apply bg-gradient-to-r from-primary-500 to-secondary-500;
  }
}
```

### Custom Blocks with Tailwind

Use Tailwind in custom block render files:

```php
// blocks/hero/render.php
<section class="<?php echo esc_attr( $wrapper_classes ); ?> bg-gradient-to-r from-primary-600 to-primary-800 py-20">
    <div class="container mx-auto px-4 text-center text-white">
        <h1 class="text-4xl font-bold mb-4"><?php echo wp_kses_post( $title ); ?></h1>
        <p class="text-xl opacity-90"><?php echo wp_kses_post( $subtitle ); ?></p>
    </div>
</section>
```

## Build Scripts Reference

| Command | Purpose |
|---------|---------|
| `npm run dev` | Watch and compile Tailwind CSS in development |
| `npm run build` | Compile and minify CSS for production |
| `npm start` | Alias for `npm run dev` |
| `npm run build:webpack` | Build JavaScript bundles |
| `npm run dev:webpack` | Watch and build JavaScript |
| `npm run lint` | Lint JavaScript files |
| `npm run lint:css` | Check CSS syntax |
| `npm run format` | Auto-format code files |

## Advanced Configuration

### Adding Custom Fonts

```javascript
// tailwind.config.js
theme: {
  extend: {
    fontFamily: {
      sans: ['Inter', 'sans-serif'],
      serif: ['Georgia', 'serif'],
    }
  }
}
```

### Custom Breakpoints

```javascript
// tailwind.config.js
theme: {
  extend: {
    screens: {
      'xs': '320px',
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
    }
  }
}
```

### Extend Colors

```javascript
// tailwind.config.js
theme: {
  extend: {
    colors: {
      brand: {
        50: '#f0fdf4',
        100: '#dcfce7',
        // ... 900, 950
      }
    }
  }
}
```

## Resources

- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Tailwind Component Library](https://www.tailwindcomponents.com/)
- [Tailwind UI (Headless Components)](https://tailwindui.com/)
- [Official Tailwind Plugins](https://tailwindcss.com/docs/plugins)

## CI/CD Integration

For automated builds in deployment:

```yaml
# Example GitHub Actions workflow
- name: Build CSS
  run: npm run build
```

## Troubleshooting Commands

```bash
# Check Node version
node --version

# Verify npm installation
npm --version

# View installed packages
npm list

# Install missing dependencies
npm install

# Clear npm cache
npm cache clean --force

# Rebuild everything
rm -rf node_modules && npm install && npm run build
```

---

**Last Updated:** 2026-04-28  
**Tailwind CSS Version:** 3.3.5+
