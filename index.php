<?php get_header(); ?>

<main class="main">
  <section class="l_section">
    <div class="l_contents">
      <div class="l_container">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
              <h1 class="m_section-ttl"><?php the_title(); ?></h1>
              <div class="p_entry_body">
                <?php the_content(); ?>
              </div>
            </article>
          <?php endwhile; ?>
        <?php else : ?>
          <h1 class="m_section-ttl">Not Found</h1>
          <p class="u_text-center">お探しのページが見つかりませんでした。</p>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
