<?php
namespace Models;

require_once('Models.php');

class ModelMember extends SQLTable
{

    public function getAll($keyword = '')
    {
        $this->query->select('members');
        if (!empty($keyword)) {
            $this->query->whereLike('name', $keyword)
                ->orWhereLike('email', $keyword)
                ->orWhereLike('phone', $keyword);
        }
        $this->execute();

        $arr = [];
        while ($result = $this->getResult()) {
            array_push(
                $arr,
                [
                    'id' => $result['member_id'],
                    'name' => $result['member_name'],
                    'email' => $result['member_email'],
                    'phone' => $result['member_phone'],
                    'university' => $result['member_uni'],
                    'join_date' => $result['member_join_date']
                ]
            );
        }

        return $arr;
    }

    public function getById($id)
    {
        $this->query->select('members')->where('member_id', $id);
        $this->execute();
        $result = $this->getResult();
        return [
            'id' => $result['member_id'],
            'name' => $result['member_name'],
            'email' => $result['member_email'],
            'phone' => $result['member_phone'],
            'university' => $result['member_uni'],
            'join_date' => $result['member_join_date']
        ];
    }

    public function insert($data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $uni = intval($data['university']);

        $this->query->select('members')
        ->where('member_name', $name)
        ->andWhere('member_email', $email)
        ->andWhere('member_phone', $phone);
        $check = $this->execute();
        if(mysqli_num_rows($check) == 0){
            $this->query->insert(
                'members',
                [
                    'member_name',
                    'member_email',
                    'member_phone',
                    'member_uni'
                ]
                )->values(
                    [
                        $name,
                        $email,
                        $phone,
                        $uni
                    ]
                    );
            $temp = $this->executeAffected();
            if($temp > 0){
                header('location: index.php');
            }
        }

        
    }
    public function delete(int $id)
    {
        $this->query->delete('members')
        ->where('member_id', $id);
        $temp = $this->executeAffected();
        header('location: index.php');
        
    }
    public function update(int $id, $data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $uni = intval($data['university']);

        $this->query->select('members')
        ->whereOr([
            'member_name' => $name,
            'member_email' => $email,
            'member_phone' => $phone
        ])->andWhereNot('member_id', $id);
        $check = $this->execute();
        if(mysqli_num_rows($check) == 0){

            $this->query->update('members')
            ->set([
                'member_name' => $name,
                'member_email' => $email,
                'member_phone' => $phone,
                'member_uni' => $uni
            ])->where('member_id', $id);
            $temp = $this->executeAffected();
            if($temp > 0){
                header('location: index.php');
            }
        }
        else{

        }
    }
}