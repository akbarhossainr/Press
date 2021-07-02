<?php

namespace akbarhossainr\Press;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileParser
{
    protected $fileName;
    protected $content;
    function __construct($fileName)
    {
        $this->fileName = $fileName;
        $this->splitFile();
        $this->getFields();
        $this->processFields();
    }

    public function getContent()
    {
        return $this->content;
    }

    public function splitFile()
    {
        preg_match(
            '/^\-{3}(.*?)\-{3}(.*)/s',
            File::exists($this->fileName) ? File::get($this->fileName) : $this->fileName,
            $this->content
        );
    }

    protected function getFields()
    {
        foreach (explode("\n", trim($this->content[1])) as $fieldString) {
            preg_match("/(.*):\s?(.*)/", $fieldString, $fieldArray);
            $this->content[$fieldArray[1]] = $fieldArray[2];
        }
        $this->content['body'] = trim($this->content[2]);
    }

    protected function processFields()
    {
        foreach ($this->content as $field => $value) {
            $class = 'akbarhossainr\\Press\\Fields\\' . Str::title($field);

            if (class_exists($class) && method_exists($class, 'process')) {
                $this->content = array_merge(
                    $this->content,
                    $class::process($field, $value)
                );
            }
        }
    }
}
