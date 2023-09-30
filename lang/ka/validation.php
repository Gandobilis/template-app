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

    'accepted' => 'ვეთანხმებით :attribute საჩვენებელს.',
    'accepted_if' => 'ვეთანხმებით :attribute, როცა :other არის :value.',
    'active_url' => ':attribute ვერ იყენება ვალიდურ URL-ადრე.',
    'after' => ':attribute უნდა იყოს თარიღი :date-ზე შემდეგ.',
    'after_or_equal' => ':attribute უნდა იყოს თარიღი :date-ზე შემდეგ ან ტოლი.',
    'alpha' => ':attribute უნდა შეიძლებოს შიგან არხები.',
    'alpha_dash' => ':attribute უნდა შეიძლებოს შიგან არხები, ციფრები, ტირეები და ქვევითი ხაზები.',
    'alpha_num' => ':attribute უნდა შეიძლებოს შიგან არხები და ციფრები.',
    'array' => ':attribute უნდა იყოს მასივი.',
    'ascii' => ':attribute უნდა შეიძლებოს შიგან მხარსად სინგლ-ბაიტური ალფანუმერული სიმბოლოები და სიმბოლოები.',
    'before' => ':attribute უნდა იყოს თარიღი :date-მდე.',
    'before_or_equal' => ':attribute უნდა იყოს თარიღი :date ან ტოლი.',
    'between' => [
        'array' => ':attribute უნდა შეიძლებოს შორის :min და :max ელემენტები.',
        'file' => ':attribute უნდა იყოს :min და :max კილობაიტი.',
        'numeric' => ':attribute უნდა იყოს :min და :max.',
        'string' => ':attribute უნდა იყოს :min და :max სიმბოლო.',
    ],
    'boolean' => ':attribute უნდა იყოს true ან false.',
    'can' => ':attribute შეიცავს არაკორექტულ მნიშვნელობას.',
    'confirmed' => ':attribute-ს დასმული არ ეკმევა.',
    'current_password' => 'პაროლი არასწორია.',
    'date' => ':attribute უნდა იყოს ვალიდური თარიღი.',
    'date_equals' => ':attribute უნდა იყოს :date-თვის თარიღი.',
    'date_format' => ':attribute უნდა ითვლებოს ფორმატში :format.',
    'decimal' => ':attribute უნდა იყოს :decimal საჭირო დეციმალები.',
    'declined' => ':attribute უნდა უარის გადაკეთდეს.',
    'declined_if' => ':attribute უნდა უარის გადაკეთდეს, როცა :other არის :value.',
    'different' => ':attribute და :other უნდა იყოს სხვადასხვა.',
    'digits' => ':attribute უნდა შეიძლებოს :digits ციფრი.',
    'digits_between' => ':attribute უნდა იყოს :min-დან :max ციფრი.',
    'dimensions' => ':attribute უნდა იყოს არავალიდური სურათის ზომები.',
    'distinct' => ':attribute-ში არის დუბლირებული მნიშვნელობა.',
    'doesnt_end_with' => ':attribute უნდა არ სრულდეს შემდეგი ელემენტებისა დაწყებული: :values.',
    'doesnt_start_with' => ':attribute უნდა არ დაიწყოს შემდეგი ელემენტებისა დაწყებული: :values.',
    'email' => ':attribute უნდა იყოს ვალიდური ელ-ფოსტა.',
    'ends_with' => ':attribute უნდა დასრულდეს შემდეგი ელემენტებისა: :values.',
    'enum' => 'შერჩეული :attribute არის არასწორი.',
    'exists' => 'შერჩეული :attribute არის არასწორი.',
    'file' => ':attribute უნდა იყოს ფაილი.',
    'filled' => ':attribute აუცილებელია.',
    'gt' => [
        'array' => ':attribute უნდა შეიძლებოს შეიძლებოს :value ელემენტზე მეტი.',
        'file' => ':attribute უნდა იყოს :value კილობაიტზე დიდი.',
        'numeric' => ':attribute უნდა იყოს :value-ზე დიდი.',
        'string' => ':attribute უნდა იყოს :value სიმბოლოზე დიდი.',
    ],
    'gte' => [
        'array' => ':attribute უნდა შეიძლებოს :value ელემენტზე ან მეტი.',
        'file' => ':attribute უნდა იყოს :value კილობაიტზე ან ტოლი.',
        'numeric' => ':attribute უნდა იყოს :value-ზე დიდი ან ტოლი.',
        'string' => ':attribute უნდა იყოს :value სიმბოლოზე დიდი ან ტოლი.',
    ],
    'image' => ':attribute უნდა იყოს სურათი.',
    'in' => 'შერჩეული :attribute არის არასწორი.',
    'in_array' => ':attribute უნდა იყოს :other-ში.',
    'integer' => ':attribute უნდა იყოს მთელი რიცხვი.',
    'ip' => ':attribute უნდა იყოს ვალიდური IP მისამართი.',
    'ipv4' => ':attribute უნდა იყოს ვალიდური IPv4 მისამართი.',
    'ipv6' => ':attribute უნდა იყოს ვალიდური IPv6 მისამართი.',
    'json' => ':attribute უნდა იყოს ვალიდური JSON სტრინგი.',
    'lowercase' => ':attribute უნდა იყოს წინასწორი ასო.',
    'lt' => [
        'array' => ':attribute უნდა შეიძლებოს შეიძლებოს :value ელემენტზე ნაკლები.',
        'file' => ':attribute უნდა იყოს :value კილობაიტზე ნაკლები.',
        'numeric' => ':attribute უნდა იყოს :value-ზე ნაკლები.',
        'string' => ':attribute უნდა იყოს :value სიმბოლოზე ნაკლები.',
    ],
    'lte' => [
        'array' => ':attribute უნდა არ იყოს :value ელემენტზე მეტი.',
        'file' => ':attribute უნდა იყოს :value კილობაიტზე ნაკლები ან ტოლი.',
        'numeric' => ':attribute უნდა იყოს :value-ზე ნაკლები ან ტოლი.',
        'string' => ':attribute უნდა იყოს :value სიმბოლოზე ნაკლები ან ტოლი.',
    ],
    'mac_address' => ':attribute უნდა იყოს ვალიდური MAC მისამართი.',
    'max' => [
        'array' => ':attribute უნდა არ იყოს :max ელემენტზე მეტი.',
        'file' => ':attribute უნდა არ იყოს :max კილობაიტზე ნაკლები.',
        'numeric' => ':attribute უნდა არ იყოს :max ზე მეტი.',
        'string' => ':attribute უნდა არ იყოს :max სიმბოლოზე მეტი.',
    ],
    'max_digits' => ':attribute არ შეიძლება იყოს :max ციფრზე მეტი.',
    'mimes' => ':attribute უნდა იყოს ფაილი ტიპი: :values.',
    'mimetypes' => ':attribute უნდა იყოს ფაილი ტიპი: :values.',
    'min' => [
        'array' => ':attribute უნდა შეიძლებოს შეიძლებოს შორის :min ელემენტი.',
        'file' => ':attribute უნდა იყოს კილობაიტი მაინც :min.',
        'numeric' => ':attribute უნდა იყოს მინიმუმ :min.',
        'string' => ':attribute უნდა იყოს მინიმუმ :min სიმბოლო.',
    ],
    'min_digits' => ':attribute უნდა შეიძლებოს მინიმუმ :min ციფრი.',
    'missing' => ':attribute უნდა იყოს არაა.',
    'missing_if' => ':attribute უნდა იყოს არაა, როცა :other არის :value.',
    'missing_unless' => ':attribute უნდა იყოს არაა, თუ :other არ არის :value.',
    'missing_with' => ':attribute უნდა იყოს არაა, თუ :values არ არის წყალი.',
    'missing_with_all' => ':attribute უნდა იყოს არაა, თუ :values არ არის წყალი.',
    'multiple_of' => ':attribute უნდა იყოს :value-ს ჯამური.',
    'not_in' => 'შერჩეული :attribute არის არასწორი.',
    'not_regex' => ':attribute ფორმატი არ არის ვალიდური.',
    'numeric' => ':attribute უნდა იყოს რიცხვი.',
    'password' => [
        'letters' => ':attribute უნდა შეიცავდეს მხარი ასო.',
        'mixed' => ':attribute უნდა შეიცავდეს მხარი და მიმდინარე ასო.',
        'numbers' => ':attribute უნდა შეიცავდეს ციფრი.',
        'symbols' => ':attribute უნდა შეიცავდეს სიმბოლო.',
        'uncompromised' => ':attribute მისამართი სწორი არაა. გთხოვთ, აირჩიეთ სხვა :attribute.',
    ],
    'present' => ':attribute უნდა იყოს არაა.',
    'prohibited' => ':attribute არ შეიძლება.',
    'prohibited_if' => ':attribute არ შეიძლება, როცა :other არის :value.',
    'prohibited_unless' => ':attribute არ შეიძლება, თუ :other არ არის :values-ში.',
    'prohibits' => ':attribute არ შეიძლება :other-ს წარმოადგენოს.',
    'regex' => ':attribute ფორმატი არ არის ვალიდური.',
    'required' => ':attribute აუცილებელია.',
    'required_array_keys' => ':attribute უნდა შეიცავდეს შემდეგ გასანაწილებელ გასაღებებს: :values.',
    'required_if' => ':attribute უნდა იყოს აუცილებელი, როცა :other არის :value.',
    'required_if_accepted' => ':attribute უნდა იყოს აუცილებელი, როცა :other არ იქნება აქვს.',
    'required_unless' => ':attribute უნდა იყოს აუცილებელი, თუ :other შეიცავს :values-ს.',
    'required_with' => ':attribute უნდა იყოს აუცილებელი, როცა :values არ არის.',
    'required_with_all' => ':attribute უნდა იყოს აუცილებელი, როცა :values არ არის.',
    'required_without' => ':attribute უნდა იყოს აუცილებელი, თუ :values არ არის.',
    'required_without_all' => ':attribute უნდა იყოს აუცილებელი, თუ :values არ არის.',
    'same' => ':attribute უნდა იყოს იგივე :other.',
    'size' => [
        'array' => ':attribute უნდა შეიძლება შეიძლებოს :size ელემენტი.',
        'file' => ':attribute უნდა იყოს :size კილობაიტზე.',
        'numeric' => ':attribute უნდა იყოს :size.',
        'string' => ':attribute უნდა იყოს :size სიმბოლო.',
    ],
    'starts_with' => ':attribute უნდა იწყეს შემდეგი ელემენტი: :values.',
    'string' => ':attribute უნდა იყოს სტრინგი.',
    'timezone' => ':attribute უნდა იყოს ვალიდური დროის სარტყელე.',
    'unique' => ':attribute უნდა იყოს უნიკალური.',
    'uploaded' => ':attribute ვერ აიტვირთა.',
    'uppercase' => ':attribute უნდა იყოს დიდი ასო.',
    'url' => ':attribute უნდა იყოს ვალიდური URL.',
    'ulid' => ':attribute უნდა იყოს ვალიდური ULID.',
    'uuid' => ':attribute უნდა იყოს ვალიდური UUID.',

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
