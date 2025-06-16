# Webpack WordPress Theme Boilerplate

## Setup

- Run `npm install` to install dependencies
- Update theme.json with your theme information and settings

### Blocks

- Run `npm run new-block` to create a new block
- Follow the prompts to set up your block

#### About the block

- The block will be created in the `/blocks` directory
- Editor styles are automatically enqueued with "editorStyle" in `block.json`
- Javascript enqueueing is still WIP

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
