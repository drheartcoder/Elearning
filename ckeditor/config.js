/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	
	/******* BROWSER DETECTION *******************/
	var nVer = navigator.appVersion;
	var nAgt = navigator.userAgent;
	var browserName  = navigator.appName;
	var fullVersion  = ''+parseFloat(navigator.appVersion); 
	var majorVersion = parseInt(navigator.appVersion,10);
	var nameOffset,verOffset,ix;
	
	// In Opera, the true version is after "Opera" or after "Version"
	if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
	 browserName = "Opera";
	 fullVersion = nAgt.substring(verOffset+6);
	 if ((verOffset=nAgt.indexOf("Version"))!=-1) 
	   fullVersion = nAgt.substring(verOffset+8);
	}
	// In MSIE, the true version is after "MSIE" in userAgent
	else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
	 browserName = "Microsoft Internet Explorer";
	 fullVersion = nAgt.substring(verOffset+5);
	}
	// In Chrome, the true version is after "Chrome" 
	else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
	 browserName = "Chrome";
	 fullVersion = nAgt.substring(verOffset+7);
	}
	// In Safari, the true version is after "Safari" or after "Version" 
	else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
	 browserName = "Safari";
	 fullVersion = nAgt.substring(verOffset+7);
	 if ((verOffset=nAgt.indexOf("Version"))!=-1) 
	   fullVersion = nAgt.substring(verOffset+8);
	}
	// In Firefox, the true version is after "Firefox" 
	else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
	 browserName = "Firefox";
	 fullVersion = nAgt.substring(verOffset+8);
	}
	// In most other browsers, "name/version" is at the end of userAgent 
	else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) < 
			  (verOffset=nAgt.lastIndexOf('/')) ) 
	{
	 browserName = nAgt.substring(nameOffset,verOffset);
	 fullVersion = nAgt.substring(verOffset+1);
	 if (browserName.toLowerCase()==browserName.toUpperCase()) {
	  browserName = navigator.appName;
	 }
	}
	// trim the fullVersion string at semicolon/space if present
	if ((ix=fullVersion.indexOf(";"))!=-1)
	   fullVersion=fullVersion.substring(0,ix);
	if ((ix=fullVersion.indexOf(" "))!=-1)
	   fullVersion=fullVersion.substring(0,ix);
	
	majorVersion = parseInt(''+fullVersion,10);
	if (isNaN(majorVersion)) {
	 fullVersion  = ''+parseFloat(navigator.appVersion); 
	 majorVersion = parseInt(navigator.appVersion,10);
	}
	/******* BROWSER DETECTION *******************/	
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	config.uiColor = '#EEEEEE';
	config.width = '750px';
	config.height = '300px';
	
	config.language = 'en';
	config.filebrowserUploadUrl = SITE_URL+'/ckeditor/ckupload.php'; 
    
    config.filebrowserVideoBrowseUrl=SITE_URL+'/ckeditor/ckupload_video.php';
	/* if(browserName!='Firefox')
	{*/
		config.extraPlugins = 'eqneditor';
	//}
	config.extraPlugins = 'video';
	config.resize_enabled = false;
	
	config.autoParagraph = false;
	config.enterMode = CKEDITOR.ENTER_BR;
	config.shiftEnterMode = CKEDITOR.ENTER_P;
	//config.toolbar = 'MyToolbar';
		
	// Add WIRIS to the plugin list START HERE
    config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'ckeditor_wiris';
    config.allowedContent = true;
    // WIRIS PLUGINS END HERE
    
	config.toolbarGroups = [
		/*{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },*/
		/*{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },*/
		/*{ name: 'links' },*/
		/*{ name: 'insert'},*/
		/*{ name: 'forms' },*/
		/*{ name: 'tools' },*/
		/*{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },*/
		{ name: 'others' },
		'/',
		/*{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },*/
		/*{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },*/
		/*{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }*/
	];
};
