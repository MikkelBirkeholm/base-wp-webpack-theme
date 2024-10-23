import { resolve } from 'path'
import glob from 'glob'

// css extraction and minification
import MiniCssExtractPlugin from 'mini-css-extract-plugin'
import CssMinimizerPlugin from 'css-minimizer-webpack-plugin'

// clean out build dir in-between builds
import { CleanWebpackPlugin } from 'clean-webpack-plugin'

import path from 'path'
import { fileURLToPath } from 'url'

// Dynamically find all SCSS files in the blocks folder
const blockScssFiles = glob.sync('./blocks/**/*.scss')

const __filename = fileURLToPath(import.meta.url) // get the resolved path to the file
const __dirname = path.dirname(__filename) // get the name of the directory

// BrowserSync for live reload
import BrowserSyncPlugin from 'browser-sync-webpack-plugin'

export default [
  {
    entry: {
      main: ['./js/src/main.js', './css/src/main.scss'],
      ...blockScssFiles.reduce((entries, file) => {
        const name = path.basename(path.dirname(file)) // Use folder name as entry name
        entries[name] = file
        return entries
      }, {}),
    },
    output: {
      filename: './js/build/[name].min.[fullhash].js',
      path: resolve(__dirname),
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
          test: /\.(png|jpg|gif|svg)$/,
          type: 'asset/resource',
          generator: {
            filename: './css/build/images/[name][ext]',
          },
        },
      ],
    },
    plugins: [
      new CleanWebpackPlugin({
        cleanOnceBeforeBuildPatterns: ['./js/build/*', './css/build/*'],
      }),
      new MiniCssExtractPlugin({
        filename: './css/build/[name].min.[fullhash].css',
      }),
      new BrowserSyncPlugin(
        {
          proxy: 'base-theme.local', // Set site domain from Local here (e.g. website.local)
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
