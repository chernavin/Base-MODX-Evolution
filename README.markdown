Base MODX Evolution
===================

Сборка MODX Evolution 1.0.6 "под себя".

Предустановленные ресурсы
-------------------------

* Главная (1)
* Системные страницы (2)
* Страница не существует (3)
* Страница закрыта для просмотра (4)
* XML карта сайта (5)
* Сайт недоступен (6)

Предустановленные шаблоны
-------------------------

* Системная страница (2)
* Типовая страница (3)
* Главная страница (4)

Изменение в настройках
----------------------
* error_page = 3
* unauthorized_page = 4
* site_unavailable_page = 6
* friendly_urls = 1
* allow_duplicate_alias = 1
* use_alias_path = 1
* captcha_words = 'a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z'
* auto_template_logic = 'sibling'
* tree_page_click = 27
* site_name = Base MODX Site

Удалено из дистрибутива
-----------------------

* Шаблон MODxHost
* Чанк WebLoginSideBar
* Чанк mm_demo_rules
* Директория assets/templates/help
* Скрипты frankensleight.js и csshover3.htc, файл README.txt из директории assets/js
* Директории assets/plugins/managermanager/docs, assets/snippets/ajaxSearch/documentation, assets/snippets/eform/docs, assets/snippets/wayfinder/examples
* Редко используемые языки, оставлены языки - Русский, Английский, Французкий, Немецкий, Итальянский, Испанский

Обновлено в дистрибутиве
------------------------

* Слово MODx заменено на MODX
* Добавлен 301 редирект FirstChildRedirect (http://community.modx-cms.ru/blog/questions/627.html#comment6754)
* Изменены параметры TransAlias по умолчанию (russian, lowercase alphanumeric)
* WebLogin (http://modx-shopkeeper.ru/forum/viewtopic.php?id=226)
* Руссификация WebChangePwd, WebSignup
* WebSignup усилена проверка captcha
* Ditto (http://modx-shopkeeper.ru/forum/viewtopic.php?id=266)
* Транслитерация имён файлов при загрузке в MODx (http://www.supremum.lv/2010/04/09/transliteraciya-imyon-fajlov-pri-zagruzke-v-modx/)
* Управление страницами вне дерева (http://community.modx-cms.ru/blog/tips_and_tricks/848.html)
* Изменен адрес XML карты сайта в robots.txt
* Обновление безопасности (http://forums.modx.com/thread/74423/modx-evolution-1-0-5-and-prior-remote-script-execution-vulnerability#dis-post-412760)
* Убираем задежку при редактировании документов (http://community.modx-cms.ru/blog/tips_and_tricks/2580.html)
* Исправление ошибки в mm_widget_showimagetvs (http://community.modx-cms.ru/blog/questions/2486.html#comment19549)
* Устраняем конфликт вкладок MM с MultiPhotos и MultiFiles (http://community.modx-cms.ru/blog/addons/1232.html#comment18538)
* mm_createTab, параметр width по умолчанию 100%; mm_moveFieldsToTab, сохраняем ширину td
* Исправлен баг с переносом полей типа checkbox на новую вкладку (https://github.com/ncrossland/ManagerManager/commit/050c04c49f149615491293f89ff0204f96f3338b)
* Ditto &filter, сравнение без учета регистра (http://community.modx-cms.ru/blog/questions/1098.html)
* Ditto, отключение постраничной навигации если 1 страница (https://github.com/dmi3yy/modx.evo.custom/commit/5cf730a9d170a5c8a4dcff10736fa519adab1f73#diff-13)
* Отключены сообщения об ошибках для не manager пользователей
* Добавлена возможность смотреть расход памяти
* Обновлён класс PHPMailer
* Исправление верстки в плагине Forgot Manager Login
* Добавлена директива php_flag magic_quotes_gpc off в .htaccess
* Добавлена иконка "Управление элементами" для быстрого доступа (https://github.com/dmi3yy/modx.evo.custom/commit/b3a419bdf45e139723ef34f9586fe634718599da#diff-4)

Добавлено в дистрибутив
-----------------------
* Сниппет DocInfo 1.0 (http://community.modx-cms.ru/blog/fast-solution/6543.html#comment43842)
* Плагин PHx 2.1.4 (http://modx.com/extras/package/phx), убираем лишние запросы PHx к БД (http://community.modx-cms.ru/blog/solutions/768.html)
* Плагин TVimageResizer 1.9.4 (http://modx.com/extras/package/tvimageresizer)
* Сниппет и плагин MultiPhotos 1.2.6 (http://community.modx-cms.ru/blog/addons/1146.html)
* Плагин systemField 1.3 (http://modx.com/extras/package/systemfield)
* Сниппет sitemap 1.0.10 (﻿﻿﻿﻿﻿﻿http://modx.com/extras/package/sitemap)
* Плагин SEO Strict URLs 1.0.1 (http://modx.com/extras/package/?id=seostricturls)
* Плагин CodeMirror 2.23 (http://community.modx-cms.ru/blog/tips_and_tricks/6499.html)
* Плагин customTemplate 0.1 (http://community.modx-cms.ru/blog/addons/2368.html)
* Реализация и сниппет multiTV 5420e2b (https://github.com/Jako/multiTV), js/multitv.css (7 строка, 100% вместо 510px), russian-UTF8.language.inc.php, multi_image.config.inc.php, multi_file.config.inc.php
* Сниппет phpthumb (http://community.modx-cms.ru/blog/6217.html), обновление правил индексации в robots.txt
* Чанки htmlHead, mmRules, itemSample
* Сниппеты eFormList, tvList
* Чанки feedback, feedbackForm, feedbackReport, feedbackThankyou
* Чанки search, benchmark
* TV параметры title, metaKeywords, metaDesc
* TV параметры sitemap_changefreq, sitemap_priority, urlOverride, noIndex
* Возможность выключать плагины при установке добавляя (@internal @disabled 1)
