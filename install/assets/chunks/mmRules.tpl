/**
 * mmRules
 * 
 * Правила для ManagerManager
 * 
 * @category	chunk
 * @version 	1.1
 * @internal	@properties
 * @internal 	@modx_category Manager and Admin
 */

mm_widget_showimagetvs();

//mm_createTab('SEO', 'seoTab');
//mm_moveFieldsToTab('title,metaKeywords,metaDesc,sitemap_changefreq,sitemap_priority,urlOverride', 'seoTab');
//mm_widget_tags('metaKeywords', ',');

mm_renameField('log', 'Дочерние ресурсы отображаются в дереве');
mm_changeFieldHelp('log', 'Это поле используется для папок с большим числом вложенных страниц');
