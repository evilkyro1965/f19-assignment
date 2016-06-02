<?php
/**
 * Template Name: Home
 */
get_header(); 

global $current_user;
get_currentuserinfo();

if(have_posts()) :
	the_post();
	$postId = $post->ID;
?>


	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Project name</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container">

		<div class="mainWrapper">
			
			<div class="row">
				<div class="col-md-3">
					<?php
						$idObj = get_category_by_slug('product'); 
						$parentId = $idObj->term_id;
						$categories = get_categories( 
							array( 
								'parent' => $parentId,
								'hide_empty' => false,
								'orderby' => 'name'
							) 
						); 
						
						if($categories != null) {
							foreach($categories as $category) {
								echo $category->name."</br>";
								
								$innerCategories = get_categories( 
									array( 
										'parent' => $category->term_id,
										'hide_empty' => false,
										'orderby' => 'name'
									) 
								);
								
								if($innerCategories != null) {
									foreach($innerCategories as $innerCat) {
										echo $innerCat->name."</br>";
									}
								}
							}
						}
					?>
				</div>
				
				
				<div class="col-md-9 productGrid">
					
					<!-- Product Row -->
					<div class="row gridRow">
						
					<?php
						
						$productQueryArg = array('post_type' => PRODUCT_POST);
						$query = new WP_Query( $productQueryArg );
						
						if ( $query->have_posts() ) :
							while ( $query->have_posts() ) :
								$query->the_post();
								$productId = get_the_id();
								$price = get_post_meta( $productId, 'price' ) != null ? get_post_meta( $productId, 'price' )[0] : 0;
								
								$title = substr( get_the_title(), 0, 40 );
								$excerpt = substr( get_the_excerpt(), 0, 30 );
								$price = number_format($price, 2, '.', ',');
					?>
						<!-- Product Item -->
						<div class="col-md-4 productItem">
							<div>
									<a href="javascript:;" class="productThumb">
										<img src="<?php bloginfo("stylesheet_directory");?>/i/small_placeholder.png" alt="Image"/>
									</a>
							</div>
							<a href="#" class="productTitle"><?php echo $title;?></a>
							<h5 class="productExcerpt"><?php echo $excerpt;?> $<?php echo $price;?></h5>
							<ul class="productList">
								<li>USP 1</li>
								<li>USP 2</li>
								<li>USP 3</li>
							</ul>
							<div>
								<a class="btn btn-default btn-default detailsLink" href="#" role="button">More Information</a>
							</div>
						</div>
						<!-- Product Item End -->
					<?php
							endwhile;
						endif;
					?>					
						<!-- Product Item -->
						<div class="col-md-4 productItem">
							<div>
									<a href="javascript:;" class="productThumb">
										<img src="<?php bloginfo("stylesheet_directory");?>/i/small_placeholder.png" alt="Image"/>
									</a>
							</div>
							<a href="#" class="productTitle">Title Display</a>
							<h5 class="productExcerpt">CTOUCH Laser Vanaf $2.999,-</h5>
							<ul class="productList">
								<li>USP 1</li>
								<li>USP 2</li>
								<li>USP 3</li>
							</ul>
							<div>
								<a class="btn btn-default btn-default detailsLink" href="#" role="button">More Information</a>
							</div>
						</div>
						<!-- Product Item End -->
						
						<!-- Product Item -->
						<div class="col-md-4 productItem">
							<div>
									<a href="javascript:;" class="productThumb">
										<img src="<?php bloginfo("stylesheet_directory");?>/i/small_placeholder.png" alt="Image"/>
									</a>
							</div>
							<a href="#" class="productTitle">Title Display</a>
							<h5 class="productExcerpt">CTOUCH Laser Vanaf $2.999,-</h5>
							<ul class="productList">
								<li>USP 1</li>
								<li>USP 2</li>
								<li>USP 3</li>
							</ul>
							<div>
								<a class="btn btn-default btn-default detailsLink" href="#" role="button">More Information</a>
							</div>
						</div>
						<!-- Product Item End -->
						
						<!-- Product Item -->
						<div class="col-md-4 productItem">
							<div>
									<a href="javascript:;" class="productThumb">
										<img src="<?php bloginfo("stylesheet_directory");?>/i/small_placeholder.png" alt="Image"/>
									</a>
							</div>
							<a href="#" class="productTitle">Title Display</a>
							<h5 class="productExcerpt">CTOUCH Laser Vanaf $2.999,-</h5>
							<ul class="productList">
								<li>USP 1</li>
								<li>USP 2</li>
								<li>USP 3</li>
							</ul>
							<div>
								<a class="btn btn-default btn-default detailsLink" href="#" role="button">More Information</a>
							</div>
						</div>
						<!-- Product Item End -->
						
					</div>
					<!-- Product Row -->
					
				</div>
				
				
			</div>
			
		</div>

	</div><!-- /.container -->

<?php 
endif;
get_footer();
?>