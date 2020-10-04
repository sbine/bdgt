<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Поле :attribute должно быть отмечено.',
    'active_url' => 'Поле :attribute - невалидная ссылка.',
    'after' => 'Поле :attribute должно быть датой после :date.',
    'after_or_equal' => 'Поле :attribute должно быть датой после или равной дате :date.',
    'alpha' => 'Поле :attribute может содержать только буквы.',
    'alpha_dash' => 'Поле :attribute может содержать только буквы,цифры, тире и подчеркивания.',
    'alpha_num' => 'Поле :attribute может содержать только буквы и цифры.',
    'array' => 'Поле :attribute должно быть массивом.',
    'before' => 'Поле :attribute должно быть датой до :date.',
    'before_or_equal' => 'Поле :attribute должно быть датой до или равной дате :date.',
    'between' => [
        'numeric' => 'Поле :attribute должно быть между :min и :max.',
        'file' => 'Поле :attribute Должно быть между :min и :max килобайт.',
        'string' => 'Поле :attribute должно быть содержать от :min до :max символов.',
        'array' => 'Поле :attribute должно содержать от :min до :max значений.',
    ],
    'boolean' => 'Поле :attribute должно быть true или false.',
    'confirmed' => 'Поле :attribute несовпадает.',
    'date' => 'Поле :attribute содержит невалидную дату.',
    'date_equals' => 'Поле :attribute должно быть датой равной :date.',
    'date_format' => 'Поле :attribute должно быть формата :format.',
    'different' => 'Поля :attribute и :other должны отличаться.',
    'digits' => 'Поле :attribute должно содержать :digits цифр.',
    'digits_between' => 'Поле :attribute должно содержать от :min до :max цифр.',
    'dimensions' => 'Поле :attribute содержить невалидное изображение.',
    'distinct' => 'Поле :attribute содержит дублирующиеся значения.',
    'email' => 'Поле :attribute должно быть валидной почтой.',
    'exists' => 'Выбранный аттрибут :attribute невалиден.',
    'file' => 'Поле :attribute должно быть файлом.',
    'filled' => 'Поле :attribute дожно содержать значение.',
    'gt' => [
        'numeric' => 'Поле :attribute должно быть больше чем :value.',
        'file' => 'Поле :attribute должно быть больше чем :value килобайт.',
        'string' => 'Поле :attribute должно быть больше чем :value символов.',
        'array' => 'Поле :attribute должно содержать больше чем :value значений.',
    ],
    'gte' => [
        'numeric' => 'Поле :attribute должно быть больше или равно :value.',
        'file' => 'Поле :attribute должно быть больше или равно :value килобайт.',
        'string' => 'Поле :attribute должно быть больше или равно :value символов.',
        'array' => 'Поле :attribute должно содержать :value значений или больше.',
    ],
    'image' => 'Поле :attribute должно быть изображением.',
    'in' => 'Выбранное поле :attribute невалидно.',
    'in_array' => 'Поле :attribute не содержится в :other.',
    'integer' => 'Поле :attribute должно быть целым числом.',
    'ip' => 'Поле :attribute должно быть валидным ip.',
    'ipv4' => 'Поле :attribute должно быть валидным IPv4 адресом.',
    'ipv6' => 'Поле :attribute должно быть валидным IPv6 адресом.',
    'json' => 'Поле :attribute должно быть валидной JSON строкой.',
    'lt' => [
        'numeric' => 'Поле :attribute должно быть меньше чем :value.',
        'file' => 'Поле :attribute должно быть меньше чем :value килобайт.',
        'string' => 'Поле :attribute должно быть меньше чем :value символов.',
        'array' => 'Поле :attribute должно содержать меньше чем :value элементов.',
    ],
    'lte' => [
        'numeric' => 'Поле :attribute должно быть не более :value.',
        'file' => 'Поле :attribute должно быть не более :value килобайт.',
        'string' => 'Поле :attribute должно быть не более :value символов.',
        'array' => 'Поле :attribute должно содержать не более :value элементов.',
    ],
    'max' => [
        'numeric' => 'Поле :attribute должно быть не более :max.',
        'file' => 'Поле :attribute должно быть не более :max килобайт.',
        'string' => 'Поле :attribute должно быть не более :max символов.',
        'array' => 'Поле :attribute должно содержать не более :max элементов.',
    ],
    'mimes' => 'Поле :attribute должно быть файлом: :values.',
    'mimetypes' => 'Поле :attribute должно быть файлом: :values.',
    'min' => [
        'numeric' => 'Поле :attribute должно быть меньше чем :min.',
        'file' => 'Поле :attribute должно быть меньше чем :min килобайт.',
        'string' => 'Поле :attribute должно быть меньше чем :min символов.',
        'array' => 'Поле :attribute должно содержать меньше чем :min элементов.',
    ],
    'not_in' => 'Выбранное поле :attribute невалидно.',
    'not_regex' => 'Поле :attribute имеет невалидный формат.',
    'numeric' => 'Поле :attribute должно быть числом.',
    'present' => 'Поле :attribute должно быть в будущем.',
    'regex' => 'Поле :attribute имеет невалидный формат.',
    'required' => ' Поле :attribute является обязательным.',
    'required_if' => 'Поле :attribute является обязательным когда у поля :other значение :value.',
    'required_unless' => 'Поле :attribute является обязательным если только :other имеет значения :values.',
    'required_with' => 'Поле :attribute является обязательным если :values .',
    'required_with_all' => 'Поле :attribute является обязательным если :values .',
    'required_without' => 'Поле :attribute является обязательным когда не :values .',
    'required_without_all' => 'Поле :attribute явзяется обязательным если не :values .',
    'same' => 'Поля :attribute и :other должны совпадать.',
    'size' => [
        'numeric' => 'Поле :attribute должно быть размера :size.',
        'file' => 'Поле :attribute должно быть :size килобайт.',
        'string' => 'Поле :attribute должно быть :size символов.',
        'array' => 'Поле :attribute должно быть :size элементов.',
    ],
    'starts_with' => 'Поле :attribute должно начинаться с одно из: :values',
    'string' => 'Поле :attribute должно быть строкой.',
    'timezone' => 'Поле :attribute должно быть валидной таймзоной.',
    'unique' => 'Поле :attribute уже используется.',
    'uploaded' => 'Поле :attribute не было загружено.',
    'url' => 'Поле :attribute имеет невалидный формат.',
    'uuid' => 'Поле :attribute должно быть валидным UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
