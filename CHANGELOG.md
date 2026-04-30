# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-04-28

### Added
- **Tailwind CSS Integration** - Utility-first CSS framework with PostCSS compilation
- Full Gutenberg support with custom block framework
- Modern `theme.json` configuration with color palettes and typography scales
- Custom block infrastructure in `/blocks` directory
- Hero block example with full implementation and Tailwind styling
- Block patterns with categories (Featured, Hero, Testimonials, CTA)
- Utility functions in `inc/utilities.php` for common theme operations
- Enhanced asset enqueueing with versioning
- Support for full site editing (FSE)
- Comprehensive theme documentation
- Modern WordPress development guide
- Tailwind CSS setup guide with examples
- EditorConfig for code consistency
- Webpack configuration for JavaScript bundling
- Example template parts with Tailwind CSS
- Development build scripts with npm

### Changed
- Updated `style.css` with proper theme metadata
- Enhanced `theme-support.php` with modern WordPress features
- Improved `enqueue.php` with better asset management and Tailwind compilation notes
- Reorganized `block-patterns.php` with categories and metadata
- Updated `functions.php` with constants and modular structure
- Hero block render updated with Tailwind CSS utilities

### Improved
- Security: Proper escaping throughout theme
- Performance: Versioned assets, deferred script loading, automatic CSS tree-shaking
- Accessibility: Semantic HTML, ARIA labels, keyboard navigation
- Code quality: Following WordPress coding standards
- Developer Experience: Modern build tools (PostCSS, Tailwind, Webpack)

### Documentation
- Added `README.md` with comprehensive theme documentation
- Added `MODERN-WORDPRESS-GUIDE.md` with best practices
- Added `TAILWIND-SETUP.md` with Tailwind CSS guide and examples
- Added `blocks/README.md` with custom block guidelines
- Added `template-parts/hero-section.php` example with Tailwind

### Build Configuration
- Added `package.json` with npm scripts and dependencies
- Added `tailwind.config.js` with custom theme configuration
- Added `postcss.config.js` for CSS processing pipeline
- Added `webpack.config.js` for JavaScript bundling
- Added `.gitignore` for version control
- Added `.editorconfig` for code consistency

## [1.0.0] - Initial Release

### Added
- Initial theme structure
- Basic Gutenberg support
- ACF integration
- Navigation menu support
