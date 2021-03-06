<?php
/**
 * Latest posts widget
 *
 * @package Rhythm
 */

class WP_Newsletter_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array('classname' => 'widget_newsletter_entries', 'description' => __( "Add newsletter", 'rhythm-addons' ) );
        parent::__construct('text-block', __( 'Rhythm: Newsletter', 'rhythm-addons' ), $widget_ops);

        $this-> alt_option_name = 'widget_newsletter_entries';

        add_action( 'save_post', array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance)
    {
        global $post;

        $cache = wp_cache_get('widget_newsletter_entries', 'widget');

        if ( !is_array($cache) )
        {
            $cache = array();
        }
        if ( ! isset( $args['widget_id'] ) )
        {
            $args['widget_id'] = $this->id;
        }

        if ( isset( $cache[ $args['widget_id'] ] ) )
        {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);
        echo $before_widget;

        $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

        if ($title):
            echo $before_title.esc_html($title).$after_title;
        endif; ?>

        <div class="mb-20">Stay informed with our newsletter. Please trust us, we will never send you spam.</div>
        <div class="mb-20"><?php echo do_shortcode('[wysija_form id="'.$instance['content'].'"]'); ?></div>

        <?php echo $after_widget;
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_newsletter_entries', $cache, 'widget');
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['content'] = $new_instance['content'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_newsletter_entries']) )
        {
            delete_option('widget_newsletter_entries');
        }
        return $instance;
    }

    function flush_widget_cache()
    {
        wp_cache_delete('widget_newsletter_entries', 'widget');
    }

    function form( $instance )
    {
        $title   = isset($instance['title']) ? $instance['title'] : '';
        $content = isset($instance['content']) ? $instance['content'] : '';
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'rhythm-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php _e( 'Form ID (Content):', "rhythm-addons" ); ?></label>
        <textarea class="widefat" rows="7" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>"><?php echo esc_textarea($content); ?></textarea></p>
        <?php
    }
}
