<?php
require_once get_template_directory() . "/vendor/autoload.php";
require_once get_template_directory() . "/app/controllers/Controller.php";

use Jenssegers\Blade\Blade;

class ThemeRouter
{
    private $blade;

    public function __construct()
    {
        $this->blade = new Blade(get_template_directory() . '/views', get_template_directory() . '/cache');
        $this->directives();
        add_filter('theme_page_templates', [$this, 'pageTemplates']);
        add_filter('theme_service_templates', [$this, 'serviceTemplates']);
        add_filter('template_include', [$this, 'routes']);
    }

    public function render(string $view, array $args = [], bool $echo = true)
    {
        $blade = new Blade(__dir__ . '/src/views', __dir__ . '/cache');
        $html = $this->blade->make($view, $args);
        if ($echo) {
            echo $html;
        } else {
            return $html;
        }
    }

    private function directives(): void
    {
        $this->blade->directive('title', function () {
            return "<?php the_title() ?>";
        });
        $this->blade->directive('content', function () {
            return "<?php the_post_content(); ?>";
        });
        $this->blade->directive('link', function () {
            return "<?php the_permalink() ?>";
        });
        $this->blade->directive('excerpt', function () {
            return "<?php the_excerpt() ?>";
        });
        $this->blade->directive('reset_query', function () {
            return "<?php wp_reset_query(); ?>";
        });
        $this->blade->directive('option', function ($field) {
            return "<?php the_option($field); ?>";
        });
        $this->blade->directive('row', function ($option) {
            return "<?php while(have_rows($option)):the_row(); ?>";
        });
        $this->blade->directive('rowend', function ($option) {
            return "<?php endwhile; ?>";
        });
        $this->blade->directive('icon', function ($icon) {
            return get_icon($icon);
        });
        $this->blade->directive('trans', function ($string) {
            return "<?php pll_e($string) ?>";
        });
        $this->blade->directive('logged', function () {
            return "<?php if(is_user_logged_in()): ?>";
        });
    }

    public function pageTemplates(array $post_templates): array
    {
        $templates = [
            'views/pages/home.blade.php' => 'Главная',
            'views/pages/faq.blade.php' => 'Информация',
            'views/pages/about.blade.php' => 'О нас',
            'views/pages/contacts.blade.php' => 'Контакты',
            'views/pages/gallery.blade.php' => 'Галерея',
            'views/pages/reviews.blade.php' => 'Отзывы',
            'views/services/archive.blade.php' => 'Услуги',
        ];

        return $templates;
    }

    public function serviceTemplates(array $service_templates): array
    {
        $templates = [
            'views/services/transfers.blade.php' => 'Международные переезды',
            'views/services/transfer.blade.php' => 'Переезд из страны',
        ];

        return $templates;
    }

    public function routes(string $template)
    {
        global $post;
        $view = '';
        $data = [];
        if (is_front_page()) {
            $data = Controller::home();
        }
        if (is_archive()) {
            //$data = Controller::archive();
            $view = 'articles/archive';
        }
        if (is_search()) {
            $data = Controller::archive();
            $view = 'articles/archive';
        }
        if (is_single()) {
            switch (get_post_type()) {
                case 'post':
                    $data = Controller::single($post);
                    $view = 'articles/single';
                    break;
                case 'service':
                    if ($templates = get_page_template_slug()) {
                        if ($post->post_parent == 0) {
                            $data = Controller::transfers($post);
                        } else {
                            $data = Controller::transfer($post);
                        }
                    } else {
                        $data = Controller::service($post);
                        $view = 'services/single';
                    }
                    break;
            }
        }
        if (is_404()) {
            $view = 'errors/404';
        }
        if (is_page()) {
            if (!get_page_template_slug()) {
                $view = 'page';
            } else {
                switch (get_page_template_slug()) {
                    case 'views/pages/gallery.blade.php':
                        $data = Controller::gallery();
                        break;
                    case 'views/services/archive.blade.php':
                        $data = Controller::services();
                        break;
                    default;
                        break;
                }
            }
        }
        if ($view === '') {
            $view = explode('views/', $template)[1];
            $view = str_replace('.php', '', $view);
            $view = str_replace('.blade', '', $view);
        }

        if (is_archive() || is_singular('post')) {
            $term = get_term(pll_get_term(1));
            if ($title = get_field('title', $term)) $data['title'] = $title;
            if ($text = get_field('text', $term)) $data['text'] = $text;
            if ($background = get_field('background', $term)) $data['background'] = $background;
        }

        if ($title = get_field('title')) $data['title'] = $title;
        if ($text = get_field('text')) $data['text'] = $text;
        if ($background = get_field('background')) {
            $data['background'] = $background;
        } else {
            $data['background'] = asset('img/bg_news.jpg');
        }

        $common = Controller::common();
        $this->render($view, array_merge($data, $common));
        return null;
    }
}
