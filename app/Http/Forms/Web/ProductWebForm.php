<?php


namespace App\Http\Forms\Web;


use App\Core\Interfaces\WithForm;

class ProductWebForm implements WithForm
{
    public static function inputGroups($value = null): array
    {
        $array = FormUtil::input('id', 1, null,
            'number', $value ? true : false,
            $value ? $value->id : '', null, null, true);
        return array_merge(
            $array,
            FormUtil::input('name', 'Миска для собак', 'Название',
                'text', true, $value ? $value->name : ''),
            FormUtil::input('price', '1800', 'Цена',
                'number', true, $value ? $value->price : ''),
            FormUtil::textArea('description', 'Описание', 'Описание',
                true, $value ? $value->description : '')
        );
    }

}
