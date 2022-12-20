/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

// CKEDITOR.editorConfig = function( config ) {
// 	// Define changes to default configuration here. For example:
// 	// config.language = 'fr';
// 	// config.uiColor = '#AADC6E';
// };

CKEDITOR.editorConfig = function( config )
{
    config.toolbar = 'MyToolbar';
    config.toolbar_MyToolbar =
    [
		['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
        ['Outdent','Indent'],
        ['NumberedList','BulletedList','-'],
        ['Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak'],
        ['Undo','Redo','-','Find','Replace'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Bold','Italic','Underline','Strike'],
        ['Source','Preview','Maximize']
    ];
};
