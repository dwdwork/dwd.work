// WordPress dependencies
import { registerBlockType } from '@wordpress/blocks';

// Internal dependencies
import json from './block.json';
import Edit from './edit';
import save from './save';
import './style.scss';

// Set block data
const { name } = json;

// Register and build block
registerBlockType( name, {
	edit: Edit,
	save,
} );
