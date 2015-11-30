/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';



	// changement expliqué
	// http://stackoverflow.com/questions/1977791/turn-off-enclosing-p-tags-in-ckeditor-3-0

	//  "unpredictable usability issues"
	// http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html#.autoParagraph
	CKEDITOR.config.autoParagraph = false;
	// enlève aussi les paragraphes pour les changements de lignes
	// pour de linebreak <br> ce qui n'est pas très bien
	CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
};
