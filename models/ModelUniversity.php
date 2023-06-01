<?php

namespace Models;
require_once('Models.php');

/**
 * Not a view, but i dotn want to implement crud on this one
 */
class ModelUni extends SQLViewTable{
    public function getAll( $keyword = ""){

        $this->query->select('universities');
        $this->execute();
        $universities = [];
        while($result = $this->getResult()){
            array_push(
                $universities,
                [
                    'id' => $result['uni_id'],
                    'name' => $result['uni_name'],
                    'city' => $result['uni_city'],
                    'members' => $result['uni_members']
                ]
            );
        }

        return $universities;

    }

    public function getById($id){
        $id = intval($id);
        $this->query->select('universities')->where('uni_id', $id);
        $this->execute();
        $result = $this->getResult();
        return [
            'id' => $result['uni_id'],
            'name' => $result['uni_name'],
            'city' => $result['uni_city'],
            'members' => $result['uni_members']
        ];
    }
}