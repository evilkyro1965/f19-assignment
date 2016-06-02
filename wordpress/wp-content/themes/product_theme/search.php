<?php
/**
 * Template Name: Blog Page
 */
get_header(); 
$currPage = $_GET["page"] != "" ? (int) $_GET["page"] : 1;
$catId  = $cat;
$categoryObj = get_category( $catId );
$currUrl = curPageURL();
$postPerPage = get_option('posts_per_page');
$featuredCategoryId = getCategoryId("featured-blog");

$searchKey = $_GET["s"];
?>

	<!-- Content -->
	<div class="content">
		<div class="wrapper960 padding10">
			<!-- Two Column Layout -->
			<div class="twoColumnLayout">
				
				<div class="left">

					<h3 class="categoryPageTitle">Result for '<?php echo $searchKey;?>'</h3>
					<!-- Blog List -->
					<div class="blogList">
					<?php 
						wp_reset_query();
						$offset = ($currPage-1) * $postPerPage;
						$args = "post_type=post";
						$args .= "&posts_per_page=$postPerPage";
						$args .= "&s=$searchKey";
						$args .= "&offset=$offset";
						$args .= "&orderby=date&order=DESC";

						query_posts($args);
						if ( have_posts() ) :
							while ( have_posts() ) : 
								the_post();
								$postId = $post->ID;
								$excerpt = wrap_content($post->post_content,220, true,'\n\r','');
								$commentCount = wp_count_comments( $postId );
								$postDateObj = date_create_from_format('Y-m-d H:i:s', $post->post_date);
								if($postDateObj!=null) {
									$day = $postDateObj->format('d');
									$month = $postDateObj->format('M');
								}
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
					?>		
						<!-- Blog item -->
						<div class="blogItem">
							<div class="imageCaption">
							<?php if($image!=null) : ?>
								<img src="<?php echo $image[0];?>" alt="" width="220" height="145" />
							<?php else : ?>
								<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/i/512px-No_image_available.png" alt="" width="220" height="145" />
							<?php endif; ?>
								<div class="commentCount"><?php echo $commentCount->total_comments;?></div>
								<div class="captionBox"><?php echo $day;?> <?php echo $month;?></div>
							</div>
							
							<div class="contentBox">
								<a class="title link" href="<?php the_permalink();?>"><?php the_title();?></a>					
								<p class="cat">
								<?php 
									$arrCategory = get_the_category( $postId ); 
									$index = 0;
									if($arrCategory!=null) :
										foreach($arrCategory as $cat) :
											if($cat->cat_ID!=1) :
												$categoryLink = get_category_link( $cat->term_id );
												if($index>0) echo ", ";
												?>
													<a href="<?php echo $categoryLink;?>" class="link"><?php echo $cat->cat_name;?></a>
												<?php 			
											endif; 
											$index++; 
										endforeach; 
									endif;
								?>
								</p>
								<p class="excerpt">
									<?php echo $excerpt;?>
								</p>
							</div>
						</div>
						<!-- Blog item end -->
					<?php
							endwhile;
						endif;
					?>					
						
					</div>
					<!-- Blog List End -->
					
					<div class="postNavBox">
					<?php
						wp_reset_query();
						$args = array(
						   's' => $searchKey,
						   'post_type' => 'post',
						);
						$myquery = new WP_Query($args);

						$postCount = $myquery->found_posts;
						
						$pageCount = (int) ($postCount / $postPerPage);
						$pageCount+= $postCount % $postPerPage > 0 ? 1 : 0; 	
					?>
					<?php 
					if($currPage>1)  {	
						$prevPage =  $currPage - 1;
						$arrParam = array("page"=>$prevPage,"s"=>$searchKey);
						$navLink = add_query_arg($arrParam,$currUrl);
						echo "<a href='$navLink' class='newer link'>Newer Posts</a>";
					}
					?>
					<?php 
					if($currPage<$pageCount)  {	
						$nextPage = $currPage + 1;
						$arrParam = array("page"=>$nextPage,"s"=>$searchKey);
						$navLink = add_query_arg($arrParam,$currUrl);
						echo "<a href='$navLink' class='older link'>Older Posts</a>";
					}
					?>
					</div>
					
				</div>
				
				<div class="right">
					<?php get_sidebar(); ?>
					
				</div>
			
			</div>
			<!-- Two Column Layout End -->
		</div>
	</div>
	<!-- Content End -->

<?php 
	get_footer();
?>