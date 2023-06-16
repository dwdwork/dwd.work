import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { TextControl } from '@wordpress/components';
import './editor.scss';


export default function Edit({ attributes, setAttributes }) {
	return (
		<div { ...useBlockProps() }>
            <TextControl
                label={ __( 'Message', 'gutenpride' ) }
                value={ attributes.message }
                onChange={ ( val ) => setAttributes( { message: val } ) }
            />
        </div>
	);
}
