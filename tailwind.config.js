module.exports = {
  content: [
    "./*.php",
    "./template-parts/**/*.php",
    "./inc/**/*.php",
    "./blocks/**/*.php",
    "./assets/js/**/*.js"
  ],
  safelist: [
    "menu-item",
    "current-menu-item",
    "current_page_item",
    "menu-item-has-children",
    "btn-primary",
    "estatein-form",
    "btn-accent",

  ],
  theme: {
    screens: {
      'xs': '320px',
      'sm': '430px',
      'md': '768px',
      'lg': '992px',
      'xl': '1280px',
      '2xl': '1440px',
      '3xl': '1600px',
      '4xl': '1920px',
    },
    extend: {
      fontFamily: {
        sans: ['Urbanist', 'sans-serif'],
      },
      colors: {
        primary: '#1A1A1A',
        secondary: '#ffffff',
        dark: '#141414',
        light: '#999999',
        accent: '#703BF7',
      },
      spacing: {
        20: '0.5rem',
        30: '1rem',
        40: '1.5rem',
        50: '2rem',
        60: '3rem',
      },
      typography: ({ theme }) => ({
        DEFAULT: {
          css: {
            color: theme('colors.gray.700'),
            a: {
              color: theme('colors.primary.600'),
              '&:hover': {
                color: theme('colors.primary.700'),
              },
            },
          },
        },
      }),
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
  ],
};
