<?php

namespace Views;

abstract class ViewHandler{

    private $filename;
    private $content;

    protected function __construct(string $filepath){
        $this->filename = $filepath;
        $this->content = file_get_contents($filepath);
    }

    protected function clear(){
        $pattern = '/<replace>(.*?)<\/replace>/is';
        $this->content = preg_replace($pattern, '', $this->content);
    }

    protected function write(){
        $this->clear();
        print $this->content;
    }

    protected function getContent(){
        $this->clear();
        return $this->content;
    }
    /**
     * @param array $to_replace_and_replacement
     * 
     * Use an array with the keys as the thing you want
     * to replace and the value as the replacement
     * 
     * @example  <replace> something </replace>; then for
     * arr['something'] = 'a thing' will replace the tags and its value.
     * In other words, <replace> something </replace> = a thing
     */
    protected function replace($to_replace_and_replacement = []){
        foreach($to_replace_and_replacement as $to_replace => $replacement){
            $pattern = '/<replace>'.$to_replace. '<\/replace>/is';
            $this->content = preg_replace($pattern, $replacement, $this->content);
        }
    }

    abstract public function render($data);

}