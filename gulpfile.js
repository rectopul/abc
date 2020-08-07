const { src, dest, watch, series } = require('gulp')
var gulp = require('gulp'),
    imagemin = require('gulp-imagemin'),
    svgSprite = require('gulp-svg-sprite'),
    svgmin = require('gulp-svgmin'),
    stylus = require('gulp-stylus'),
    es = require('event-stream'),
    concat = require('gulp-concat'),
    rename = require('gulp-rename'),
    sourcemaps = require('gulp-sourcemaps'),
    postcss = require('gulp-postcss'),
    autoprefixer = require('autoprefixer-stylus'),
    pxtorem = require('postcss-pxtorem'),
    replace = require('gulp-replace'),
    merge = require('merge-stream')

var fs = require('fs')
var package = JSON.parse(fs.readFileSync('./package.json'))
var config = {
    theme: package.theme,
    style: {
        in: 'src/assets/css',
        out: 'wp-content/themes/' + package.theme + '/assets/css',
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
        out: 'wp-content/themes/' + package.theme + '/assets/js',
    },
    svg: {
        in: 'src/assets/svg',
        out: 'wp-content/themes/' + package.theme + '/assets/svg',
    },
}

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

    const vendor = src(config.vendor.in + '/**/*').pipe(dest(config.vendor.out))

    return merge(normal, frameworks, vendor)
}

// Styles
function styles() {
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
                compress: true,
                linenos: true,
                import: __dirname + '/src/assets/css/app.styl',
            })
        )
        .pipe(rename('app.css'))
        .pipe(concat('app.css'))
        .pipe(sourcemaps.write())
        .pipe(dest(config.style.out))
        .on('error', function (err) {
            console.log(err)
            this.emit('end')
        })
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
        .pipe(svgSprite(configSVG))
        .on('error', function (error) {
            console.log(error)
        })
        .pipe(rename(configSVG.mode.css.sprite))
        .pipe(dest(config.svg.out))
}

//  Watch

exports.styles = styles
exports.copy = copy
exports.svg = svg
//exports.stylesCompress = stylesCompress

exports.init = series(styles, copy, svg /*stylesCompress*/)

exports.default = function () {
    watch('./src/assets/css/**/*.styl', series(styles))
    //watch('./src/assets/css/**/*.styl', series(stylesCompress))
    watch(
        [
            'src/**/*.{php,jpg,jpeg,png,svg,css}',
            'src/frameworks/**/*.{php,jpg,jpeg,png,svg,css,js}',
            'src/vendor/**/*',
            '!node_modules',
            '!src/vendor/composer',
        ],
        series(copy)
    )

    watch([config.svg.in + '/**/*.svg'], series(svg))
}

// Default
//gulp.task('default', ['docker-compose', 'clean', 'copy', 'styles', 'images', 'svg'])
