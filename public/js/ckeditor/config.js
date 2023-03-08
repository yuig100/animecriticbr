/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    CKEDITOR.config.extraPlugins = 'easyimage';
    CKEDITOR.config.easyimage_styles = {};
    config.extraPlugins = 'dragdrop';
    config.uploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json';
    config.extraPlugins = 'uploadwidget';
    config.extraPlugins = 'filetools';
    config.extraPlugins = 'notification';
    config.extraPlugins = 'clipboard';
    config.extraPlugins = 'notificationaggregator';
    config.extraPlugins = 'widget';
    config.extraPlugins = 'widgetselection';
    config.extraPlugins = 'lineutils';

    config.pasteFilter = 'p; a[!href]';

};
