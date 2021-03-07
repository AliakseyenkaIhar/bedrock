/* eslint import/no-extraneous-dependencies: 0 */
const path                = require('path');

// PostCSS plugins
const cssnano             = require('cssnano');
const autoprefixer        = require('autoprefixer');
const tailwindcss         = require('tailwindcss');
const postcssFocusVisible = require('postcss-focus-visible');
const purgecss            = require('@fullhuman/postcss-purgecss');
const purgecssWordpress   = require('purgecss-with-wordpress');

// Define mode
const isProd = process.env.NODE_ENV === 'production';

module.exports = {
	tailwindConfig: {},
	postcssConfig: {
		plugins: [
			tailwindcss(path.resolve(__dirname, 'tailwind.config.js')),
			isProd
				? cssnano({ preset: 'default' })
				: null,
			isProd
				? purgecss({
					content: [
						'./resources/views/**/*.twig',
						'./resources/js/**/*.js',
					],
					defaultExtractor: content => content.match(/[\w-:./]+(?<!:)/g) || [],
					safelist: [
						/^marusia-*/,
						/^wp/,
						/^swiper/,
						...purgecssWordpress.safelist
					],
				})
				: null,
			isProd
				? autoprefixer()
				: null,
			postcssFocusVisible(),
		],
	},
	webpackConfig: {},
};
