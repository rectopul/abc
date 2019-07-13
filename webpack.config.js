const webpack = require('webpack');
// const ExtractTextPlugin = require("extract-text-webpack-plugin");
const path = require('path');
const fs      = require('fs');
const package  = JSON.parse(fs.readFileSync('./package.json'));
const config   = {
    theme: package.theme,
    script: {
        in: __dirname + '/src/assets/js',
        out: __dirname + '/wp-content/themes/' + package.theme + '/js'
    }
};

module.exports = {
    entry: {
        app: config.script.in + '/app.js',
        vendor: 'jquery'
    },
    output: {
        filename: '[name].js',
        path: config.script.out
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery"
        }),
        // new ExtractTextPlugin("styles.css"),
        // new webpack.optimize.UglifyJsPlugin({
        //     sourceMap: true
        // }),
        // new webpack.LoaderOptionsPlugin({
        //     minimize: true
        // })
    ],
    module: {
        rules: [
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
                query: {
                    presets: [['es2015',{modules: false}]]
                }
            },
            {
                test: /\.exec\.js$/,
                use: [ 'script-loader' ]
            },
            {
                test: /\.css$/,
                use: [ 'style-loader', 'css-loader' ]
            },
            {
                test: /\.(eot|woff|woff2|ttf|svg|png|jpg|gif)$/,
                loader: 'url-loader?limit=30000&name=[name]-[hash].[ext]'
            }
        ]
    },
    watchOptions: {
        aggregateTimeout: 300,
        ignored: /node_modules/
    },
    performance: {
        hints: false
    },
    devtool: 'source-map'
};
