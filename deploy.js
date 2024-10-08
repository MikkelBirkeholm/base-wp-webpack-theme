const FtpDeploy = require('ftp-deploy')
const ftpDeploy = new FtpDeploy()

const config = {
  user: process.env.FTP_USER,
  password: process.env.FTP_PASSWORD, // Password optional, prompted if none given
  host: process.env.FTP_HOST,
  port: process.env.FTP_PORT,
  localRoot: __dirname,
  remoteRoot: process.env.FTP_PATH,
  include: [
    'js/build/*.js',
    'css/build/*.css',
    '*.php',
    'blocks/**/*',
    'style.css',
    'theme.json',
    'screenshot.jpeg',
    'acf-json/**',
    'img/**',
    'font/**',
  ],
  exclude: [
    'dist/**/*.map',
    'node_modules/**',
    'node_modules/**/.*',
    '.git/**',
    'deploy.js',
    'package.json',
    'package-lock.json',
    'webpack.config.js',
  ],
  deleteRemote: true,
  forcePasv: true,
  sftp: false,
}
console.log('Deploying to server...')
ftpDeploy
  .deploy(config)
  .then((res) => console.log('Deployed successfully')) // add 'res' to view result
  .catch((err) => console.log('Deployment failed: ', err))
