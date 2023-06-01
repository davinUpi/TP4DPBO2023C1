<?php

namespace Views;
require_once('Views.php');

class IndexView extends ViewHandler{

    public function __construct(string $filepath = 'views/skins/index.html'){
        parent::__construct($filepath);
    }

    public function render($data){
        $member = $data['member'];
        $uni = $data['uni'];

        $nav_items = '
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="university.php">University</a>
    </li>
        ';

        $table_head = "
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th>UNIVERSITY</th>
            <th>JOINING DATE</th>
            <th>ACTIONS</th>
        ";

        $table_body = null;
        foreach($member as $val){
            $cur_uni = null;
            foreach($uni as $u){
                if($u['id'] == $val['university']){
                    $cur_uni = $u;
                    break;
                }
            }

            $table_body .= "
            <tr>
            <th>".$val['id']."</th>
            <td>".$val['name']."</td>
            <td>".$val['email']."</td>
            <td>".$val['phone']."</td>
            <td>".$cur_uni['name']."</td>
            <td>".$val['join_date']."</td>
            <td>
                      <a class='btn btn-success' href='edit.php?id=".$val['id']."'>Edit</a>
                      <a class='btn btn-danger' href='delete.php?id=".$val['id']."'>Delete</a>
                    </td>
          </tr>
            ";
        }

        $add_btn = '
        <div class="col-1 my-3">
            <a type="button" class="btn btn-primary nav-link active" href="create.php">Add New</a>
        </div>
        ';

        $this->replace([
            'nav_items' => $nav_items,
            'table_head' => $table_head,
            'table_body' => $table_body,
            'add_btn' => $add_btn
        ]);
        $this->write();
    }
}