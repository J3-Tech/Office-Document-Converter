<?php

    function read($file)
    {
        return file_get_contents($file);
    }

    /**
     * write to file.
     * 
     * @param string $file   - filename to write in or create
     * @param string $text   - text to write
     * @param bool   $append - whether to append
     */
    function write($file, $text, $append = false)
    {
        $mode = ($append) ? 'a' : 'w';
        $fh = fopen($file, $mode);
        fwrite($fh, $text);
        fclose($fh);
    }

    /**
     * logger - log text in file (implement in case of error).
     * 
     * @param string $text - text to be written
     */
    function logger($text)
    {
        $logFile = LOG.date('Y-m-d').'.log';
        write($logFile, date('Y-m-d H:i:s')." - $text\n", true);
    }

    /**
     * redirect - to another link.
     * 
     * @param string $location
     */
    function redirect($location)
    {
        header("Location:{$location}");
        exit;
    }

    /**
     * __autoload - load class file at run time.
     * 
     * @param string $class_name
     */
    function __autoload($class_name)
    {
        $class_name = strtolower($class_name);
        $path = LIB."/{$class_name}.php";
        if (file_exists($path)) {
            require_once $path;
        } else {
            die("The file {$class_name}.php could not be found");
        }
    }

    /**
     * getTemplate - load tempate (ex. header, footer).
     * 
     * @param string $name - name of template
     */
    function getTemplate($name)
    {
        if (file_exists(TEMPLATES_PATH."/{$name}.php")) {
            include TEMPLATES_PATH."/{$name}.php";
        } else {
            die("The file {$name}.php could not be found");
        }
    }
