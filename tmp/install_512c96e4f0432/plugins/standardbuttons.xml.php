<?xml version="1.0" encoding="iso-8859-1"?>
<mosinstall type="mambot" group="docman" version="4.5.1">
	<name>DOCman Standard Buttons</name>
	<creationDate>February 2009</creationDate>
	<author>Joomlatools</author>
	<copyright>Copyright (c) 2003-2009 Joomlatools</copyright>
	<license>This extension is released under the GNU/GPL License</license>
	<authorEmail>support@joomlatools.eu</authorEmail>
	<authorUrl>http://www.joomlatools.eu</authorUrl>
	<version>1.4.1.stable</version>
	<description>This plugin provides the default buttons in DOCman for download, view, details, checkout/in, edit, publish etc...</description>

	<files>
		<filename mambot="standardbuttons">standardbuttons.php</filename>
	</files>

	<params>
		<param name="download" type="radio" default="1" label="Show Download" description="This will hide the button for this task when browsing in the front-end. Please note that will not prevent access to this task." >
	        <option value="0">No</option>
	        <option value="1">Yes</option>
	   	</param>
	   	<param name="view" type="radio" default="1" label="Show View" description="This will hide the button for this task when browsing in the front-end. Please note that will not prevent access to this task." >
	        <option value="0">No</option>
	        <option value="1">Yes</option>
	   	</param>
	   	<param name="details" type="radio" default="1" label="Show Details" description="This will hide the button for this task when browsing in the front-end. Please note that will not prevent access to this task." >
	        <option value="0">No</option>
	        <option value="1">Yes</option>
	   	</param>

	   	<param name="edit" type="radio" default="1" label="Show Edit" description="This will hide the button for this task when browsing in the front-end. Please note that will not prevent access to this task." >
	        <option value="0">No</option>
	        <option value="1">Yes</option>
	   	</param>
	   	<param name="move" type="radio" default="1" label="Show Move" description="This will hide the button for this task when browsing in the front-end. Please note that will not prevent access to this task." >
	        <option value="0">No</option>
	        <option value="1">Yes</option>
	   	</param>
	   	<param name="delete" type="radio" default="1" label="Show Delete" description="This will hide the button for this task when browsing in the front-end. Please note that will not prevent access to this task." >
	        <option value="0">No</option>
	        <option value="1">Yes</option>
	   	</param>
	   	<param name="update" type="radio" default="1" label="Show Update" description="This will hide the button for this task when browsing in the front-end. Please note that will not prevent access to this task." >
	        <option value="0">No</option>
	        <option value="1">Yes</option>
	   	</param>

	   	<param name="reset" type="radio" default="1" label="Show Reset" description="This will hide the button for this task when browsing in the front-end. Please note that will not prevent access to this task." >
	        <option value="0">No</option>
	        <option value="1">Yes</option>
	   	</param>
	   	<param name="checkout" type="radio" default="1" label="Show Checkin/Checkout" description="This will hide the button for this task when browsing in the front-end. Please note that will not prevent access to this task." >
	        <option value="0">No</option>
	        <option value="1">Yes</option>
	   	</param>
	   	<param name="approve" type="radio" default="1" label="Show Approve" description="This will hide the button for this task when browsing in the front-end. Please note that will not prevent access to this task." >
	        <option value="0">No</option>
	        <option value="1">Yes</option>
	   	</param>
	   	<param name="publish" type="radio" default="1" label="Show Publish/Unpublish" description="This will hide the button for this task when browsing in the front-end. Please note that will not prevent access to this task." >
	        <option value="0">No</option>
	        <option value="1">Yes</option>
	   	</param>

	</params>
</mosinstall>