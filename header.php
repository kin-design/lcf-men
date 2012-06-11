<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'lcfmen' ), max( $paged, $page ) );

	?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />


<?php 
function using_ie(){
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $ub = false;
    if(preg_match('/MSIE/i',$u_agent))
    {
        $ub = true;
    }
   
    return $ub;
} 



include("Mobile_Detect.php");
$detect = new Mobile_Detect();

//if ($detect->isMobile() || using_ie()) {
if ($detect->isMobile()) {
    // any mobile platform
}else{ ?>
    <link rel="stylesheet" media="all" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bg.css">
<?php } ?>

<script type="text/javascript">

function fBuildNav(active,totes){
	var i=1;
	var txt="<a style='text-decoration:none' href='javascript:fLoadPreviousClip();'><</a> ";
	
     for (i=1;i<=totes;i++){
	   if(i == active){
	     txt=txt+"<a style='text-decoration:underline' href='javascript:fLoadClip("+n[i-1]+","+i+","+totes+")'>"+i+"</a> ";
	   }else{
	     txt=txt+"<a style='text-decoration:none' href='javascript:fLoadClip("+n[i-1]+","+i+","+totes+")'>"+i+"</a> ";
	   }
	 }
	 
	var txt=txt+" <a style='text-decoration:none' href='javascript:fLoadNextClip();'>></a>";
	
	var div=document.getElementById("nav");
    div.innerHTML=txt;
}


var n = new Array();
function fAddToClipsArray(id){
    n.push(id);
}

var c = new Array();
function fAddToCaptionsArray(cap){
    c.push(cap);
}


var clipNum=0;
var clipTotes=0;

function fLoadClip(clipID,num,t){
  clipTotes = t;
  if(clipNum==0){
    clipNum=1;
  } else{
    clipNum = num;
  }
  
  var txt=document.getElementById("videoclip")
  txt.innerHTML="<center><div style='border: solid 10px #FFFFFF; width:580px; height:326px'><iframe src='http://player.vimeo.com/video/"+n[clipNum-1]+"?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff' width='580' height='326' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div><br>"+c[clipNum-1]+"</center>";
  
  fBuildNav(clipNum,clipTotes);
}

function fLoadNextClip(){
   if (clipNum < clipTotes){
     clipNum++;
   }else{
      clipNum = 1;
   }
  var txt=document.getElementById("videoclip")
  txt.innerHTML="<center><div style='border: solid 10px #FFFFFF; width:580px; height:326px'><iframe src='http://player.vimeo.com/video/"+n[clipNum-1]+"?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff' width='580' height='326' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div><br>"+c[clipNum-1]+"</center>";
  
  fBuildNav(clipNum,clipTotes);
}

function fLoadPreviousClip(){
   if (clipNum > 1){
     clipNum--;
   }else{
      clipNum = clipTotes;
   }
  var txt=document.getElementById("videoclip")
  txt.innerHTML="<center><div style='border: solid 10px #FFFFFF; width:580px; height:326px'><iframe src='http://player.vimeo.com/video/"+n[clipNum-1]+"?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff' width='580' height='326' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div><br>"+c[clipNum-1]+"</center>";
  
  fBuildNav(clipNum,clipTotes);
}


function fBuildImgNav(active,totes){
	var i=1;
	
	
	var txt="<center style='color:#FFFFFF;'><a style='color:#FFFFFF;text-decoration:none' href='javascript:onclick=changeStackOrder(-1,totes);'><</a>  ";
	
     for (i=1;i<=totes;i++){
	   if(i == active){
	     txt=txt+"<a style='color:#FFFFFF;text-decoration:underline' href='javascript:onclick=changeStackOrder("+i+",totes);'>"+i+"</a>  ";
	   }else{
	     txt=txt+"<a style='color:#FFFFFF;text-decoration:none' href='javascript:onclick=changeStackOrder("+i+",totes);'>"+i+"</a>  ";
	   }
	 }
	 
	var txt=txt+" <a style='color:#FFFFFF;text-decoration:none' href='javascript:onclick=changeStackOrder(500,totes);'>></a></center>";
	
	var div=document.getElementById("imgnav");
    div.innerHTML=txt;
	
	
}


function fHideDiv(s){
    document.getElementById(s).style.visibility='hidden';
}

function fShowDiv(s){
    var vis = document.getElementById(s).style.visibility;
	if(vis=='hidden'){
      document.getElementById(s).style.visibility='visible';
	}else{
	  document.getElementById(s).style.visibility='hidden';
	}
}



  var imgNum = 1;
  var totes = 0;
  
function changeStackOrder(n,t){

   totes = t;
   //alert(n +' '+ t +' '+ totes);
   if(n==500 || n== -1){
     if(n==500){
	   //alert (imgNum + ' ' + totes);
	   if(imgNum < totes){
	     imgNum++;
		 fUpDateImgs(imgNum,totes);
		}else{
		 imgNum = 1;
		 fUpDateImgs(imgNum,totes);
	   }
	 }else{
	    //alert (imgNum + ' ' + totes);
	   if(imgNum > 1){
	     imgNum--;
		 fUpDateImgs(imgNum,totes);
		}else{
		 imgNum = totes;
		 fUpDateImgs(imgNum,totes);
	   }
	 }
  }else{
  
    fUpDateImgs(n,t);
    
	
  }
  
  fBuildImgNav(imgNum,totes);
}

function fUpDateImgs(n,t){
     var i=1;
     for (i=1;i<=20;i++){
   
      var El = document.getElementById('img'+i);
      if (El != null){
         document.getElementById('img'+i).style.zIndex=(1000-i).toString();
		 document.getElementById('img'+i).style.visibility='hidden';
	  }
     }
	  
	 myObject = document.getElementById('img'+n);
	
	 if (myObject != null || myObject != undefined) {
	   myObject.style.zIndex="3000";
       myObject.style.visibility='visible';
	 }
	 imgNum = n;
	  
	  
}

</script>


<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body onLoad="fUpDateImgs(1,1);" <?php body_class(); ?>>

<div id="cadreT"></div>
<div id="cadreR"></div>
<div id="cadreB"></div>
<div id="cadreL"></div>



<div id="bg" style="z-index:-1;">
  <div>
<table cellpadding="0" cellspacing="0"><tbody><tr><td>

<?php if(is_page('Event')){ ?>
  <img style="width: 1024px;" alt="" src="<?php bloginfo('template_directory'); ?>/images/event-bg02.jpg">
<?php } else if(is_page('Homepage') || is_page('PRESS') || is_page('Menswear at LCF') ){ ?>
  <img style="width: 1024px;" alt="" src="<?php bloginfo('template_directory'); ?>/images/bg0<?php echo rand(1, 3);?>.jpg">
<?php } ?>

</td></tr></tbody></table>
  </div>
</div>





<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
			<div id="branding" role="banner">
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<?php
					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() && current_theme_supports( 'post-thumbnails' ) &&
							has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= HEADER_IMAGE_WIDTH ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID );
					elseif ( get_header_image() ) : ?>
						<center><a href="http://www.lcfm.co.uk"><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" border="0" /></a></center>
					<?php endif; ?>
                    
                    
			</div><!-- #branding -->
		</div><!-- #masthead -->
        
	</div><!-- #header -->
    
      <ul id="inner_menu2">
    
    <?php if(is_page('Homepage')){ ?>
		<li class="current_page_item"><a href="<?php bloginfo('url');?>">HOME / INFO</a></li>
    <?php }else{ ?>
        <li><a href="<?php bloginfo('url');?>">HOME / INFO</a></li>
    <?php } ?>
    
    <?php if(is_page('Asger Juel Larsen')){ ?>
		<li  class="current_page_item"><a href="<?php bloginfo('url');?>/asger-juel-larsen/">Asger Juel Larsen</a></li>
    <?php }else{ ?>    
        <li><a href="<?php bloginfo('url');?>/asger-juel-larsen/">Asger Juel Larsen</a></li>
    <?php } ?> 
    
    <?php if(is_page('Domingo Rodriguez')){ ?>  
		<li  class="current_page_item"><a href="<?php bloginfo('url');?>/domingo-rodriguez/">Domingo Rodriguez</a></li>
    <?php }else{ ?>  
        <li><a href="<?php bloginfo('url');?>/domingo-rodriguez/">Domingo Rodriguez</a></li>
    <?php } ?>  
        
    <?php if(is_page('Matteo Molinari')){ ?>  
        <li  class="current_page_item"><a href="<?php bloginfo('url');?>/matteo-molinari/">Matteo Molinari</a></li>
    <?php }else{ ?>     
        <li><a href="<?php bloginfo('url');?>/matteo-molinari/">Matteo Molinari</a></li>
    <?php } ?>
    
    <?php if(is_page('Oliver Ruuger')){ ?>    
        <li  class="current_page_item"><a href="<?php bloginfo('url');?>/oliver-ruuger/">Oliver Ruuger</a></li>
    <?php }else{ ?>     
        <li><a href="<?php bloginfo('url');?>/oliver-ruuger/">Oliver Ruuger</a></li>
    <?php } ?> 
    
     <?php if(is_page('Event')){ ?>   
        <li  class="current_page_item"><a href="<?php bloginfo('url');?>/event/">EVENT</a></li>
     <?php }else{ ?>
        <li><a href="<?php bloginfo('url');?>/event/">EVENT</a></li>
     <?php } ?>
     
     
     
     <?php if(is_page('VIDEO')){ ?>
       <li  class="current_page_item"><a href="<?php bloginfo('url');?>/video/">VIDEO</a></li>
     <?php }else{ ?>
       <li><a href="<?php bloginfo('url');?>/video/">VIDEO</a></li>
     <?php } ?>
     
     <?php if(is_page('MA_N')){ ?>
       <li  class="current_page_item"><a href="<?php bloginfo('url');?>/ma_n/">MA_N</a></li>
     <?php }else{ ?>
       <li><a href="<?php bloginfo('url');?>/ma_n/">MA_N</a></li>
     <?php } ?>
     
     <?php if(is_page('Menswear at LCF')){ ?>  
	    <li  class="current_page_item"><a href="<?php bloginfo('url');?>/menswear-at-lcf/">MENSWEAR AT LCF</a></li>
     <?php }else{ ?> 
        <li><a href="<?php bloginfo('url');?>/menswear-at-lcf/">MENSWEAR AT LCF</a></li>
      <?php } ?>
      
      <?php if(is_page('PRESS')){ ?>
	    <li  class="current_page_item"><a href="<?php bloginfo('url');?>/press/?">PRESS</a></li>
      <?php }else{ ?>
        <li><a href="<?php bloginfo('url');?>/press/">PRESS</a></li>
      <?php } ?>
      
      
      
    <?php if(is_page('Asger Juel Larsen')){ ?>
    	<li ><span style="border-width:0px; margin:3px"></span></li>
		<li class="current_page_item"><a href="javascript:fShowDiv('content');">Information</a></li>
        <li><span style="border-width:0px; margin:3px"></span></li>
        <li><span style="border-width:0px; margin:3px"></span></li>
        <li><span style="border-width:0px; margin:3px"></span></li>
    <?php } ?>   
    
    <?php if(is_page('Domingo Rodriguez')){ ?>
    	<li><span style="border-width:0px; margin:3px"></span></li>
        <li><span style="border-width:0px; margin:3px"></span></li>
		<li class="current_page_item"><a href="javascript:fShowDiv('content');">Information</a></li>
        <li><span style="border-width:0px; margin:3px"></span></li>
        <li><span style="border-width:0px; margin:3px"></span></li>
    <?php } ?> 
    
    <?php if(is_page('Matteo Molinari')){ ?>
    	<li><span style="border-width:0px; margin:3px"></span></li>
        <li><span style="border-width:0px; margin:3px"></span></li>
        <li><span style="border-width:0px; margin:3px"></span></li>
		<li class="current_page_item"><a href="javascript:fShowDiv('content');">Information</a></li>
        <li><span style="border-width:0px; margin:3px"></span></li>
    <?php } ?>
    
    <?php if(is_page('Oliver Ruuger')){ ?>
    	<li><span style="border-width:0px; margin:3px"></span></li>
        <li><span style="border-width:0px; margin:3px"></span></li>
        <li><span style="border-width:0px; margin:3px"></span></li>
        <li><span style="border-width:0px; margin:3px"></span></li>
		<li class="current_page_item"><a href="javascript:fShowDiv('content');">Information</a></li> 
    <?php } ?> 
   </ul>

	<div id="main">
