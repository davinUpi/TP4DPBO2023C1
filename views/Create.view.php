<?php

namespace Views;
require_once('Views.php');

class CreateView extends ViewHandler{
    public function __construct(string $filepath = 'views/skins/form.html'){
        parent::__construct($filepath);
    }

    public function render($data){
        $form_action = "create.php";

        $uni_dropdown_val = null;
        foreach($data as $val){
            $uni_dropdown_val .= '
                    <option value="'.$val["id"].'">'.$val["name"].'</option>
                ';
        }

        $this->replace(
            [
                'form_action' => $form_action,
                'uni_dropdown_val' => $uni_dropdown_val
            ]
        );

        $this->write();
    }
}