//<?php
/**
 * CodeMirror
 * 
 * JavaScript library that can be used to create a relatively pleasant editor interface
 *
 * @category 	plugin
 * @version 	2.21
 * @internal	@events OnDocFormRender, OnChunkFormRender, OnModFormRender, OnPluginFormRender, OnSnipFormRender, OnTempFormRender
 * @internal	@modx_category Manager and Admin
 */

// relative path to CodeMirror path from /manager
$_CM_URL = '/assets/plugins/codemirror/';

require('..'. $_CM_URL .'codemirror.plugin.php');
