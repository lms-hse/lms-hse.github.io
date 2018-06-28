<!DOCTYPE HTML>
<html>
    
<head>
    <title>LMS HSE</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <script src='js/jquery.min.js'></script>
        <script>
            var $j = jQuery.noConflict();
        </script>
    <script src='js/jquery-ui.min.js'></script>
    <script src='js/jquery-ui-timepicker-addon.min.js'></script>
    <script src='js/jquery-ui-timepicker-addon-i18n.min.js'></script>
    <script src='js/underscore-min.js'></script>
    <script src='js/backbone-min.js'></script>
    <script src='js/pages.js@v=1509619556'></script>
    
    <link rel="stylesheet" href="css/ui/jquery-ui.min.css" />
    <link rel="stylesheet" href="css/ui/themes/start/theme.css" />
    <link rel="stylesheet" href="css/ui/jquery-ui.structure.min.css" />
    <link rel="stylesheet" href="css/ui/jquery-ui-timepicker-addon.min.css" />
    <link rel='stylesheet' href='css/pages.css@v=1511960959' />
<link rel='stylesheet' href='css/menu.css@v=1462887355' />
<link rel='stylesheet' href='css/footer.css@v=1468235541' />
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
</head>
    
<div id="oe_menu" class="oe_wrapper">
    <ul id="oe_menu_user" class="oe_menu" style="float:right;">
                <li><a href="index.php" class="padding-home" target="_top"><span class="fa fa-sign-in"></span></a></li>
        <li><span style="color: #f98012;"> Гость</span></li>
            </ul>

    <!-- ******************************************************************* -->

    <ul id="oe_menu_main" class="oe_menu">
        <!-- **** INDEX ***************************************************** -->
        <li class="li_no_hide" ><a href="index.php" class="padding-home" target="_top"><span class="fa fa-home"></span></a></li>

        
        <!-- **** HELP ***************************************************** -->
        <li><span>Помощь</span>
            <div>
                <ul class="oe_full">
                    <li class="oe_heading"><span class=" fa fa-book">&nbsp;</span>Справочная документация</li>
                    <li><a href="index.php@page=docs" target="_top">Справочные материалы. Оглавление.</a></li><li><a href="index.php@page=docs&amp;page_point=student_start" target="_top">Студентам</a></li><li><a href="index.php@page=docs&amp;page_point=professor_start" target="_top">Преподавателям</a></li>                    <li>&nbsp;</li>
                    <li class="oe_heading"><span class=" fa fa-comments">&nbsp;</span>Служба поддержки</li>
                    <li><a href="index.php@page=contacts" target="_top">Контакты</a></li>
                    <li><a href="index.php@page=helpdesk" target="_top">HelpDesk</a></li>
                </ul>
            </div>
        </li>

        <!-- **** LANG ***************************************************** -->
        <li><span> <span class="fa fa-language"> </span>&nbsp;RU</span>
            <div>
                <ul class="oe_full">
                    <li class="oe_heading"><span class=" fa fa-language"> </span>&nbsp;Сменить язык интерфейса</li>
                    <li><span class="link" onclick="changeLanguage('english');"><span class="fa fa-square-o" style="width: 1.4em;"> </span> English</span></li>
                    <li><span class="link" onclick="changeLanguage('russian');"><span class="fa fa-check-square-o" style="width: 1.4em;"> </span> Русский</span></li>
                </ul>
            </div>
        </li>

    </ul>
</div>

<script type="text/javascript">
    // проверка активности страницы 
    // если поддерживается, то будем периодически проверять количество сообщений у пользователя
    // иначе не будем
    var supportVisibilityAPI = typeof document.hidden !== "undefined" ? true : false;

    // для формы поиска
    $j('#current_location').val(window.location);
    // проверка на тач скрин
    var isTouch = (('ontouchstart' in window) || (navigator.msMaxTouchPoints > 0));
//    var isTouch = true;

    if (!isTouch) {
        // скрипт для меню с мышкой
        $j(function () {
            var oe_menu_user = $j('#oe_menu_user');
            var oe_menu_main = $j('#oe_menu_main');
            var oe_menu_main_items = oe_menu_main.children('li');
            var oe_menu_user_items = oe_menu_user.children('li');

            function mouseenter_li_func() {
                var t = $j(this);
                var d = t.children('div');
                t.addClass('slided selected');
                if(d.length > 0){
                    t.parent().children('li').not('.slided').children('div').hide();
                    t.removeClass('slided');
                    d.css('z-index', '99999').show();
//                    d.css('z-index', '99999').stop(true, true).slideDown(300, function () {
//                        t.parent().children('li').not('.slided').children('div').hide();
//                        t.removeClass('slided');
//                    });
                    var ww = $j(window).width();
                    var tl = t.offset().left;
                    var dw = d.first().width();
                    if(ww - tl < dw) {
                        d.css('left', -(dw - (ww - tl)) + 'px');
                    } else {
                        d.css('left', '0px');
                    }
                } else {
                    t.stop(true, true);
                    t.removeClass('slided');
                    d.hide();
                }
            }
            function mouseleave_li_func() {
                var t = $j(this);
                t.removeClass('selected').children('div').css('z-index', '1');
            }

            oe_menu_main_items.bind('mouseenter', mouseenter_li_func).bind('mouseleave', mouseleave_li_func);
            oe_menu_user_items.bind('mouseenter', mouseenter_li_func).bind('mouseleave', mouseleave_li_func);

            function mouseenter_ul_func() {
                $j(this).addClass('hovered');
            }
            function mouseleave_ul_func() {
                var t = $j(this);
                t.removeClass('hovered');
                t.children('li').children('div').hide();
            }

            oe_menu_main.bind('mouseenter', mouseenter_ul_func).bind('mouseleave', mouseleave_ul_func);
            oe_menu_user.bind('mouseenter', mouseenter_ul_func).bind('mouseleave', mouseleave_ul_func);
        });
    } else {
        // скрипт для меню без мышки (предполагаем тачскрин)
        $j(function () {
            var oe_menu_user = $j('#oe_menu_user');
            var oe_menu_main = $j('#oe_menu_main');
            var oe_menu_main_items = oe_menu_main.children('li');
            var oe_menu_user_items = oe_menu_user.children('li');

            function mouseclick_li_func() {
                var t = $j(this);
                var mi = t.parent().children('li');
                var d = t.children('div');
                mi.removeClass('slided selected').children('div').css('z-index', '1');
                t.addClass('slided selected');
                if(d.length > 0){
                    mi.not('.slided').children('div').hide();
                    d.css('z-index', '99999').show();
//                    d.css('z-index', '99999').stop(true, true).slideDown(300, function () {
//                        mi.not('.slided').children('div').hide();
//                    });
                    var ww = $j(window).width();
                    var tl = t.offset().left;
                    var dw = d.first().width();
                    if(ww - tl < dw) {
                        d.css('left', -(dw - (ww - tl)) + 'px');
                    } else {
                        d.css('left', '0px');
                    }
                } else {
                    t.stop(true, true);
                    mi.children('div').hide();
                }
            }

            oe_menu_main_items.bind('click', mouseclick_li_func);
            oe_menu_user_items.bind('click', mouseclick_li_func);


            function hide_menu_items(menu){
                menu.removeClass('slided selected').children('div').css('z-index', '1');
                menu.children('div').hide();
            }

            $j(document).click( function(event) {
                if ($j(event.target).closest(oe_menu_main_items).length){
                    hide_menu_items(oe_menu_user_items);
                    return;
                }
                if ($j(event.target).closest(oe_menu_user_items).length){
                    hide_menu_items(oe_menu_main_items);
                    return;
                }
                hide_menu_items(oe_menu_user_items);
                hide_menu_items(oe_menu_main_items);
                event.stopPropagation();
            });

        });
    }

    // периодический опрос LMS на новые сообщения пользователю
    function mt_get_new_msg_count() {
        if (supportVisibilityAPI && !document.hidden) {
            $j.getJSON('/act.php?on=menu&name=get_count_new_messages', function(data){
                $j.each(data, function(key, val){
                    if (key === 'msg_count') {
                        var prev_val = $j('#mt_new_msg_count').text();
                        $j('#mt_new_msg_count').text(val);
                        if (val > 0) {
                            $j('#mt_new_msg').show();
                            if (prev_val !== val.toString()) {
                                var el = $j('#mail-in-animator');
                                var new_el = el.clone(true);
                                el.before(new_el);
                                $j(".mail-in:last").remove();
                            }
                        } else {
                            $j('#mt_new_msg').hide();
                        }
                    }
                });
            });
        }
    }

    // учёт изменения высоты
    function menu_padding() {
        var menuHeight = $j(".oe_wrapper").height();
        $j("body").css({"padding-top": menuHeight + "px"});
    }

    $j(document).ready(menu_padding);
    $j(window).resize(menu_padding);

    // изменение языка
    function changeLanguage(language) {
        $j.post('/act.php?on=menu&name=change_language', {lang_name: language}, function( data ) {
            document.location.reload(true);
        });
    }
    // изменение языка
    function changePreferedDesign(use_pages) {
        $j.post('/act.php?on=menu&name=change_prefered_design', {use_pages: use_pages}, function( data ) {
            document.location.reload(true);
        });
    }
    // смена роли
    function changeAccount(login) {
        $j.getJSON('/act.php?on=menu&name=change_account&login='+login, function(data){
            $j.each(data, function(key, val){
                if (key === 'location') {
                    window.location = val;
                }
            });
        });
    }

        var isInFrame = (window.location !== window.parent.location) ? true : false;
    var test_userpage = window.parent.location.toString();
    if (!isInFrame) {
        $j('div.oe_wrapper').show(); // показываем меню
        // запускаем таймер для сообщений
        var mt_get_new_msg_count_timer = setInterval(mt_get_new_msg_count,
            60000 );
            } else {
        $j('div.oe_wrapper').hide(); // скрываем меню
    }

</script>
    
    <div id="content_wrapper">


                    <div class="content__row">
                <div class="layout-2cl">
                    <div class="layout-2cl-left">
                        <div class="content__row">
                            <div class="c12">
                                <div class="div_clear mrgn_s" style="text-align: center;">
                                    <div style="margin: 0 auto;">
                                        <img class="logo_img" src="img/logo_lms.png" style="width: 4em;" alt="Logo" />
                                        <div class="">
                                            <p style="margin: 0 1em;"> <span style="font-weight: 600;">Информационная образовательная среда НИУ ВШЭ</span><br />
                                                <span style="font-style: italic; font-size: 0.7em;">Не для школы, но для жизни мы учимся!</span></p>
                                        </div>
                                    </div>
                                </div>


                                
<div class="content__block block_navajowhite">
        <div class="content__row">
        <div class="c12">
            <p class="block__header">Аутентификация пользователя</p>
        </div>
    </div>
    <hr />
    
    <div class="content__row">
        <div class="c12">
            <div class="mrgn_s">
                                <div class='div_clear'><a class='login_lost' style='float:right;' href='index.php@reset_password=true'>Забыли пароль?</a></div><div class="quickform"><form action="index.php" method="post" id="login_form"><div><div style="display: none;"><input type="hidden" id="qf:login_form" name="_qf__login_form" /></div>
<div class="content__row form-field"><div class="c12 form-control"><input type="text" class="form-control" placeholder="Ваш логин" name="user_login" id="user_login-0" value="" /></div></div>
<div class="content__row form-field"><div class="c12 form-control"><input type="password" class="form-control" placeholder="Ваш пароль" name="user_password" id="user_password-0" value="" /></div></div>
<div class="content__row form-field"><div class="c12 form-control"><input type="submit" class="button button-primary" value="Войти" name="userLogin" id="userLogin-0" /></div></div>
</div></form>

</div>
                            </div>
        </div>
    </div>
</div>

                                
<div class="content__block block_transparent">
    
    <div class="content__row">
        <div class="c12">
            <div class="mrgn_s">
                                
                            </div>
        </div>
    </div>
</div>
                                <div class="for-big-width-screen">
<div class="content__block block_transparent">
        <div class="content__row">
        <div class="c12">
            <p class="block__header">ВШЭ в сети</p>
        </div>
    </div>
    <hr />
    
    <div class="content__row">
        <div class="c12">
            <div class="mrgn_s">
                                

    <div class="icons__block div_clear">
                    <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="http://www.hse.ru" target="_blank" >
                                            <span class="icons__img_wrapper"><img src="img/icons/logo_hse_ru_inv.png" style="height:3em;" alt="HSE"></span>
                                                        </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="http://www.hse.ru/edu/courses/" target="_blank" >
                                            <span class="fa fa-2x fa-edit"></span>
                                        Учебные курсы                </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="https://www.hse.ru/studyspravka/" target="_blank" >
                                            <span class="fa fa-2x fa-book"></span>
                                        Справочник учебного процесса                </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="https://www.hse.ru/edu/vkr/" target="_blank" >
                                            <span class="fa fa-2x fa-graduation-cap"></span>
                                        Каталог ВКР                </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="http://window.teamlms.hse.ru" target="_blank" >
                                            <span class="icons__img_wrapper"><img src="img/icons/logo_single_win.png" style="height:2em;" alt="HSESingleWin"></span>
                                        Единое окно                </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="http://library.hse.ru/e-resources/e-resources.htm" target="_blank" >
                                            <span class="fa fa-2x fa-file-text"></span>
                                        Электронная библиотека                </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#eee; color:#444;">
                                <a class="icons__icon_content" href="http://www.youtube.com/user/hse" target="_blank" >
                                            <span class="fa fa-3x fa-youtube"></span>
                                                        </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="https://www.hse.ru/plus/" target="_blank" >
                                            <span class="icons__img_wrapper"><img src="img/icons/logo_hse_ru_inv.png" style="height:2em;" alt="HSEPlus"></span>
                                        Вышка +                </a>
            </div>
                </div>
                                </div>
        </div>
    </div>
</div>
</div>
                            </div>
                        </div>
                    </div>
                    <div class="layout-2cl-main">
                        
<div class="content__block block_transparent">
        <div class="content__row">
        <div class="c12">
            <p class="block__header">Объявления</p>
        </div>
    </div>
    <hr />
    
    <div class="content__row">
        <div class="c12">
            <div class="mrgn_s">
                                
<ul class="fa-ul ads__list striped">
                <li class="ads__item_warning">
                <span class="fa-li fa fa-info"> </span>
                <p class="ads__item_date"> 
                    2016-07-11 11:35:00                                    </p>
                <h4> Обратите внимание: используйте браузеры последних версий! </h4>
                <p> Для корректной работы в системе LMS используйте браузер <strong> <a href="https://www.google.ru/chrome/browser/" target="_blank">Google Chrome.</a> </strong> 
<br>В браузере должно быть разрешено выполнение JavaScript. <br /> </p>
                            </li>
                <li class="ads__item_attention">
                <span class="fa-li fa fa-exclamation-triangle"> </span>
                <p class="ads__item_date"> 
                    2016-07-11 11:34:00                                    </p>
                <h4> Внимание! Проведение регламентных работ! </h4>
                <p> Ежедневно с 03:00 до 04:30 система недоступна в связи с проведением регламентных работ. </p>
                            </li>
    </ul>
                            </div>
        </div>
    </div>
</div>

<div class="content__block block_transparent">
        <div class="content__row">
        <div class="c12">
            <p class="block__header">Служба поддержки</p>
        </div>
    </div>
    <hr />
    
    <div class="content__row">
        <div class="c12">
            <div class="mrgn_s">
                                

<p>
    Прежде чем обратиться в службу поддержки, убедитесь, что на Ваш вопрос ещё нет ответа в справочных материалах    (<a href="index.php@page=docs">Справочные материалы. Оглавление.</a>)
</p>
<br />
<div class="content__row form-field">
    <div class="c02" style="margin-right: 0.2em"><label style="font-weight: 400;">e-mail:</label></div>
    <div><span><a href="mailto:lms@hse.ru">lms@hse.ru</a></span></div>
</div>
<div class="content__row form-field">
    <div class="c02" style="margin-right: 0.2em"><label style="font-weight: 400;">Телефоны:</label></div>
    <div>
    	+7 (495) 772 95 90 *110-24 <a href="http://www.hse.ru/org/persons/26334929" target="_blank">Бурдюкова Елена Викторовна</a>
    </div>
</div>
<div class="content__row form-field">
    <div class="c02" style="margin-right: 0.2em"><label style="font-weight: 400;">Адрес:</label></div>
        <div>Москва, ул. Мясницкая 20, к. 426</div>
</div>
<div class="content__row form-field">
    <div class="c02" style="margin-right: 0.2em"><label style="font-weight: 400;">Форма on-line:</label></div>
    <div><a href="index.php@page=helpdesk">HelpDesk</a></div>
</div>
                            </div>
        </div>
    </div>
</div>
                        <div class="for-small-width-screen">
<div class="content__block block_transparent">
        <div class="content__row">
        <div class="c12">
            <p class="block__header">ВШЭ в сети</p>
        </div>
    </div>
    <hr />
    
    <div class="content__row">
        <div class="c12">
            <div class="mrgn_s">
                                

    <div class="icons__block div_clear">
                    <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="http://www.hse.ru" target="_blank" >
                                            <span class="icons__img_wrapper"><img src="img/icons/logo_hse_ru_inv.png" style="height:3em;" alt="HSE"></span>
                                                        </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="http://www.hse.ru/edu/courses/" target="_blank" >
                                            <span class="fa fa-2x fa-edit"></span>
                                        Учебные курсы                </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="https://www.hse.ru/studyspravka/" target="_blank" >
                                            <span class="fa fa-2x fa-book"></span>
                                        Справочник учебного процесса                </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="https://www.hse.ru/edu/vkr/" target="_blank" >
                                            <span class="fa fa-2x fa-graduation-cap"></span>
                                        Каталог ВКР                </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="http://window.teamlms.hse.ru" target="_blank" >
                                            <span class="icons__img_wrapper"><img src="img/icons/logo_single_win.png" style="height:2em;" alt="HSESingleWin"></span>
                                        Единое окно                </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="http://library.hse.ru/e-resources/e-resources.htm" target="_blank" >
                                            <span class="fa fa-2x fa-file-text"></span>
                                        Электронная библиотека                </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#eee; color:#444;">
                                <a class="icons__icon_content" href="http://www.youtube.com/user/hse" target="_blank" >
                                            <span class="fa fa-3x fa-youtube"></span>
                                                        </a>
            </div>
                        <div class="icons__icon_box" style="width:9em; background-color:#005bab; color:#efefef;">
                                <a class="icons__icon_content" href="https://www.hse.ru/plus/" target="_blank" >
                                            <span class="icons__img_wrapper"><img src="img/icons/logo_hse_ru_inv.png" style="height:2em;" alt="HSEPlus"></span>
                                        Вышка +                </a>
            </div>
                </div>
                                </div>
        </div>
    </div>
</div>
</div>
                    </div>
                </div>
            </div>

    </div>


<div id="footer__block" class="footer__block" style="width: 100%;">
    <div class="footer__element">&copy; ВШЭ. Все права защищены. <script>var currentTime = new Date(); document.write(' 2014 - ' + currentTime.getFullYear() + '. ');</script></div>
    <div class="footer__element"> <a class="footer__link" href="index.php@page=contacts">Служба поддержки</a> работает для пользователей системы.</div>
    <div class="footer__element"> Техническая поддержка и развитие системы: <a class="footer__link" href="http://it.hse.ru/lms" target="_blank">ДИТ НИУ ВШЭ (LMS)</a></div>
</div>

<script>
    function footer_stick() {
        var bodyHeight = $j("body").height();
        var vwptHeight = $j(window).height();
        var footerHeight = $j("#footer__block").height();
        //alert('footer: body=' + bodyHeight + '; window = ' + vwptHeight + '; footer = ' + footerHeight);
        if (vwptHeight - footerHeight > bodyHeight) {
            $j("#footer__block").addClass("footer_stick");
            $j("body").css({"padding-bottom": footerHeight + "px"});
        } else {
            $j("#footer__block").removeClass("footer_stick");
            $j("body").css({"padding-bottom": "0px"});
        }
    }

    $j(document).ready(footer_stick);
    $j(window).resize(footer_stick);

    var footerIsInFrame = (window.location !== window.parent.location) ? true : false;
    if (!footerIsInFrame) {
        $j('#footer__block').show(); // показываем футер
    } else {
        $j('#footer__block').hide(); // скрываем футер
    }

</script>


<script>
    $j(document).ready(function () {
        addFilesIcons();
    });
</script>

</html>
