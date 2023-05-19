<?php get_header(); ?>
<article class="inner">
  <div class="header">
    <h1 class="title"><?php the_title(); ?></h1>
  </div>
  <section>
    <div class="title">
      <h3>Sumikaのスローガン</h3>
    </div>
    <div class="paragraph">
      <div class="text">
        <ul>
          <li>日々の暮らしを楽しもう。</li>
          <li>話題のトピックを追いかけよう。</li>
          <li>あなたの暮らしをシェアしよう。</li>
        </ul>
      </div>
      <div class="text">
        <p>Sumikaは、暮らしに関する情報を「発信」「シェア」するためのWEBサイトとなっています。</p>
        <p>サイトへ訪れて下さった方々が「暮らしを楽しむ」際に役立つ情報を発信していくことをテーマにサイトを運営して参りますので、ご協力の程よろしくお願いいたします。</p>
      </div>
    </div>
  </section>
  <section>
    <div class="title">
      <h3>ユーザー投稿機能について</h3>
    </div>
    <div class="paragraph">
      <div class="text">
        <p>サイトの右上にあるログインボタンからSumikaに会員登録をすることで「ユーザー投稿機能」が解放されます。</p>
        <p>ブログを書く感覚で、写真の枚数や文字の制限なく自由に記事を投稿することが出来ます。</p>
      </div>
    </div>
  </section>
  <section>
    <div class="title">
      <h3>投稿できる記事の内容について</h3>
    </div>
    <div class="paragraph">
      <div class="text">
        <p>現在用意されているカテゴリーは下記になります。</p>
        <ul>
          <li><a href="<?php echo home_url('/') ?>article/category/interior/">インテリア</a></li>
          <li><a href="<?php echo home_url('/') ?>article/category/architecture/">アーキテクチャー（建築）</a></li>
          <li><a href="<?php echo home_url('/') ?>article/category/art/">デザイン＆アート</a></li>
        </ul>
      </div>
      <div class="text">
        <p>上記カテゴリーのいずれかを選択して記事を投稿することができます。</p>
        <p>ただし、先述したSumikaのスローガンに大きく逸脱する内容と判断された場合や下記の内容に当てはまる場合は、記事を削除させていただくことが御座います。</p>
      </div>
      <div class="text">
        <ul>
          <li>社会通念上の倫理、公序良俗に反した内容</li>
          <li>内容またはテキスト、画像等が違法またはその可能性がある内容</li>
          <li>他メディアで公開されている、公開される予定のある独自性が希薄な内容</li>
        </ul>
      </div>
    </div>
  </section>
  <section>
    <div class="title">
      <h3>インスタグラムとの連携</h3>
    </div>
    <div class="paragraph">
      <div class="text">
        <p>投稿された記事には、投稿者のインスタグラムアカウントが紐ずけられます。</p>
        <p>より注目度の高い記事は、Sumikaの<a href="https://www.instagram.com/sumika.casa/" target="_blank" rel="noopener noreferrer">インスタグラムアカウント</a>で紹介させていただきます。</p>
      </div>
    </div>
  </section>
</article><?php get_footer(); ?>