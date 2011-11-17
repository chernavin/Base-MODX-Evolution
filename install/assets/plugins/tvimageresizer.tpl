//<?php
/**
 * TVimageResizer
 * 
 * Plugin for creating miniature copy of pictures of Template Variables (TV - Image).
 *
 * @category    plugin
 * @version     1.9.4
 * @author		 Andchir <andchir@gmail.com>
 * @internal    @properties &tv_ids=TV IDs;string; &dirs=Thumb folders;string;small~medium &width=Width;string;200~400 &height=Height;string;100~200 &rcorner=Corners percentage of clipping;string; &backgroundColor=Background color;string;#FFFFFF &watermark=Watermark image path (png);string; &watermarkPos=Watermark position;string;90% 90% &cprighttext=Copyright text;string; &quality=Quality;int;90 &mirror=Mirror effect;list;yes,no;no &crop=Cropping;list;yes,no,crop_resized,fill_resized;no &save_o_name=Save only name;list;yes,no;no &rename_images=Rename images;list;yes,no;no &refresh_all_images=Refresh all images;list;yes,no;no
 * @internal    @events OnBeforeDocFormSave,OnSiteRefresh
 * @internal    @modx_category Manager and Admin
 */

require MODX_BASE_PATH.'assets/plugins/tvimageresizer/TVimageResizer.inc.php';
