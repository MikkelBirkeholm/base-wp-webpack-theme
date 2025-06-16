import { mkdirSync, writeFileSync } from 'fs';
import { input, select } from '@inquirer/prompts';
import path from 'path';

// Function to slugify the block name
function slugify(text) {
  return text
    .toString()
    .toLowerCase()
    .replace(/\s+/g, '-') // Replace spaces with -
    .replace(/[^a-z0-9\-]/g, '') // Remove all non-word chars
    .replace(/--+/g, '-') // Replace multiple - with single -
    .replace(/^-+/, '') // Trim - from start of text
    .replace(/-+$/, ''); // Trim - from end of text
}

(async () => {
  try {
    // Prompt user for the block name
    const blockNameInput = await input({
      message: 'Enter the name of the block:',
      validate: (input) => {
        if (input.trim() === '') {
          return 'Block name cannot be empty';
        }
        return true;
      },
    });

    const blockName = slugify(blockNameInput);
    const keywords = blockNameInput
      .split(' ')
      .map((word) => word.toLowerCase())
      .filter((word) => word !== 'and');

    const blockDir = path.join(process.cwd(), 'blocks', blockName);

    // Create a directory for the block
    mkdirSync(blockDir, { recursive: true });

    // Create the block PHP file
    writeFileSync(
      `${blockDir}/${blockName}.php`,
      `<?php
        /**
         * Block: ${blockNameInput}
         */
            $id = isset($block['anchor']) && $block['anchor'] ? $block['anchor'] : $block['id'];

            $wrapper_attributes = get_block_wrapper_attributes([
            'id' => $id,
            'class' => 'block ${blockName}',
          ]);
            
        ?>
        <div <?= get_block_wrapper_attributes(); ?>>
          <!-- Block content goes here -->
        </div>
`
    );

    // Create the block SCSS file
    writeFileSync(
      `${blockDir}/${blockName}.scss`,
      `.${blockName} {
        // Styles for the ${blockName} block
      }`
    );

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
  "editorStyle": [
    "file:./${blockName}.min.css"
  ],
  "category": "theme",
  "icon": {
    "src": "shortcode",
    "background": "#29f29f",
    "foreground": "#000"
  },
  "keywords": ${JSON.stringify(keywords)},
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
    "spacing": {
      "margin": true,
      "padding": true
    }
  }
}`
    );

    console.log(`Block "${blockNameInput}" created successfully.`);
  } catch (error) {
    console.error('Error creating block:', error);
  }
})();
