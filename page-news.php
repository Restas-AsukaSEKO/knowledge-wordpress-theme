<?php
/**
 * Template Name: News（お知らせ一覧）
 */
get_header();
?>

<main class="main">
  <section id="news-archive" class="news l_section">
    <div class="l_contents-sm">
      <div class="l_container">
        <h2 class="m_section-ttl" data-subtitle="お知らせ">News</h2>

        <ul class="news_list">
          <?php
          $news_query = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => -1,
          ]);
          if ($news_query->have_posts()) :
            while ($news_query->have_posts()) : $news_query->the_post();
          ?>
            <li class="news_item">
              <span class="news_cat">[ <?php $cat = get_the_category(); echo $cat[0]->name; ?> ]</span>
              <p class="news_txt">
                <a href="<?php the_permalink(); ?>" class="news_link"><?php the_title(); ?></a>
                <time class="p_entry_date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
              </p>
            </li>
          <?php
            endwhile;
            wp_reset_postdata();
          else :
          ?>
            <p>News is coming soon</p>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
