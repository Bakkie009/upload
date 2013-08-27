<?php

namespace Bakkie\Upload;


use Traversable;

class FileCollection implements \IteratorAggregate {

    protected $items = array();


    public function __construct($key, $storage)
    {

        foreach ($_FILES[$key]['name'] as $i => $v)
        {
            array_push($this->items, new File($key, $storage, $this->getFileAttributes($key, $i)));
        }


    }


    protected function getFileAttributes($key, $i)
    {
        $options = array();

        $options['name'] = $_FILES[$key]['name'][$i];
        $options['error'] = $_FILES[$key]['error'][$i];
        $options['tmp_name'] = $_FILES[$key]['tmp_name'][$i];

        return $options;
    }

    protected function count($key)
    {
        return count($_FILES[$key]['name']);
    }



    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }


}