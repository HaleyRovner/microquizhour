<?php
class templates{
	function __construct($mysql){
		$this->mysql = $mysql;
	}
	function home(){
		$mysql = $this->mysql;
	?>
	<header class = "masthead text-center text-white">
		<div class = "masthead-content">
			<h1 class="masthead-heading mb-0">Micro Quiz Hour</h1>
			<h2 class="masthead-subheading mb-0">Brought to You by Nanomaterials Chemistry</h2>
			<h4 class="masthead-subheading mb-0" id="points" style="font-size: 30pt"></h4>
		</div><!--masthead-content close-->
	</header><!--header close-->
	<div class="container">
		<div class="game">
			<div class="row">
					<!--could create a function here that would select id, name from categories order by id and then would loop through answers and then would populate headings and then inside that loop could put buttons loop inside of that-->
					<?php
						$categories = $mysql->getCategories(); //gets all of the category names 
						foreach($categories as $category){ //cycles through all of the categories
						?>
							<div class="column">
						<?php
							$categoryName = $category['name']; 
							$categoryId = $category['id'];
						?>
							<h3><?=$categoryName?></h3> 
						<?php
							$buttons = $mysql->getButtonInfo($categoryId); //button info gets the item info for each tile
							$info = $buttons[0];

							 

							foreach($buttons as $button){
								$imageId = $button['imageId'];
								$overlay = $mysql->getOverlayImage($imageId); //will get the overlay image for each tile
								$image = $overlay[0];
								$overlayImage = $image['overlay_img'];
								?>
								<button type="button" class="btn btn-primary jeopardy" data-toggle="modal" data-target="#example" data-id="<?=$imageId?>"><img src="../images/<?=$overlayImage?>"></button>
							<?php
							
							}
							?>
							</div> <!--closes column-->
							<?php
						}//end of outer foreach 
					?>
			</div><!--row close-->
			<div class="modal" tabindex="-1" role="dialog" id="example">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
								
					</div>
				</div>
			</div>
		</div><!--game close-->
	</div><!--container close-->
<?php
	}
}
?>
