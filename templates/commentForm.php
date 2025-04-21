<form action="addComment.php" method="post">
	<h1>Оставить отзыв</h1>
	<textarea name="comment" id="com" class="form-control" placeholder="Ваш отзыв..." required></textarea>
	<input type="hidden" name="page_id" value="<?=$page[0]['id']?>">
	<input type="hidden" name="page_url" value="<?=$page[0]['url']?>">

	<div class="stars_partner">
    
	<section>
		<input type="radio" name="rate" id="star-5" value="5">
		<label for="star-5">
			<svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M15 3.23607L17.4167 10.6738L17.6412 11.3647H18.3677H26.1882L19.8613 15.9615L19.2735 16.3885L19.498 17.0795L21.9147 24.5172L15.5878 19.9205L15 19.4934L14.4122 19.9205L8.08533 24.5172L10.502 17.0795L10.7265 16.3885L10.1387 15.9615L3.81184 11.3647H11.6323H12.3588L12.5833 10.6738L15 3.23607Z" fill="#FFCF0E" stroke="black" stroke-width="2"/>
			</svg>
		</label>
		<input type="radio" name="rate" id="star-4" value="4">
		<label for="star-4">
			<svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M15 3.23607L17.4167 10.6738L17.6412 11.3647H18.3677H26.1882L19.8613 15.9615L19.2735 16.3885L19.498 17.0795L21.9147 24.5172L15.5878 19.9205L15 19.4934L14.4122 19.9205L8.08533 24.5172L10.502 17.0795L10.7265 16.3885L10.1387 15.9615L3.81184 11.3647H11.6323H12.3588L12.5833 10.6738L15 3.23607Z" fill="#FFCF0E" stroke="black" stroke-width="2"/>
			</svg>
		</label>
		<input type="radio" name="rate" id="star-3" value="3">
		<label for="star-3">
			<svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M15 3.23607L17.4167 10.6738L17.6412 11.3647H18.3677H26.1882L19.8613 15.9615L19.2735 16.3885L19.498 17.0795L21.9147 24.5172L15.5878 19.9205L15 19.4934L14.4122 19.9205L8.08533 24.5172L10.502 17.0795L10.7265 16.3885L10.1387 15.9615L3.81184 11.3647H11.6323H12.3588L12.5833 10.6738L15 3.23607Z" fill="#FFCF0E" stroke="black" stroke-width="2"/>
			</svg>
		</label>
		<input type="radio" name="rate" id="star-2" value="2">
		<label for="star-2">
			<svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M15 3.23607L17.4167 10.6738L17.6412 11.3647H18.3677H26.1882L19.8613 15.9615L19.2735 16.3885L19.498 17.0795L21.9147 24.5172L15.5878 19.9205L15 19.4934L14.4122 19.9205L8.08533 24.5172L10.502 17.0795L10.7265 16.3885L10.1387 15.9615L3.81184 11.3647H11.6323H12.3588L12.5833 10.6738L15 3.23607Z" fill="#FFCF0E" stroke="black" stroke-width="2"/>
			</svg>
		</label>
		<input type="radio" name="rate" id="star-1" value="1">
		<label for="star-1">
			<svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M15 3.23607L17.4167 10.6738L17.6412 11.3647H18.3677H26.1882L19.8613 15.9615L19.2735 16.3885L19.498 17.0795L21.9147 24.5172L15.5878 19.9205L15 19.4934L14.4122 19.9205L8.08533 24.5172L10.502 17.0795L10.7265 16.3885L10.1387 15.9615L3.81184 11.3647H11.6323H12.3588L12.5833 10.6738L15 3.23607Z" fill="#FFCF0E" stroke="black" stroke-width="2"/>
			</svg>
		</label>
	</section>

	<select id="soflow-color" name="partner">
  		<option disabled selected>Выберите партнёра</option>
		<option value="partner_dodo">Додо пицца</option>
		<option value="partner_apple_gold">Золотое яблоко</option>
	</select>
	</div>

	<button type="submit" class="send_comment_button">Отправить</button>
</form>
        