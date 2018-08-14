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
                            <h3 class="bread-title">Blogs</h3>
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
    <section class="contact-page">
        <div class="container">
            <?php if ($blogs) { ?>
                <div class="row row-flex results-default">

                    <!-- ./ one article -->
                    <?php foreach ($blogs as $blog) { ?>
                        <div class="col-md-4">
                            <div class="thumbnail thumbnail-article"> <img src="<?= Yii::$app->homeUrl . 'uploads/blog/' . $blog->id . '/image.' . $blog->image . '?' . rand(); ?>" alt="<?= !empty($blog->image_alt) ? $blog->image_alt : '' ?>" class="preview">
                                <div class="body">
                                    <div class="top"><?= date('M d, Y', strtotime($blog->date)); ?></div>
                                    <h3 class="title"><a href=""><?= $blog->title ?></a></h3> </div>
                                <div class="footer">
                                    <?= Html::a('Read More<i class="arrow_carrot-right"></i>', ['/employer/blog-view', 'id' => yii::$app->EncryptDecrypt->Encrypt('encrypt', $blog->id)]) ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- ./ one article -->
                </div>
            <?php } ?>
        </div>
    </section>
</main>