<?php
get_header(); 

$categoryObj = get_category_by_slug( COMMUNITY_CAT );
$mainCatId = $categoryObj->term_id;
?>
<script>
$(document).ready( function(){
	$("#topMenu-<?php echo $mainCatId;?>").addClass("active");
	$("#topMobileMenu-<?php echo $mainCatId;?>").addClass("active");
	$("#footerMobileMenu-<?php echo $mainCatId;?>").addClass("active");
	$("#subMenu-<?php echo $mainCatId;?>").addClass("active");
	$("#subMenuMobile-<?php echo $mainCatId;?>").addClass("active");
});
</script>
<?php
$categorySlug = $_GET["categorySlug"] == "" ? "brandx" : $_GET["categorySlug"];
$categoryObj = get_category_by_slug( $categorySlug );
$catId = $categoryObj->term_id;

global $current_user;
get_currentuserinfo();

	$args = "post_type=post";
	$args .= "&posts_per_page=-1";
	$args .= "&cat=".$catId;

	$firstPost;
	
	query_posts($args);
	if ( have_posts() ) :
		the_post();
		$firstPost = $post;
	endif;
?>
    <div class="third none">
      <a href="javascript:;" class="close close-warning"></a>
      <div class="container">
        <span class="icon-top-arrow"></span>
        <a href="javascript:;" class="row-link">
          <span class="text-orange first-info font-14">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod laoreet.
          </span>
          <span class="pull-right info-time">12/06/2014  08:00 am</span>
        </a>
        <hr class="hr-third-border">
        <a href="javascript:;" class="row-link">
          <span class="text-orange font-14">
            Consectetur adipiscing elit. Aenean euismod bibendum laoreet amet elite consecteture.
          </span>
          <span class="pull-right info-time">12/06/2014  08:00 am</span>
        </a>
      </div>
      <!-- end .container -->
    </div>
    <!-- end .third -->
		
    <div class="crumbs">
      <div class="container">
        <p class="text-muted">
          <a href="javascript:;">Communities</a>
          >
          <a href="javascript:;"><?php echo $categoryObj->name;?></a>
          > <?php echo $firstPost->post_title; ?>
        </p>
      </div>
    </div>
    <!-- end .crumbs -->
    
    <div class="menu-list">
      <div class="container">
        <ul class="list-inline hidden-xs">
				<?php
					$items = wp_get_nav_menu_items( "submenu" ); 
					//print_r($items);
					if($items!=null)
					foreach($items as $menu) :
						$class= $menu->object_id == $postId ? "active" : "";
						if($menu->classes[0]=="dropdown-toggle") : 
				?>
					<li id="subMenu-<?php echo $menu->object_id;?>" class="<?php echo $class;?>">
            <div class="dropdown">
              <a data-toggle="dropdown" id="dropdownMenu1" class="dropdown-toggle" href="javascript:;">
                <?php echo $menu->title;?>
                <span class="caret"></span>
              </a>
            </div>
          </li>
				<?php
						else :
				?>
          <li id="subMenu-<?php echo $menu->object_id;?>" class="<?php echo $class;?>">
						<a href="<?php echo $menu->url;?>"><?php echo $menu->title;?></a>
					</li>
				<?php endif; ?>
				<?php endforeach;?>	
				<!--
          <li>
            <div class="dropdown">
              <a href="javascript:;" class="dropdown-toggle"  id="dropdownMenu1" data-toggle="dropdown">
                More
                <span class="caret"></span>
              </a>
            </div>
          </li>
				-->
        </ul>
                
          <div class="btn-group visible-xs">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
              Sub Menu <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
							<?php
								$items = wp_get_nav_menu_items( "submenu" ); 
								if($items!=null)
								foreach($items as $menu) :
									$class= $menu->object_id == $postId ? "active" : "";
							?>
								<li id="subMenuMobile-<?php echo $menu->object_id;?>" class="<?php echo $class;?>">
									<a href="<?php echo $menu->url;?>"><?php echo $menu->title;?></a>
								</li>
							<?php endforeach;?>	
            </ul>
            <div class="disable-warning">
              <a href="javascript:;" class="icon-warning"></a>
            </div>
          </div>          
          <!-- end single button -->
                  
      </div>
    </div>
    <!-- end .menu-list -->
    
    <div class="between">
      <div class="container">
        <h2 class="titles text-muted pull-left"><?php echo $firstPost->post_title; ?></h2>
        <ul class="list-unstyled share list-inline text-center pull-right">
          <li>
            <a href="javascript:;" class="icon-share">
              <i></i>Share
            </a>
          </li>
          <li>
            <a href="javascript:;" class="icon-like">
              <i></i>Like
            </a>
          </li>
          <li>
            <a href="javascript:;" class="icon-comment">
              <i></i>Comment
            </a>
          </li>
          <li>
            <a href="javascript:;" class="icon-bookmark">
              <i></i>Bookmark
            </a>
          </li>
          <li>
            <a href="javascript:;" class="icon-subscribe">
              <i></i>Subscribe
            </a>
          </li>
          <li>
            <a href="javascript:;" class="icon-subscribers">
              <i></i>Subscribers
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- end .between -->

    <div class="information">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-12 spacing-12">
          
            <div class="min-content panel panel-default">
              <div class="panel-body">
								<?php the_content();?>
              </div>
            </div>
            <!-- .min-content -->
						
            <?php  dynamic_sidebar('condensed-content-aggregator'); ?>
						<?php  dynamic_sidebar('community-blog-aggregator'); ?>
						<?php  dynamic_sidebar('google-drive-aggregator'); ?>

            
            <div class="comments panel panel-default">
              <div class="panel-body">
                <div class="infotitle">Comments</div>  
                <div id="comments-pagination">
                  <div class="pull-right">
                    <div class="title-right-page">
                      <a href="javascript:;" class="prev-btn">Prev</a>
                      <span class="pages">
                        <a href="javascript:;" class="active">1</a>
                        <a href="javascript:;">2</a>
                        <a href="javascript:;">3</a>
                      </span>
                      <a href="javascript:;" class="next-btn">Next</a>
                    </div>
                  </div>

                  <div class="page-content comments-current">       

									<?php
										$args = array(
											'status' => 'approve',
											'post_id' => $firstPost->ID // use post_id, not post_ID
										);
										$comments = get_comments($args);

										foreach($comments as $comment) :
											$postDateObj = date_create_from_format('Y-m-d H:i:s', $post->post_date);
											$dateStr = "";
											if($postDateObj!=null)
												$dateStr = $postDateObj->format('m/d/Y H:i a');
									?>
                    <div class="row-box">
                      <div class="avatar-box">
                        <img src="<?php bloginfo("stylesheet_directory");?>/i/user-avatar.png" class="img-circle" alt="Avatar">
                      </div>
                      <div class="texts-box">
                        <a href="javascript:;" class="font-14 title-link">
                          <?php echo $comment->comment_author; ?>
                        </a>
                        <p><?php echo $comment->comment_content; ?></p>
                        <p class="text-grey time"><?php echo $dateStr;?></p>                  
                        <div class="four-icons">
                          <ul class="list-inline text-muted">
                            <li class="icon-like">
                              <a href="javascript:;">500</a>
                            </li>
                            <li class="icon-comment">
                              <a href="javascript:;">12</a>
                            </li>
                          </ul>
                        </div>
                        <!-- end .four-icons -->
                      </div>
                    </div>
                    <!-- .row-box -->  									
									<?php
										endforeach;
									?>										
                  </div>
                  <!-- end .page-content -->          
                </div>
              </div>
            
              <div class="panel-footer">
								<form action="<?php bloginfo("siteurl");?>/wp-comments-post.php" method="post" id="commentform">
									<input name="author" id="author" value="<?php echo $current_user->data->user_nicename;?>" type="hidden">
									<input name="email" id="email" value="<?php echo $current_user->data->user_email;?>" type="hidden">
									<input name="comment_post_ID" value="<?php echo $firstPost->ID;?>" type="hidden">
									<input name="redirectTo" value="<?php echo curPageURL();?>" type="hidden" />
									
									<button id="comment-add-btn" class="btn btn-default green-btn">Post</button>
									<span class="input-box">
										<input type="text" name="comment" class="form-control placeholder-text" id="comment-value" value="Your comment">
									</span>
									
								</form>
              </div>
            </div>
            <!-- .comments -->
          </div>
          <!-- .col-xs-8 -->

          <aside class="col-md-4 col-sm-12 spacing-12">
            
            <div class="right-user-info">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="profile">
                    <img src="<?php bloginfo("stylesheet_directory");?>/i/user-avatar.png" alt="" class="img-circle">
                  </div>
                  <div class="info">
                    <h4 class="title-white">Page Owner</h4>
                    <div class="texts">
                      <strong>
                        <a href="javascript:;"><?php echo $current_user->data->user_nicename;?></a>
                      </strong>
                      <a href="mailto:<?php echo $current_user->data->user_email;?>"><?php echo $current_user->data->user_email;?></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- .right-user-info -->
            
            <div class="right-about panel panel-default">
              <div class="panel-body">
                <div class="infotitle">About</div>
                <img src="<?php bloginfo("stylesheet_directory");?>/i/img-about-1.png" alt="About">
                <p class="font-14 texts">
                  Lorem ipsum dolor sit amet, consectetuer adipi-
                  scing elit. Morbi commodo, ipsum sed pharetra 
                  gravida, orci magna rhoncus neque, id pulvinar 
                  odio lorem non turpis. Nullam sit amet enim. 
                  modo, lorem non turpis.
                </p>
              </div>
            </div>
            <!-- .right-about -->
                  
            <div class="right-sitemap panel panel-default">
              <div class="panel-body">
                <div class="infotitle">Sitemap</div>
                <hr class="hr-gray-border">
                <div class="tree tree-menu">
                  <div>
                    <span class="active tiltes">
                      <a href="javascript:;">Community Name</a>
                    </span>
                    <div class="true">
                      <span class="current">
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <div>
                        <span>
                        <a href="javascript:;">Sample Content page</a>
                        </span>
                        <span>
                        <a href="javascript:;">Sample Content page</a>
                        </span>
                      </div>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <div>
                        <span>
                        <a href="javascript:;">Sample Content page</a>
                        </span>
                      </div>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                    </div>
                    
                    <span class="tiltes">
                      <a href="javascript:;">Blogs</a>
                    </span>
                    <div>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <div>
                        <span>
                        <a href="javascript:;">Sample Content page</a>
                        </span>
                        <span>
                        <a href="javascript:;">Sample Content page</a>
                        </span>
                      </div>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <div>
                        <span>
                        <a href="javascript:;">Sample Content page</a>
                        </span>
                      </div>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                    </div>
                    
                    <span class="tiltes">
                      <a href="javascript:;">Discussions</a>
                    </span>
                    <div>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <div>
                        <span>
                        <a href="javascript:;">Sample Content page</a>
                        </span>
                        <span>
                        <a href="javascript:;">Sample Content page</a>
                        </span>
                      </div>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <div>
                        <span>
                        <a href="javascript:;">Sample Content page</a>
                        </span>
                      </div>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                    </div>
                    
                    <span class="tiltes">
                      <a href="javascript:;">Members</a>
                    </span>
                    <div>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <div>
                        <span>
                        <a href="javascript:;">Sample Content page</a>
                        </span>
                        <span>
                        <a href="javascript:;">Sample Content page</a>
                        </span>
                      </div>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <div>
                        <span>
                        <a href="javascript:;">Sample Content page</a>
                        </span>
                      </div>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                      <span>
                        <a href="javascript:;">Sample Content page</a>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- .right-sitemap -->
            
            <div class="right-members panel panel-default">
              <div class="panel-body">
                <div class="infotitle pull-left">Members(125)</div>
                <div class="pull-right">
                  <a href="javascript:;" class="icon-right-arrow">View All</a>
                </div>
                <div class="clearfix"></div>
                <hr class="hr-gray-border">
                <ul class="list-inline peoples">
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <img src="<?php bloginfo("stylesheet_directory");?>/i/avatar1-46x46.png" class="img-circle" alt="Avatar">
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- .right-members -->
                  
            <div class="right-lorem-ipsum panel panel-default">
              <div class="panel-body">
                <div class="infotitle">Lorem ipsum</div>
                <img src="<?php bloginfo("stylesheet_directory");?>/i/img-lorem-ipsum-1.png" alt="Lorem Ipsum">
                <p class="font-14 texts">
                  Lorem ipsum dolor sit amet, consectetuer adipi-
                  scing elit. Morbi commodo, ipsum sed pharetra 
                  gravida, orci magna rhoncus neque, id pulvinar 
                  odio lorem non turpis. Nullam sit amet enim. 
                  modo, lorem non turpis.
                </p>
              </div>
            </div>
            <!-- .lorem-ipsum -->
          </aside>
          <!-- .col-xs-4 -->
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </div>

<?php 
get_footer();
?>