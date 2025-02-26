import glob from 'glob'
import path from 'path'
import { fileURLToPath } from 'url'
import MiniCssExtractPlugin from 'mini-css-extract-plugin'
import CssMinimizerPlugin from 'css-minimizer-webpack-plugin'
import { CleanWebpackPlugin } from 'clean-webpack-plugin'
import RemoveEmptyScriptsPlugin from 'webpack-remove-empty-scripts'
import BrowserSyncPlugin from 'browser-sync-webpack-plugin'

const __filename = fileURLToPath(import.meta.url)
const __dirname = path.dirname(__filename)

// Dynamically find all SCSS files in the blocks folder
const blockScssFiles = glob.sync('./blocks/**/*.scss')
const componentJSFiles = glob.sync('./js/src/components/*.js')

const scssEntries = blockScssFiles.reduce((entries, file) => {
  const name = `style.${path.basename(path.dirname(file), '.scss')}` // Add a `_style` suffix
  entries[name] = file
  return entries
}, {})

const jsEntries = componentJSFiles.reduce((acc, file) => {
  const name = `script.${path.basename(file, '.js')}` // Add a `_script` suffix
  acc[name] = file
  return acc
}, {})

export default {
  entry: {
    main: ['./js/src/main.js', './css/src/main.scss'],
    ...scssEntries,
    ...jsEntries,
  },
  output: {
    filename: './js/build/[name].min.js',
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
        test: /\.(scss|css)$/,
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
      cleanAfterEveryBuildPatterns: ['./js/build/*.LICENSE.txt'],
    }),
    new RemoveEmptyScriptsPlugin(),
    new MiniCssExtractPlugin({
      filename: './css/build/[name].min.css',
    }),
    new BrowserSyncPlugin(
      {
        proxy: 'base-theme.local',
        files: [
          './css/build/main.min.css',
          './js/build/main.min.js',
          '**/*.php',
        ],
      },
      { reload: false }
    ),
  ],
  optimization: {
    minimize: true,
    minimizer: [`...`, new CssMinimizerPlugin()],
  },
}
