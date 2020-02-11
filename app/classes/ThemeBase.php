<?php

class ThemeBase
{
    protected function __construct()
    {
        $this->themeSetup();
        $this->enqueueStyles();
        $this->enqueueScripts();
        $this->customHooks();
        $this->GPSI();
        //$this->registerWidgets();
        $this->ACF();
        $this->registerNavMenus();
        $this->Polylang();
    }

    private function themeSetup()
    {
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_theme_support('widgets');
        show_admin_bar(false);
    }

    private function enqueueStyles()
    {
        add_action('wp_print_styles', function () {
            wp_register_style('main', path() . 'assets/css/main.css');
            wp_enqueue_style('main');
        });
        add_action('admin_enqueue_scripts', function () {
            //wp_enqueue_style('admin-styles', get_template_directory_uri() . '/assets/css/admin.css');
        });
    }

    private function enqueueScripts()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_deregister_script('jquery');

            wp_register_script('main', path() . 'assets/js/main.js');
            wp_enqueue_script('main');
            wp_localize_script('main', 'sharedData',
                [
                    'adminAjax' => admin_url('admin-ajax.php'),
                    'locale' => pll_current_language()
                ]
            );
        });
    }

    private function customHooks()
    {
        add_action('admin_init', function () {
            global $user_ID;
            if (!current_user_can('administrator')) {
                remove_menu_page('tools.php');
                remove_menu_page('themes.php');
                remove_menu_page('edit-comments.php');
                remove_menu_page('plugins.php');
                remove_menu_page('users.php');
                remove_menu_page('options-general.php');
            }
        });
        add_filter('nav_menu_css_class', function ($classes, $item) {
            if (in_array('current-menu-item', $classes)) {
                $classes[] = 'active ';
            }
            return $classes;
        }, 10, 2);
        add_action('navigation_markup_template', function ($content) {
            $content = str_replace('role="navigation"', '', $content);
            $content = preg_replace('#<h2.*?>(.*?)<\/h2>#si', '', $content);

            return $content;
        });
        add_image_size('article', 320, 220, ['center', 'center']);
        add_image_size('article_big', 600, 300, ['center', 'center']);
        add_filter('wpcf7_form_elements', function ($content) {
            // pre($content);
            $content = preg_replace('/<br \/>/', '', $content);
            return $content;
        });
        add_filter('body_class', function ($classes) {
            if (is_404()) $classes[] = 'error-page';
            switch (get_page_template_slug()) {
                case 'views/pages/contacts.blade.php':
                    $classes[] = 'page-contact';
                    break;
                case 'views/pages/about.blade.php':
                    $classes[] = 'page-about';
                    break;
                case 'views/services/archive.blade.php':
                    $classes[] = 'archive-services';
                    break;
                default;
                    break;
            }
            return $classes;
        });
        add_action('template_redirect', function () {
        });
        add_action('pre_get_posts', function (WP_Query $query) {
            if (!is_admin() && $query->is_search() && $query->is_main_query()) {
                $query->set('post_type', 'post');
            }
        });
        add_filter('comment_reply_link', function ($link) {
            if (empty ($GLOBALS['user_ID']) && get_option('comment_registration')) {
                return '';
            }

            return $link;
        });
        add_action('wp_logout', function () {
            wp_redirect(home_url());
            exit();
        });
        add_filter('comment_text', function ($text) {
            return '<div class="comment-text mb-2">' . $text . '</div><div class="d-flex align-items-center justify-content-between">';
        }, 33);
        add_filter('wp_mail_from_name', function ($from_name) {
            return 'admin@monich-trans.com'; // тут можно указать свою почту: asd@asd.ru
        });
    }

    private function ACF()
    {
        if (function_exists('acf_add_options_page')) {
            $main = acf_add_options_page([
                'page_title' => 'Общие настойки',
                'menu_title' => 'Настройки',
                'menu_slug' => 'theme-general-settings',
                'capability' => 'edit_theme_options',
                'redirect' => false,
                'position' => 2,
                'icon_url' => 'dashicons-hammer',
            ]);
            acf_add_options_sub_page([
                'page_title' => 'Русский',
                'menu_title' => "Русский",
                'menu_slug' => 'options_ru',
                'parent_slug' => $main['menu_slug'],
                'post_id' => 'options_ru',
            ]);
            acf_add_options_sub_page([
                'page_title' => 'Украинский',
                'menu_title' => "Украинский",
                'menu_slug' => 'options_uk',
                'parent_slug' => $main['menu_slug'],
                'post_id' => 'options_uk',
            ]);
            acf_add_options_sub_page([
                'page_title' => 'English',
                'menu_title' => "English",
                'menu_slug' => 'options_en',
                'parent_slug' => $main['menu_slug'],
                'post_id' => 'options_en',
            ]);
        }

        $path = get_template_directory() . '/app/acf';
        add_filter('acf/settings/save_json', function () use ($path) {
            return $path;
        });
        add_filter('acf/settings/load_json', function () use ($path) {
            return [$path];
        });
    }

    private function GPSI()
    {
        add_action('after_setup_theme', function () {
            remove_action('wp_head', 'wp_print_scripts');
            remove_action('wp_head', 'wp_print_head_scripts', 9);
            remove_action('wp_head', 'wp_enqueue_scripts', 1);
            add_action('wp_footer', 'wp_print_scripts', 5);
            add_action('wp_footer', 'wp_enqueue_scripts', 5);
            add_action('wp_footer', 'wp_print_head_scripts', 5);
            remove_action('wp_head', 'wp_generator');
            remove_action('wp_head', 'wlwmanifest_link');
            remove_action('wp_head', 'rsd_link');
            remove_action('wp_head', 'wp_shortlink_wp_head');
            remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
            add_filter('the_generator', '__return_false');
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('wp_print_styles', 'print_emoji_styles');
        });
        add_action('wp_print_styles', function () {
            wp_deregister_style('dashicons');
        }, 100);
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');
        add_filter('use_block_editor_for_post_type', '__return_false', 10);
        add_action('wp_enqueue_scripts', function () {
            wp_dequeue_style('wp-block-library');
            wp_dequeue_style('wp-block-library-theme');
            wp_dequeue_style('wc-block-style');
            wp_dequeue_style('storefront-gutenberg-blocks');
        }, 100);

    }

    private function Polylang()
    {
        add_action('init', function () {
            $strings = [
                'Заказать перевозку' => 'Заказать перевозку',
                'Услуги компании' => 'Услуги компании',
                'Перевозки с Европы' => 'Перевозки с Европы',
                'Подробнее' => 'Подробнее',
                'Заказать услугу' => 'Заказать услугу',
                'Перевозки с' => 'Перевозки с',
                'Перевозки в' => 'Перевозки в',
                'Расчитать стоимость' => 'Расчитать стоимость',
                'выберите страну из списка' => 'выберите страну из списка',
                'Перевозки с (в)' => 'Перевозки с (в)',

                'У Вас остались вопросы?' => 'У Вас остались вопросы?',
                'Мы с нетерпением ждем вашего обращения:' => 'Мы с нетерпением ждем вашего обращения:',
                'Имя' => 'Имя',
                'Телефон' => 'Телефон',
                'Текст сообщения' => 'Текст сообщения',
                'Задать вопрос' => 'Задать вопрос',

                'Читать полностью' => 'Читать полностью',
                'Загрузить еще' => 'Загрузить еще',

                'Получить бесплатную консультацию' => 'Получить бесплатную консультацию',
                'Заказать звонок' => 'Заказать звонок',
                'Посмотреть оригинал отзыва' => 'Посмотреть оригинал отзыва',

                'Спасибо!' => 'Спасибо!',
                'Консультант свяжется с вами' => 'Консультант свяжется с вами',
                'на протяжении 10 минут' => 'на протяжении 10 минут',

                'Расчет стоимости' => 'Расчет стоимости',
                'Дата перевозки' => 'Дата перевозки',
                'Страна погрузки' => 'Страна погрузки',
                'Город или код' => 'Город или код',
                'Страна выгрузки' => 'Страна выгрузки',
                'Наименование груза, тоннаж, обьем' => 'Наименование груза, тоннаж, обьем',
                'Укажите свое имя' => 'Укажите свое имя',
                'Ваш номер телефона' => 'Ваш номер телефона',
                'Ваш email' => 'Ваш email',
                'Вариант доставки' => 'Вариант доставки',
                'TIR нужен' => 'TIR нужен',
                'Тип транспорта' => 'Тип транспорта',
                'Загрузка' => 'Загрузка',
                'Фото' => 'Фото',
                'Коментарий' => 'Коментарий',
                'Выберите файл' => 'Выберите файл',
                'Рассчитать' => 'Рассчитать',

                'Просмотреть все новости' => 'Просмотреть все новости',
                'Новости' => 'Новости',
                'Прочитать новость' => 'Прочитать новость',

                'Эта страница недоступна' => 'Эта страница недоступна',
                'Возможно, вы  воспользовались...' => 'Возможно, вы  воспользовались недействительной ссылкой или страница была удалена.',
                'На главную' => 'На главную',
            ];
            foreach ($strings as $key => $string)
                pll_register_string($key, $string);
        });
    }

    private function registerNavMenus()
    {
        add_action('after_setup_theme', function () {
            register_nav_menus(['header' => 'Меню в шапке']);
            register_nav_menus(['services' => 'Услуги компании']);
            register_nav_menus(['transfers' => 'Перевозки с Европы']);
        });
    }
}
