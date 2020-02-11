<?php

class Controller
{
    public static function common(): array
    {
        $data = [];
        $data['languages'] = pll_the_languages(['raw' => 1]);
        $data['viber'] = get_field('viber', 'option');
        $data['whatsapp'] = get_field('whatsapp', 'option');
        $data['copyright'] = get_field('copyright', 'option');
        $data['copyrightBottom'] = get_field('copyright_bottom', 'option');

        function mapAcf($item)
        {
            return reset($item);
        }

        $data['order'] = [
            'countries' => array_map('mapAcf', pll_option('countries')),
            'delivery' => array_map('mapAcf', pll_option('delivery')),
            'tir' => array_map('mapAcf', pll_option('tir')),
            'transport' => array_map('mapAcf', pll_option('transport')),
            'load' => array_map('mapAcf', pll_option('load')),
        ];

        return $data;
    }

    public static function home(): array
    {
        $news = get_posts([
            'posts_per_page' => 3
        ]);
        $blocks = [
            'service-block' => get_field('service_block'),
            'news-block' => get_field('news_block')
        ];
        $about = get_field('about');
        $advantages = get_field('advantages');
        $statistics = get_field('statistics');
        $partners = get_field('partners');
        $titles = get_field('titles');
        $contacts = get_fields(pll_get_post(14) ? pll_get_post(14) : 14);
        return compact('news', 'blocks', 'about', 'advantages', 'statistics', 'partners', 'contacts', 'titles');
    }

    public static function gallery(): array
    {
        $galleries = get_posts([
            'post_type' => 'gallery',
            'posts_per_page' => -1
        ]);
        return compact('galleries');
    }

    public static function single(WP_Post $post): array
    {
        $posts = get_posts([
            'posts_per_page' => 3,
            'exclude' => $post->ID
        ]);
        return compact('posts');
    }

    public static function services(): array
    {
        $services = get_posts([
            'post_type' => 'service',
            'post_parent' => 0,
            'posts_per_page' => -1
        ]);
        return compact('services');
    }

    public static function service(WP_Post $post): array
    {
        $advantages = pll_option('services_advantages');
        return compact('advantages');
    }

    public static function transfers(WP_Post $post): array
    {
        $ukraine = get_posts([
            'post_type' => 'service',
            'posts_per_page' => -1,
            'meta_key' => 'country_from',
            'meta_value' => 'ua'
        ]);
        $russia = get_posts([
            'post_type' => 'service',
            'posts_per_page' => -1,
            'meta_key' => 'country_from',
            'meta_value' => 'ru'
        ]);
        $advantages = pll_option('services_advantages');
        return compact('advantages', 'ukraine', 'russia');
    }

    public static function transfer(WP_Post $post): array
    {
        $country = get_field('country');
        $countryTo = get_field('country_to') ?? $country;
        $flag = get_field('country_from') == 'ua' ? 'uk.jpg' : 'ru.jpg';
        return compact('country', 'countryTo', 'flag');
    }
}
