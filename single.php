<?php get_header(); ?>
  
<main class="l_main">
  <article class="p_entry l_section">
    <div class="l_container l_contents">
        <h2 class="m_section-ttl" data-subtitle="お知らせ">News</h2>
      
      <header class="p_entry_header">
        <div class="p_entry_meta">
          <?php
            $categories = get_the_category();
            if ( ! empty( $categories ) ) : ?>
              <span class="p_entry_category"><?php echo esc_html( $categories[0]->name ); ?></span>
          <?php endif; ?>
          <time class="p_entry_date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
            <?php echo get_the_date('Y.m.d'); ?>
          </time>

        </div>
        <h1 class="p_entry_title"><?php the_title(); ?></h1>
      </header>

      <?php if (has_post_thumbnail()) : ?>
        <div class="p_entry_thumbnail">
          <?php the_post_thumbnail('full'); ?>
        </div>
      <?php endif; ?>

      <div class="p_entry_body">
        <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
          <?php the_content(); ?>
        <?php endwhile; endif; ?>
      </div>

      <footer class="p_entry_footer">
        <div class="m_btn_wrap">
          <a href="<?php echo esc_url(home_url('/')); ?>#news" class="m_btn_link">Back to Top</a>
        </div>
      </footer>

    </div>
  </article>
</main>

<?php get_footer(); ?>
