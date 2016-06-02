<?php
get_header(); 

global $current_user;
get_currentuserinfo();

if ( have_posts() ) :
	the_post();
	$firstPost = $post;
?>

    <div class="crumbs">
      <div class="container">
        <p class="text-muted">
          <a href="javascript:;">Blogs</a>
          > <?php echo $firstPost->post_title; ?>
        </p>
      </div>
    </div>
    <!-- end .crumbs -->
    
    <div class="menu-list">
      <div class="container">
        <ul class="list-inline hidden-xs">
          <li class="active">
            <a href="javascript:;">Home</a>
          </li>
          <li>
            <a href="javascript:;">Blogs</a>
          </li>
          <li>
            <a href="javascript:;">Discussions</a>
          </li>
          <li>
            <a href="javascript:;">Members</a>
          </li>
          <li>
            <div class="dropdown">
              <a href="javascript:;" class="dropdown-toggle"  id="dropdownMenu1" data-toggle="dropdown">
                More
                <span class="caret"></span>
              </a>
            </div>
          </li>
        </ul>
                
          <div class="btn-group visible-xs">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
              Sub Menu <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li class="active"><a href="javascript:;">Home</a></li>
              <li><a href="javascript:;">Blogs</a></li>
              <li><a href="javascript:;">Discussions</a></li>
              <li><a href="javascript:;">Members</a></li>
              <li><a href="javascript:;">More</a></li>
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


          </aside>
          <!-- .col-xs-4 -->
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </div>

<?php 
	endif;
get_footer();
?>