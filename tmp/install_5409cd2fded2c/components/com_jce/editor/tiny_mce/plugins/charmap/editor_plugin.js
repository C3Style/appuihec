/* JCE Editor - 2.4.2 | 28 July 2014 | http://www.joomlacontenteditor.net | Copyright (C) 2006 - 2014 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
(function(){tinymce.create('tinymce.plugins.CharacterMap',{init:function(ed,url){this.editor=ed;ed.addCommand('mceCharacterMap',function(v){ed.windowManager.open({url:ed.getParam('site_url')+'index.php?option=com_jce&view=editor&layout=plugin&plugin=charmap',width:550+parseInt(ed.getLang('advanced.charmap_delta_width',0)),height:250+parseInt(ed.getLang('advanced.charmap_delta_height',0)),close_previous:false,inline:true,popup_css:false});});ed.addButton('charmap',{title:'advanced.charmap_desc',cmd:'mceCharacterMap'});}});tinymce.PluginManager.add('charmap',tinymce.plugins.CharacterMap);})();