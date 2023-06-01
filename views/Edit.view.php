<?php

namespace Views;
require_once('Views.php');

class EditView extends ViewHandler{

    public function __construct(string $filepath = 'views/skins/form.html'){
        parent::__construct($filepath);
    }

    public function render($data){
        $member = $data['member'];
        $form_action = 'edit.php';
        $id_val = $member['id'];
        $name_val = $member['name'];
        $email_val = $member['email'];
        $uni_val = $member['university'];
        $phone_val = $member['phone'];

        $uni = $data['uni'];
        $uni_dropdown_val = null;
        foreach($uni as $val){
            if($val['id'] == $uni_val){
                $uni_dropdown_val .= '
                    <option value="'.$val["id"].'" selected>'.$val["name"].'</option>
                ';
            }
            else{
                $uni_dropdown_val .= '
                    <option value="'.$val["id"].'">'.$val["name"].'</option>
                ';
            }
        }

        $this->replace([
            'form_action' => $form_action,
            'id_val' => $id_val,
            'name_val' => $name_val,
            'email_val' => $email_val,
            'phone_val' => $phone_val,
            'uni_dropdown_val' => $uni_dropdown_val
        ]);
        $this->write();
    }
}