<?php get_header(); ?>

<!-- ==== HEADER ==== -->
<section id="home">
  <header>
    <p>
      <?php echo str_replace('/n', '<br />', get_bloginfo('description')); ?>
    </p>
  </header>
</section>

<!-- ==== ABOUT ==== -->


<section id="about">
  <br>
  <article>
	<header>
	    <h1>
	      <?php
		  $content = get_the_title(5);
		  echo $content;
	      ?>
	    </h1>

	</header>
	    <p>
	      <?php
		  $about = get_post(5);
		  $content = $about->post_content;
		  echo $content;
	      ?>
	    </p>
  </article>
</section>



<!-- ==== SECTION DIVIDER1 -->
<section id="partDesigner">
  <article >
	<header>
	    <h1>
	      <?php
		  $content = get_the_title(11);
		  echo $content;
	      ?>
	    </h1>
	</header>

	    <p>
	      <?php
		  $about = get_post(11);
		  $content = $about->post_content;
		  echo $content;
	      ?>
	    </p>
  </article>
</section>

<!-- ==== SECTION DIVIDER2 -->
<section id="partCoder" >
  <article >
    	<header>
	    <h1>
	      <?php
		  $content = get_the_title(13);
		  echo $content;
	      ?>
	    </h1>
	</header>

	<p>
	  <?php
	   $about = get_post(13);
	   $content = $about->post_content;
	   echo $content;
          ?>
	</p>
  </article>
</section>


<section id="technicalSkills">
  <h1> My Technical Skills</h1>
  <div>
     <ul>
        <li><div id="barHTML"></div><div class="barNumber">
          <?php
          echo get_theme_mod('html_skill_percentage');
          ?>
        <span>%</span></div> <div class="barDesc">HTML</div></li>
        <li><div id="barCSS"></div><div class="barNumber">
          <?php
          echo get_theme_mod('css_skill_percentage');
          ?>
        <span>%</span></div> <div class="barDesc">CSS</div></li>
        <li><div id="barJS"></div><div class="barNumber">
          <?php
          echo get_theme_mod('javascript_skill_percentage');
          ?>
        <span>%</span></div> <div class="barDesc">JavaScript</div></li>
        <li><div id="barWP"></div><div class="barNumber">
          <?php
          echo get_theme_mod('wordpress_skill_percentage');
          ?>
        <span>%</span></div> <div class="barDesc">WordPress</div></li>
     </ul>
  </div>
</section>

<!-- ==== PORTFOLIO ==== -->
<section id="portfolio">
  <div >
     <br>
     <h1 >I WORKED ON COOL STUFF</h1>
     <br>
     <br>
  </div>
  <ul class="buttonsList">
     <button onclick="portfoliofilter('ALL')">ALL</button>
     <button onclick="portfoliofilter('UI DESIGN')">UI DESIGN</button>
     <button onclick="portfoliofilter('ANDROID PAGE')">ANDROID PAGE</button>
  </ul>
  <br>
  <div id="contentlist" >


  </div>

</section>


<!-- ==== BLOG ==== -->
<section id="blog">
  <br>
  <div >
     <br>
     <h1 >MY  PERSONAL BLOG</h1>
     <br>
     <br>
  </div>



  <div class="blogContainer">
     <div class ="block">
        <div class = "dark" >
           <figure>
              <img  src="<?php bloginfo('template_directory') ?>/assets/img/team/u1.jpg" width="60px" height="60px">

              <figcaption>
		  <?php $query = new WP_Query( array( 'posts_per_page' => 5, 'offset' => 0)); ?>
		  <?php $query -> the_post(); ?>
		  <?php the_author(); ?>
	      </figcaption>
           </figure>
           <h5>Published <?php the_date('M j.'); ?></h5>
        </div>
        <div class = "white" >
           <article>
              <header><?php the_title(); ?></header>
              <p>
		<?php the_excerpt(); ?>
	      </p>
              <p><a href="#" > Read More</a></p>
           </article>
        </div>
     </div>



     <div class = "block" >
        <div class = "dark" >
           <figure>
              <img  src="<?php bloginfo('template_directory') ?>/assets/img/team/u1.jpg" width="60px" height="60px">
              <figcaption>
    		 <?php $query -> the_post(); ?>
		 <?php the_author(); ?>
              </figcaption>
           </figure>
           <h5>Published <?php the_date('M j.'); ?></h5>
        </div>
        <div class = "white" >
           <article>
              <header><?php the_title(); ?></header>
              <p><?php the_excerpt(); ?></p>
              <p><a href="#" > Read More</a></p>
           </article>
        </div>
     </div>

     <div class ="right">
        <div  class = "tutorialBlock">
		<?php $query -> the_post(); ?>
		<p><?php the_title(); ?></p>
		<p class="tutorialDate"><?php the_date('M Y'); ?></p>

 		<p><a href="#" > Read More</a></p>
        </div>
        <div  class = "tutorialBlock">

		<?php $query -> the_post(); ?>
		<p><?php the_title(); ?></p>
		<p class="tutorialDate"><?php the_date('M Y'); ?></p>

           	<p><a href="#" > Read More</a></p>
        </div>
        <div class = "tutorialBlock" >

		<?php $query -> the_post(); ?>
		<p><?php the_title(); ?></p>
		<p class="tutorialDate"><?php the_date('M Y'); ?></p>
		<?php wp_reset_postdata(); ?>

		<p><a href="#"> Read More</a></p>
        </div>
     </div>
  </div>
  <br>
  <br>
</section>

<!-- ==== SECTION DIVIDER6 ==== -->
<section id = "crafted">
	    <h1>
	      <?php
		  $content = get_the_title(41);
		  echo $content;
	      ?>
	    </h1>
	<div class="manualUnderline"></div>
	<p>
	  <?php
	   $about = get_post(41);
	   $content = $about->post_content;
	   echo $content;
          ?>
	</p>

	<p class="lastP"></p>
</section>

<section id="contact">
  <div id="contact2">
     <br>
     <h1 >THANKS FOR VISITING!</h1>
     <br>
     <br>
     <br>
     <br>
     <div class ="container">
       <section class="element">
          <article>
             <header>Contact Information</header>
             <br>
             <p><span ></span><?php echo get_theme_mod('location_info'); ?> <br/>
                <span ></span> <?php echo get_theme_mod('phone_info'); ?><br/>
                <span ></span> <?php echo get_theme_mod('fax_info'); ?><br/>
                <span ></span> <a href="#"> <?php echo get_theme_mod('mail_info'); ?></a> <br/>
                <span ></span> <a href="#"><?php echo get_theme_mod('twitter_info'); ?></a> <br/>
                <span ></span> <a href="#"> <?php echo get_theme_mod('name_info'); ?></a> <br/>
             </p>
          </article>
       </section>

        <section class="element">
           <article>
              <header>Newsletter</header>
              <br>
              <p>Register to our newsletter and be updated with the latests information regarding our services, offers and much more.</p>
              <br>
              <br>
              <br>
              <p>
              <form  role="form">
                 <ol>
                    <li >
                       <label for="inputEmail1" class="col-lg-4 control-label"></label>
                       <input type="email"  id="inputEmail1" placeholder="Email">
                    </li>
                    <br>
                    <li >
                       <label for="text1" class="col-lg-4 control-label"></label>
                       <input type="text"  id="text1" placeholder="Your Name">
                    </li> <br>
                 </ol>
                 <br>
                 <div >
                    <button type="submit" >Sign in</button>
                 </div>
              </form>
              </p>
           </article>
        </section>

        <section class="element">
           <article>
              <header>Support Us</header>
              <br>
              <p>If you would like to support my work and my passion for web crafting please feel free to send me an email, or to share one of my project on tweeter or facebook. Any small little thing will be appreciated!</p>
           </article>
        </section>
     </div>
  </div>

</section>

<?php get_footer(); ?>
