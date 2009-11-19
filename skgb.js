/*
Theme Name: SKGB-Web V
Theme URI: http://www.skgb.de/
Description: Das neue Theme der Segel- und Kanugemeinschaft Bruchertalsperre – SKGB-Web Version 5.0 – modernisiert Design und Funktionalität des SKGB-Web in Worpress.
Version: 5.0d
Author: Arne Johannessen, 2009
Tags: skgb, proprietary, confidential, utf8

*/



if (! window.SKGB) { SKGB = {}; }


// settings
SKGB.bodyElementWidth = 960;

// interface
SKGB.searchPlaceholderText = 'Suche';
SKGB.calendarTableClassName = 'termine';
SKGB.calendarTbodyIdRegExp = /^date:([0-9]{4})-?(0[1-9]|1[0-2])-?(0[1-9]|[1-2][0-9]|3[0-1])(?::([0-9]{4})-?(0[1-9]|1[0-2])-?(0[1-9]|[1-2][0-9]|3[0-1]))?$/;
SKGB.calendarTbodyClassNames = {'-1': 'date-past', '0': 'date-now', '1': 'date-future'};


SKGB.windowDimensions = function () {
	/* Currently there's no interoperable way to figure out the available
	 * dimensions of the viewport. A W3C Working Draft proposes an object
	 * model that is in fact implemented by the most recent browser
	 * versions. However, if quirks mode is selected or older browsers
	 * come into play, other object models might be used.
	 * 
	 * This particular algorithm is:
	 * - expected to work in Firefox 2+, Opera 9.5+, Safari 3+, IE 5+
	 * - successfully tested in Firefox 2.0-3.5, Opera 9.6-10.0, Safari 3.1-4.0, IE 7.0-8.0, iCab 3.0.5
	 * - known to fail in Opera 7-9.2
	 * - expected to at least return the correct width in Opera 9.0-9.2, Safari 2
	 * 
	 * See also:
	 * <http://www.howtocreate.co.uk/tutorials/javascript/browserwindow>
	 * <http://code.google.com/p/doctype/wiki/ArticleViewportSize>
	 * <http://lists.w3.org/Archives/Public/www-archive/2007Aug/0002.html>
	 * <http://www.w3.org/TR/2008/WD-cssom-view-20080222/#client-attributes>
	 * <http://hsivonen.iki.fi/doctype/#handling>
	 * <http://cross-browser.com/forums/viewtopic.php?id=230>
	 */
	var dimensions;
	if (document.documentElement && document.compatMode && document.compatMode == 'CSS1Compat') {
		// standards mode in Gecko, Opera 9.5+, Safari 3+, IE 6+ (cf. CSSOM-View 4.4:4.2, W3C WD)
		dimensions = { width: document.documentElement.clientWidth, height: document.documentElement.clientHeight };
	}
	else if (document.body) {
		// quirks mode in Gecko, Opera 6+, Safari 3+, IE 5+
		dimensions = { width: document.body.clientWidth, height: document.body.clientHeight };
	}
	return dimensions;
};


SKGB.centerBodyElement = function () {
	if (! document.getElementsByTagName) { return; }
	var dimensions = SKGB.windowDimensions();
	if (! dimensions || ! dimensions.width || dimensions.width <= 0) { return; }
	var htmlNode = document.getElementsByTagName('HTML')[0];
	var bodyNode = document.getElementsByTagName('BODY')[0];
	if (! htmlNode || ! htmlNode.style || ! bodyNode || ! bodyNode.style) { return; }
	
	var left = Math.max((dimensions.width - SKGB.bodyElementWidth) >> 1, 0);
	htmlNode.style.backgroundPosition = (left - 16) + 'px 0';
	bodyNode.style.left = left + 'px';
	
	// also stretch the <body> to full width while we're at it; this improves rendering a bit, particularly for the masthead on pages with narrow content
	var width = Math.min(dimensions.width, SKGB.bodyElementWidth);
	bodyNode.style.width = width + 'px';
};


SKGB.initSearchForm = function () {
	if (! document.getElementById) { return; }
	var searchFormNode = document.getElementById('searchform');
	if (! searchFormNode || ! searchFormNode.getElementsByTagName) { return; }
	var searchFieldNode = searchFormNode.getElementsByTagName('INPUT')[0];
	if (! searchFieldNode || ! searchFieldNode.style || ! searchFieldNode.className) { return; }
	
/*
	var searchInputTypeSupported = RegExp(" AppleWebKit/").test(navigator.userAgent);
	if (searchInputTypeSupported) {
		// use the HTML5 construct <input type=search> if possible (only in WebKit)
		
		searchFieldNode.type = 'search';
		searchFieldNode.autosave = 'skgb';
		searchFieldNode.placeholder = SKGB.searchPlaceholderText;
		searchFieldNode.className = '';
		
		searchFormNode.onsubmit = function () {
			if (searchFieldNode.value == '') {
				return false;  // cancel submit without query string
			}
		};
	}
	else {
		// the HTML5 search type is not supported, so we try to simulate its behaviour
*/
		
		if (searchFieldNode.value == '') {
			searchFieldNode.value = SKGB.searchPlaceholderText;
		}
		if (searchFieldNode.value != SKGB.searchPlaceholderText) {
			searchFieldNode.className = '';
		}
		
		searchFieldNode.onfocus = function () {
			if (searchFieldNode.value == SKGB.searchPlaceholderText) {
				searchFieldNode.value = '';
			}
			searchFieldNode.className = '';
		};
		searchFieldNode.onblur = function () {
			if (searchFieldNode.value == '' || searchFieldNode.value == SKGB.searchPlaceholderText) {
				searchFieldNode.className = 'placeholder';
				searchFieldNode.value = SKGB.searchPlaceholderText;
			}
		};
		searchFormNode.onsubmit = function () {
			if (searchFieldNode.value == '' || searchFieldNode.value == SKGB.searchPlaceholderText) {
				return false;  // cancel submit without query string
			}
		};
/*
	}
*/
};


SKGB.updateCalendarTable = function () {
	var now = new Date();
	var nowYear = now.getFullYear();
	var nowMonth = now.getMonth() + 1;  // months in Date are zero-based
	var nowDay = now.getDate();
	
	// for all <table>s in this document
	if (! document.getElementsByTagName) { return; }
	var calendarTableClassNameRegExp = new RegExp('(^|\\s)' + SKGB.calendarTableClassName + '(\\s|$)');
	var tableNodes = document.getElementsByTagName('TABLE');
	for (var i = 0; i < tableNodes.length; i++) {
		var tableNode = tableNodes[i];
		if (! tableNode || ! tableNode.getElementsByTagName) { continue; }
		
		// for all <tbody>s in this table
		if (tableNode.className.length == 0 || calendarTableClassNameRegExp.exec(tableNode.className) == null) { continue; }
		var tbodyNodes = tableNode.getElementsByTagName('TBODY');
		for (var j = 0; j < tbodyNodes.length; j++) {
			var tbodyNode = tbodyNodes[j];
			if (! tbodyNode || ! tbodyNode.id) { continue; }
			
			// parse @id for date range
			var tbodyIdMatch = SKGB.calendarTbodyIdRegExp.exec(tbodyNode.id);
			if (! tbodyIdMatch) { continue; }
			var fromYear = Number(tbodyIdMatch[1]);
			var fromMonth = Number(tbodyIdMatch[2]);
			var fromDay = Number(tbodyIdMatch[3]);
			var untilYear = tbodyIdMatch[4] ? Number(tbodyIdMatch[4]) : fromYear;
			var untilMonth = tbodyIdMatch[5] ? Number(tbodyIdMatch[5]) : fromMonth;
			var untilDay = tbodyIdMatch[6] ? Number(tbodyIdMatch[6]) : fromDay;
			
			// set <tbody> class according to whether date is past, present or future
			var state = 0;  // initial assumption: the <tbody>'s date is now
			if (nowYear > untilYear || nowYear == untilYear && (nowMonth > untilMonth || nowMonth == untilMonth && nowDay > untilDay)) {
				state = -1;  // the <tbody>'s date is in the past
			}
			else if (nowYear < fromYear || nowYear == fromYear && (nowMonth < fromMonth || nowMonth == fromMonth && nowDay < fromDay)) {
				state = 1;  // the <tbody>'s date is in the future
			}
			tbodyNode.className += ' ' + SKGB.calendarTbodyClassNames[state];
			
			// insert DOM node for 'today!' marker
			if (state == 0) {
				if (! tbodyNode.getElementsByTagName || ! document.createElement) { continue; }
				var tdNodes = tbodyNode.getElementsByTagName('TD');
				var lastTdNode = tdNodes[tdNodes.length - 1];
				if (! lastTdNode.insertBefore || ! lastTdNode.firstChild) { continue; }
				var markerNode = document.createElement('SPAN');
				markerNode.className = 'date-now';
				lastTdNode.insertBefore(markerNode, lastTdNode.firstChild);
			}
		}
	}
};


SKGB.domDidLoad = function (deferred) {
	// only execute this function once (Singleton)
	if (arguments.callee.didExecute) {
		return;
	}
	arguments.callee.didExecute = true;
	
	if (! deferred) {
		/* If we can't do this before the page is rendered,
		 * there will be an ugly visual effect when the body
		 * is moved to the centre. It's better to keep
		 * everything on the left then.
		 */
		SKGB.centerBodyElement();
		SKGB.registerResize();
	}
	SKGB.initSearchForm();
	SKGB.updateCalendarTable();
};


SKGB.registerDomDidLoad = function () {
	/* Currently there's no interoperable way to register an event
	 * handler to be called after the DOM is loaded, but before images
	 * are loaded. A W3C Working Draft proposes an event that is in
	 * fact implemented by most recent browser versions. However, if
	 * older browsers come into play, other methods might need to be
	 * used.
	 * 
	 * This particular algorithm is:
	 * - expected to work in Firefox 2+, Opera 9+, Safari 3.1+, IE 5.5+
	 * - successfully tested in Firefox 2.0-3.5, Opera 10.0, Safari 4.0, IE 7.0-8.0
	 * 
	 * See also:
	 * <http://www.w3.org/TR/2009/WD-html5-20090825/syntax.html#the-end>
	 * <http://dean.edwards.name/weblog/2006/06/again/>
	 * <https://prototype.lighthouseapp.com/projects/8886/tickets/64-safari-now-has-domcontentloaded-event-use-it>
	 */
	
	if (document.addEventListener) {
		document.addEventListener('DOMContentLoaded', function () {
			SKGB.domDidLoad();
		}, false);
	}
	
	// IE doesn't support DOMContentLoaded, but we can use the @defer attribute
	/*@cc_on @if (@_win32 || @_win64)
		document.write('<SCRIPT ID="ie__onload" SRC="//:" DEFER><\/SCRIPT>');
		var script = document.getElementById('ie__onload');
		script.onreadystatechange = function () {
			if (this.readyState == 'complete') {
				SKGB.domDidLoad();
			}
		};
	/*@end @*/
	
	// last resort
	window.onload = function () {
		SKGB.domDidLoad(true);
	};
	
};


SKGB.registerResize = function () {
	window.onresize = function () {
		SKGB.centerBodyElement();
	};
};


SKGB.registerDomDidLoad();
