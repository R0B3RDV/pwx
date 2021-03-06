<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * Build PWX
     */
    public function build()
    {
        // Minify JS
        $this->taskMinify('web/js/script.js')
            ->run();

        // Minify CSS
        $this->taskMinify('web/css/style.css')
            ->run();

        // Concat JS
        $this->taskConcat(array(
            'web/js/jquery.min.js',
            'web/js/bootstrap.min.js',
            'web/js/jquery.countdown.min.js',
            'web/js/jquery.zclip.min.js',
            'web/js/js.cookie.min.js',
            'web/js/hideShowPassword.min.js',
            'web/js/script.min.js',
        ))
            ->to('web/js/scripts.min.js')
            ->run();
    }

    /**
     * Watch CSS and JS assets for changes and compile minfied assets on change
     */
    public function watch()
    {
        $this->taskWatch()
            ->monitor(
                array('web/js/script.js', 'web/css/style.css'),
                function() {
                    $this->build();
                }
            )
            ->run();
    }
}

