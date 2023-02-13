const gulp = require( 'gulp' );
const zip = require( 'gulp-zip' );

function bundleTheme() {
	return gulp
		.src([
			'themes/theme/**/*',
			'!themes/theme/src/**/*',
			'!themes/theme/src',
		])
		.pipe( zip( 'theme.zip' ) )
		.pipe( gulp.dest( 'bundle' ) );
}

function bundleVendor() {
	return gulp
		.src([
			'vendor/**/*',
		])
		.pipe( zip( 'vendor.zip' ) )
		.pipe( gulp.dest( 'bundle' ) );
}

function bundlePlugin() {
	return gulp
		.src([
			'plugins/plugin/**/*',
			'!plugins/plugin/app/blocks/src/**/*',
		])
		.pipe( zip( 'plugin.zip' ) )
		.pipe( gulp.dest( 'bundle' ) );
}

exports.bundleTheme = bundleTheme;
exports.bundleVendor = bundleVendor;
exports.bundlePlugin = bundlePlugin;
