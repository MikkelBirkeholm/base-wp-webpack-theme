# Webpack WordPress Theme Boilerplate

## Setup

- Run `npm install` to install dependencies
- Update theme.json with your theme information and settings

## BrowserSync

- Setup a site in Local
- Update `proxy` in `webpack.config.js` with your Local site URL

## Deploy to FTP

- Create .env with the following content:

```
FTP_USER=''
FTP_PASSWORD=''
FTP_HOST=''
FTP_PORT=21
FTP_PATH=''
```

- Run `npm run deploy` to deploy
