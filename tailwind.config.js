const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    './resources/**/*.antlers.html',
    './resources/**/*.antlers.php',
    './resources/**/*.blade.php',
    './resources/**/*.vue',
    './content/**/*.md',
      './app/**/*.php',
      './resources/**/*.html',
      './resources/**/*.js',
      './resources/**/*.jsx',
      './resources/**/*.ts',
      './resources/**/*.tsx',
      './resources/**/*.php',
      './resources/**/*.vue',
      './resources/**/*.twig',
      './node_modules/flowbite/**/*.js',
  ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                sudepartment: ['CaeciliaeText-Bold', 'Georgia', 'Times', 'Times New Roman', 'serif'],
            },
            colors: {
                suprimary: '#002f5f',
                sudepartment: '#33587f',
                susecondary: '#acdee6',
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ['active'],
        }
    },
  plugins: [
      require('@tailwindcss/forms'),
      require('@tailwindcss/typography'),
      require('flowbite/plugin'),
  ],
}
