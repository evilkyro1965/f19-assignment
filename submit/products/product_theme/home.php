<?php
/**
 * Template Name: Home
 */
get_header(); 

$filters = $_GET['filters'] != '' ? explode(",", $_GET['filters']) : null;

if(have_posts()) :
	the_post();
	$postId = $post->ID;
?>

<script>var currUrl = "<?php echo get_site_url(); ?>";</script>


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
								'hide_empty' => true,
								'orderby' => 'name'
							) 
						); 
						
						if($categories != null) {
							foreach($categories as $category) {
								
								$innerCategories = get_categories( 
									array( 
										'parent' => $category->term_id,
										'hide_empty' => true,
										'orderby' => 'name'
									) 
								);
								
								if($innerCategories != null) {
									echo '<h5 class="filterTitle">'.$category->name.'</h5>';
									echo '<ul class="filterList">';
									foreach($innerCategories as $innerCat) {
										$checked = "";
										if($filters!=null && in_array($innerCat->term_id, $filters)) {
											$checked = "CHECKED";
										}
										echo '<li><label><input type="checkbox" class="filterCheck" value="'.$innerCat->term_id.'" '.$checked.' />'.$innerCat->name.'</label></li>';
									}
									echo '</ul>';
								}
							}
						}
					?>
				</div>
				
				
				<div class="col-md-9 productGrid">
					
					<a id="removeFilters" class="btn btn-default btn-default" href="javascript:removeFilters();" role="button">Remove All Filter</a>
					
					<!-- Product Row -->
					<div class="row gridRow">
						
					<?php
						
						$productQueryArg = array('post_type' => PRODUCT_POST);
						if($filters!=null) {
							$filterString = $_GET['filters'];
							$productQueryArg['cat'] = $filterString;
						}
						$query = new WP_Query( $productQueryArg );
						
						if ( $query->have_posts() ) :
							while ( $query->have_posts() ) :
								$query->the_post();
								$productId = get_the_id();
								$price = get_post_meta( $productId, 'price' ) != null ? get_post_meta( $productId, 'price' )[0] : 0;
								
								$title = substr( get_the_title(), 0, 40 );
								$excerpt = substr( get_the_excerpt(), 0, 30 );
								$price = number_format($price, 2, '.', ',');
								
								$categories = get_the_category($productId);
								$postThumb = wp_get_attachment_url( get_post_thumbnail_id($productId) );
								$postThumb = $postThumb != null ? $postThumb : get_bloginfo("stylesheet_directory").'/i/small_placeholder.png';
					?>
						<!-- Product Item -->
						<div class="col-md-4 productItem">
							<div>
									<a href="javascript:;" class="productThumb">
										<img src="<?php echo $postThumb;?>" alt="Image"/>
									</a>
							</div>
							<a href="#" class="productTitle"><?php echo $title;?></a>
							<h5 class="productExcerpt"><?php echo $excerpt;?> $<?php echo $price;?></h5>
							<?php 
								if($categories != null) :
							?>
							<ul class="productList">
								<?php 
									foreach($categories as $index=>$category) : 
										if($index>=2) break;
								?>
								<li><?php echo $category->name;?></li>
								<?php endforeach; ?>
							</ul>
							<?php
								endif;
							?>
							<div>
								<a class="btn btn-default btn-default detailsLink" href="#" role="button">More Information</a>
							</div>
						</div>
						<!-- Product Item End -->
					<?php
							endwhile;
						endif;
					?>					
						
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