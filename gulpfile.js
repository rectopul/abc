const { src, dest, watch, series } = require('gulp')
const browserSync = require('browser-sync')
const reload = browserSync.reload

var imagemin = require('gulp-imagemin'),
    svgSprite = require('gulp-svg-sprite'),
    svgmin = require('gulp-svgmin'),
    stylus = require('gulp-stylus'),
    concat = require('gulp-concat'),
    cheerio = require('gulp-cheerio'),
    rename = require('gulp-rename'),
    sourcemaps = require('gulp-sourcemaps'),
    minify = require('gulp-minify'),
    jsImport = require('gulp-js-import'),
    autoprefixer = require('autoprefixer-stylus'),
    replace = require('gulp-replace'),
    merge = require('merge-stream'),
    uglify = require('gulp-uglify')

var fs = require('fs')
var package = JSON.parse(fs.readFileSync('./package.json'))
var config = {
    theme: package.theme,
    style: {
        in: 'src/assets/css',
        out: 'wp-content/themes/hello-elementor/assets/css',
    },
    vendor: {
        in: 'src/vendor',
        out: 'wp-content/themes/' + package.theme + '/vendor',
    },
    image: {
        in: 'src/assets/images',
        out: 'wp-content/themes/' + package.theme + '/assets/images',
    },
    script: {
        in: 'src/assets/js',
        out: 'wp-content/themes/hello-elementor/assets/js',
    },
    svg: {
        in: 'src/assets/svg',
        out: 'wp-content/themes/' + package.theme + '/assets/svg',
    },
}

const server = browserSync.create()

// Configs
require('events').EventEmitter.defaultMaxListeners = Infinity

var configSVG = {
    svg: {
        xmlDeclaration: false,
        doctypeDeclaration: false,
        rootAttributes: {
            class: 'sprite-svg',
            id: 'sprite-svg',
        },
    },
    mode: {
        css: {
            dest: '.',
            sprite: 'sprite-svg.svg',
            layout: 'diagonal',
            bust: false,
            render: {
                css: false,
                scss: false,
            },
        },
        symbol: true,
    },
}

const js = () => {
    return src(['./src/assets/js/app.js'], {
        sourcemaps: false,
    })
        .pipe(jsImport({ hideConsole: true }))
        .pipe(concat('app.js'))
        .pipe(
            minify({
                ext: {
                    src: '.js',
                    min: '.min.js',
                },
                exclude: ['tasks'],
                ignoreFiles: ['.combo.js', '-min.js'],
            })
        )
        .pipe(dest(config.script.out, { sourcemaps: false }))
}

function dockerCompose() {
    'use strict'
    return src('docker-compose.yml')
        .pipe(replace('wae', config.theme))
        .pipe(rename('docker-compose.yml'))
        .pipe(dest('./'))
}

function copy() {
    const normal = src('src/**/*.{php,jpg,jpeg,png,svg,css}').pipe(
        dest(__dirname + '/wp-content/themes/' + config.theme)
    )

    const frameworks = src('src/frameworks/**/*.{php,jpg,jpeg,png,svg,css,js}').pipe(
        dest(__dirname + '/wp-content/themes/' + config.theme + '/frameworks')
    )

    const scripts = src('src/js/*.js').pipe(dest(__dirname + '/wp-content/themes/' + config.theme + '/js'))

    const vendor = src(config.vendor.in + '/**/*').pipe(dest(config.vendor.out))

    return merge(normal, frameworks, vendor, scripts)
}

// Styles
function styles() {
    const vendorFiles = src(['node_modules/normalize.css/normalize.css'])

    return src([config.style.in + '/**/*.styl'])
        .pipe(sourcemaps.init())
        .pipe(
            stylus({
                'include css': true,
                use: [autoprefixer('iOS >= 7', 'last 1 Chrome version')],
                compress: true,
                linenos: true,
                import: __dirname + '/src/assets/css/app.styl',
            })
        )
        .pipe(rename('app.css'))
        .pipe(concat('app.css'))
        .pipe(sourcemaps.write())
        .pipe(dest(config.style.out))
        .on('error', console.log)
        .pipe(server.stream())
}
function stylesCompress() {
    const vendorFiles = src([
        // 'bower_components/bootstrap/dist/css/bootstrap.min.css',
        // 'bower_components/owl/owl-carousel/owl.carousel.css'
        'node_modules/normalize.css/normalize.css',
    ])

    return src([config.style.in + '/app.styl'])
        .pipe(sourcemaps.init())
        .pipe(
            stylus({
                'include css': true,
                use: [autoprefixer('iOS >= 7', 'last 1 Chrome version')],
                linenos: true,
                import: __dirname + '/src/assets/css/app.styl',
            })
        )
        .pipe(rename('app.min.css'))
        .pipe(concat('app.min.css'))
        .pipe(sourcemaps.write())
        .pipe(dest(config.style.out))
        .on('error', function (err) {
            console.log(err)
            this.emit('end')
        })
}

// Images
function images() {
    'use strict'
    return src([config.image.in + '/**/*.{jpg,png}'])
        .pipe(
            imagemin({
                optimizationLevel: 5,
            })
        )
        .pipe(dest(config.image.out))
}

// SVG Clean
function svgMin() {
    'use strict'
    return src(config.svg.in + '/*.svg')
        .pipe(
            svgmin({
                plugins: [{ removeStyleElement: true }],
            })
        )
        .pipe(dest(config.svg.out))
}

// SVG
function svg() {
    'use strict'
    return src(config.svg.in + '/**/*.svg')
        .pipe(svgmin({ js2svg: { pretty: true } }))
        .pipe(
            cheerio({
                run: function ($) {
                    $('[fill]').removeAttr('fill')
                    $('[stroke]').removeAttr('stroke')
                    $('[style]').removeAttr('style')
                },
                parserOptions: { xmlMode: true },
            })
        )
        .pipe(replace('&gt;', '>'))
        .pipe(
            svgSprite({
                mode: {
                    symbol: {
                        sprite: 'sprite.svg',
                        render: {
                            css: configSVG.mode.css,
                        },
                    },
                },
            })
        )
        .on('error', function (error) {
            console.log(error)
        })
        .pipe(dest(config.svg.out))
}

function reloadTask(done) {
    server.reload()
    done()
}

const url = `http://localhost:8003` // Change me

function startTask(done) {
    server.init(
        {
            proxy: url,
            notify: true,
            port: 3333,
        },
        done
    )
}

//exports.stylesCompress = stylesCompress
function watchTask() {
    watch(config.script.in + '/app.js', series(js))
    watch('./src/assets/css/**/*.styl', series(styles))
    watch(config.image.in + '/**/*.{jpg,png}', series(images))
    watch(config.svg.in + '/**/*.svg', series(svg))

    watch([config.svg.in + '/**/*.svg'], series(svg))

    watch('src/js/*.js', reloadTask)
    watch('src/**/*.{php}', reloadTask)
}

exports.default = series(styles, js, svg, images, dockerCompose, startTask, watchTask)

// Default
//gulp.task('default', ['docker-compose', 'clean', 'copy', 'styles', 'images', 'svg'])
