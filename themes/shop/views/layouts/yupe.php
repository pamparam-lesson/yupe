<!DOCTYPE html>
<html lang="<?= Yii::app()->language; ?>">

<head>
    <?php
    \yupe\components\TemplateEvent::fire(ShopThemeEvents::HEAD_START);

    Yii::app()->getController()->widget(
        'vendor.chemezov.yii-seo.widgets.SeoHead',
        [
            'httpEquivs' => [
                'Content-Type' => 'text/html; charset=utf-8',
                'X-UA-Compatible' => 'IE=edge,chrome=1',
                'Content-Language' => 'ru-RU',
                'viewport' => 'width=1200',
                'imagetoolbar' => 'no',
                'msthemecompatible' => 'no',
                'cleartype' => 'on',
                'HandheldFriendly' => 'True',
                'format-detection' => 'telephone=no',
                'format-detection' => 'address=no',
                'apple-mobile-web-app-capable' => 'yes',
                'apple-mobile-web-app-status-bar-style' => 'black-translucent',
            ],
            'defaultTitle' => $this->yupe->siteName,
            'defaultDescription' => $this->yupe->siteDescription,
            'defaultKeywords' => $this->yupe->siteKeyWords,
        ]
    );

    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/js/libs/select2/select2.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/js/libs/slick/slick/slick.css');
    Yii::app()->getClientScript()->registerCssFile($this->mainAssets . '/styles/common.css');
    Yii::app()->getClientScript()->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css');

    Yii::app()->getClientScript()->registerCoreScript('jquery');
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/common.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/store.js', CClientScript::POS_END);
    ?>
    <script type="text/javascript">
        var yupeTokenName = '<?= Yii::app()->getRequest()->csrfTokenName;?>';
        var yupeToken = '<?= Yii::app()->getRequest()->getCsrfToken();?>';
        var yupeCartDeleteProductUrl = '<?= Yii::app()->createUrl('/cart/cart/delete/')?>';
        var yupeCartUpdateUrl = '<?= Yii::app()->createUrl('/cart/cart/update/')?>';
        var yupeCartWidgetUrl = '<?= Yii::app()->createUrl('/cart/cart/widget/')?>';
    </script>
    <?php \yupe\components\TemplateEvent::fire(ShopThemeEvents::HEAD_END);?>
</head>

<body>
<?php \yupe\components\TemplateEvent::fire(ShopThemeEvents::BODY_START);?>
<div class="main">
    <div class="main__navbar">
        <div class="navbar">
            <div class="navbar__wrapper grid">
                <div class="navbar__menu">
                    <?php if (Yii::app()->hasModule('menu')): ?>
                        <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'top-menu']); ?>
                    <?php endif; ?>
                </div>
                <div class="navbar__personal">
                    <div class="navbar__toolbar"><a href="<?= Yii::app()->createUrl('/favorite/default/index');?>" class="toolbar-button"><span class="toolbar-button__label"><i class="fa fa-heart-o fa-lg fa-fw"></i> Избранное</span><span class="badge badge_light-blue" id="yupe-store-favorite-total"><?= Yii::app()->favorite->count();?></span></a>
                        <?php if(Yii::app()->hasModule('compare')):?>
                        <a href="javascript:void(0);" class="toolbar-button"><span class="toolbar-button__label"><i class="fa fa-balance-scale fa-lg fa-fw"></i> Сравнение</span><span class="badge badge_light-blue">0</span>
                        </a>
                        <?php endif;?>
                    </div>
                    <div class="navbar__user">
                        <?php if (Yii::app()->getUser()->isGuest): ?>
                            <a href="<?= Yii::app()->createUrl('/user/account/login') ?>" class="btn btn_login-button">
                                <?= Yii::t('UserModule.user', 'Login'); ?>
                            </a>
                        <?php else: ?>
                            <div class="toolbar-button toolbar-button_dropdown">
                                <span class="toolbar-button__label">
                                    <i class="fa fa-user fa-lg fa-fw"></i> Личный кабинет
                                </span>
                                <span class="badge badge_light-blue"></span>

                               <div class="dropdown-menu">
                                   <div class="dropdown-menu__header"><?= Yii::app()->getUser()->getProfile()->getFullName() ?></div>
                                   <div class="dropdown-menu__item">
                                       <div class="dropdown-menu__link">
                                           <a href="<?= Yii::app()->createUrl('/order/user/index') ?>">Мои заказы</a>
                                       </div>
                                   </div>
                                   <div class="dropdown-menu__item">
                                       <div class="dropdown-menu__link">
                                           <a href="<?= Yii::app()->createUrl('/user/profile/profile') ?>">
                                               <?= Yii::t('UserModule.user', 'My profile') ?>
                                           </a>
                                       </div>
                                   </div>
                                   <div class="dropdown-menu__separator"></div>
                                   <div class="dropdown-menu__item">
                                       <div class="dropdown-menu__link dropdown-menu__link_exit">
                                           <a href="<?= Yii::app()->createUrl('/user/account/logout') ?>">
                                               <?= Yii::t('UserModule.user', 'Logout'); ?>
                                           </a>
                                       </div>
                                   </div>
                               </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main__header">
        <div class="header grid">
            <div class="header__item header-logo">
                <a href="<?= Yii::app()->createUrl(Yii::app()->hasModule('homepage') ? '/homepage/hp/index' : '/site/index') ?>" class="header__logo-link">
                    <img src="<?= $this->mainAssets ?>/images/logo.png" class="header-logo-image">
                </a>
            </div>
            <div class="header__item header-description">Магазин бытовой техники</div>
            <div class="header__item header-phone">
                <div class="header__phone">8 (456) 123-45-67</div>
                <?php if (Yii::app()->hasModule('callback')): ?>
                    <?php $this->widget('application.modules.callback.widgets.CallbackWidget'); ?>
                <?php endif; ?>
            </div>
            <?php if (Yii::app()->hasModule('cart')): ?>
                <div id="shopping-cart-widget">
                    <?php $this->widget('application.modules.cart.widgets.ShoppingCartWidget'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="main__search grid">
        <div class="search-bar">
            <div class="search-bar__wrapper"><a href="javascript:void(0);" data-toggle="#menu-catalog" class="search-bar__catalog-button">Каталог товаров</a>
                <?php $this->widget('application.modules.store.widgets.SearchProductWidget', ['query' => Yii::app()->getRequest()->getQuery('SearchForm')['q']]); ?>
            </div>
            <?php $this->widget('application.modules.store.widgets.CategoryWidget', ['depth' => 2]); ?>
        </div>
    </div>
    <div class="main__breadcrumbs grid">
        <div class="breadcrumbs">
            <?php $this->widget(
                'zii.widgets.CBreadcrumbs',
                [
                    'links' => $this->breadcrumbs,
                    'tagName' => 'ul',
                    'separator' => '',
                    'homeLink' => '<li><a href="/">' . Yii::t('Yii.zii', 'Home') . '</a>',
                    'activeLinkTemplate' => '<li><a href="{url}">{label}</a>',
                    'inactiveLinkTemplate' => '<li><a>{label}</a>',
                    'htmlOptions' => []
                ]
            );?>
        </div>
    </div>
    <?= $content ?>
    <div class="main__footer">
        <div class="footer">
            <div class="grid">
                <div class="footer__wrap">
                    <div class="footer__group">
                        <div class="footer__item">&copy; Yupe! <?= date('Y') ?></div>
                        <div class="footer__item footer__item_mute">Все права защищены.</div>
                    </div>
                    <div class="footer__group">
                        <?php if (Yii::app()->hasModule('menu')): ?>
                            <?php $this->widget('application.modules.menu.widgets.MenuWidget', [
                                'name' => 'top-menu',
                                'layout' => 'footer'
                            ]); ?>
                        <?php endif; ?>
                    </div>
                    <div class="footer__group">
                        <?php $this->widget('application.modules.store.widgets.CategoryWidget', [
                            'depth' => 0,
                            'view' => 'footer'
                        ]); ?>
                    </div>
                    <div class="footer__group">
                        <div class="footer__item footer__item_header">Контакты</div>
                        <div class="footer__item"><i class="fa fa-phone fa-fw"></i> (123) 456-78-90, 0 (123) 456-78-90</div>
                        <div class="footer__item"><i class="fa fa-envelope fa-fw"></i> E-mail: partner@YupeStore.net</div>
                        <div class="footer__item"><i class="fa fa-skype fa-fw"></i> Skype: YupeStore</div>
                    </div>
                    <div class="footer__group">
                        <div class="footer__item footer__item_header">Работаем</div>
                        <div class="footer__item">Пн–Пт 09:00–20:00</div>
                        <div class="footer__item">Сб 09:00–17:00</div>
                        <div class="footer__item">Вс выходной</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php \yupe\components\TemplateEvent::fire(ShopThemeEvents::BODY_END);?>
<div class='notifications top-right' id="notifications"></div>
</body>
</html>