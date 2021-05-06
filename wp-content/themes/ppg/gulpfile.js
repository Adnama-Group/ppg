require('dotenv').config();

const env = process.env.NODE_ENV || 'development';
const { series, parallel, src, dest, watch } = require('gulp');
const { rollup } = require('rollup');
const { terser } = require('rollup-plugin-terser');
const sass = require('gulp-sass');
const Fiber = require('fibers');
const postcss = require('gulp-postcss');
const concat = require('gulp-concat');
const autoprefixer = require('autoprefixer');
const babel = require('rollup-plugin-babel');
const bs = require('browser-sync').create();
const { nodeResolve } = require('@rollup/plugin-node-resolve');
const commonjs = require('@rollup/plugin-commonjs');
const multi = require('@rollup/plugin-multi-entry');
const replace = require('@rollup/plugin-replace');

sass.compiler = require('dart-sass');

function css() {
	return src(['./src/app.scss'])
		.pipe(concat('app.min.scss'))
		.pipe(
			sass({
				fiber: Fiber,
				outputStyle: 'compressed',
				includePaths: ['./src'],
			}).on('error', sass.logError)
		)
		.pipe(postcss([autoprefixer()]))
		.pipe(dest('./dist'))
		.pipe(bs.stream());
}

async function js_entrypoint() {
	const bundle = await rollup({
		external: ['jquery', 'axios'],
		input: ['./src/app.js'],
		plugins: [
			nodeResolve(),
			commonjs({ include: 'node_modules/**' }),
			replace({
				'process.env.NODE_ENV': JSON.stringify(env),
			}),
			babel({ exclude: 'node_modules/**' }),
		],
	});

	return bundle.write({
		globals: {
			jquery: '$',
			axios: 'axios',
		},
		file: './dist/app.js',
		format: 'iife',
		sourcemap: true,
	});
}

function serve(cb) {
	bs.init({
		proxy: process.env.GULP_PROXY,
	});

	watch(['src/**/*.scss'], parallel(css));
	// watch(['custom-field-types/**/*.scss'], parallel(custom_field_types_css));
	watch(['src/**/*.js'], parallel(js_entrypoint));
	// watch(['custom-field-types/**/*.js'], parallel(custom_field_types_js));
	watch(['*.html', 'dist/**/*.js', '**/*.php']).on('change', bs.reload);

	cb();
}

exports.default = series(parallel(parallel(css), parallel(js_entrypoint)), serve);
exports.javascript = series(parallel(js_entrypoint));
exports.css = series(parallel(css));