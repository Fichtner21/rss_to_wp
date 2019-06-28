<?php
$footer_settings = get_option('footer_settings');
get_header(); ?>

<div class="index-top">
	<div class="container index-top__container">
		<div class="slider-header">
			<?php
				$args = array(
					'posts_per_page'   => -1,
					'orderby'          => 'date',
					'order'            => 'DESC',
					'post_type'        => 'slider',
					'post_status'      => 'publish',
					'suppress_filters' => true
				);

				$posts_array = get_posts($args);
			?>
			<ul id="bxslider">
				<?php foreach ($posts_array as $post): ?>
					<?php
						$relPost = get_field('redirect', $post->ID);
						$slider_image = get_field('image',  $post->ID);
					?>
					<li>
						<a <?php echo $relPost ? 'href="'.$relPost.'"' : ''; ?> title="<?php echo $post->post_title; ?>" class="slide" tabindex="-1" >
							<div class="relative-cont">
								<img src="<?php echo $slider_image['url']; ?>" alt="<?php echo $post->post_title; ?>" title="<?php echo $post->post_title; ?>" />
							</div>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php wp_reset_query(); ?>
		</div>
		<div class="index-top__right">
			<?php get_template_part('contact-data'); ?>
			<?php get_template_part('weather'); ?>
		</div>
	</div>
</div>

<div class="container main-page">
	<section class="main-page__news">
		<h1 class="section-title">Ważne wiadomości<a href="category/wazne-wiadomosci/"><span>więcej</span></a></h1>
		<div class="main-page__news-important">
			<div id="news-important">
				<?php
					$post_query = new WP_Query(array(
						'posts_per_page' => 4,
						'post_type' => 'post',
						'post_status' => 'publish',
						'orderby' => 'date',
						'order' => 'DESC',
						//'cat' => 25
						'category_name' => 'wazne-wiadomosci'
					));
					while ($post_query->have_posts()) : $post_query->the_post(); ?>
					<article class="slide-article">
						<div class="slide-article__left">
							<?php if(has_post_thumbnail()): ?>
								<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'slide-article'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
							<?php endif; ?>
						</div>
						<div class="slide-article__right">
							<h2 class="slide-article__title"><?php the_title(); ?></h2>
							<div class="slide-article__details">
								<div class="slide-article__social">
									<a class="slide-article__facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&title=<?php echo $url_title; ?>" title="facebook">
										<em class="fab fa-facebook-f"></em>
									</a>
									<a class="slide-article__twitter" href="http://twitter.com/share?text=<?php echo $url_title; ?>&url=<?php the_permalink(); ?>&hashtags=<?php echo $hashtags; ?>" title="twitter">
										<em class="fab fa-twitter"></em>
									</a>
								</div>
								<div class="slide-article__date">
									<em class="fas fa-clock"></em>
									<?php echo get_the_date('j'). " " . get_month(get_the_date('m')) . " " . get_the_date('Y'); ?>
								</div>
							</div>
							<div class="slide-article__content">
								<?php echo strip_tags(get_the_excerpt()); ?>
							</div>
							<div class="slide-article__more-cont">
								<a class="slide-article__more" href="<?php echo get_the_permalink(); ?>" title="<?php the_title(); ?>">więcej</a>
							</div>
						</div>
					</article>
				<?php endwhile ?>
				<?php wp_reset_query() ?>
			</div>
		</div>
		<div class="main-page__news-rest">
			<div>
				<h1 class="section-title">Aktualności urzędu</h1>
				<div class="articles">

					<?php
						$post_query = new WP_Query(array(
							'posts_per_page' => 4,
							'post_type' => 'post',
							'post_status' => 'publish',
							'orderby' => 'date',
							'order' => 'DESC'
							//'category__not_in' => array(25)
						));
						while ($post_query->have_posts()) : $post_query->the_post(); ?>
						<article class="small-post">
							<div class="small-post__cont">
								<?php if (has_post_thumbnail()): ?>
									<div class="small-post__img">
										<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'small-post'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
									</div>
								<?php endif; ?>
								<div class="small-post__right">
									<h2 class="small-post__title">
										<?php the_title(); ?>
									</h2>
									<div class="small-post__content">
										<?php the_excerpt(); ?>
									</div>
								</div>
							</div>
							<div class="small-post__cont-2">
								<div class="small-post__social-date">
									<a class="small-post__facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&title=<?php echo $url_title; ?>" title="facebook">
										<em class="fab fa-facebook-square"></em>
									</a>
									<a class="small-post__twitter" href="http://twitter.com/share?text=<?php echo $url_title; ?>&url=<?php the_permalink(); ?>&hashtags=<?php echo $hashtags; ?>" title="twitter">
										<em class="fab fa-twitter-square"></em>
									</a>
									<div class="small-post__date">
										<em class="fas fa-clock"></em>
										<?php echo get_the_date('j'). " " . get_month(get_the_date('m')) . " " . get_the_date('Y'); ?>
									</div>
								</div>
								<a class="small-post__more" href="<?php echo get_the_permalink(); ?>" title="<?php the_title(); ?>">wiecej</a>
							</div>
						</article>
					<?php endwhile ?>
					<?php wp_reset_query() ?>
				</div>
			</div>
			<div class="news__units">
				<h2 class="section-title">Aktualności jednostek</h2>

				<?php //dynamic_sidebar('news-bip'); ?>
				

				
				
				<?php 

				

				$original_blog_id = get_current_blog_id();


							//	Setup a category for each blog id you want to loop through - EDIT
				$catslug_per_blog_id = array( 
				    //1 => '',
				    2 => '', // tutaj wpisz nazwe kategori zamiast pustego stringa
				    3 => '',
				    4 => '',				   
				); 

				// $myrss = get_posts(
				// 	array(
				// 		'post_type' => 'wprss_feed_item',
				// 		'posts_per_page' => 3
				// ));

				// foreach ($myrss as $rss) {
				// 	echo '<li>'.$rss->guid .=
				// 	 $rss->post_date .=
				// 	 $rss->post_title .'</li>';
				// 	echo get_permalink();
				// 	//var_dump($rss);
				// }
			
				

				foreach( $catslug_per_blog_id as $bid => $catslug )
				{
				    //Switch to the blog with the blog id $bid
				    switch_to_blog( $bid ); 

				    // Get posts for each blog
				    $myposts = get_posts( 
				        array( 
				            'category_name'  => $catslug,
				            'post_type' => array('post'),
				            'orderby' => 'DATE',
				            'order' => 'DESC',
				            'posts_per_page' => 2, 
				        )
				    );

				    // Skip a blog if no posts are found
				    if( empty( $myposts ) )
				        continue;

				    // Loop for each blog
				    $li = '';
				    global $post;
				    foreach( $myposts as $post )
				    {
				        setup_postdata( $post );
				        $t = the_title();
				        $c = the_content();
				        $d = get_the_date();
				        $p = the_permalink();

				        // $li .= the_title(
				        //     $before = sprintf( '<li><a href="%s">', esc_url( get_permalink() ) ),
				        //     $after  = '</a><div>'. esc_url(the_content()) .'</div></li>',
				        //     $echo   = false
				        // ); 
				       echo $t . '</br>' . $c . '</br>' . $d . '</br>' . $p . '</br>';
				    }

				    // Print for each blog
				    // printf(
				    //     '<h2>%s %s</h2><ul>%s</ul>', //jeśli chcesz dodać kategorię do tagu h2 wpisz: (%s)
				    //     esc_html( get_bloginfo( 'name' ) ),				        
				    //     esc_html( $catslug ),
				    //     $li
				         
				    // );
				}

				// Switch back to the current blog
				switch_to_blog( $original_blog_id ); 

				wp_reset_postdata();


				?>
				 
    <script type="text/javascript">
    	
    </script>


    <!-- DODAJ TABELE DO BAZY -->
   <!--  CREATE TABLE IF NOT EXISTS rssdata (id int(11) NOT NULL AUTO_INCREMENT, `title` varchar(255) NOT NULL, 
  `description` tinytext NOT NULL, `link` tinytext NOT NULL, `post_date` varchar(255), PRIMARY KEY (id)) -->

    	<?php

    	$servername = "localhost";
		$username = "root";
		$password = " ";
		$dbname = "pokrzywnica";
			
		$doc = new DOMDocument();
		$doc->load('https://bip.pokrzywnica.pl/rss');
		$arrFeeds = array();
		foreach ($doc->getElementsByTagName('item') as $node) {
		    $itemRSS = array ( 
		  'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,		  
		  'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,		  
		  'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,		  
		  'post_date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue		  
		  );
		  array_push($arrFeeds, $itemRSS);
		}

		$mysqli = new mysqli($servername, $username, '', $dbname);
		$mysqli->set_charset("utf8");
		//var_dump($arrFeeds);

		/* sprawdzenie polaczenia */
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
		/* dodanie do bazy */
		$sql = "INSERT INTO rssdata (title, description, link, post_date, post_type) VALUES (?, ?, ?, ?, 'rss_post')";
		/* wykluczenie dodawania jesli istnieje z ta sama data */
		$unique = "ALTER TABLE rssdata ADD CONSTRAINT UNIQUE (post_date)";		
	
		//var_dump($sql);

		if($stmt = $mysqli->prepare($sql)){
			$stmt->bind_param('ssss', $title, $description, $link, $post_date);
			foreach( $arrFeeds as $RssItem){
			    $title = $RssItem["title"];	    
			    $description = !is_null($RssItem["dscription"]) ? $RssItem["dscription"]: '';			       
			    $link = $RssItem["link"];
			    $post_date = $RssItem['post_date'];	

			   	//var_dump($stmt);
			    $stmt->execute();
			}
		} else {
			 $error = $mysqli->errno . ' ' . $mysqli->error;
		    echo $error; 
		}

		$mysqli->prepare($unique);

		$stmt->close();
		$mysqli->close();

		?>

		<?php
			global $wpdb;
			$rss_posts = $wpdb->get_results("SELECT * FROM rssdata");
			
		?>

		<?php
		if(isset($_POST['new_post']) == '1') {
			foreach ($rss_posts as $rss_post) {
				$new_rss = array(
					'post_title' => $rss_post->title,
					'post_content' => $rss_post->link,
					'post_status' => 'publish',
					'post_type' => $rss_post->post_type,
				);

				// $tocpt = wp_insert_post($new_rss);
				// wp_set_post_terms($tocpt, $_POST['from_rss'], 'from_rss', false);

				$post_id = wp_insert_post($new_rss);
				$post = get_post($post_id);
			}
		}
		?>
<form method="post" action="">

      <input name="post_title" type="text" />

      <input type="hidden" name="new_post" value="1" />
      <input type="submit" name="submit" value="Post" />

</form>
<!-- 
			<table class="table">

			<?php foreach(array_slice($rss_posts,0,5) as $rss_post){ ?>
			
			<tr>
			 <td><center>tytul: <?php echo $rss_post->title; ?></center></td>
			 <td><center>link: <?php echo $rss_post->link; ?></center></td>
			 <td><center>data: <?php echo $rss_post->post_date; ?></center></td>			 
			</tr>

			<?php } ?> -->

			<!-- </table> -->
			<?php
$post_query = new WP_Query(array(
						'posts_per_page' => 4,
						'post_type' => 'rss_post',
						'post_status' => 'publish',
						'orderby' => 'date',
						'order' => 'DESC'						
					));
					while ($post_query->have_posts()) : $post_query->the_post(); ?>
						<div><?php echo the_title(); ?></div>

					<?php endwhile; ?>

    <article class="small-post">
						<div class="small-post__cont">
							<?php if (has_post_thumbnail()): ?>
								<div class="small-post__img">
									<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'small-post'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
								</div>
							<?php endif; ?>
							<div class="small-post__right">
								<h2 class="small-post__title">
									<?php the_title(); ?>
								</h2>
								<div class="small-post__content">
									<?php the_excerpt(); ?>
								</div>
							</div>
						</div>
						<div class="small-post__cont-2">
							<div class="small-post__social-date">
								<a class="small-post__facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&title=<?php echo $url_title; ?>" title="facebook">
									<em class="fab fa-facebook-square"></em>
								</a>
								<a class="small-post__twitter" href="http://twitter.com/share?text=<?php echo $url_title; ?>&url=<?php the_permalink(); ?>&hashtags=<?php echo $hashtags; ?>" title="twitter">
									<em class="fab fa-twitter-square"></em>
								</a>
								<div class="small-post__date">
									<em class="fas fa-clock"></em>
									<?php echo get_the_date('j'). " " . get_month(get_the_date('m')) . " " . get_the_date('Y'); ?>
								</div>
							</div>
							<a class="small-post__more" href="<?php echo get_the_permalink(); ?>" title="<?php the_title(); ?>">wiecej</a>
						</div>
					</article>

					
					
					<?php //endforeach; ?>
					<?php //restore_current_blog(); ?>
					<?php //wp_reset_query();
				?>				
			</div>
		</div>
		
		<div id="horizontal_gallery"  class="main-page__galeries">
			<!-- <div class="gallery-sidebar"> -->
				<h3 class="section-title">Galeria<a href="galerie/"><span>więcej</span></a></h3>
				<!-- <div class="yellow-prev"></div> -->
				<div class="articles">
					<ul id="bxSlider-gallery">
					<?php
					$i = 0;

					$post_query = new WP_Query(array(
						'posts_per_page' => -1,
						'post_type' => 'galerie',
						'post_status' => 'publish',
						'orderby' => 'date',
						'order' => 'DESC'
					));
					while ($post_query->have_posts()) : $post_query->the_post(); ?>

						<!-- <div class="articles-row"> -->
								<article>
									<figure>
										<a href="<?php the_permalink() ?>" title="artykuł <?php the_title(); ?>">
										<?php if(has_post_thumbnail()): ?>
											<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
											<div class="overlay">
												<div class="gallery-title"> <?php the_title(); ?> </div>
												<em class="fas fa-search see-more"></em>
											</div>
										<?php endif; ?>
										</a>
									</figure>
								</article>
						<!-- </div> -->
					<?php endwhile;
					wp_reset_query();?>
					</ul>
				</div>
				<!-- <div class="yellow-next"></div>		 -->
			<!-- </div>	 -->
		</div>
	</section>
	<aside class="main-page__sidebar">
		<?php get_template_part('sidebar'); ?>
	</aside>
</div>

<?php get_footer(); ?>

<script type="text/javascript">
	$(function() {
		$('#bxslider').bxSlider({
			auto: true,
			pause: 5000,
			speed: 1000,
			controls: false,
			touchEnabled: false,
			onSliderLoad: function() {
				$('.bx-pager-link, .bx-prev, .bx-next').attr('tabindex', '-1');
			}
		});

		$('#news-important').bxSlider({
			auto: true,
			pause: 5000,
			speed: 1000,
			controls: false,
			touchEnabled: false,
			onSliderLoad: function() {
				$('.bx-pager-link, .bx-prev, .bx-next').attr('tabindex', '-1');
			}
		});

		$('#bxSlider-gallery').bxSlider({
			mode: 'horizontal',
			speed: 500,
			slideMargin:0,
			infiniteLoop: false,
			pager: false,
			controls: true,
			slideWidth: 760, //450,
			minSlides: 4,
			maxSlides: 4,
			moveSlides: 1,
			adaptiveHeight: false
			//nextSelector: '.yellow-next',
			//prevSelector: '.yellow-prev'
		});
	})
</script>
