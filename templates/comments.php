<?php
if(!empty($_SESSION['id'])){
    require 'commentForm.php';
} else {
    echo '<div class="com_href">
            Чтобы оставить комментарий - <a href="login.php">Войдите на сайт</a>
          </div>';
}
?>

<form action="" method="post" class="form_sort">
	<div class="sorted">
    <select id="soflow-color" name="partner">
        <option disabled selected>Сортировать по партнёру</option>
        <option value="all">Все</option>
        <option value="partner_dodo">Додо пицца</option>
        <option value="partner_apple_gold">Золотое яблоко</option>
    </select>
	<button id="sorted_button">
		<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-sort-down-alt" viewBox="0 0 16 16">
  		<path d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5"/>
		</svg>
	</button>
	</div>
</form>

<div class="all_comments_container">
    <?php
    if(empty($_POST['partner']) || $_POST['partner'] == 'all'){
        foreach(getComments($link, $page[0]['id']) as $c){
            echo '<div class="comment_container">
                    <span>'.$c['login'].'</span>
                    <small>'.$c['date'].'</small>

                    <div class="comment_stars">';
            
            for($i = 0; $i < $c['stars']; $i++){
                echo '<svg width="26" height="26" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 3.23607L17.4167 10.6738L17.6412 11.3647H18.3677H26.1882L19.8613 15.9615L19.2735 16.3885L19.498 17.0795L21.9147 24.5172L15.5878 19.9205L15 19.4934L14.4122 19.9205L8.08533 24.5172L10.502 17.0795L10.7265 16.3885L10.1387 15.9615L3.81184 11.3647H11.6323H12.3588L12.5833 10.6738L15 3.23607Z" fill="#FFCF0E" stroke="black" stroke-width="2"/>
                      </svg>';
            }
            if($c['stars'] != 5){
                for($i = 0; $i < 5 - $c['stars']; $i++){
                    echo '<svg width="26" height="26" viewBox="0 0 30 28" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 3.23607L17.4167 10.6738L17.6412 11.3647H18.3677H26.1882L19.8613 15.9615L19.2735 16.3885L19.498 
                            17.0795L21.9147 24.5172L15.5878 19.9205L15 19.4934L14.4122 19.9205L8.08533 24.5172L10.502 17.0795L10.7265 
                            16.3885L10.1387 15.9615L3.81184 11.3647H11.6323H12.3588L12.5833 10.6738L15 3.23607Z" fill="#fff" stroke="black" stroke-width="2"/>
                          </svg>';
                }
            }
            echo '</div>
                  <div class="comment_body">
                      <p class="comment_text">'.$c['comment'].'</p>
                  </div>
                  </div>';
        }
    } elseif($_POST['partner'] == 'partner_dodo') {
        foreach(getComments($link, $page[0]['id']) as $c){
			if($c['partner'] == 'partner_dodo'){
				echo '<div class="comment_container">
						<span>'.$c['login'].'</span>
						<small>'.$c['date'].'</small>

						<div class="comment_stars">';
				
				for($i = 0; $i < $c['stars']; $i++){
					echo '<svg width="26" height="26" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M15 3.23607L17.4167 10.6738L17.6412 11.3647H18.3677H26.1882L19.8613 15.9615L19.2735 16.3885L19.498 17.0795L21.9147 24.5172L15.5878 19.9205L15 19.4934L14.4122 19.9205L8.08533 24.5172L10.502 17.0795L10.7265 16.3885L10.1387 15.9615L3.81184 11.3647H11.6323H12.3588L12.5833 10.6738L15 3.23607Z" fill="#FFCF0E" stroke="black" stroke-width="2"/>
						</svg>';
				}
				if($c['stars'] != 5){
					for($i = 0; $i < 5 - $c['stars']; $i++){
						echo '<svg width="26" height="26" viewBox="0 0 30 28" fill="#fff" xmlns="http://www.w3.org/2000/svg">
								<path d="M15 3.23607L17.4167 10.6738L17.6412 11.3647H18.3677H26.1882L19.8613 15.9615L19.2735 16.3885L19.498 
								17.0795L21.9147 24.5172L15.5878 19.9205L15 19.4934L14.4122 19.9205L8.08533 24.5172L10.502 17.0795L10.7265 
								16.3885L10.1387 15.9615L3.81184 11.3647H11.6323H12.3588L12.5833 10.6738L15 3.23607Z" fill="#fff" stroke="black" stroke-width="2"/>
							</svg>';
					}
				}
				echo '</div>
					<div class="comment_body">
						<p class="comment_text">'.$c['comment'].'</p>
					</div>
					</div>';
			}
        }
    }elseif($_POST['partner'] == 'partner_apple_gold') {
        foreach(getComments($link, $page[0]['id']) as $c){
			if($c['partner'] == 'partner_apple_gold'){
				echo '<div class="comment_container">
						<span>'.$c['login'].'</span>
						<small>'.$c['date'].'</small>

						<div class="comment_stars">';
				
				for($i = 0; $i < $c['stars']; $i++){
					echo '<svg width="26" height="26" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M15 3.23607L17.4167 10.6738L17.6412 11.3647H18.3677H26.1882L19.8613 15.9615L19.2735 16.3885L19.498 17.0795L21.9147 24.5172L15.5878 19.9205L15 19.4934L14.4122 19.9205L8.08533 24.5172L10.502 17.0795L10.7265 16.3885L10.1387 15.9615L3.81184 11.3647H11.6323H12.3588L12.5833 10.6738L15 3.23607Z" fill="#FFCF0E" stroke="black" stroke-width="2"/>
						</svg>';
				}
				if($c['stars'] != 5){
					for($i = 0; $i < 5 - $c['stars']; $i++){
						echo '<svg width="26" height="26" viewBox="0 0 30 28" fill="#fff" xmlns="http://www.w3.org/2000/svg">
								<path d="M15 3.23607L17.4167 10.6738L17.6412 11.3647H18.3677H26.1882L19.8613 15.9615L19.2735 16.3885L19.498 
								17.0795L21.9147 24.5172L15.5878 19.9205L15 19.4934L14.4122 19.9205L8.08533 24.5172L10.502 17.0795L10.7265 
								16.3885L10.1387 15.9615L3.81184 11.3647H11.6323H12.3588L12.5833 10.6738L15 3.23607Z" fill="#fff" stroke="black" stroke-width="2"/>
							</svg>';
					}
				}
				echo '</div>
					<div class="comment_body">
						<p class="comment_text">'.$c['comment'].'</p>
					</div>
					</div>';
			}
        }
	}
    ?>
</div>