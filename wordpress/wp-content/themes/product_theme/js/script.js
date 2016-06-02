$(document).ready(function () {
  var aMenuOneLi = $(".menu-one > li");
  var aMenuTwo = $(".menu-two");
  /*Accordion menus*/
  $(".menu-one > li > .header").each(function (i) {
    $(this).click(function () {
      if ($(aMenuTwo[i]).css("display") == "block") {
        $(aMenuTwo[i]).slideUp(300);
        $(aMenuOneLi[i]).removeClass("menu-show")
      } else {
        for (var j = 0; j < aMenuTwo.length; j++) {
          $(aMenuTwo[j]).slideUp(300);
          $(aMenuOneLi[j]).removeClass("menu-show");
        }
        $(aMenuTwo[i]).slideDown(300);
        $(aMenuOneLi[i]).addClass("menu-show")
      }
    });
  });
  
  $('#show-treemenu').children('.menu-two').css({'display':'block'})
     
  //set carousel
  $('#picture-scroll-box').bxCarousel({
		display_num: 5, 
		move: 1,    
		margin: 15,
		speed: 100,
	});

  //click on carousle prev/next buttons
  var carPosIndex=2;
  var is_working = false;
  $(".picture-scroll a").click(function(){
    if (!is_working)
    {
      var a=$(this);
      var length=$("#picture-scroll-box li").length-2;
			var curli=$("#picture-scroll-box li[class=active]");
			var index=curli.index();
			var largerDiv=$(".col-md-8.col-sm-12.spacing-12 .boxs").children();
			var preLi= curli.prev();
			var nextLi= curli.next();
			//click on prev button
			if (a.attr("class")=="prev")
			{
        is_working = true;
				setTimeout(function(){
					
					var list = $("#picture-scroll-box li");
					carPosIndex = $("#picture-scroll-box li:nth-child(4)").find(".index").val();
					console.log(carPosIndex);
					largerDiv.not(largerDiv.last()).addClass('none');
					$("#newsWrapper .large-"+carPosIndex).removeClass("none");
					$("#picture-scroll-box li").removeClass("active");
					$("#picture-scroll-box li:nth-child(4)").addClass("active");
					
				  is_working = false;
				},200);
			}
			
			//click on next button
			if (a.attr("class")=="next")
			{
        is_working = true;
        setTimeout(function(){
					
					var list = $("#picture-scroll-box li");
					carPosIndex = $("#picture-scroll-box li:nth-child(4)").find(".index").val();
					console.log(carPosIndex);
					largerDiv.not(largerDiv.last()).addClass('none');
					$("#newsWrapper .large-"+carPosIndex).removeClass("none");
					$("#picture-scroll-box li").removeClass("active");
					$("#picture-scroll-box li:nth-child(4)").addClass("active");
					
					is_working = false;
					
				},200);
			}
		}
	});

  /*mouse hover shiw pencil and trash icons*/
  $(".bookmark-list li").hover(function(){
	  $(this).find(".icon-bookmark-link").show();
  },function(){
		$(this).find(".icon-bookmark-link").hide();
  });

  /*click show bookmark list*/
  $(".li-bookmarks").click(function(){
	  $(this).css("border-bottom","1px solid #fff");
	 
    $(".bookmark-block").removeClass("overflow-visible");
    	  
	 $(".bookmark-block").slideToggle();


	  if($(".bookmark-block").is(":visible"))
	  {
	    setTimeout("$('.bookmark-block').addClass('overflow-visible')",800)
	  }
	  
	  
  });

  /*click on items in carousel*/
  $("#picture-scroll-box li").live("click", function(){
    var list = $("#picture-scroll-box li");
  
		var a=$(this);
		var length=$("#picture-scroll-box li").length-2;
		var curli=$("#picture-scroll-box li[class=active]");
		var index=curli.index();
		var largerDiv=$(".col-md-8.col-sm-12.spacing-12 .boxs").children();
		var preLi= curli.prev();
		var nextLi= curli.next();
			
    var clickIndex = list.index($(this));
		console.log(clickIndex);
		switch(clickIndex)
    {
			case 0:
        $('.bx_wrap .prev').click();
        setTimeout("$('.bx_wrap .prev').click()",400);
				setTimeout("$('.bx_wrap .prev').click()",800);
        break;
      case 1:
        $('.bx_wrap .prev').click();
        setTimeout("$('.bx_wrap .prev').click()",400);
        break;
      case 2:
        $('.bx_wrap .prev').click();
        break;
      case 3:
        break;
      case 4:
        $('.bx_wrap .next').click();
        break;
      case 5:
        $('.bx_wrap .next').click();
        setTimeout("$('.bx_wrap .next').click()",400);
        break;
			case 6:
        $('.bx_wrap .next').click();
        setTimeout("$('.bx_wrap .next').click()",400);
				setTimeout("$('.bx_wrap .next').click()",800);
        break;	
      default:
        break;
    }

  });
	
	var largerDiv=$(".col-md-8.col-sm-12.spacing-12 .boxs").children();
	var list = $("#picture-scroll-box li");
	carPosIndex = $("#picture-scroll-box li:nth-child(4)").find(".index").val();
	console.log(carPosIndex);
	largerDiv.not(largerDiv.last()).addClass('none');
	$("#newsWrapper .large-"+carPosIndex).removeClass("none");
	$("#picture-scroll-box li").removeClass("active");
	$("#picture-scroll-box li:nth-child(4)").addClass("active");
	
  /*click on warning icon*/
  $(".warning").click(function(){
	  $(".third").toggle();
	});
	



  /*show the dialog*/
  $(".add-bookmark").click(function(e){
	  $(".dialog").hide();
	  $(".dialog-add").toggle();
	  $(".in-title").val("");
	  $(".in-url").val("");
	  $(".ex-title").val("");
	  $(".ex-url").val("");
    $(".external2").css({"color":"#fff"});
    $(".intranet2").css({"color":"#fff"});
	  $(".intranet-form-add").show();
	  $(".intranet").addClass("active");
	  $(".intranet-arrow").show();
	  $(".external-arrow").hide();
	  $(".external").removeClass("active");
	  $(".external-form-add").hide();
	  return false;
  });
  $("body").click(function(){
       $(".bookmark-block .dialog-add").hide();
	   $(".bookmark-block .dialog").hide();
  });
  $(".bookmark-block .dialog-add,.bookmark-block .dialog").click(function(e){ return false;});

  $(".close-dialog").click(function(){
	  $(".dialog-add").hide();
  })
  
  $(".add-btn").click(function(){
	  $(".dialog").hide();
	  
	  if($(this).parents("form").hasClass("intranet-form-add"))
	  {
	    if($(".in-title-add").val().trim() != "")
	    {
	      var new_item = $(".intranet-pages ul li").eq(0).clone(true);
	      new_item.find("a.text-blue").html($(".in-title-add").val().trim());
	      
	      new_item.insertBefore($(".intranet-pages ul li").eq(0));
	    }
	  }
	  
	  if($(this).parents("form").hasClass("external-form-add"))
	  {
	    if($(".ex-title-add").val().trim() != "")
	    {
	      var new_item = $(".external-pages ul li").eq(0).clone(true);
	      new_item.find("a.text-blue").html($(".in-title-add").val().trim());
	      
	      new_item.insertBefore($(".external-pages ul li").eq(0));
	    }
	  }
  });
  
  $(".edit-btn").click(function(){
	  $(".dialog").hide();	  
  });
  
  //close waring
  $(".close-warning").click(function(){
    $(".third").hide();
  });
  
  //click intranet tab
  $(".intranet2").click(function(){
		$(this).addClass("active");
		$(".intranet-form-add").show();
		$(".intranet-arrow-add").show();
		$(".external-arrow-add").hide();
		$(".external2").removeClass("active");
		$(".external-form-add").hide();
	});
  
   //click external tab
  $(".external2").click(function(){
		$(this).addClass("active");
		$(".external-form-add").show(); 
		$(".intranet-arrow-add").hide();
		$(".external-arrow-add").show();
		$(".intranet2").removeClass("active");
		$(".intranet-form-add").hide();
	})
	
	 //click intranet tab
  $(".intranet").click(function(){
		$(this).addClass("active");
		$(".intranet-form").show();
		$(".intranet-arrow").show();
		$(".external-arrow").hide();
		$(".external").removeClass("active");
		$(".external-form").hide();
	});
	
	//click external tab
	$(".external").click(function(){
		$(this).addClass("active");
		$(".external-form").show(); 
		$(".intranet-arrow").hide();
		$(".external-arrow").show();
		$(".intranet").removeClass("active");
		$(".intranet-form").hide();
	})
	
  $(".close").click(function(){
	  $(".dialog").hide();
	  $(".dialog-add").hide();
  })
  
  $(".dialog").blur(function(){
	  $(this).hide();
  });
  
  //click intranet edit icon
  $(".in-pencil").click(function(){
    var indexOfLink = $(this).parents("li").parents("ul").find("li").index($(this).parents("li"));
    $(".dialog").css({"top":32});
    
    $(".dialog").insertAfter($(this).parent());
    
	  $(".dialog").show();
	  $(".dialog-add").hide();
	  $(".intranet").addClass("active");
		$(".intranet-form").show();
		$(".intranet-arrow").show();
		$(".external-arrow").hide();
		$(".external-form").hide();
		$('.external-edit').unbind("click"); 
		$('.external').css({"color":"#7EBD79"});
		$('.intranet').css({"color":"#fff"});
		$('.external').removeClass("active");
	  $(".in-title").val($(this).parent().prev().html());
	  $(".in-url").val($(this).parent().prev().attr("href"));
	  return false;
  });

  //click external edit icon
  $(".ex-pencil").click(function(){
    var indexOfLink = $(this).parents("li").parents("ul").find("li").index($(this).parents("li"));
    $(".dialog").css({"top":72+(indexOfLink)*30+"px"});
    
    $(".dialog").insertAfter($(this).parent());
    
		$(".dialog").show();
		$(".dialog-add").hide();
		$(".external").addClass("active");
		$(".external-form").show(); 
		$(".intranet-arrow").hide();
		$(".external-arrow").show();
		$('.intranet').removeClass("active");
		$(".intranet-form").hide();
		$('.intranet-edit').unbind("click"); 
		$('.intranet').css({"color":"#7EBD79"});
		$('.external').css({"color":"#fff"});
		$(".ex-title").val($(this).parent().prev().html());
	  $(".ex-url").val($(this).parent().prev().attr("href"));
	   return false;
  })
  
  $(".trash").click(function(){
    if($(this).parent().parent().find("div.dialog").length > 0)
    {
      $(this).parent().parent().find("div.dialog").eq(0).insertAfter($("div.intranet-pages span.bookmark-head"));
    }
	  $(this).parent().parent().remove();
  });

  if ($(window).width()<768) {   
	  if (!$(".navbar-collapse.collapse").hasClass("in")) {
		  $(".navbar-toggle").click(function(){
			 $(".bookmark-block").hide();				  
		  })
	  }   
   };

  /*click post comment button*/
  $("#comment-add-btn").click(function(){
    /*
		var item = $(".comments-current").find(".row-box").eq(0).clone(true);
    item.find(".texts-box p:eq(0)").html($("#comment-value").val());
	  item.insertBefore($(".comments-current").find(".row-box").eq(0));
	  
	  initCommentPagination();
		*/
  })

  $(".tiltes").click(function(){
	  
	  $(this).siblings().removeClass("active");
	  
	  if(!$(this).hasClass("open"))
	  {
	    $(this).addClass("active");
	  }
	  else
	  {
	    $(this).removeClass("active");
	  }
  })
  
  //placeholder text of Post Comment input
  $("#comment-value").focus(function(){
    if(($("#comment-value").val() == "Your comment") && $("#comment-value").hasClass("placeholder-text"))
    {
      $("#comment-value").val("");
      $("#comment-value").removeClass("placeholder-text");
    }
  });
  
  $("#comment-value").blur(function(){
    if($("#comment-value").val() == "")
    {
      $("#comment-value").val("Your comment");
      $("#comment-value").addClass("placeholder-text");
    }
  });
  
  /*click tree menu items*/
  $(".tree-menu div div span").click(function(){
	  $(this).parents().find(".current").removeClass("current");
	  $(this).parents(".tree-menu").find(".active").removeClass("active");
	  $(this).addClass("current");
	  

    var flag = true;
    var node = $(this);
    while(flag)
    {
      if(node.parent().prev().hasClass("folder") && (!node.parent().prev().hasClass("tiltes")))
      {
        node.parent().prev().addClass("current");
        node = node.parent().prev();
      }
      
      if(node.parent().prev().hasClass("folder") && (node.parent().prev().hasClass("tiltes")))
      {
        node.parent().prev().addClass("active");
        flag = false;
      }
    }	  
  })

  /*init tree menu items*/
  if($(".tree").length>0)
  {
    $(".tree").SimpleTree({
		  click:function(a){
			  if(!$(a).attr("hasChild"))
				  alert($(a).attr("ref"));
		    }
    });
  }

  //set blog section pagination
  $("#blog-pagination .title-right-page .prev-btn,#blog-pagination .title-right-page .next-btn").hide();
  $("#blog-pagination .title-right-page .pages").empty();
  var tbLen=$("#blog-pagination table").length;
  if(tbLen>0)
	{
	  var span=$("#blog-pagination .title-right-page .pages");
	  var tables=$("#blog-pagination table");
    tables.hide();
	  tables.first().show();
    for(var i=0;i<tbLen;i++)
    {
      var a=$("<a href=\"javascript:;\"></a>");
      a.text(i+1);
		  if(i==0) a.addClass("active");
        span.append(a);
    }
	    
	  if(tbLen>1)
	    $("#blog-pagination .title-right-page .next-btn").show();
	    
    var a=span.find("a");
    
    a.click(function(){
      var pA=$(this).prev();
	    var nA=$(this).next();
	    $("#blog-pagination .title-right-page .pages").find("a").removeAttr("class");
	    $(this).addClass("active");
	    if(pA.length==0) $("#blog-pagination .title-right-page .prev-btn").hide(); else  $("#blog-pagination .title-right-page .prev-btn").show();
	    if(nA.length==0) $("#blog-pagination .title-right-page .next-btn").hide(); else  $("#blog-pagination .title-right-page .next-btn").show();
      tables.hide();
      tables.eq($(this).index()).show();
    });

    $("#blog-pagination .title-right-page .next-btn").click(function(){
      var a= $("#blog-pagination .title-right-page .pages").find("a[class=active]");
	    a.next().click();
    });

    $("#blog-pagination .title-right-page .prev-btn").click(function(){
      var a= $("#blog-pagination .title-right-page .pages").find("a[class=active]");
	    a.prev().click();
    });
  }

  //set comments section pagination
  function initCommentPagination(){
    $("#comments-pagination .title-right-page .prev-btn,#comments-pagination .title-right-page .next-btn").hide();
    $("#comments-pagination .title-right-page .pages").empty();
    var rBoxLen=$("#comments-pagination .page-content.comments-current .row-box").length;
    var rPage=Math.ceil(rBoxLen/4);
    if(rPage>0)
    {
      $("#comments-pagination .page-content.comments-current .row-box").show();
      $("#comments-pagination .page-content.comments-current .row-box:gt(3)").hide();
      var span=$("#comments-pagination .title-right-page .pages");
      
	    for(var i=0;i<rPage;i++)
	    {
        var a=$("<a href=\"javascript:;\"></a>");
	      a.text(i+1);
	      if(i==0) a.addClass("active");
          span.append(a);
	    }
  	  
	    if(rPage>1)
	      $("#comments-pagination .title-right-page .next-btn").show();
  	  
	    var a=span.find("a");
      a.click(function(){
		    var pA=$(this).prev();
		    var nA=$(this).next();
		    $("#comments-pagination .title-right-page .pages").find("a").removeAttr("class");
		    $(this).addClass("active");
  			
		    if(pA.length==0)
		      $("#comments-pagination .title-right-page .prev-btn").hide();
		    else
		      $("#comments-pagination .title-right-page .prev-btn").show();
  			
		    if(nA.length==0)
		      $("#comments-pagination .title-right-page .next-btn").hide();
		    else
		      $("#comments-pagination .title-right-page .next-btn").show();
  		    
	      $("#comments-pagination .page-content.comments-current .row-box").hide();
	      var i=$(this).index();
  		  
		    if(i>0)
		      $("#comments-pagination .page-content.comments-current .row-box:lt("+(i+1)*4+"):gt("+((i*4)-1)+")").show();
	      else
		      $("#comments-pagination .page-content.comments-current .row-box:lt(4)").show();  	
	    });
    }
  }
  
  //comment section,click on next button
  $("#comments-pagination .title-right-page .next-btn").click(function(){
    var a= $("#comments-pagination .title-right-page .pages").find("a[class=active]");
    a.next().click();
  });

  //comment section,click on prev button
  $("#comments-pagination .title-right-page .prev-btn").click(function(){
    var a= $("#comments-pagination .title-right-page .pages").find("a[class=active]");
    a.prev().click();
  });
  
  initCommentPagination();
});