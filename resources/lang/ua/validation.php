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

    'accepted' => 'поле :attribute має бути зазначено.',
    'active_url' => 'поле :attribute - невалидность посилання.',
    'after' => 'поле :attribute має бути датою після :date.',
    'after_or_equal' => 'поле :attribute має бути датою після або рівній датою :date.',
    'alpha' => 'поле :attribute може містити тільки літери.',
    'alpha_dash' => 'поле :attribute може містити тільки букви, цифри, тире і підкреслення.',
    'alpha_num' => 'поле :attribute може містити тільки букви і цифри.',
    'array' => 'поле :attribute має бути масивом.',
    'before' => 'поле :attribute має бути датою до :date.',
    'before_or_equal' => 'поле :attribute має бути датою до або рівній датою :date.',
    'between' => [
        'numeric' => 'поле :attribute має бути між :min і :max.',
        'file' => 'поле :attribute повинно бути між :min і :max кілобайт.',
        'string' => 'поле :attribute має бути містити від :min до :max символів.',
        'array' => 'поле :attribute повинно містити від :min до :max значень.',
    ],
    'boolean' => 'поле :attribute має бути true або false.',
    'confirmed' => 'поле :attribute незбіжними.',
    'date' => 'поле :attribute містить невалидность дату.',
    'date_equals' => 'поле :attribute має бути датою рівною :date.',
    'date_format' => 'поле :attribute має бути формату :format.',
    'different' => 'поля :attribute і :other повинні відрізнятися.',
    'digits' => 'поле :attribute повинно містити :digits цифр.',
    'digits_between' => 'поле :attribute повинно містити від :min до :max цифр.',
    'dimensions' => 'поле :attribute содержить невалидность зображення.',
    'distinct' => 'поле :attribute містить дублюються значення.',
    'email' => 'поле :attribute має бути валидной поштою.',
    'exists' => 'обраний атрибут :attribute неваліден.',
    'file' => 'поле :attribute має бути файлом.',
    'filled' => 'поле :attribute дожно містити значення.',
    'gt' => [
        'numeric' => 'поле :attribute має бути більше ніж :value.',
        'file' => 'поле :attribute має бути більше ніж :value кілобайт.',
        'string' => 'поле :attribute має бути більше ніж :value символів.',
        'array' => 'поле :attribute повинно містити більше ніж :value значень.',
    ],
    'gte' => [
        'numeric' => 'поле :attribute має бути більше або дорівнює :value.',
        'file' => 'поле :attribute має бути більше або дорівнює :value кілобайт.',
        'string' => 'поле :attribute має бути більше або дорівнює :value символів.',
        'array' => 'поле :attribute повинно містити :value значень або більше.',
    ],
    'image' => 'поле :attribute має бути зображенням.',
    'in' => 'обраний поле :attribute невалидность.',
    'in_array' => 'поле :attribute не міститься в :other.',
    'integer' => 'поле :attribute має бути цілим числом.',
    'ip' => 'поле :attribute має бути дійсним ip.',
    'ipv4' => 'поле :attribute має бути дійсним ipv4 адресою.',
    'ipv6' => 'поле :attribute має бути дійсним ipv6 адресою.',
    'json' => 'поле :attribute має бути валидной json рядком.',
    'lt' => [
        'numeric' => 'поле :attribute має бути менше ніж :value.',
        'file' => 'поле :attribute має бути менше ніж :value кілобайт.',
        'string' => 'поле :attribute має бути менше ніж :value символів.',
        'array' => 'поле :attribute повинно містити менше ніж :value елементів.',
    ],
    'lte' => [
        'numeric' => 'поле :attribute має бути не більше :value.',
        'file' => 'поле :attribute має бути не більше :value кілобайт.',
        'string' => 'поле :attribute має бути не більше :value символів.',
        'array' => 'поле :attribute повинно містити не більше :value елементів.',
    ],
    'max' => [
        'numeric' => 'поле :attribute має бути не більше :max.',
        'file' => 'поле :attribute має бути не більше :max кілобайт.',
        'string' => 'поле :attribute має бути не більше :max символів.',
        'array' => 'поле :attribute повинно містити не більше :max елементів.',
    ],
    'mimes' => 'поле :attribute має бути файлом: :values.',
    'mimetypes' => 'поле :attribute має бути файлом: :values.',
    'min' => [
        'numeric' => 'поле :attribute має бути менше ніж :min.',
        'file' => 'поле :attribute має бути менше ніж :min кілобайт.',
        'string' => 'поле :attribute має бути менше ніж :min символів.',
        'array' => 'поле :attribute повинно міститименше ніж :min елементів. ',
    ],
    'not_in' => 'обраний поле :attribute невалидность.',
    'not_regex' => 'поле :attribute має невалідний формат.',
    'numeric' => 'поле :attribute має бути числом.',
    'present' => 'поле :attribute має бути в майбутньому.',
    'regex' => 'поле :attribute має невалідний формат.',
    'required' => 'поле :attribute є обов язковим.',
    'required_if' => 'поле :attribute є обов язковим коли у поля :other значення :value.',
    'required_unless' => 'поле :attribute є обов язковим якщо тільки :other має значення :values.',
    'required_with' => 'поле :attribute є обов язковим якщо :values.',
    'required_with_all' => 'поле :attribute є обов язковим якщо :values.',
    'required_without' => 'поле :attribute є обов язковим коли ні :values.',
    'required_without_all' => 'поле :attribute явзяется обов язковим якщо не :values.',
    'same' => 'поля :attribute і :other повинні збігатися.',
    'size' => [
        'numeric' => 'поле :attribute має бути розміру :size.',
        'file' => 'поле :attribute має бути :size кілобайт.',
        'string' => 'поле :attribute має бути :size символів.',
        'array' => 'поле :attribute має бути :size елементів.',
    ],
    'starts_with' => 'поле :attribute має починатися з одне з: :values',
    'string' => 'поле :attribute має бути рядком.',
    'timezone' => 'поле :attribute має бути валидной таймзона.',
    'unique' => 'поле :attribute вже використовується.',
    'uploaded' => 'поле :attribute не було завантажено.',
    'url' => 'поле :attribute має невалідний формат.',
    'uuid' => 'поле :attribute має бути дійсним uuid.',

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
