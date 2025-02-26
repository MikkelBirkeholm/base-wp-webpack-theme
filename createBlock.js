import { mkdirSync, writeFileSync } from 'fs'
import { input, select } from '@inquirer/prompts'
import path from 'path'

// Function to slugify the block name
function slugify(text) {
  return text
    .toString()
    .toLowerCase()
    .replace(/\s+/g, '-') // Replace spaces with -
    .replace(/[^a-z0-9\-]/g, '') // Remove all non-word chars
    .replace(/--+/g, '-') // Replace multiple - with single -
    .replace(/^-+/, '') // Trim - from start of text
    .replace(/-+$/, '') // Trim - from end of text
}

;(async () => {
  try {
    // Prompt user for the block name
    const blockNameInput = await input({
      message: 'Enter the name of the block:',
      validate: (input) => {
        if (input.trim() === '') {
          return 'Block name cannot be empty'
        }
        return true
      },
    })

    const blockName = slugify(blockNameInput)

    // Prompt user for the block icon
    const blockIcon = await select({
      message: 'Choose an icon for the block:',
      choices: [
        { name: 'Admin Menu', value: 'admin-menu' },
        { name: 'Admin Menu (alt)', value: 'admin-menu-alt' },
        { name: 'Admin Menu (alt2)', value: 'admin-menu-alt2' },
        { name: 'Admin Menu (alt3)', value: 'admin-menu-alt3' },
        { name: 'Admin Site', value: 'admin-site' },
        { name: 'Admin Site (alt)', value: 'admin-site-alt' },
        { name: 'Admin Dashboard', value: 'admin-dashboard' },
        { name: 'Admin Post', value: 'admin-post' },
        { name: 'Admin Media', value: 'admin-media' },
        { name: 'Admin Links', value: 'admin-links' },
        { name: 'Admin Page', value: 'admin-page' },
        { name: 'Admin Comments', value: 'admin-comments' },
        { name: 'Admin Appearance', value: 'admin-appearance' },
        { name: 'Admin Plugins', value: 'admin-plugins' },
        { name: 'Admin Plugins Checked', value: 'admin-plugins-checked' },
        { name: 'Admin Users', value: 'admin-users' },
        { name: 'Admin Tools', value: 'admin-tools' },
        { name: 'Admin Settings', value: 'admin-settings' },
        { name: 'Admin Network', value: 'admin-network' },
        { name: 'Admin Home', value: 'admin-home' },
        { name: 'Admin Generic', value: 'admin-generic' },
        { name: 'Admin Collapse', value: 'admin-collapse' },
        { name: 'Admin Filter', value: 'admin-filter' },
        { name: 'Admin Customizer', value: 'admin-customizer' },
        { name: 'Admin Multisite', value: 'admin-multisite' },
        { name: 'Welcome Write Blog', value: 'welcome-write-blog' },
        { name: 'Welcome Add Page', value: 'welcome-add-page' },
        { name: 'Welcome View Site', value: 'welcome-view-site' },
        { name: 'Welcome Widgets Menus', value: 'welcome-widgets-menus' },
        { name: 'Welcome Comments', value: 'welcome-comments' },
        { name: 'Welcome Learn More', value: 'welcome-learn-more' },
        { name: 'Post Formats Aside', value: 'format-aside' },
        { name: 'Post Formats Image', value: 'format-image' },
        { name: 'Post Formats Gallery', value: 'format-gallery' },
        { name: 'Post Formats Video', value: 'format-video' },
        { name: 'Post Formats Status', value: 'format-status' },
        { name: 'Post Formats Quote', value: 'format-quote' },
        { name: 'Post Formats Chat', value: 'format-chat' },
        { name: 'Post Formats Audio', value: 'format-audio' },
        { name: 'Media Archive', value: 'media-archive' },
        { name: 'Media Code', value: 'media-code' },
        { name: 'Media Default', value: 'media-default' },
        { name: 'Media Document', value: 'media-document' },
        { name: 'Media Interactive', value: 'media-interactive' },
        { name: 'Media Spreadsheet', value: 'media-spreadsheet' },
        { name: 'Media Text', value: 'media-text' },
        { name: 'Media Video', value: 'media-video' },
        { name: 'Playlist Audio', value: 'playlist-audio' },
        { name: 'Playlist Video', value: 'playlist-video' },
        { name: 'Play', value: 'controls-play' },
        { name: 'Pause', value: 'controls-pause' },
        { name: 'Forward', value: 'controls-forward' },
        { name: 'Skip Forward', value: 'controls-skip-forward' },
        { name: 'Back', value: 'controls-back' },
        { name: 'Skip Back', value: 'controls-skip-back' },
        { name: 'Repeat', value: 'controls-repeat' },
        { name: 'Volume On', value: 'controls-volume-on' },
        { name: 'Volume Off', value: 'controls-volume-off' },
        { name: 'Image Crop', value: 'image-crop' },
        { name: 'Image Rotate', value: 'image-rotate' },
        { name: 'Image Rotate Left', value: 'image-rotate-left' },
        { name: 'Image Rotate Right', value: 'image-rotate-right' },
        { name: 'Image Flip Vertical', value: 'image-flip-vertical' },
        { name: 'Image Flip Horizontal', value: 'image-flip-horizontal' },
        { name: 'Image Filter', value: 'image-filter' },
        { name: 'Undo', value: 'undo' },
        { name: 'Redo', value: 'redo' },
        { name: 'Database Add', value: 'database-add' },
        { name: 'Database', value: 'database' },
        { name: 'Database Export', value: 'database-export' },
        { name: 'Database Import', value: 'database-import' },
        { name: 'Database Remove', value: 'database-remove' },
        { name: 'Database View', value: 'database-view' },
        { name: 'Block Editor Align Full Width', value: 'align-full-width' },
        { name: 'Block Editor Align Pull Left', value: 'align-pull-left' },
        { name: 'Block Editor Align Pull Right', value: 'align-pull-right' },
        { name: 'Block Editor Align Wide', value: 'align-wide' },
        { name: 'Block Editor Block Default', value: 'block-default' },
        { name: 'Block Editor Button', value: 'button' },
        { name: 'Block Editor Cloud Saved', value: 'cloud-saved' },
        { name: 'Block Editor Cloud Upload', value: 'cloud-upload' },
        { name: 'Block Editor Columns', value: 'columns' },
        { name: 'Block Editor Cover Image', value: 'cover-image' },
        { name: 'Block Editor Ellipsis', value: 'ellipsis' },
        { name: 'Block Editor Embed Audio', value: 'embed-audio' },
        { name: 'Block Editor Embed Generic', value: 'embed-generic' },
        { name: 'Block Editor Embed Photo', value: 'embed-photo' },
        { name: 'Block Editor Embed Post', value: 'embed-post' },
        { name: 'Block Editor Embed Video', value: 'embed-video' },
        { name: 'Block Editor Exit', value: 'exit' },
        { name: 'Block Editor Heading', value: 'heading' },
        { name: 'Block Editor HTML', value: 'html' },
        { name: 'Block Editor Info Outline', value: 'info-outline' },
        { name: 'Block Editor Insert', value: 'insert' },
        { name: 'Block Editor Insert After', value: 'insert-after' },
        { name: 'Block Editor Insert Before', value: 'insert-before' },
        { name: 'Block Editor Remove', value: 'remove' },
        { name: 'Block Editor Saved', value: 'saved' },
        { name: 'Block Editor Shortcode', value: 'shortcode' },
        { name: 'Block Editor Table Col After', value: 'table-col-after' },
        { name: 'Block Editor Table Col Before', value: 'table-col-before' },
        { name: 'Block Editor Table Col Delete', value: 'table-col-delete' },
        { name: 'Block Editor Table Row After', value: 'table-row-after' },
        { name: 'Block Editor Table Row Before', value: 'table-row-before' },
        { name: 'Block Editor Table Row Delete', value: 'table-row-delete' },
      ],
    })

    const blockDir = path.join(process.cwd(), 'blocks', blockName)

    // Create a directory for the block
    mkdirSync(blockDir, { recursive: true })

    // Create the block PHP file
    writeFileSync(
      `${blockDir}/${blockName}.php`,
      `<?php
/**
 * Block: ${blockNameInput}
 */
    $id = $block['id'];
    
    if($block['align']) {
      $classes .= ' align' . $block['align'];
    }
?>
<div class="${blockName} <?= $classes; ?>">
  <!-- Block content goes here -->
</div>
`
    )

    // Create the block SCSS file
    writeFileSync(
      `${blockDir}/${blockName}.scss`,
      `.${blockName} {
  // Styles for the ${blockName} block
}`
    )

    // Create the block JSON file
    writeFileSync(
      `${blockDir}/block.json`,
      `{
  "name": "acf/${blockName}",
  "title": "${blockNameInput}",
  "description": "A custom block",
  "style": [
    "file:./${blockName}.min.css"
  ],
  "category": "formatting",
  "icon": {
    "src": "${blockIcon}",
    "background": "#29f29f",
    "foreground": "#000"
  },
  "keywords": [
    "${blockNameInput}"
  ],
  "acf": {
    "mode": "preview",
    "renderTemplate": "${blockName}.php"
  },
  "supports": {
    "anchor": true,
    "align": [
      "wide",
      "full"
    ],
    "layout": true
  }
}`
    )

    console.log(`Block "${blockNameInput}" created successfully.`)
  } catch (error) {
    console.error('Error creating block:', error)
  }
})()
