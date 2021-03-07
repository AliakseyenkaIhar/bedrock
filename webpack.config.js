/* eslint import/no-extraneous-dependencies: 0 */
const dotenv                   = require('dotenv').config();
const path                     = require('path');
const webpack                  = require('webpack');
const CaseSensitivePathsPlugin = require('case-sensitive-paths-webpack-plugin');
const SpeedMeasurePlugin       = require('speed-measure-webpack-plugin');
const { merge }                = require('webpack-merge');

const HtmlWebpackPlugin        = require('html-webpack-plugin');
const CopyPlugin               = require('copy-webpack-plugin');
const MiniCssExtractPlugin     = require('mini-css-extract-plugin');
const AssetsPlugin             = require('assets-webpack-plugin');
const ImageMinimizerPlugin     = require('image-minimizer-webpack-plugin');
const svgToMiniDataURI         = require('mini-svg-data-uri');
const BrowserSyncPlugin        = require('browser-sync-webpack-plugin');
const { CleanWebpackPlugin }   = require('clean-webpack-plugin');

const marusia                  = require('./marusia.config');

const { DF='src', THEME: themeName, APP_URL, BROWSER } = process.env;
const themeFolder = `web/app/themes/${themeName}`;

// Filename output for js and css files
const fileName = (pathData, ext) => pathData.chunk.name === 'main' ? `public/${ext}/[name].${ext}`: `public/${ext}/[name].[contenthash].${ext}`;

// Define is it production mode or not
const isProd = process.env.NODE_ENV === 'production';

// Public path for output
const publicPath = (resourcePath, context) => `${path.relative(path.dirname(resourcePath), context)}/`;

// All plugins
const plugins = [
	new webpack.ProgressPlugin(),
	new webpack.DefinePlugin({
    	envVariables: dotenv.parsed,
  	}),
	new webpack.SourceMapDevToolPlugin({
		filename: '[file].map',
	}),
	new BrowserSyncPlugin({
		proxy: APP_URL,
		files: [`./${themeFolder}/resources/views/**/*.twig`, `./${themeFolder}/**/*.php`, `./${themeFolder}/style.css`],
		browser: BROWSER,
		notify: false,
	}),
	new CleanWebpackPlugin({
		cleanAfterEveryBuildPatterns: ['!assets.json'],
	}),
	new HtmlWebpackPlugin({
		filename: 'public/views/index.twig',
		template: 'resources/views/index.twig',
		publicPath: '{{ theme.link }}/',
		inject: !isProd,
	}),
	new CopyPlugin({
		patterns: [
			{
				from: './**/*.php',
				to: path.resolve(__dirname, themeFolder),
				globOptions: {
					ignore: ['**/framework/**'],
				},
			},
			{
				from: './**/*.twig',
				to: 'public/',
				context: path.resolve(__dirname, DF, 'resources'),
			},
			{
				from: path.resolve(__dirname, DF, 'style.css'),
			},
			{
				from: path.resolve(__dirname, DF, 'screenshot.png'),
			},
		],
	}),
	new MiniCssExtractPlugin({
		filename: (pathData) => fileName(pathData, 'css'),
	}),
	new CaseSensitivePathsPlugin(),
];

if(isProd) {
	plugins.unshift(
		new AssetsPlugin({
			filename: themeFolder + '/public/assets.json',
			prettyPrint: true,
			includeAllFileTypes: false,
			fileTypes: ['js', 'css'],
		})
	)
}

const target = 'browserslist';
const devtool = isProd ? false : 'eval';

const commonConfig = {
	context: path.resolve(__dirname, DF),
	entry: {
		main: './resources/js/index.js',
	},
	output: {
		path: path.resolve(__dirname, themeFolder),
		filename: (pathData) => fileName(pathData, 'js'),
		publicPath: '',
	},
	resolve: {
		alias: {
			'@': path.resolve(__dirname),
			'@src': path.resolve(__dirname, DF),
			'@resources': path.resolve(__dirname, DF, 'resources'),
			'@sass': path.resolve(__dirname, DF, 'resources/sass'),
			'@img': path.resolve(__dirname, DF, 'resources/img'),
			'@js': path.resolve(__dirname, DF, 'resources/js'),
			'modernizr$': path.resolve(__dirname, '.modernizrrc'),
		},
	},
	target,
	devtool,
	plugins,
	optimization: {
		runtimeChunk: 'single',
		splitChunks: {
			chunks: 'all',
			maxInitialRequests: Infinity,
			minSize: 0,
			cacheGroups: {
				vendor: {
					test: /[\\/]node_modules[\\/]/,
					name(module) {
						const packageName = module.context.match(/[\\/]node_modules[\\/](.*?)([\\/]|$)/)[1];
						return `lib.${packageName.replace('@', '')}`;
					},
				},
			},
		},
	},
	module: {
		rules: [
			// {
			// 	test: /\.modernizrrc(\.json)?$/,
			// 	use: [ 'modernizr-loader', 'json-loader' ],
			// },
			{
				test: /\.m?js$/,
				exclude: [
					/@babel(?:\/|\\{1,2})runtime|core-js/,
					/(node_modules|bower_components)/,
				],
				loader: 'babel-loader',
			},
			{
				test: /\.font\.js/,
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: 'css-loader',
						options: {
							url: false,
						},
					},
					{
						loader: 'webfonts-loader',
						options: {
							publicPath,
						},
					},
				],
			},
			{
				test: /\.s(a|c)ss$/i,
				use: [
					{
						loader: MiniCssExtractPlugin.loader,
						options: {
							publicPath,
						},
					},
					{
						loader: 'css-loader',
					},
					{
						loader: 'postcss-loader',
						options: {
							postcssOptions: {
                        		config: path.resolve(__dirname, 'postcss.config.js'),
							},
        				},
					},
					{
						loader: 'sass-loader',
					},
				],
			},
			{
				test: /\.css$/i,
				use: [
					{
						loader: MiniCssExtractPlugin.loader,
						options: {
							publicPath,
						},
					},
					{
						loader: 'css-loader',
					},
					{
						loader: 'postcss-loader',
						options: {
							postcssOptions: {
                        		config: path.resolve(__dirname, 'postcss.config.js'),
							},
        				},
					},
				],
			},
			{
				test: /\.(png|jp(e?)g|gif|ico)$/,
				include: path.resolve(__dirname, DF, 'resources/img'),
				type: 'asset',
				generator: {
					filename: 'public/img/[name].[hash].[ext]'
				},
       			parser: {
         			dataUrlCondition: {
           				maxSize: 8 * 1024, // 8kb
         			},
       			},
				use: [
					{
						loader: ImageMinimizerPlugin.loader,
						options: {
							severityError: 'warning',
							minimizerOptions: {
								plugins: [
									['gifsicle', { interlaced: true, optimizationLevel: 3 }],
									['mozjpeg', { quality: 80 }],
									['pngquant', { quality: [0.6, 0.8] }],
								],
							},
						},
					},
				],
			},
			{
				test: /\.svg$/,
				include: path.resolve(__dirname, DF, 'resources/img'),
				type: 'asset/inline',
				generator: {
					dataUrl: content => svgToMiniDataURI(content.toString())
				},
				use: [
					{
						loader: ImageMinimizerPlugin.loader,
						options: {
							severityError: 'warning',
							minimizerOptions: {
								plugins: [
									['svgo', { plugins: [{ removeViewBox: false }] } ],
								],
							},
						},
					},
				],
			},
			{
				test: /\.(ttf|eot|woff(2?)|svg)$/,
				include: path.resolve(__dirname, DF, 'resources/fonts'),
				type: 'asset/resource',
				generator: {
					filename: 'public/fonts/[name].[hash].[ext]'
				},
			},
		],
	},
};

/**
 * Wrap it into smp.wrap() after fix will be released
 * https://github.com/stephencookdev/speed-measure-webpack-plugin/issues/160
 */
const smp = new SpeedMeasurePlugin();

module.exports = merge(commonConfig, marusia.webpackConfig);
