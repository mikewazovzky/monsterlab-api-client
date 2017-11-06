<?php

namespace App;

class View
{
    use Magic;

    /**
     * Render view template to the string.
     * Populated template data
     *
     * @param string $template
     * @return string
     */
    public function render($template)
    {
        foreach ($this->data as $prop => $value) {
            $$prop = $value;
        }

        ob_start();
        include __DIR__ . '/../templates/' . $template;
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }

    /**
     * Display (echo) template
     *
     * @param type name
     * @return type
     */
    public function display($template)
    {
        echo $this->render($template);
    }
}
