<?php
	require 'system/config.php';
	require 'system/functions.php';

	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if(!$link){
		die('Ошибка подключения к базе данных');
	}

	$title = 'Главная страница';
	$cssFile = '<link rel="stylesheet" href="css/home.css"><link rel="stylesheet" href="css/functions.css"';
	
	require 'templates/header.php';
?>

	<main>
		<div class="container">
			<?php
			alerts('danger');
			alerts('success');
			?>
            <div class="search">
                <form>
                    <input type="search" id="pageSearchInput" placeholder="введите текст для поиска">
                </form>
            </div>


            <div class="header__content">
                <div class="map">
                    <div class="map_map">
                        <div id="ymaps-container"></div>
                    </div>
                </div>
                <div class="text">
                    <!-- <div class="all_card"> -->
                        
                        <!-- card for apple_gold -->
                        <div onclick="gold_apple()" class="card_container card_container_apple">
                            <div class="small-rectangle sr_apple">
                                <img class="small_rectangle_img sr_img_apple" src="img/logo_apple_gold.jpg" alt="">
                                <p class="small_rectangle_text">Золотое Яблоко</p>
                            </div>
                            <div class="large-rectangle sr_apple">
                                <div class="large_rectengle_text_conteiner">
                                    <p class="large_rectangle_text">«Золотое яблоко» — это торговая сеть по продаже товаров для жизни, красоты и дома.
На 2023 год занимает первое место по выручке среди парфюмерных сетей России. Главный офис расположен в Екатеринбурге.</p>
                                    <p class="large_rectangle_text_mobile">«Золотое яблоко» — торговая сеть по продаже товаров для жизни, красоты и дома.
Занимает первое место по выручке среди парфюмерных сетей России.</p>
                                        <a href="https://goldapple.ru/" class="partner_a">Перейти на сайт партнера</a>
                                </div>
                                <div class="large_rectangle_img">
                                    <img src="img/apple_gold_shop.jpg" alt="">
                                </div>
                            </div>
                        </div>

                        <!-- card for dodo -->
                            <div onclick="dodo()" class="card_container card_container_dodo">
                            <div class="small-rectangle">
                                <img class="small_rectangle_img" src="img/dodo_logo.png" alt="">
                                <p class="small_rectangle_text">Додо Пицца</p>
                            </div>
                            <div class="large-rectangle">
                                <div class="large_rectengle_text_conteiner">
                                    <p class="large_rectangle_text">«Додо Пицца» — это сеть пиццерий, которая предлагает своим 
                                    клиентам вкусную и качественную пиццу, приготовленную из свежих ингредиентов. 
                                    Компания использует современные технологии и оборудование для приготовления пиццы, 
                                    а также уделяет большое внимание качеству продукции и уровню обслуживания клиентов.</p>
                                    <p class="large_rectangle_text_mobile">«Додо Пицца» — это сеть пиццерий, которая предлагает своим 
                                    клиентам вкусную и качественную пиццу, приготовленную из свежих ингредиентов.</p>
                                    <a href="https://dodopizza.ru/peterburg" class="partner_a">Перейти на сайт партнера</a>
                                </div>
                                <div class="large_rectangle_img">
                                    <img src="img/dodo_cafe.png" alt="">
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="promotion">

        <h1 class="promotion_title">Наши
        <br>предложения 
        <br>и акции для 
        <br> вас</h1>

        <div class="pr_blocks">
            <div class="pr_one"> 
                <div class="pr_one_front">
                    <div class="pr_one_text">
                        <p>А</p>
                        <p>К</p>
                        <p>Ц</p>
                        <p>И</p>
                        <p>Я</p>
                    </div>
                    <svg class="pr_one_img" width="136" height="223" viewBox="0 0 136 223" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M24.9863 222.851H12.0089L114.111 191.019L0 172.607L115.223 170.744L8.6895 120.364L120.697 151.423L28.4343 72.2411L130.188 134.271L57.9937 31.2614L135.635 112.549V197.851C135.635 211.658 124.442 222.851 110.635 222.851H99.2053L117.43 210.974L24.9863 222.851ZM135.635 70.3021L95.5105 0L135.635 101.484V70.3021Z" fill="#FFCF0E"/>
                    </svg>
                </div>
                <div class="pr_one_back">
                    <?php
                    $query_promotion = 'SELECT `description` FROM `project_promotion`';
                    $res_promotion = mysqli_query($link, $query_promotion);
                    $row_promotion = mysqli_fetch_assoc($res_promotion);
                    echo '<p>' . htmlspecialchars($row_promotion['description']) . '</p>';
                    ?>
                </div>
            </div>


            <div class="pr_col">
                <div class="pr_date">
                    <div class="time-block">
                        <span id="days">00</span>
                        <small>Дней</small>
                    </div>
                    <div class="time-block">
                        <span id="hours">00</span>
                        <small>Часов</small>
                    </div>
                    <div class="time-block">
                        <span id="minutes">00</span>
                        <small>Минут</small>
                    </div>
                </div>
                <div class="pr_subgroup">
                <a href="page.php?url=comments"><div class="pr_statistic"><h2>Отзывы</h2></div></a>
                    <div class="pr_balance">
                        <p class="pr_balance_title title1">Бонусы</p>
                        <p class="pr_balance_title">100</p>
                        <p class="pr_balance_text">баллов</p>
                    </div>
                </div>
            </div>
            <div class="pr_cash">
                <p>Кэшбэк 10%</p>
                <div class="ellipse1"></div>
                <div class="ellipse2"></div>
            </div>
        </div>
    </div>

<!-- mobile promotion -->
<div class="promotion_mobile">

<h1 class="promotion_title">Наши
<br>предложения 
<br>и акции для 
<br> вас</h1>
<div class="pr_blocks_mobile_with_data">
    <div class="pr_blocks_mobile">
        <div class="pr_one"> 
            <div class="pr_one_front">
                <div class="pr_one_text">
                    <p>А</p>
                    <p>К</p>
                    <p>Ц</p>
                    <p>И</p>
                    <p>Я</p>
                </div>
                <svg class="pr_one_img" width="136" height="223" viewBox="0 0 136 223" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24.9863 222.851H12.0089L114.111 191.019L0 172.607L115.223 170.744L8.6895 120.364L120.697 151.423L28.4343 72.2411L130.188 134.271L57.9937 31.2614L135.635 112.549V197.851C135.635 211.658 124.442 222.851 110.635 222.851H99.2053L117.43 210.974L24.9863 222.851ZM135.635 70.3021L95.5105 0L135.635 101.484V70.3021Z" fill="#FFCF0E"/>
                </svg>
            </div>
            <div class="pr_one_back">
                <?php
                $query_promotion = 'SELECT `description` FROM `project_promotion`';
                $res_promotion = mysqli_query($link, $query_promotion);
                $row_promotion = mysqli_fetch_assoc($res_promotion);
                echo '<p>' . htmlspecialchars($row_promotion['description']) . '</p>';
                ?>
            </div>
        </div>
        <div class="pr_subgroup">
            <a href="page.php?url=comments"><div class="pr_statistic"><h2>Отзывы</h2></div></a>
            <div class="pr_balance">
                <p class="pr_balance_title title1">Бонусы</p>
                <p class="pr_balance_title">100</p>
                <p class="pr_balance_text">баллов</p>
            </div>
        </div>
    </div>
    <div class="pr_date">
        <div class="time-block">
            <span id="days_mobile">00</span>
            <small>Дней</small>
        </div>
        <div class="time-block">
            <span id="hours_mobile">00</span>
            <small>Часов</small>
        </div>
        <div class="time-block">
            <span id="minutes_mobile">00</span>
            <small>Минут</small>
        </div>
    </div>
</div>
</div>


<!-- end mobile promotion -->
    <div class="about">
    <h2 class="about_title">О нас</h2>
    <p class="about_text">  На сайте  представлена актуальная информация о партнёрах Сбера. 
        Здесь вы можете найти подробную карту партнёров, которая поможет вам выбрать наиболее подходящих поставщиков товаров и услуг для вашего бизнеса и личного использования.
    </p>
    <p class="about_text">
    Предприниматели могут легко найти надёжных поставщиков оборудования, материалов, программного обеспечения и других ресурсов, необходимых для развития бизнеса. На сайте представлена подробная информация о каждом партнёре: контактные данные, описание деятельности, отзывы клиентов и т.д. Это позволяет вам оценить надёжность и качество предоставляемых  услуг.</p>
    </div>

    <div class="possibilities">
        <h2 class="possibilities_title">Возможности сайта</h2>
        <div class="possibilities_block1">
            <p class="possibilities_sale">Акции и скидки</p>
            <p class="possibilities_sale_text">На сайте регулярно проводятся акции и скидки на различные товары.</p>
        </div>
        <div class="possibilities_block2">
            <p class="possibilities_sale">Удобство и экономия времени</p>
            <p class="possibilities_sale_text">Вы можете ознакомиться с отзывами других пользователей о работе с партнёрами и оценить их надёжность.</p>
        </div>
        <div class="possibilities_block3">
            <p class="possibilities_sale">Отзывы и рейтинги</p>
            <p class="possibilities_sale_text">Отзывы и рейтинги. Вы можете ознакомиться с отзывами других пользователей о работе с партнёрами и оценить их надёжность.</p>
        </div>
        <div class="possibilities_block4">
            <p class="possibilities_sale">Специальные предложения</p>
            <p class="possibilities_sale_text">Клиентам Сбера доступны специальные предложения от партнёров, информацию об актуальных акциях можно найти на сайте.</p>
        </div>
        <div class="possibilities_block5">
            <p class="possibilities_sale">Поддержка консультации</p>
            <p class="possibilities_sale_text">Если у вас возникнут вопросы или проблемы при работе с сайтом, вы всегда можете обратиться за помощью к специалистам Сбера.</p>
        </div>
        <div class="possibilities_block6">
            <p class="possibilities_sale">Фильтрация по критериям. </p>
            <p class="possibilities_sale_text">Можно фильтровать партнёров по различным критериям, например, местоположение, специализация и т.д.</p>
        </div>
    </div>

    <!-- <div class="comments">
        <p class="comments_title">Отзывы</p>
        <div class="comments_blocks">

        </div>
    </div> -->

<?php
    require 'templates/footer.php';
?>


<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/main.js"></script>
<script src="js/maps.js"></script>
<script src="js/card.js"></script>
</body>
</html> -->