import glob from 'glob';
import path from 'path';
import { fileURLToPath } from 'url';
import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import CssMinimizerPlugin from 'css-minimizer-webpack-plugin';
import { CleanWebpackPlugin } from 'clean-webpack-plugin';
import RemoveEmptyScriptsPlugin from 'webpack-remove-empty-scripts';
import BrowserSyncPlugin from 'browser-sync-webpack-plugin';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Dynamically find all SCSS files in the blocks folder
const blockScssFiles = glob.sync('./blocks/**/*.scss');

// Dynamically find all JS files in the components and site folders
const componentJSFiles = glob.sync('./js/src/components/*.js');
const siteJSFiles = glob.sync('./js/src/site/*.js');

const scssEntries = blockScssFiles.reduce((entries, file) => {
  const blockFolder = path.basename(path.dirname(file));
  // Create an entry key that includes the block folder path
  entries[`blocks/${blockFolder}/${blockFolder}`] = file;
  return entries;
}, {});

const jsEntries = componentJSFiles.reduce((acc, file) => {
  const name = `script.${path.basename(file, '.js')}`; // Add a `script.` prefix
  acc[name] = file;
  return acc;
}, {});

const siteEntries = siteJSFiles.reduce((acc, file) => {
  const name = `script.${path.basename(file, '.js')}`; // Add a `script.` prefix
  acc[name] = file;
  return acc;
}, {});

export default {
  entry: {
    main: ['./js/src/main.js', './css/src/main.scss'],
    ...scssEntries,
    ...jsEntries,
    ...siteEntries,
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
      // filename: './css/build/[name].min.css',
      filename: (pathData) => {
        // If the chunk name starts with "blocks/", output it in the same folder
        if (pathData.chunk.name.startsWith('blocks/')) {
          return `${pathData.chunk.name}.min.css`;
        }
        // Otherwise, use the default build path
        return `./css/build/${pathData.chunk.name}.min.css`;
      },
    }),
    new BrowserSyncPlugin(
      {
        proxy: 'https://base-theme.local',
        https: true,
        files: [
          './css/build/main.min.css',
          './js/build/main.min.js',
          '**/*.php',
        ],
      },
      { reload: true }
    ),
  ],
  optimization: {
    minimize: true,
    minimizer: [`...`, new CssMinimizerPlugin()],
  },
};
