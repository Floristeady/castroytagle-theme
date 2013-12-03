<?php
/**
 * SubMenu for Pages
 *
 * @package WordPress
 * @subpackage aasa
 * @since aasa 1.0
 */
?>

<div id="top-menu">    
	 <?php 
	 
	 global $post;
	 
	 $titlepadre = get_the_title();
	 
     if(!$post->post_parent){
      // will display the subpages of this top level page
      	$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
      
      } else {
          // diplays only the subpages of parent level
          //$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
		  $ancestors =  $post->ancestors;
          if($ancestors) {
	          // now you can get the the top ID of this page
	          // wp is putting the ids DESC, thats why the top level ID is the last one
	          $ancestors = end($ancestors);
	          $children = wp_list_pages("title_li=&child_of=".$ancestors."&echo=0&sort_order=ASC&sort_column=menu_order");
	         	
	          $titlenamer = get_the_title($post->post_parent);
	          
	          $tituloDelPapaDelPapa = '';
	          if($post->post_parent) {
				$parent = get_post($post->post_parent);
					if ($parent->post_parent){
						$grandpa = get_post($parent->post_parent);
						$titlenamer = get_the_title($grandpa->ID);
						//print "titulo padre es: " . $titlenamer;
					}
			   }

          }
      }
      
          if ($children) { ?>
          <h1 class="section-title"> <?php if (!empty($titlenamer)) {echo $titlenamer;} else {print $titlepadre;} ?> </h1>
              <ul id="submenu">
                  <?php echo $children; ?>
              </ul>
          <?php } ?>
          
  </div>