import { useBlockProps } from '@wordpress/block-editor';

export default function save( { attributes } ) {
    const blockProps = useBlockProps.save();
    return <div { ...blockProps }>{ attributes.message }{imageUrl && <img src={imageUrl} alt={imageAlt} />}</div>;
}
