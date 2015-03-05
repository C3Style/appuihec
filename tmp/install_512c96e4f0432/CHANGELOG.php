<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: CHANGELOG.php 1382 2010-06-14 11:59:49Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');
?>

Changelog
---------
This is a non-exhaustive (but still near complete) changelog for
DOCman 1.x, including beta and release candidate versions.
Our thanks to all those people who've contributed bug reports and
code fixes.

Legend:
* -> Security Fix
# -> Bug Fix
+ -> Addition
^ -> Change
- -> Removed
! -> Note

----------- 2010-06 Released v1.4.1.stable ----------------

 * Fixed #215 MEDIUM: Attackers with upload permissions can in some cases expose sensitive data
 * Fixed #116 LOW: DOClink exposed document names
 # Fixed: Menu icons were using relative urls

----------- 2009-02-14 Released v1.4.0.stable ----------------

2009-02-13 Mathias Verraes
 # Fixed #27: Attribs sample data error
 # Fixed #26: Pear fails on j1.0

2009-02-10 Mathias Verraes
 # Cosmetic fixes

2009-02-08 Mathias Verraes
 # Fixed #15: URL's missing the index.php part
 # Fixed: Token regressions
 # Fixed #19: Token issues on Chrome and FF

2009-01-21 Mathias Verraes
 ^ Refactored installer, gives warnings & suggestions instead of halting completely on errors

2009-01-19 Mathias Verraes
 # Reverted to using dmdocuments
 # Using modal dialog for viewing docs instead of popups (J15 only), partial fix for #12 (IE7 issue)

2009-01-08 Mathias Verraes
 # Fixed #13010: JCK editor is too small, thanks Stéphane G
 # Fixed #13009: Missing language, thanks Stéphane G
 # Fixed #13011: Labels for input fields misaligned
 # Fixed #13008: Uploading on windows, thanks Stéphane G
 # Hardened standardbuttons plugin installation
 ^ Changed default data dir to /media/com_docman/data (J!1.5 only)

2009-01-05 Mathias Verraes
 # Better support for Core SEF and 3PD SEF extensions
 # Fixed calendar
 ! Changed version info

2009-01-02 Mathias Verraes
 # Fixed issue with displaying html
 - Removed PEAR, now using Joomla's included PEAR file
 ! Joomlatools official site is now http://www.joomlatools.eu
 ! Changelog cleanup

------------------ 1.4.0 RC3 Released ------------------------

21-Mar-2008 Mathias Verraes
 ! Final cleanup for RC3

20-Mar-2008 Mathias Verraes
 + Added Help button

18-Mar-2008 Mathias Verraes
 # Fixed : Language corrections, thanks dtech

17-Mar-2008 Mathias Verraes
 # Readded CSS .clr style
 # Fixed [#10086] Fatal error: Call to undefined method DOCMAN_users

01-Mar-2008 Mathias Verraes
 ^ http://forum.joomlatools.eu/viewtopic.php?f=24&t=166 : Search form layout
 # Fixed [#9094] : Preview 'image' broken in upload page 3
 # Fixed [#7909], [#8103], [#9750], [#8842], [#9783], [#9953] : issues with quotes, slashes etc
 # Fixed [#6692] : Upload box is transparent
 # Fixed [#9952] : Invalid Token Error in Backend DOCman control panel: Unapproved Docs

29-Feb-2008 Mathias Verraes
 # Fixed [#9974] : Group error
 ^ Performance: Moved some require_once() statements to where they are needed

28-Feb-2008 Mathias Verraes
 # Fixed : Images sometimes weren't copied during install (J! bug?)

25-Feb-2008 Mathias Verraes
 ^ Improved 'Edit Group' UI
 # Fixed : 500 error when browsing categories
 # Fixed [#9918] : Update from backend results in token error
 # Fixed [t,681] : Logs module query, thanks slabbi and euro22

23-Feb-2008 Mathias Verraes
 # Fixed : DOClink + SEF http://forum.joomlatools.eu/viewtopic.php?f=18&t=594

22-Feb-2008 Mathias Verraes
 # Various fixes
 # Fixed [#9766] Text alternative atribute is not show for thumbs and icons, thanks Fabio
 ^ Error messages for failed installation are bigger and more informative

------------------ 1.4.0 RC2 Released ------------------------

19-Feb-2008 Mathias Verraes
 ^ Updated version information
 ^ Updated feed url to http://feeds.joomlatools.eu/docman

18-Feb-2008 Mathias Verraes
 ^ Updated feed urls to new blog
 * [SECURITY] [#9563] : Implemented tokens in client code

17-Feb-2008 Mathias Verraes
 * [SECURITY] [#9563] : Added DOCMAN_token class to help preventing CSRF (thanks Zinho)
 # Fixed : CSS improvements, thanks Andy

29-Jan-2008 Mathias Verraes
 # Fixed [#8239] : No scroll bar in DOClink popup, thanks Chris Jones

27-Jan-2008 Mathias Verraes
 # Fixed : Non-standard INSERTs causing incompatibility with 3PDs
 # Fixed : Buttons Plugin didn't get the parameters

10-Jan-2008 Mathias Verraes
 + Added confirmation to frontend 'delete' and 'reset' buttons
 # Fixed [t=431] : 'configuration.php unwritable' should be 'docman.config.php'

09-Jan-2008 Mathias Verraes
 # Fixed : Another little SEF url thingie

08-Jan-2008 Mathias Verraes
 + Added writable checks in installer
 # Fixed [#t=335] : Missing param check in buttons plugin, thanks cjcj01
 # Fixed [#5787] : State is lost in document edit when validation fails

07-Jan-2008 Mathias Verraes
 # Fixed [#8555] : Error occurs when saving document if using linked document and URL contains dashes
 ^ Changed [t=399] : Language strings referring to Details tab
 # Fixed [#9089] : Cannot Submit Uploads

06-Jan-2008 Mathias Verraes
 # Fixed [#7890] : Search form listed unpublished categories
 ^ Limited the number of search results returned
 # Fixed [#8078] : Save and Cancel buttons in frontend not working
 ^ Simplified document tooltips in frontend

05-Jan-2008 Mathias Verraes
 # Various small fixes and cleanup
 # Fixed [#8968] : Moved CSS calls to head
 - Removed admin menu separators
 # Fixed [#8838] : Url Length in Admin com_docman&section=documents
 # Fixed [#9041] : Back to downloads home after selecting tabs
 # Fixed : Buttons plugin not installed correctly in J!1.5

03-Jan-2008 Mathias Verraes
 # Fixed [t=365] : Issue with Community Builder

18-Dec-2007 Mathias Verraes
 - Removed 'Special Compatibility mode', too confusing
 # Fixed : Categories get renamed incorrectly http://forum.joomlatools.eu/viewtopic.php?f=14&t=316

08-Dec-2007 Mathias Verraes
 ^ Performance : Added another index to #__docman
 # Fixed [#8070] : Installer DOCMAN.XML is failing on line 441 Reason: incorrect filename
 # Fixed partially : [#7972] Pathway links are incorrect / not generating properly

05-Dec-2007 Mathias Verraes
 # Fixed : 'File not found' when entering url with spaces

29-Nov-2007 Mathias Verraes
 # Fixed : Missing _DML

14-Nov-2007 Mathias Verraes
 # Fixed : SQL query error in filter of Download Logs

11-Nov-2007 Mathias Verraes
 ^ Moved buttons to a plugin

10-Nov-2007 Mathias Verraes
 # Fixed [#7999] and [#5779] : Searching with special characters
 # Fixed : Selecting multiple categories in mod_lister
   http://www.mambodocman.com/index.php?option=com_simpleboard&Itemid=35&func=view&catid=508&id=16088#16088
 # Fixed [#7977] : Errors in search results
 # Fixed : Image tags in description crashed the inputfilter

09-Nov-2007 Mathias Verraes
 ^ licenseDocumentProcess() uses $_REQUEST to allow for redirects in onBeforeDownload plugins

05-Nov-2007 Mathias Verraes
 # Fixed : ob_end_clean() doesn't exist in php < 4.3.0
 # Fixed  [#7925] : Unpublished categories accessible through guesswork
