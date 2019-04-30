<?php
/**
 * Documenttion: https://dev.megaplan.ru/api/API_contractors.html
 */


namespace Zloykolobok\Megaplan2\Classes;

use Zloykolobok\Megaplan2\Megaplan;


class Contractor extends Megaplan
{
    public function list($filterId, $limit, $offset, $qs, $phone, $model, $droppedOnly = false)
    {
        $this->auth();

        $params = [];
        if(!is_null($filterId))
            $params['FilterId'] = $filterId;
        if(!is_null($limit))
            $params['Limit'] = $limit;
        if(!is_null($offset))
            $params['Offset'] = $offset;
        if(!is_null($qs))
            $params['qs'] = $qs;
        if(!is_null($phone))
            $params['Phone'] = $phone;
        if(!is_null($model)){
            foreach ($model as $key => $value) {
                $params['Model['.$key.']'] = $value;
            }
        }
        $params['DroppedOnly'] = $droppedOnly;

        $raw = $this->req->post('/BumsCrmApiV01/Contractor/list.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Редактирование/Создание клиента
     *
     * @param [type] $id - integer	ID клиента, если не указан то будет создан новый клиент
     * @param [type] $typePerson - Тип организации, принимает значения: human и company
     * @param [type] $type - string ID типа клиента
     * @param [type] $firstName - string Имя, обязательное если тип human
     * @param [type] $lastName - string Фамилия, обязательное если тип human
     * @param [type] $middleName - string	Отчество, обязательное если тип human
     * @param [type] $companyName - string	Наименование компании, обязательное если тип company
     * @param [type] $parentCompany - int	Id компании, используется для связи контактного лица с компанией
     * @param [type] $email - string	Email
     * @param [type] $phones - array	Массив телефонов*
     * @param [type] $birthday - array	День основания компании или день рождения клиента, формат: Y-m-d (Пример: ‘1999-03-27’)
     * @param [type] $responsibles - string	Идентификаторы ответственных сотрудников перечисленных через запятую (Пример: ‘1000005,1013202’)
     * @param [type] $responsibleContractors - string	Идентификаторы ответственных клиентов** перечисленных через запятую (Пример: ‘1000005,1013202’)
     * @return void
     */
    public function save(
        $id,
        $typePerson,
        $type,
        $firstName,
        $lastName,
        $middleName,
        $companyName,
        $parentCompany,
        $email,
        $phones,
        $birthday,
        $responsibles,
        $responsibleContractors,
        $customs
        )
    {
        $this->auth();
        $params = [];

        if(!is_null($id))
            $params['Id'] = $id;
        if(!is_null($typePerson))
            $params['Model[TypePerson]'] = $typePerson;
        if(!is_null($type))
            $params['Model[Type]'] = $type;
        if(!is_null($firstName))
            $params['Model[FirstName]'] = $firstName;
        if(!is_null($lastName))
            $params['Model[LastName]'] = $lastName;
        if(!is_null($middleName))
            $params['Model[MiddleName]'] = $middleName;
        if(!is_null($companyName))
            $params['Model[CompanyName]'] = $companyName;
        if(!is_null($parentCompany))
            $params['Model[ParentCompany]'] = $parentCompany;
        // if(!is_null($parentCompany))
        //     $params['Model[ParentCompany]'] = $parentCompany;
        if(!is_null($email))
            $params['Model[Email]'] = $email;
        if(!is_null($phones))
            $params['Model[Phones]'] = $phones;
        if(!is_null($birthday))
            $params['Model[Birthday]'] = $birthday;
        if(!is_null($responsibles))
            $params['Model[Responsibles]'] = $responsibles;
        if(!is_null($responsibleContractors))
            $params['Model[ResponsibleContractors]'] = $responsibleContractors;

        //TODO: добавить Attaches
        //TODO: Model[Locations][location]
        if(!is_null($customs)){
            foreach ($customs as $key => $val){
                $params[$key] = $val;
            }
        }

        $raw = $this->req->post('/BumsCrmApiV01/Contractor/save.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Список полей клиента
     *
     * @return mixed
     * @throws \Zloykolobok\Megaplan2\Exception\ConnectionException
     */
    public function listFields()
    {
        $this->auth();
        $params = [];

        $raw = $this->req->post('/BumsCrmApiV01/Contractor/listFields.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }
}