<?php

function imgd_widgets_init() {
    /** Register widgets */
    register_widget('imgd_vcard_widget');
    register_widget('imgd_destacadas_widget');
    register_widget('imgd_social_widget');
}

add_action('widgets_init', 'imgd_widgets_init');

/**
 * vCard Widget
 *
 * Basado en el vCard que viene de default con roots
 */
class imgd_vcard_widget extends WP_Widget {

    private $fields = array(
        'title' => 'Title (optional)',
        'street_address' => 'Street Address',
        'locality' => 'Ciudad/Localidad',
        'region' => 'Estado',
        'postal_code' => 'Cod. Postal',
        'tel' => 'Teléfono',
        'email' => 'Email'
    );

    function __construct() {
        $widget_ops = array('classname' => 'widget_imgd_vcard',
            'description' => __('Use this widget to add a vCard', 'imgd'));

        $this->WP_Widget('widget_imgd_vcard', __('IMGD: vCard', 'imgd'), $widget_ops);
        $this->alt_option_name = 'widget_imgd_vcard';

        add_action('save_post', array(&$this, 'flush_widget_cache'));
        add_action('deleted_post', array(&$this, 'flush_widget_cache'));
        add_action('switch_theme', array(&$this, 'flush_widget_cache'));
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_imgd_vcard', 'widget');

        if (!is_array($cache)) {
            $cache = array();
        }

        if (!isset($args['widget_id'])) {
            $args['widget_id'] = null;
        }

        if (isset($cache[$args['widget_id']])) {
            echo $cache[$args['widget_id']];
            return;
        }

        ob_start();
        extract($args, EXTR_SKIP);

        $title = apply_filters('widget_title', !empty($instance['title']) ? $instance['title'] : '', $instance, $this->id_base);

        foreach ($this->fields as $name => $label) {
            if (!isset($instance[$name])) {
                $instance[$name] = '';
            }
        }

        echo $before_widget;

        if ($title) {
            echo $before_title, $title, $after_title;
        }
        ?>

        <address class="vcard">
            <p>
                <?php if ($instance['street_address']!=='') { ?>
                    <span class="street-address"><?php echo $instance['street_address']; ?></span><br>
                <?php } ?>
                <?php if ($instance['locality']!=='') { ?>
                    <span class="locality"><?php echo $instance['locality']; ?></span>,
                <?php } ?>
                <?php if ($instance['region']!=='') { ?>
                    <span class="region"><?php echo $instance['region']; ?></span>
                <?php } ?>
                <?php if ($instance['postal_code']!=='') { ?>
                    <span class="postal-code">(<?php echo $instance['postal_code']; ?>)</span><br>
                <?php } ?>
                <?php if ($instance['tel']!=='') { ?>
                    <span class="tel">Tel: <span class="value"><?php echo $instance['tel']; ?></span></span><br>
                <?php } ?>
                <?php if ($instance['email']!=='') { ?>
                    <a class="email" href="mailto:<?php echo $instance['email']; ?>">
                        <?php echo $instance['email']; ?></a>
                <?php } ?>
            </p>
        </address>
        <?php
        echo $after_widget;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_imgd_vcard', $cache, 'widget');
    }

    function update($new_instance, $old_instance) {
        $instance = array_map('strip_tags', $new_instance);

        $this->flush_widget_cache();

        $alloptions = wp_cache_get('alloptions', 'options');

        if (isset($alloptions['widget_imgd_vcard'])) {
            delete_option('widget_imgd_vcard');
        }

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_imgd_vcard', 'widget');
    }

    function form($instance) {
        foreach ($this->fields as $name => $label) {
            ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", 'imgd'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
            </p>
        <?php
        }
    }

}

/**
 * Destacadas Widget
 * Propiedades Destacadas
 *
 * @todo Activar las opciones para ue el mismo widget sirva para varias cosas
 *
 * Usa de Template el Widget de vCard que viene de default con roots
 */
class imgd_destacadas_widget extends WP_Widget {

    private $fields = array(
        'title' => 'Title (optional)',
//        'options' => array(
//            'destacadas' => 'Propiedades Destacadas',
//            'recientes' => 'Propiedades Recientes',
//        //'ciudad' => 'Proiedades x Ciudad'
//        ),
    );

    function __construct() {
        $widget_ops = array('classname' => 'widget_imgd_destacadas',
            'description' => __('Use this widget to add 
                a list of thumbnails of destacadas', 'imgd'));

        $this->WP_Widget('widget_imgd_destacadas', __('IMGD: Destacadas', 'imgd'), $widget_ops);
        $this->alt_option_name = 'widget_imgd_destacadas';

        add_action('save_post', array(&$this, 'flush_widget_cache'));
        add_action('deleted_post', array(&$this, 'flush_widget_cache'));
        add_action('switch_theme', array(&$this, 'flush_widget_cache'));
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_imgd_destacadas', 'widget');

        if (!is_array($cache)) {
            $cache = array();
        }

        if (!isset($args['widget_id'])) {
            $args['widget_id'] = null;
        }

        if (isset($cache[$args['widget_id']])) {
            echo $cache[$args['widget_id']];
            return;
        }

        ob_start();
        extract($args, EXTR_SKIP);

        $title = apply_filters('widget_title', !empty($instance['title']) ? $instance['title'] : '', $instance, $this->id_base);

        foreach ($this->fields as $name => $label) {
            if (!isset($instance[$name])) {
                $instance[$name] = '';
            }
        }

        echo $before_widget;
        ?>

        <?php
        /**
         * @TODO Colocar el filtro para las posibilidades que el widget tenga opciones
         */
        $args = array('post_type' => 'nowik',
            'post_status' => 'publish',
            'meta_key' => 'imgd_destacada',
            'meta_value' => '1',
            'post_limits' => '6'
        );

        $propiedades = new WP_Query($args);

        if ($propiedades->have_posts()) {
            ?>
            <?php
            // Sólo muestra el título del widget si hay data, sino no!
            if ($title) {
                echo $before_title, $title, $after_title;
            }
            ?>
            <div class = "row prop-desta">
                <?php while ($propiedades->have_posts()) : $propiedades->the_post();
                    ?>

                    <div class="col-span-4 col-small-span-4">
                        <a href="<?php the_permalink(); ?>" class="thumbnail">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail(array(100, 100), array('class' => "imgdecor"));
                            }
                            ?>
                        </a>
                    </div>


                <?php endwhile; ?>
            </div>
        <?php } //End have Post
        ?>

        <?php
        echo $after_widget;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_imgd_destacadas', $cache, 'widget');
    }

    function update($new_instance, $old_instance) {
        $instance = array_map('strip_tags', $new_instance);

        $this->flush_widget_cache();

        $alloptions = wp_cache_get('alloptions', 'options');

        if (isset($alloptions['widget_imgd_destacadas'])) {
            delete_option('widget_imgd_destacadas');
        }

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_imgd_destacadas', 'widget');
    }

    function form($instance) {
        foreach ($this->fields as $name => $label) {
            ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", 'roots'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
            </p>
        <?php
        }
    }

}

/**
 * Social Widget
 * Links a redes sociales
 *
 * Usa de Template el Widget de vCard que viene de default con roots
 */
class imgd_social_widget extends WP_Widget {

    private $fields = array(
        'title' => 'Title (optional)',
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'google' => 'Google Plus',
    );

    function __construct() {
        $widget_ops = array('classname' => 'widget_imgd_destacadas',
            'description' => __('Use this widget to add 
                a list of thumbnails of destacadas', 'roots'));

        $this->WP_Widget('widget_imgd_social', __('IMGD: SociaL', 'roots'), $widget_ops);
        $this->alt_option_name = 'widget_imgd_social';

        add_action('save_post', array(&$this, 'flush_widget_cache'));
        add_action('deleted_post', array(&$this, 'flush_widget_cache'));
        add_action('switch_theme', array(&$this, 'flush_widget_cache'));
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_imgd_social', 'widget');

        if (!is_array($cache)) {
            $cache = array();
        }

        if (!isset($args['widget_id'])) {
            $args['widget_id'] = null;
        }

        if (isset($cache[$args['widget_id']])) {
            echo $cache[$args['widget_id']];
            return;
        }

        ob_start();
        extract($args, EXTR_SKIP);

        $title = apply_filters('widget_title', !empty($instance['title']) ? $instance['title'] : '', $instance, $this->id_base);

        foreach ($this->fields as $name => $label) {
            if (!isset($instance[$name])) {
                $instance[$name] = '';
            }
        }

        echo $before_widget;
        $data = "";

        if ($instance['google']) {
            $data .= '<li><a href="http://plus.google.com/' . $instance["google"] . '"><i class="icon-google-plus-sign"></i></a>';
        }
        if ($instance['facebook']) {
            $data .= '<li><a href="http://facebook.com/' . $instance["facebook"] . '"><i class="icon-facebook-sign"></i></a>';
        }
        if ($instance['twitter']) {
            $data .= '<li><a href="http://twitter.com/' . $instance["twitter"] . '"><i class="icon-twitter-sign"></i></a>';
        }

        if ($data != '') {
            ?>
            <ul class="social list-inline">
                <?php echo $data; ?>
            </ul>
        <?php
        }
        echo $after_widget;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_imgd_social', $cache, 'widget');
    }

    function update($new_instance, $old_instance) {
        $instance = array_map('strip_tags', $new_instance);

        $this->flush_widget_cache();

        $alloptions = wp_cache_get('alloptions', 'options');

        if (isset($alloptions['widget_imgd_social'])) {
            delete_option('widget_imgd_social');
        }

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_imgd_social', 'widget');
    }

    function form($instance) {
        foreach ($this->fields as $name => $label) {
            ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", 'roots'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
            </p>
        <?php
        }
    }

}