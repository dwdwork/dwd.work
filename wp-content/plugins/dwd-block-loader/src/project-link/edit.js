import { __ } from '@wordpress/i18n';
import './editor.scss';
import React, { useEffect, useState } from 'react';
import { RichText, MediaUpload, URLInput, useBlockProps } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';

export default function Edit( props )  {
    const blockProps = useBlockProps();
    const [tags, setTags] = useState([]);

    const { 
        attributes: { title, logoID, logoURL, ftImgID, ftImgURL, textDescription, link, linkTitle },
		setAttributes,
    } = props;

    useEffect(() => {
        const fetchTags = async () => {
            try {
                const response = await fetch('/wp-json/wp/v2/tags?post=1631');
                const data = await response.json();
                setTags(data);
                console.log(data);
            } catch (error) {
                console.error('Error fetching tags:', error);
            }
        };

        fetchTags();
    }, []);

    const onTitleChange = (newTitle) => {
        setAttributes({ title: newTitle });
    };

    const onLogoSelect = (newLogoImg) => {
        setAttributes({ 
            logoID: newLogoImg.id,
            logoURL: newLogoImg.url,
            logoAlt: newLogoImg.alt,
        });
    };

    const onImageSelect = (newFtImg) => {
        setAttributes({
            ftImgID: newFtImg.id,
            ftImgURL: newFtImg.url,
            ftImgAlt: newFtImg.alt,
        });
    };

    const onDescriptionChange = (newDescription) => {
        setAttributes({ textDescription: newDescription });
    };

    const onLinkChange = (newLink) => {
        setAttributes({ link: newLink });
    };

    const onLinkTitleChange = (newLinkTitle) => {
        setAttributes({ linkTitle: newLinkTitle });
    };

	return (
        <div { ...blockProps }>

            <div className="project-link container d-flex flex-column flex-justify-around wp-block">
                <div className="project-link-heading row">
                    <div className="project-link-heading-tags col-12">
                    <h2>Available Tags</h2>
                        <ul>
                            {tags.map((tag) => (
                            <li key={tag.id}>
                                <input type="checkbox" id={`tag-${tag.id}`} value={tag.id} />
                                <label htmlFor={`tag-${tag.id}`}>{tag.name}</label>
                            </li>
                            ))}
                        </ul>
                    </div>
                    <div className="project-link-heading-title col-12 col-sm-8">
                        <RichText
                            tagName="h2" 
                            className="block-title"
                            placeholder={__('Enter a title', 'project-link')}
                            value={title}
                            onChange={onTitleChange}
                        />
                    </div>
                    <div className="project-link-heading-logo col-12 col-sm-4 d-md-flex">
                        <MediaUpload
                            onSelect={onLogoSelect}
                            allowedTypes={['image']}
                            value={logoID}
                            render={({ open }) => (
                                <Button onClick={open} className={'button button-large'}>
                                    {!logoID ? __('Select an Logo', 'project-link') : (<img src={ logoURL } alt={ logoURL } />)}
                                </Button>
                            )}
                        />
                        

                    </div>
                </div>
                
                <div className="project-link-featured-img row">
                    <div className="col-12">
                        <MediaUpload
                            onSelect={onImageSelect}
                            allowedTypes={['image']}
                            value={ftImgID}
                            render={({ open }) => (
                                <Button onClick={open} className={ftImgID ? 'image-button' : 'button'}>
                                    {!ftImgID ? __('Select an Image', 'project-link') : (<img src={ ftImgURL } alt={ ftImgURL } />)}
                                </Button>
                            )}
                        />
                    </div>
                </div>

                <div className="project-link-body row">
                    <div className="project-link-body-description col-12 col-sm-8">
                        <RichText
                            tagName="p"
                            className="text-description"
                            placeholder={__('Enter a description', 'project-link')}
                            value={textDescription}
                            onChange={onDescriptionChange}
                        />
                    </div>
                    <div className="project-link-body-cta col-12 col-sm-4 d-flex flex-justify-end flex-align-end">
                        <URLInput 
                            value={link} onChange={onLinkChange} 
                        />
                        <RichText 
                            placeholder={__('Enter Link Text', 'project-link')}
                            value={linkTitle}
                            onChange={onLinkTitleChange}
                        />
                    </div>
                </div>
            </div>

        </div>
    );
}
