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

          <form action="#" method="post" class="contact_form">
            <div class="contact_item">
              <label class="contact_label" for="name">Name <span class="contact_tag">必須</span></label>
              <div class="contact_input-wrap">
                <input type="text" id="name" name="your-name" placeholder="山田 太郎" required>
              </div>
            </div>

            <div class="contact_item">
              <label class="contact_label" for="kana">Kana <span class="contact_tag">必須</span></label>
              <div class="contact_input-wrap">
                <input type="text" id="kana" name="your-kana" placeholder="ヤマダ タロウ" required>
              </div>
            </div>

            <div class="contact_item">
              <label class="contact_label" for="email">Email <span class="contact_tag">必須</span></label>
              <div class="contact_input-wrap">
                <input type="email" id="email" name="your-email" placeholder="example@mail.com" required>
              </div>
            </div>

            <div class="contact_item">
              <label class="contact_label" for="message">Message <span class="contact_tag">必須</span></label>
              <div class="contact_input-wrap">
                <textarea id="message" name="your-message" rows="8" placeholder="お問い合わせ内容をご記入ください"></textarea>
              </div>
            </div>

            <div class="contact_btn-wrap">
              <button type="submit" class="m_btn_link contact_submit">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </section>      
  </main>

<?php get_footer(); ?>