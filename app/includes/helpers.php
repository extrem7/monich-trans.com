<?php

//cool functions for development

function pre($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function dd($array)
{
    pre($array);
    exit;
}

function path()
{
    return get_template_directory_uri() . '/';
}

function tel(string $phone)
{
    return 'tel:' . preg_replace('/[^0-9]/', '', $phone);
}

function the_post_content()
{
    global $id;
    echo apply_filters('the_content', wpautop(get_post_field('post_content', $id), true));
}

function the_image($name, $class = '', $post = null, $size = 'full')
{
    if ($post == null) {
        global $post;
    }

    $image = get_field($name);

    echo wp_get_attachment_image($image, $size, false, ['class' => $class]);
}

function get_icon(string $name)
{
    return file_get_contents(path() . "assets/img/$name.svg");
}

function the_checkbox($field, $print, $post = null)
{
    if ($post == null) {
        global $post;
    }
    echo get_field($field, $post) ? $print : null;
}

function the_table($field, $post = null)
{
    if ($post == null) {
        global $post;
    }
    $table = get_field($field, $post);
    if ($table) {
        echo '<table>';
        if ($table['header']) {
            echo '<thead>';
            echo '<tr>';
            foreach ($table['header'] as $th) {
                echo '<th>';
                echo $th['c'];
                echo '</th>';
            }
            echo '</tr>';
            echo '</thead>';
        }
        echo '<tbody>';
        foreach ($table['body'] as $tr) {
            echo '<tr>';
            foreach ($tr as $td) {
                echo '<td>';
                echo $td['c'];
                echo '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
}

function the_link($field, $post = null, $classes = "")
{
    if ($post == null) {
        global $post;
    }
    $link = get_field($field, $post);
    if ($link) {
        echo "<a ";
        echo "href='{$link['url']}'";
        echo "class='$classes'";
        echo "target='{$link['target']}'>";
        echo $link['title'];
        echo "</a>";
    }
}

function repeater_image(string $name)
{
    echo 'src="' . get_sub_field($name)['url'] . '" ';
    echo 'alt="' . get_sub_field($name)['alt'] . '" ';
}

function front_id()
{
    return get_option('page_on_front');
}

/**
 * @param WP_Post|null $post
 * @return WP_Term[]
 */
function post_categories(WP_Post $post = null): array
{
    if ($post == null) {
        global $post;
    }
    return wp_get_post_categories(get_the_ID(), [
        'exclude' => [get_queried_object_id(), get_field('blog_category', front_id())->term_id]
    ]);
}

function the_option(string $name, string $page = 'option')
{
    echo get_field($name, $page);
}

function view(string $view, array $args = null, string $folder = 'views')
{
    if (!empty($args) && is_array($args)) {
        extract($args); // @codingStandardsIgnoreLine
    }
    include get_template_directory() . "/$folder/$view.php";
}

function time_diff(WP_Post $post = null): string
{
    if ($post == null) {
        global $post;
    }
    return human_time_diff(get_post_time('U'), current_time('timestamp')) . ' назад';
}

function get_views(WP_Post $post = null): int
{
    if ($post == null) {
        global $post;
    }

    $id = $post->ID;
    $metaKey = 'post_views_count';
    $count = get_post_meta($id, $metaKey, true);
    if ($count == '') {
        $count = 1;
        delete_post_meta($id, $metaKey);
        add_post_meta($id, $metaKey, 1);
    } else {
        $count++;
        update_post_meta($id, $metaKey, $count);
    }
    return $count;
}

function asset(string $path)
{
    return path() . 'assets/' . $path;
}

function pll_option(string $name)
{
    if ($value = get_field($name, 'options_' . pll_current_language())) {
        return $value;
    }
    return get_field($name, 'options_ru');
}
