<?php

define('_EXEC', 1);

define('PATH_BASE', __DIR__);

if (file_exists('app.vars.php'))
{
	include_once 'app.vars.php';
}
if (file_exists('application/geo.php'))
{
    include_once 'application/geo.php';
}
$options = array();
$options['charset'] = 'utf-8';
$geo = new Geo($options);

// Показ информации в зависимости от страны
$country = $geo->get_value('country', true);
$co = ( isset($country) && $country != null ) ? strtolower($country) : 'ua';

if(array_key_exists($co, $geo_vars)) {
    $gvars = $geo_vars[$co];
} else {
    $gvars = $geo_vars['ua'];
}

// Показ информации в зависимости от контекстного запроса
$ptype = ( isset($_GET['type']) && (int)$_GET['type'] == 2 ) ? 'avt' : 'inv';
$tvars = $type_vars[$ptype];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="keywords" content="Инвентаризация, переучет, перемещение, возврат, магазин, недостачи, пересорт" />
        <meta name="description" content="Инвентаризация на складе, переучет в магазине, недостачи, пересорт" />
        <link rel="shortcut icon" type="image/png" href="/favicon.png" />

        <title><?php echo $tvars['title']; ?></title>

        <link rel="stylesheet" href="/css/reset.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lte IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>    
        <![endif]-->

        <!-- Custom styles for tamplate -->
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/style-responsive.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="/js/modernizr.custom.js"></script>
        
    </head>
    <body>
        <div class="vspl"></div>
        <div id="vspl"><br><div id="exit">Закрыть</div></div>
        <header class="mainheader" id="top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <div class="logo"></div>
                        <div class="hidden-xs left">
                            <p class="slogan">Мобильные приложения<br>для автоматизации бизнеса</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="phone hidden-xs">
                            <div><?php echo $gvars['contact_row1']; ?> <?php echo $gvars['contact_row2']; ?></div>
                            <a href="#" id="add_callback" class="callback">заказать обратный звонок</a>
                        </div>
                        <div class="phone-xs visible-xs-block">
                            <div><?php echo $gvars['contact_row1']; ?> <span>/</span> <?php echo $gvars['contact_row2']; ?></div>
                            <a href="#" id="add_callback" class="callback">заказать обратный звонок</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="maincontent" id="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <h1><?php echo $tvars['mcontent_h1']; ?></h1>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <p class="row1">с современным мобильным решением</p>
                        <p class="row2">«Рабочее место кладовщика» на Android</p>
                        <img src="/images/tablet-intro.png" class="img-responsive hidden-xs">
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <form action="" method="POST" class="request-callback-1" id="ajaxform">
                            <div class="heading">Оставьте заявку</div>
                            <div class="inputs">
                                <div class="input-1 ico-name required"><input type="text" name="name" data-notice="Ваше имя" placeholder="Ваше имя"></div>
                                <div class="input-1 ico-phone required"><input type="text" name="phone" id="phone3" data-notice="Ваш телефон" placeholder="Ваш телефон"></div>
                                <input type="hidden" name="country" value="<?php echo $gvars['country']; ?>" />
                            </div>
                            <input type="submit" value="Отправить заявку" class="button-1 submit">
                            <div class="input-caption">или <a href="#" class="callnow">позвонить нам, прямо сейчас!</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
		
        <div class="why-benefits" id="why_benefits">
            <div class="container">
                <h2><?php echo $tvars['benefits_h2']; ?></h2>
                <div class="row">
                    <?php
                        foreach( $tvars['benefits_items'] as $item ) : 
                        $item = explode( '::', $item );
                    ?>
                        <div class="col-xs-6 col-sm-4 icons">
                            <img src="/images/<?php echo $item[0]; ?>" alt="" class="img-responsive">
                            <h3><?php echo $item[1]; ?></h3>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="most-important" id="most_important">
            <div class="container">
                <ul id="iTab" class="nav nav-pills nav-justified" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Самое важное</a>
                    </li>
                    <li role="presentation">
                        <a href="#func" aria-controls="func" role="tab" data-toggle="tab">Функциональность</a>
                    </li>
                    <li role="presentation">
                        <a href="#license" aria-controls="license" role="tab" data-toggle="tab">Управление лицензиями</a>
                    </li>
                </ul>
                <div class="row">                    
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                            <div class="col-xs-12 col-sm-8">
                                <h2>РАБОЧЕЕ МЕСТО КЛАДОВЩИКА</h2>
                                <p>Функциональное решение для автоматизации работы кладовщиков и товароведов, как на обычных складах, так и на складах с адресным хранением с применением мобильных устройств.</p>
                                <p>Инвентаризация, прием товаров, отбор, размещение и другие операции - БЕЗ ПРОБЛЕМ.</p>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-10 col-md-12">
                                        <div class="col-xs-4 col-sm-6 col-md-4 icons">
                                            <img src="/images/icon_use.png" alt="" class="img-responsive">
                                            <p>Легкость в<br>использования</p>
                                        </div>
                                        <div class="col-xs-4 col-sm-6 col-md-4 icons">
                                            <img src="/images/icon_update.png" alt="" class="img-responsive">
                                            <p>Мгновенное обновление<br>информации</p>
                                        </div>
                                        <div class="col-xs-4 col-sm-6 col-md-4 icons">
                                            <img src="/images/icon_1c.png" alt="" class="img-responsive">
                                            <p>Интеграция<br>с 1С 7.7/8.+</p>
                                        </div>
                                        <div class="col-xs-4 col-sm-6 col-md-4 icons">
                                            <img src="/images/icon_integration.png" alt="" class="img-responsive">
                                            <p>Быстрая интеграция<br>за 1 час</p>
                                        </div>
                                        <div class="col-xs-4 col-sm-6 col-md-4 icons">
                                            <img src="/images/icon_android.png" alt="" class="img-responsive">
                                            <p>На любое устройство<br>с Android 2.2+</p>
                                        </div>
                                        <div class="col-xs-4 col-sm-6 col-md-4 icons">
                                            <img src="/images/icon_sertif.png" alt="" class="img-responsive">
                                            <p>Сертифицированный<br>продукт</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="phone-rmk hidden-xs">
                                <img src="/images/phone-rmk.png">
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="func">
                            <div class="col-xs-12">
                                
                            </div>
                            <div class="col-xs-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Функциональные возможности</th>
                                            <th>Простой склад</th>
                                            <th>Магазин</th>
                                            <th>Адресный склад</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Прием товаров (приход)</td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Отбор товаров к отгрузке (расход)</td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Возврат</td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Чек</td>
                                            <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Размещение (поступление товаров)</td>
                                            <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Инвентаризация</td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Внутренний заказ</td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Перемещение внешнее (с одного склада на другой)</td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Перемещение внутреннее (внутри одного склада)</td>
                                            <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Модуль подключения для организации адресного учета (для "1С:Предприятие" 8.х)</td>
                                            <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                            <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a class="button-3" title="Описание фунционала в формате *.pdf" href="/images/rmk-functionaly.pdf" target="_blank">Подробная информация о функционале</a>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="license">
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <p>Чтобы использовать продукт «Рабочее место кладовщика» необходимо приобрести лицензию. Одна лицензия может работать только на одном мобильном устройстве. Это обусловлено тем, что ключ лицензии "привязывается" к мобильному устройству.</p>
                                            <p>В связи с этим возникают вопросы: «Что делать, если мобильное устройство с установленным продуктом «Рабочее место кладовщика» потеряется или сломается? Можно ли лицензию перенести на другое мобильное устройство?».</p>
                                            <p>Для управления лицензиями наши клиенты могут воспользоваться «Сервисом контроля и учета лицензий», который позволит при необходимости самостоятельно перенести лицензию с одного мобильного устройства на другое.</p>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <img src="/images/licensereg.png" class="img-responsive" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <h3>«Сервис контроля и учета лицензий» позволяет:</h3>
                                            <ul>
                                                <li>регистрировать мобильные устройства;</li>
                                                <li>привязывать лицензии к мобильным устройствам;</li>
                                                <li>отвязывать лицензии от мобильных устройств;</li>
                                                <li>просматривать подробную информацию о мобильном устройстве (контактные данные торгового представителя; информацию об операторе мобильной связи, о сим-карте, идентификаторах МУ)</li>
                                                <li>формировать отчеты по использованию лицензий (история привязок/отвязок, количество свободных лицензий).</li>
                                            </ul>
                                            <p>Используя «Сервис контроля и учета лицензий» клиент всегда будет иметь доступ к актуальной информации об использовании парка мобильных устройств и лицензий, а также сможет в любое время без простоев и потерь самостоятельно подготовить полноценный рабочий инструмент для торгового представителя.</p>
                                            <p>Доступ к «Сервису контроля и учета лицензий» осуществляется посредством сети Интернет через любой веб-браузер. Каждый клиент получает личный виртуальный кабинет.</p>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <img src="/images/licensemanagement.png" class="img-responsive child-2" alt="">
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
		
        <div class="prices" id="prices">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-md-3">
                        <p class="price"><?php echo $gvars['price_simple']; ?></p>
                        <p class="order">- простой склад -</p>
                        <a href="#pre_footer" class="button-2 center-block">Оставить заявку</a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <p class="price"><?php echo $gvars['price_shop']; ?></p>
                        <p class="order">- магазин -</p>
                        <a href="#pre_footer" class="button-2 center-block">Оставить заявку</a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <p class="price"><?php echo $gvars['price_address']; ?></p>
                        <p class="order">- адресный склад  -</p>
                        <a href="#pre_footer" class="button-2 center-block">Оставить заявку</a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <p class="price">Аренда лицензии</p>
                        <a href="#rental_service" class="button-2 center-block">Оставить заявку</a>
                    </div>
                </div>
            </div>
        </div>
		
        <div class="compare" id="compare">
            <div class="container">
                <h2>«Рмк» ДЛЯ МОБИЛЬНЫХ УСТРОЙСТВ - ЛУЧШИЙ АНАЛОГ ТСД</h2>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <img src="/images/icon1_vs.png" alt="" class="img-responsive center-block">
                            <h3>ЦЕНА</h3>
                            <p>Широкий выбор мобильных устройств, которые гораздо дешевле</p>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <img src="/images/icon2_vs.png" alt="" class="img-responsive center-block">
                            <h3>УДОБСТВО</h3>
                            <p>Программный продукт имеет гибкие настройки, которые всегда можно изменить под нужды пользователя</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 no-padding-md">
                        <img src="/images/tablet-vs-tsd.png" alt="" class="img-vs img-responsive center-block">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <img src="/images/icon3_vs.png" alt="" class="img-responsive center-block">
                            <h3>ПРОГРАММИРУЕМОСТЬ</h3>
                            <p>Возможность изменения  интерфейса и доработки функциональности под потребности клиента</p>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <img src="/images/icon4_vs.png" alt="" class="img-responsive center-block">
                            <h3>5 В 1</h3>
                            <p>Не забываем - это камера, сканер штрих-кодов, голосовой поиск  и связь через WI-FI, EDGE</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
        <div class="advantages" id="advantages">
            <div class="container">
                <h2>ЧТО ВЫ ПОЛУЧИТЕ ОТ ВНЕДРЕНИЯ МОБИЛЬНОГО РЕШЕНИЯ «Рмк»</h2>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6" id="left">
                        <div class="list">Значительное улучшение порядка на складе и снижение пересорта товаров</div>
                        <div class="list">Сокращение среднего времени отгрузки заказов</div>
                        <div class="list">Уменьшение потерь за счет быстрых скользящих инвентаризаций</div>
                        <div class="list">Более эффективная работа персонала и уменьшение количества ошибок при сборке</div>
                        <div class="list">Возможность оценки эффективности работы персонала склада</div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6" id="right">
                        <div class="list">Оптимизация затрат на персонал</div>
                        <div class="list">Значительное ускорение приемки товара</div>
                        <div class="list">Ускорение процесса текущих, плановых и годовых инвентаризаций</div>
                        <div class="list">Уменьшение зависимости от персонала склада</div>
                        <div class="list">Значительное сокращение затрат на бумагу и накладных расходов</div>
                    </div>
                </div>
                <h3>Наше программное обеспечение помогает решать Ваши бизнес-задачи.<br>Оставьте заявку прямо сейчас!</h3>
            </div>
        </div>
		
        <div class="rental-service" id="rental_service">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>Услуга «аренда лицензии»</h2>
                    </div>                   
                    <div class="col-sm-12 col-md-7">
                        <div class="row1">
                            <p>Появилась возможность пользоваться всеми преимуществами мобильного решения «Рабочее место кладовщика» на условиях краткосрочной аренды.</p>
                        </div>
                        <div class="row2">
                           <h3>УСЛОВИЯ АРЕНДЫ:</h3>
                           <ul>
                               <li>лицензия предоставляется сроком на 30 дней. </li>
                               <li>в стоимость лицензии входит 1 час работы специалиста для подключения, настройки и консультации клиента.</li>
                           </ul>
                           <div class="price"><?php echo $gvars['r_service_old']; ?> <p><?php echo $gvars['r_service_new']; ?>*</p></div>
                           <div class="clearfix"></div>
                           <p>* В стоимость услуги не входит дорабока конфигурации учетной системы клиента</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <form action="#" method="POST" class="request-callback-1 request-callback" id="ajaxform">
                            <div class="heading">Оставьте заявку</div>
                            <div class="inputs">
                                <div class="input-1 ico-name required"><input type="text" name="name" data-notice="Ваше имя" placeholder="Ваше имя"></div>
                                <div class="input-1 ico-phone required"><input type="text" name="phone" id="phone4" data-notice="Ваш телефон" placeholder="Ваш телефон"></div>
                                <input type="hidden" name="country" value="<?php echo $gvars['country']; ?>" />
                            </div>
                            <input type="submit" value="Отправить заявку" class="button-1 submit">
                            <div class="input-caption">или <a href="#" class="callnow">позвонить нам, прямо сейчас!</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		
        <div class="about" id="about">
            <div class="container">
                <h2>УЗНАЙТЕ, ПОЧЕМУ ВЫБИРАЮТ ИМЕННО НАС</h2>  
            </div>
            <div id="cbp-fwslider" class="cbp-fwslider">
				<ul>
					<li><a href="#"><img src="/images/slider/s1.jpg" alt="Сертификат"/></a></li>
					<li><a href="#"><img src="/images/slider/s2.jpg" alt="Сертификат"/></a></li>
					<?php $gslide = ($gvars['id'] == 'ru') ? 's4.jpg' : 's3.jpg'; ?>
					<li><a href="#"><img src="/images/slider/<?php echo $gslide; ?>" alt="Сертификат"/></a></li>
				</ul>
			</div>
        </div>
		
        <div class="pre-footer" id="pre_footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-7">
                        <div class="row1">
                            <span><?php echo $tvars['pre_footer_row1']; ?></span>
                        </div>
                        <div class="row2">
                            <span><?php echo $tvars['pre_footer_row2']; ?></span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <form action="#" method="POST" class="request-callback-1 request-callback" id="ajaxform">
                            <div class="heading">Оставьте заявку</div>
                            <div class="inputs">
                                <div class="input-1 ico-name required"><input type="text" name="name" data-notice="Ваше имя" placeholder="Ваше имя"></div>
                                <div class="input-1 ico-phone required"><input type="text" name="phone" id="phone5" data-notice="Ваш телефон" placeholder="Ваш телефон"></div>
                                <input type="hidden" name="country" value="<?php echo $gvars['country']; ?>" />
                            </div>
                            <input type="submit" value="Отправить заявку" class="button-1 submit">
                            <div class="input-caption">или <a href="#" class="callnow">позвонить нам, прямо сейчас!</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <div class="logo"></div>
                        <div class="hidden-xs left">
                            <p class="slogan">Мобильные приложения<br>для автоматизации бизнеса</p>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="phone hidden-xs">
                            <div><?php echo $gvars['contact_row1']; ?> <?php echo $gvars['contact_row2']; ?></div>
                            <a href="#" id="add_callback" class="callback">заказать обратный звонок</a>
                        </div>
                        <div class="phone-xs visible-xs-block">
                            <div><?php echo $gvars['contact_row1']; ?> <span>/</span> <?php echo $gvars['contact_row2']; ?></div>
                            <a href="#" id="add_callback" class="callback">заказать обратный звонок</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
		
        <div class="modal-call" id="callback-form" style="display: none;">
            <a href="#" class="close"></a>
            <h1>Обратный звонок</h1>
            <img src="/images/ajax-loader.gif" id="loading" style="display:none;">
            <div id="mf_error"></div>
            <div class="fmore">
                <form name="form" id="file-form" action="" method="POST">
                    <label>Имя:</label>
                    <input type="text" name="name" id="name" placeholder="Ваше имя" value="">
                    <label>Телефон:</label>
                    <input type="text" name="phone" id="phone2" placeholder="<?php echo $gvars['phone_mask']['1']; ?>" value="">
                    <input type="hidden" name="country" value="<?php echo $gvars['country']; ?>" />
                    <input type="submit" value="Отправить"><br />
                </form>
            </div>
        </div>
		
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="/js/jquery.maskedinput.js"></script>
        <script src="/js/jquery.the-modal.js"></script>
        <script src="/js/ajax.sendform.js"></script>
        <script src="/js/jquery.slider.min.js"></script>
        <script>
            
            $('#cbp-fwslider').cbpFWSlider();
            $('#cbp-fwslider a').on('click', function(e){
                console.log(e);
                e.preventDefault();
            });
            
            $('#vspl').hide();
            $('.vspl').hide();
            $("#exit").click(function() {
                $('#vspl').hide(500);
                $('.vspl').hide(500);
            });
            
            $("#phone3").mask("<?php echo $gvars['phone_mask']['2']; ?>");
            $("#phone4").mask("<?php echo $gvars['phone_mask']['2']; ?>");
            $("#phone5").mask("<?php echo $gvars['phone_mask']['2']; ?>");
                     
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var anchor = e.target.href.split('#')[1];
                switch(anchor) {
                    case 'home':
                        $('#most_important').css({'background': '#fff url(../images/bg/bg-3.jpg) 50% 0% no-repeat', 'background-size': 'cover'});
                        break;

                    case 'func':
                        $('#most_important').css('background', '#f8f8f8 url(../images/bg/pattern-2.png)');
                        break;
                    
                    case 'license':
                        $('#most_important').css('background', '#f8f8f8 url(../images/bg/pattern-2.png)');
                        break;
                }
            });
            
            jQuery(function($){
                $('body').on('click', '#add_callback', function(e){e.preventDefault();$('#callback-form').modal().open();$("#phone2").mask("<?php echo $gvars['phone_mask']['2']; ?>");});
                $('.modal-call .close').on('click', function(e){e.preventDefault();$.modal().close();});
            });
            
            $(document).ready(function() {
                $("a.button-2").click(function(e) {
                    $('html,body').stop().animate({
                        scrollTop: $($(this).attr("href")).offset().top
                    }, 1000);
                    e.preventDefault();
                });
            });
        </script>    
    </body>
</html>
