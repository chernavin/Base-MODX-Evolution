Base MODX Evolution
===================

Сборка MODX Evolution 1.0.6 "под себя".

Предустановленные ресурсы
-------------------------

* Главная (1)
* Системные страницы (2)
* Страница не существует (3)
* Страница закрыта для просмотра (4)
* XML карта сайта (7)

Предустановленные шаблоны
-------------------------

* Системная страница (2)
* Типовая страница (3)
* Главная страница (4)

Изменение в настройках
----------------------
* error_page = 3
* unauthorized_page = 4
* friendly_urls = 1
* allow_duplicate_alias = 1
* use_alias_path = 1
* captcha_words = 'a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z'
* auto_template_logic = 'sibling'
* tree_page_click = 27

Удалено из дистрибутива
-----------------------

* Шаблон MODxHost
* Чанк WebLoginSideBar
* Чанк mm_demo_rules

Обновлено в дистрибутиве
------------------------

* Добавлен 301 редирект FirstChildRedirect (http://community.modx-cms.ru/blog/questions/627.html#comment6754)
* Изменены параметры TransAlias по умолчанию (russian, lowercase alphanumeric)
* WebLogin (http://modx-shopkeeper.ru/forum/viewtopic.php?id=226)
* WebSignup усилена проверка captcha
* Ditto (http://modx-shopkeeper.ru/forum/viewtopic.php?id=266)
* Транслитерация имён файлов при загрузке в MODx (http://www.supremum.lv/2010/04/09/transliteraciya-imyon-fajlov-pri-zagruzke-v-modx/)
* Управление страницами вне дерева (http://community.modx-cms.ru/blog/tips_and_tricks/848.html)
* Изменен адрес XML карты сайта в robots.txt
* Обновление безопасности (http://forums.modx.com/thread/74423/modx-evolution-1-0-5-and-prior-remote-script-execution-vulnerability#dis-post-412760)
* Убираем задежку при редактировании документов (http://community.modx-cms.ru/blog/tips_and_tricks/2580.html)
* Исправление ошибки в mm_widget_showimagetvs (http://community.modx-cms.ru/blog/questions/2486.html#comment19549)

Добавлено в дистрибутив
-----------------------
* Сниппет GetField 1.3 (http://modx.com/extras/package/getfield)
* Плагин PHx 2.1.4 (http://modx.com/extras/package/phx)
* Плагин TVimageResizer 1.9.4 (http://modx.com/extras/package/tvimageresizer)
* Сниппет и плагин MultiPhotos 1.2.4 (http://community.modx-cms.ru/blog/addons/1146.html)
* Плагин systemField 1.3 (http://modx.com/extras/package/systemfield)
* Сниппет sitemap 1.0.9 (﻿﻿﻿﻿﻿﻿http://modx.com/extras/package/sitemap)
* Плагин SEO Strict URLs 1.0.1 (http://modx.com/extras/package/?id=seostricturls)
* Плагин CodeMirror 2.23 (http://community.modx-cms.ru/blog/tips_and_tricks/6499.html)
* Плагин customTemplate (http://community.modx-cms.ru/blog/addons/2368.html)
* Чанки htmlHead, mmRules, itemSample
* Сниппеты eFormList, tvList
* Чанки feedback, feedbackForm, feedbackReport, feedbackThankyou
* TV параметры title, metaKeywords, metaDesc
* TV параметры sitemap_changefreq, sitemap_priority, urlOverride
* Возможность выключать плагины при установке добавляя (@internal @disabled 1)
