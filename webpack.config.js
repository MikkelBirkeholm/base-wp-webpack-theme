const path = require('path')

// css extraction and minification
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin')

// clean out build dir in-between builds
const { CleanWebpackPlugin } = require('clean-webpack-plugin')

// BrowserSync for live reload
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

module.exports = [
  {
    entry: {
      main: ['./js/src/main.js', './css/src/main.scss'],
    },
    output: {
      filename: './js/build/[name].min.[fullhash].js',
      path: path.resolve(__dirname),
    },
    module: {
      rules: [
        {
          test: /\.(js|jsx)$/,
          exclude: /node_modules/,
          loader: 'babel-loader',
        },
        {
          test: /\.(sass|scss)$/,
          use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader'],
        },
        {
          test: /\.(woff|woff2|eot|ttf|otf)$/,
          type: 'asset/resource',
          generator: {
            filename: './css/build/font/[name][ext]',
          },
        },
        {
          test: /\.(png|jpg|gif)$/,
          type: 'asset/resource',
          generator: {
            filename: './css/build/img/[name][ext]',
          },
        },
      ],
    },
    plugins: [
      new CleanWebpackPlugin({
        cleanOnceBeforeBuildPatterns: ['./js/build/*', './css/build/*'],
      }),
      new MiniCssExtractPlugin({
        filename: './css/build/main.min.[fullhash].css',
      }),
      // Uncomment this if you want to use CSS Live reload
      new BrowserSyncPlugin(
        {
          proxy: '', // Set site domain from Local here (e.g. website.local)
          files: [
            './css/build/style.min.css',
            './js/build/main.min.js',
            '**/*.php',
          ],
          injectCss: true,
        },
        { reload: false }
      ),
    ],
    optimization: {
      minimize: true,
      minimizer: [`...`, new CssMinimizerPlugin()],
    },
  },
]
