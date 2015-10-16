/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    config.toolbar = 'Full';
    config.disableNativeSpellChecker = false;
    config.extraPlugins = 'youtube';
    config.filebrowserBrowseUrl = '/_admin/filemanager/index.html';
    config.allowedContent = true;
    config.extraAllowedContent = '*(*);*{*}';
     
    config.toolbar_Full =
    [
        ['Source'],
        ['Cut','Copy','Paste','PasteText'],
        ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
        '/',
        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
        ['NumberedList','BulletedList','-','Outdent','Indent'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Link', 'Image','Table','SpecialChar'],
        ['Youtube'],
        '/',
        ['Styles', 'Format','FontSize','TextColor', 'BGColor']
    ];
};