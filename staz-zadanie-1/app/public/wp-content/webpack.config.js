const glob = require( 'glob' );
const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );
const StylelintPlugin = require( 'stylelint-webpack-plugin' );

let dotenv = {
    PROXY_TARGET: null,
    OUTPUT_PORT: null
};

module.exports = ( env, argv ) => {
    const {mode} = argv;

    if ( 'production' !== mode ) {
        dotenv = require( 'dotenv' ).config().parsed;
    }

	// patterns in theme
    const entry = glob.sync( path.resolve( __dirname, './themes/theme/inc/patterns/*/index.js' ) ).reduce( function( obj, el ) {
		const name = el
            .match( /\/patterns\/.*\.js/ )[0]
            .replace( '/patterns/', '' )
            .replace( '\\patterns\\', '' )
            .replace( '/index.js', '' )
            .replace( '\\index.js', '' );

        obj[name] = el;
        return obj;
    }, {});

	// common JS for the theme
    entry.common = path.resolve( __dirname, './themes/theme/src/common.js' );

	// blocks definition
	entry.editor = path.resolve( __dirname, './plugins/plugin/app/blocks/src/editor.js' );
	entry.script = path.resolve( __dirname, './plugins/plugin/app/blocks/src/script.js' );

    return {
        entry,
        output: {
            filename: ( elm ) => {
				switch ( elm.runtime ) {
					case 'common':
						return './../themes/theme/assets/[name].js';

					case 'editor':
					case 'script':
						return './../plugins/plugin/app/blocks/dist/[name].js';

					default:
						return './../themes/theme/inc/patterns/[name]/[name].min.js';
                }
            }
        },
        module: {
            rules: [
				{
					test: /\.js$/,
					exclude: /node_modules/,
					use: [
						{
							loader: 'babel-loader',
							options: {
								plugins: [ '@babel/plugin-proposal-class-properties' ],
								presets: [
									'@babel/preset-env',
									[
										'@babel/preset-react',
										{
											'pragma': 'wp.element.createElement',
											'pragmaFrag': 'wp.element.Fragment',
											'development': 'development' === argv.mode,
										}
									]
								],
							},
						},
						'eslint-loader',
					]
				},
                {
                    test: /\.(s?css)$/i,
                    use: [

                        // load extract css to individual files. To not compile everything into single file
                        {
                            loader: MiniCssExtractPlugin.loader
                        },

                        // load css
                        {
                            loader: 'css-loader',
                            options: {
                                url: false
                            }
                        },

                        // compile scss to css
                        {
                            loader: 'postcss-loader'
                        },

                        // load scss
                        {
                            loader: 'sass-loader'
                        }
                    ],
                    exclude: /node_modules/
                },
				{
					test: /\.svg$/,
					use: [ '@svgr/webpack', 'url-loader' ]
				}
            ]
        },
        watchOptions: {
            ignored: [ '**/node_modules', '**/vendor' ]
        },
        plugins: [
            new MiniCssExtractPlugin({
                filename: ( chunkData ) => {
                    const name = 'script' === chunkData.chunk.name ? 'style' : '[name]';

                    if ( 'common' === chunkData.chunk.name ) {
                        return `./../themes/theme/assets/${name}.css`;
                    }

					if ( 'editor' === chunkData.chunk.name || 'script' === chunkData.chunk.name ) {
						return `./../plugins/plugin/app/blocks/dist/${name}.css`;
					}

                    return `./../themes/theme/inc/patterns/${name}/${name}.css`;
                }
            }),
            new BrowserSyncPlugin({
                proxy: {
                    target: dotenv.PROXY_TARGET
                },
                host: 'localhost',
                files: [ './**/*.php', '../../plugins/**/*.php' ],
                port: dotenv.OUTPUT_PORT
            }),
            new StylelintPlugin({
                files: '**/themes/theme/*.scss',
                failOnError: false,
            })
        ],
        devtool: 'production' === mode ? false : 'source-map',
        resolve: {
            extensions: [ '*', '.js' ]
        },
        externals: {
            jquery: 'jQuery',
            '@wordpress/blocks': [ 'wp', 'blocks' ],
            '@wordpress/i18n': [ 'wp', 'i18n' ],
            '@wordpress/editor': [ 'wp', 'editor' ],
            '@wordpress/block-editor': [ 'wp', 'blockEditor' ],
            '@wordpress/components': [ 'wp', 'components' ],
            '@wordpress/element': [ 'wp', 'element' ],
        }
    };
};
