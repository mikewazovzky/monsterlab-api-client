<?php

namespace App;

class Environment
{
    use Singleton;

    /**
     * Env configuration parameters.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Default env parameters filename.
     *
     * @var string
     */
    protected $filename = __DIR__ . '/../.env';

    /**
     * Create Environment  instance  singleton and
     * read configuration parameters from the file
     *
     * @param type name
     * @return type
     */
    protected function __construct($filename = null)
    {
        $filename = $filename ?: $this->filename;

        if (!file_exists($filename)) {
            throw new \Exception("Error: Can not read env file.");
        }

        $lines = file($filename, FILE_SKIP_EMPTY_LINES);
        $lines = array_filter($lines, function ($line) {
            return mb_strlen(trim($line)) !== 0 && $line[0] !== '#';
        });

        foreach ($lines as $line) {
            list($key, $value) = explode('=', trim($line));
            $this->data[$key] = $value;
        }
    }

    /**
     * Get env configuration parameter
     *
     * @param string $key - parameter key
     * @param string $default - default parameter value
     * @return mixed
     */
    public function get($key, $default)
    {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }
}
