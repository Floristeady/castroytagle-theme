<?php
/**
 * The Sidebar containing submenu
 *
 * @package WordPress
 * @subpackage castroytagle
 * @since castroytagle 1.0
 */
?>

<div id="sidebar-menu" class="resize">    
		 <?php $titlepadre = get_the_title();
         if(!$post->post_parent){
          // will display the subpages of this top level page
          $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
          
          } else {
          // diplays only the subpages of parent level
          //$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");

          if($post->ancestors)
          {
          // now you can get the the top ID of this page
          // wp is putting the ids DESC, thats why the top level ID is the last one
          $ancestors = end($post->ancestors);
          $children = wp_list_pages("title_li=&child_of=".$ancestors."&echo=0&sort_order=DESC");
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
          		  
          // you will always get the whole subpages list
          }
      }
          if ($children) { ?>
          <h3> <?php if (!empty($titlenamer)) {echo $titlenamer;} else {print $titlepadre;} ?> </h3>
              <ul>
                  <?php echo $children; ?>
              </ul>
          <?php } ?>
          
  </div>