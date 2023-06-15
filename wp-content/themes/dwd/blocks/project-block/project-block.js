import { registerBlockType } from '@wordpress/blocks';

registerBlockType('project-block/project-block', {
  title: 'Project Block',
  icon: 'smiley',
  category: 'common',
  edit: function() {
    return <div>Your block content in the editor</div>;
  },
  save: function() {
    return <div>Your block content in the frontend</div>;
  },
});
