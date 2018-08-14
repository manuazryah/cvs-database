<?php

use yii\helpers\Html;
?>

<div class="page_banner banner price-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  col-12">
                <div class="apus-breadscrumb">
                    <div class="wrapper-breads">
                        <div class="wrapper-breads-inner">
                            <h3 class="bread-title">Blogs view</h3>
                            <div class="breadscrumb-inner">
                                <ol class="breadcrumb">
                                    <li><?= Html::a('Home', ['/employer/index']) ?> </li>
                                    <li><span class="active">Blogs</span></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<main id="maincontent">
    <section class="blog-view">
        <div class="container">
            <div class="wraper-row">
                <?php if ($blog) { ?>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                        <div class="column-content">
                            <div class="box-post-open m15">
                                <div class="post-open-thumbnail"><img src="<?= Yii::$app->homeUrl . 'uploads/blog/' . $blog->id . '/image.' . $blog->image . '?' . rand(); ?>" alt="<?= !empty($blog->image_alt) ? $blog->image_alt : '' ?>"></div>
                                <div class="header">
                                    <h1 class="title"><?= $blog->title ?></h1>
                                    <div class="meta-tags"> <span class="meta-option"><i class="fa fa-calendar"></i><?= date('M d, Y', strtotime($blog->date)); ?></span></div>
                                </div>
                                <div class="body">
                                    <?= $blog->content ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- ./ content -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="column-sidebar">
                        <?php if ($recent_blog) { ?>
                            <div class="widget widget-posts">
                                <div class="widget-header">
                                    <h2 class="title">Recent Post</h2> </div>
                                <div class="w-posts-list">
                                    <?php
                                    foreach ($recent_blog as $recent) {
                                        $image_alt = !empty($recent->image_alt) ? $recent->image_alt : '';
                                        ?>
                                        <div class="item">
                                            <div class="preview">

                                                <?= Html::a('<img src="' . Yii::$app->homeUrl . 'uploads/blog/' . $recent->id . '/image.' . $recent->image . '?' . rand() . '" alt="' . $image_alt . '">', ['/employer/blog-view', 'id' => yii::$app->EncryptDecrypt->Encrypt('encrypt', $recent->id)])
                                                ?>
                                            </div>
                                            <div class="body">
                                                <h3 class="title"><?= Html::a($recent->title, ['/employer/blog-view', 'id' => yii::$app->EncryptDecrypt->Encrypt('encrypt', $recent->id)]) ?></h3>
                                                <div class="data"><?= date('M d, Y', strtotime($recent->date)); ?></div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php } ?>
                        <!-- ./ widget recent listings -->
                    </div>
                </div>
                <!-- ./ sidebar -->
            </div>
        </div>
    </section>
</main>