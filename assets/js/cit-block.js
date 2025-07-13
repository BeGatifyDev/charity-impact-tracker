( function( blocks, editor, element ) {
    var el = element.createElement;
    blocks.registerBlockType( 'charity-impact-tracker/project-list', {
        title: 'Project List',
        icon: 'list-view',
        category: 'widgets',
        edit: function() {
            return el( 'p', {}, 'Project List block placeholder' );
        },
        save: function() {
            return null; // Uses PHP render callback
        },
    } );
} )( window.wp.blocks, window.wp.editor, window.wp.element );
        