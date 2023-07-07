import { __ } from '@wordpress/i18n';
import { RichText, useBlockProps } from '@wordpress/block-editor';

export default function save( props ) {
    const { 
        attributes: { title, logoURL, logoID, ftImgURL, ftImgID, textDescription, link, linkTitle }
    } = props;

    const blockProps = useBlockProps.save();

    return (
        <div {...blockProps}>
            <div className="project-link container d-flex flex-column flex-justify-around wp-block">
                <div className="project-link-heading row">
                    <div className="project-link-heading-title col-12 col-sm-8">
                        <RichText.Content className="title" tagName="h2" value={ title } />
                    </div>
                    <div className="project-link-heading-logo col-12 col-sm-4 d-md-flex">
                        {logoID && (<img className="logo-img" src={ logoURL } alt={ logoID } />)}
                    </div>
                </div>

                <div className="project-link-featured-img row">
                    <div className="col-12">
                        {ftImgID && <img className="ft-img" src={ ftImgURL } alt={ ftImgID } />}
                    </div>
                </div>

                <div className="project-link-body row">
                    <div className="project-link-body-description col-12 col-sm-8">
                        <RichText.Content className="text-description" tagName="p" value={ textDescription } />
                    </div>
                    <div className="project-link-body-cta col-12 col-sm-4 d-flex flex-justify-end flex-align-end">
                        <a className="btn btn-primary" href={ link }>{ linkTitle }</a>
                    </div>
                </div>
            </div>
        </div>
    );
}
