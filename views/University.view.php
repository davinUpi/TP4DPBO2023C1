<?php

namespace Views;
require_once('Views.php');

class UniversityView extends ViewHandler{

    public function __construct(string $filepath = 'views/skins/index.html'){
        parent::__construct($filepath);
    }

    public function render($data){

        $nav_items = '
        <li class="nav-item">
        <a class="nav-link"  href="index.php">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="university.php">University</a>
    </li>
        ';

        $table_head = "
            <th>ID</th>
            <th>NAME</th>
            <th>CITY</th>
            <th>MEMBERS</th>
        ";

        $table_body = null;
        foreach($data as $val){
            $table_body .= "
            <tr>
            <th>".$val['id']."</th>
            <td>".$val['name']."</td>
            <td>".$val['city']."</td>
            <td>".$val['members']."</td>
          </tr>
            ";
        }

        $this->replace([
            'nav_items' => $nav_items,
            'table_head' => $table_head,
            'table_body' => $table_body,
        ]);
        $this->write();
    }
}