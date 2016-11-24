<?php

/**
 * Created by PhpStorm.
 * User: zhuk
 * Date: 21.11.16
 * Time: 23:49
 */

namespace View;

/**
 * Class View
 */
class View
{
    /**
     * @param string $template
     * @param array  $paramsPartial
     *
     * @return string
     *
     * @throws \Exception
     */
    public function render($template, $paramsPartial = [])
    {
        $content = '';
        $partial = __DIR__.DIRECTORY_SEPARATOR.$template.'.php';

        if (file_exists($partial)) {
            ob_start();
            extract($paramsPartial);
            include $partial;
            $content = ob_get_contents();
            ob_end_clean();
        } else {
            throw new \Exception('View not found', 500);
        }

        try {
            ob_start();
            include 'template.php';
            $result = ob_get_contents();
            ob_end_clean();
        } catch (\Exception $e) {
            $result = $e->getMessage();
        }

        return $result;
    }
}