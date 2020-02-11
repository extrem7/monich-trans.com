<?php

require_once "includes/helpers.php";
require_once "includes/breadcrumbs.php";
require_once "classes/ThemeBase.php";
require_once 'classes/ThemeRouter.php';

class Theme extends ThemeBase
{
    private static $instance;

    public $router;

    public static function getInstance(): Theme
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    protected function __construct()
    {
        $this->router = new ThemeRouter();
        $this->shortCodes();
        parent::__construct();
        add_action('init', function () {
            //$this->registerTaxonomies();
            $this->registerPostTypes();
        });

        add_action('wp_ajax_mail', [$this, 'mail']);
        add_action('wp_ajax_nopriv_mail', [$this, 'mail']);
    }

    public function mail()
    {
        date_default_timezone_set('Europe/Kiev');

        $headers = "From: MonichTrans<admin@" . $_SERVER['SERVER_NAME'] . ">\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-Type: text/html; charset=utf-8' . "\r\n";

        $fields = [];

        $subject = $_POST['subject'];

        $fields['Дата'] = $_POST['date'] ?? null;

        $fields['Страна погрузки'] = $_POST['loading_country'] ?? null;
        $fields['Город погрузки'] = $_POST['loading_city'] ?? null;
        $fields['Страна выгрузки'] = $_POST['unloading_country'] ?? null;
        $fields['Город выгрузки'] = $_POST['unloading_city'] ?? null;

        $fields['Наименование груза, тоннаж, обьем'] = $_POST['description'] ?? null;

        $fields['Имя клиента'] = $_POST['name'] ?? null;
        $fields['Телефон клиента'] = $_POST['phone'] ?? null;
        $fields['Email клиента'] = $_POST['email'] ?? null;

        if (isset($_POST['delivery']) && !empty($_POST['delivery'])) {
            $fields['Вариант доставки'] = implode(', ', $_POST['delivery']);
        }
        $fields['TIR нужен'] = $_POST['tir'] ?? null;
        if (isset($_POST['transport']) && !empty($_POST['transport'])) {
            $fields['Тип транспорта'] = implode(', ', $_POST['transport']);
        }
        if (isset($_POST['load']) && !empty($_POST['load'])) {
            $fields['Загрузка'] = implode(', ', $_POST['load']);
        }

        $fields['Комментарий'] = $_POST['comment'] ?? null;

        $attachments = [];
        if (!empty($_FILES) && isset($_FILES['photo'])) {
            $file_path = dirname($_FILES['photo']['tmp_name']);
            $new_file_uri = $file_path . '/' . $_FILES['photo']['name'];
            $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $new_file_uri);
            $attachment_file = $moved ? $new_file_uri : $_FILES['photo']['tmp_name'];
            $attachments[] = $attachment_file;
        }

        $message = "<html><head></head><body>";
        foreach ($fields as $key => $field) {
            if ($field !== null)
                $message .= "$key : $field<br>";
        }
        $message .= "<br><p>Данное сообщение сгенерировано автоматически. Пожалуйста, не отвечайте на него.</p>";
        $message .= "</body></html>";


        $mail = wp_mail(get_option('admin_email'), $subject, $message, $headers, $attachments);
        if (isset($attachment_file))
            unlink($attachment_file);

        if ($mail) {
            echo json_encode(['status' => 'ok']);
        } else {
            echo json_encode(['status' => 'error']);
        }
        exit;
    }

    public function pagination(): string
    {
        return get_the_posts_pagination([
            'show_all' => false,
            'end_size' => 3,
            'mid_size' => 3,
            'prev_next' => true,
            'prev_text' => '<',
            'next_text' => '>',
        ]);
    }

    private function shortCodes()
    {
        add_shortcode('gallery', function () {
            if ($gallery = get_field('gallery')) {
                $data = [
                    'main' => array_shift($gallery),
                    'thumbnails' => $gallery
                ];
                return $this->router->render('articles.includes.gallery', $data, false);
            } else {
                return 'Нет галереи';
            }
        });
    }

    private function registerPostTypes(): void
    {
        register_post_type(
            'gallery',
            [
                'label' => null,
                'labels' => [
                    'name' => 'Галерея',
                    'singular_name' => 'Галерея',
                    'add_new' => 'Добавить галерею',
                    'add_new_item' => 'Добавление галереи',
                    'edit_item' => 'Редактирование галереи',
                    'new_item' => '',
                    'view_item' => 'Смотреть галерею',
                    'search_items' => 'Искать галерею',
                    'not_found' => 'Не найдено',
                    'not_found_in_trash' => 'Не найдено в корзине',
                    'menu_name' => 'Галерея',
                ],
                'public' => true,
                'publicly_queryable' => false,
                'menu_position' => 5,
                'menu_icon' => 'dashicons-format-gallery',
                'supports' => ['title', 'custom-fields', 'thumbnail'],
                'has_archive' => false,
            ]);

        $services = get_post(pll_get_post(209));
        register_post_type(
            'service',
            [
                'label' => null,
                'labels' => [
                    'name' => $services->post_title,
                    'singular_name' => 'Услуга',
                    'add_new' => 'Добавить услугу',
                    'add_new_item' => 'Добавление услуги',
                    'edit_item' => 'Редактирование услуги',
                    'new_item' => '',
                    'view_item' => 'Смотреть услугу',
                    'search_items' => 'Искать услугу',
                    'not_found' => 'Не найдено',
                    'not_found_in_trash' => 'Не найдено в корзине',
                    'menu_name' => 'Услуги',
                ],
                'public' => true,
                'menu_position' => 5,
                'menu_icon' => 'dashicons-admin-site-alt3',
                'supports' => ['title', 'editor', 'excerpt', 'page-attributes', 'custom-fields', 'thumbnail'],
                'has_archive' => false,
                'hierarchical' => true,
                'rewrite' => ['slug' => 'services']
            ]);
    }

}
