/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = 'http://localhost/e-commerce_brightstar/admin/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = 'http://localhost/e-commerce_brightstar/admin/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = 'http://localhost/e-commerce_brightstar/admin/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = 'http://localhost/e-commerce_brightstar/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = 'http://localhost/e-commerce_brightstar/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = 'http://localhost/e-commerce_brightstar/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
	config.extraPlugins = 'youtube';
	config.allowedContent = true;
};
