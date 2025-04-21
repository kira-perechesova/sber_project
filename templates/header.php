<?php
$q = 'SELECT * FROM `project_menu` WHERE `parent_id` = 0 ORDER BY `sort`';
$res = mysqli_query($link, $q);
$menus = mysqli_fetch_all($res, MYSQLI_ASSOC);
//printR($menus);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$title?></title>
  <link rel="shortcut icon" href="img/map.png">
 <?php
  if(!empty($cssFile)){
  		echo $cssFile;
  }
  ?>
</head>
<body>

<header class="header">
        <!-- <div class="container"> -->
            <nav class="menu__desktop">
			<div class="container">
                <ul class="menu">
                <li class="menu__item"><a href="<?=DOMAIN?>">Главная</a></li>
				<?php
						foreach($menus as $menu){
							$curID = $menu['id'];
							$q = 'SELECT * FROM `project_menu` WHERE `parent_id` = '.$curID;
							$subMenu = mysqli_query($link, $q);
							$subMenu = mysqli_fetch_all($subMenu, MYSQLI_ASSOC);
							if(empty($subMenu)){
								echo "<li class=\"menu__item\"><a href=\"{$menu['href']}\">{$menu['title']}</a></li>";
							}
						}
						
					?>
					<?php
						if(!empty($_SESSION['login'])){
							echo '<li class="menu__item"><a href="profile.php">Профиль</a></li>';
							echo '<li class="menu__item"><a href="logout.php">Выход('.$_SESSION['login'].')</a></li>';
						}else{
							echo '<li class="menu__item"><a href="login.php">Вход</a></li>';
						}	
							
						if(!empty($_SESSION['admin'])){
							echo '<li class="menu__item"><a href="/project/admin/index.php">Админка('.$_SESSION['admin'].')</a></li>';
						}			
					?>
                </ul>
				</div>
            </nav>

            <nav class="menu__mobile">
                <div class="menu__inner">
                    <a href="<?=DOMAIN?>" class="home_page_mob">Главная страница</a>
                    <div class="menu__burger"><span>toggle menu</span></div>
                </div>
                    <ul class="menu">
                    <?php
						foreach($menus as $menu){
							$curID = $menu['id'];
							$q = 'SELECT * FROM `project_menu` WHERE `parent_id` = '.$curID;
							$subMenu = mysqli_query($link, $q);
							$subMenu = mysqli_fetch_all($subMenu, MYSQLI_ASSOC);
							if(empty($subMenu)){
								echo "<li class=\"menu__item\"><a href=\"{$menu['href']}\">{$menu['title']}</a></li>";
							}
						}
						
					?>
					<?php
						if(!empty($_SESSION['login'])){
							echo '<li class="menu__item"><a href="profile.php">Профиль</a></li>';
							echo '<li class="menu__item"><a href="logout.php">Выход('.$_SESSION['login'].')</a></li>';
						}else{
							echo '<li class="menu__item"><a href="login.php">Вход</a></li>';
						}	
							
						if(!empty($_SESSION['admin'])){
							echo '<li class="menu__item"><a href="/project/admin/index.php">Админка('.$_SESSION['admin'].')</a></li>';
						}			
					?>
                    </ul>
                
            </nav>
    </header>