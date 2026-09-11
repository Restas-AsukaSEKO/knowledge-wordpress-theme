<?php get_header(); ?>

  <main class="main">
    <section id="contact" class="contact l_section">
      <div class="l_contents">
        <div class="l_container">
          <h2 class="m_section-ttl" data-subtitle="お問い合わせ">Contact Us</h2>
          
          <p class="contact_lead">
            商品に関するご質問や、猫オーナーへのメッセージなど、<br class="about_br">
            どうぞお気軽にお問い合わせください。
          </p>

          <?php
          // Contact Form 7（「Contact」という名前のフォームをタイトルで検索し、IDをハードコードしない）
          $cf7_form = get_posts([
            'post_type'   => 'wpcf7_contact_form',
            'title'       => 'Contact',
            'numberposts' => 1,
          ]);
          if ($cf7_form) :
            echo do_shortcode('[contact-form-7 id="' . $cf7_form[0]->ID . '" title="Contact" html_class="contact_form"]');
          endif;
          ?>
        </div>
      </div>
    </section>
  </main>

  <?php if ($cf7_form) : ?>
  <script>
  document.addEventListener('wpcf7mailsent', function (event) {
    if (event.detail.contactFormId === <?php echo (int) $cf7_form[0]->ID; ?>) {
      location = '<?php echo esc_js(home_url('/contact/thanks/')); ?>';
    }
  }, false);
  </script>
  <?php endif; ?>

<?php get_footer(); ?>