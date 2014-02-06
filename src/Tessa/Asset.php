<?php

namespace App;

class AssetFinder
{
    private $root;

    public function __construct($root)
    {
        $this->root = $root;
    }

    function glob_recursive($pattern, $flags = 0)
    {
        $files = glob($pattern, $flags);
        foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
            $files = array_merge($files, $this->glob_recursive($dir . '/' . basename($pattern), $flags));
        }
        return $files;
    }

    public function find($path, $map)
    {
        $root = $this->root;
        $files = $this->glob_recursive($root . $path);

        $assets = array_map(
            $map,
            array_filter($files, function ($file) {
                return is_file($file);
            })
        );

        $value = implode("\n", $assets);

        return (strlen($value) ? $value . "\n" : '');
    }

    public function script($path)
    {
        $root = $this->root;

        return $this->find($path, function ($file) use ($root) {
            return '<script src="' . substr($file, strlen($root)) . '"></script>';
        });
    }

    public function link($path, $rel = "stylesheet", $type = "text/css")
    {
        $root = $this->root;

        return $this->find($path, function ($file) use ($root, $rel, $type) {
            return '<link href="' . substr($file, strlen($root)) . '" rel="' . $rel . '" type="' . $type . '"/>';
        });
    }

    public function template($path, $type = "script/ng-template")
    {
        $root = $this->root;

        return $this->find($path, function ($file) use ($root, $type) {
            return '<script id="' . substr($file, strlen($root)) . '" type="' . $type . '">'
            . file_get_contents($file)
            . '</script>';
        });
    }
}