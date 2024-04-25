<?php

namespace app\models;

use app\core\db\DbModel as parentAlias;

class BabyCare extends parentAlias
{

    public string $user_id = '';
    public string $child_id = '';

    public string $nic = '';

    public string $no_of_apga ='';
    public string $birth_weight = '';
    public string $head_circumference_at_birth = '';
    public string $baby_length_at_birth = '';
    public string $health_condition = '';
    public string $vitamin_k= '';




    public function rules(): array
    {
        return [

        ];
    }

    public function tableName(): string
    {
        return 'BabyCare';
    }

    public function primaryKey(): string
    {
        return 'nic';
//        childid or motherid
    }

    public function attributes(): array
    {
        return [
            'user_id',
            'nic',
            'no_of_apga',
            'birth_weight',
            'head_circumference_at_birth',
            'baby_length_at_birth',
            'health_condition',
            'vitamin_k',


        ];
    }

    public function save(): bool
    {
        $ValidateUser = (new User())->getUserByNIC($this->nic);

        if (!$ValidateUser) {
            $this->addError('nic', 'User does not exist with this NIC');
            return false;
        }
        else{
            $exitUser = (new Mother())->getUser($ValidateUser->getId());


            $this->user_id = $ValidateUser->id;
            var_dump("errors", $this->errors);
            return parent::save();
        }
        return parent::save();

    }


    public function getChilds(): string
    {
        $childData = (new Child())->findAll(self::class);
        $data = [];

        foreach ($childData as $child) {
//            $Child = self::findOne(Child::class, ["user_id" => $Child->user_id]);
//            $Child = self::findOne(Child::class, ["id" => $Child->Register_NO]);
            $data[] = [
                'ChildName' => $child->Child_Name,
                'MotherName' => $child->Mother_Name,
                'RegistrationNo' => $child->Register_NO,
                'Gender' => $child-> Gender,

            ];
        }

        return json_encode($data);
    }

//
//    public function getMothers(): string
//    {
//        // Implement a method to get a list of mothers similar to the getMidwifes method
//        // Fetch data from the database and format it as needed
//        // Return data in JSON format as shown in the getMidwifes method.
//    }
//
//    public function getMotherById($MotherId): string
//    {
//        // Implement a method to get mother details by ID
//        // Fetch data from the database based on MotherId and return it in JSON format.
//    }
//
//    public function getAMother($MotherId)
//    {
//        // Implement a method to get a single mother by ID similar to getAMidwife
//        // Fetch data from the database and return it, or return null if not found.
//    }
//
//    public function update(): bool
//    {
//        // Implement the update logic similar to the Midwife class
//        // Add validation, checks, and database updating logic
//        // Ensure you return true if the update is successful, and false if it fails.
//    }

    // Add any additional methods you need for the Mother module here
}