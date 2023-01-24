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

    'headermsg' => '给定的数据无效',
    'accepted' => ':attribute 必须被接受。',
    'accepted_if' => '当 :other 是 :value 时，:attribute 必须被接受。',
    'active_url' => ':attribute 不是一个有效的URL。',
    'after' => ':attribute 必须是在 :date 之后的日期。',
    'after_or_equal' => ':attribute 必须是在 :date 或之后的日期。',
    'alpha' => ':attribute 只能包含字母。',
    'alpha_dash' => ':attribute 只能包含字母，数字，破折号和下划线。',
    'alpha_num' => ':attribute 只能包含字母和数字。',
    'array' => ':attribute 必须是一个数组。',
    'before' => ':attribute 必须是在 :date 之前的日期。',
    'before_or_equal' => ':attribute 必须是在 :date 或之前的日期。',
    'between' => [
        'numeric' => ':attribute 必须在 :min 和 :max 之间。',
        'file' => ':attribute 必须在 :min 和 :max kilobytes之间。',
        'string' => ':attribute 必须在 :min 和 :max 个字符之间。',
        'array' => ':attribute 必须有 :min 到 :max 项。',
    ],
    'boolean' => ':attribute 字段必须是 true 或 false。',
    'confirmed' => ':attribute 确认不匹配。',
    'current_password' => '密码不正确。',
    'date' => ':attribute 不是一个有效的日期。',
    'date_equals' => ':attribute 必须是等于 :date 的日期。',
    'date_format' => ':attribute 不匹配格式 :format。',
    'declined' => ':attribute 必须被拒绝。',
    'declined_if' => '当 :other 是 :value 时，:attribute 必须被拒绝。',
    'different' => ':attribute 和 :other 必须不同。',
    'digits' => ':attribute必须是 :digits 位数.',
    'digits_between' => ':attribute必须在 :min 和 :max 之间.',
    'dimensions' => ':attribute具有无效的图像尺寸.',
    'distinct' => ':attribute字段具有重复值.',
    'email' => ':attribute必须是有效的电子邮件地址.',
    'ends_with' => ':attribute必须以以下之一结尾: :values.',
    'enum' => '所选的:attribute无效.',
    'exists' => '所选的:attribute无效.',
    'file' => ':attribute必须是文件.',
    'filled' => ':attribute字段必须有一个值.',
    'gt' => [
        'numeric' => ':attribute必须大于:value.',
        'file' => ':attribute必须大于:value千字节.',
        'string' => ':attribute必须大于:value个字符.',
        'array' => ':attribute必须有超过:value项.',
    ],
    'gte' => [
        'numeric' => ':attribute必须大于或等于:value。',
        'file' => ':attribute必须大于或等于:value千字节。',
        'string' => ':attribute必须大于或等于:value个字符。',
        'array' => ':attribute必须有:value个或更多项目。',
    ],
    'image' => ':attribute 必须是图片。',
    'in' => '所选 :attribute 无效。',
    'in_array' => ':attribute 字段在 :other 中不存在。',
    'integer' => ':attribute 必须是整数。',
    'ip' => ':attribute 必须是有效的IP地址。',
    'ipv4' => ':attribute 必须是有效的 IPv4 地址。',
    'ipv6' => ':attribute 必须是有效的 IPv6 地址。',
    'json' => ':attribute 必须是有效的 JSON 字符串。',
    'lt' => [
        'numeric' => ':attribute 必须小于 :value。',
        'file' => ':attribute 必须小于 :value 千字节。',
        'string' => ':attribute 必须少于 :value 个字符。',
        'array' => ':attribute 必须少于 :value 个项目。',
    ],
    'lte' => [
        'numeric' => ':attribute 必须小于或等于 :value。',
        'file' => ':attribute 必须小于或等于 :value 千字节。',
        'string' => ':attribute 必须少于或等于 :value 个字符。',
        'array' => ':attribute 不能有超过 :value 个项目。',
    ],
    'mac_address' => ':attribute 必须是有效的 MAC 地址。',
    'max' => [
        'numeric' => ':attribute 的值不能大于 :max。',
        'file' => ':attribute 的大小不能超过 :max KB。',
        'string' => ':attribute 的长度不能超过 :max 个字符。',
        'array' => ':attribute 不能有超过 :max 个项。',
    ],
    'mimes' => ':attribute必须是以下类型的文件: :values.',
    'mimetypes' => ':attribute必须是以下类型的文件: :values.',
    'min' => [
        'numeric' => ':attribute必须至少为:min.',
        'file' => ':attribute必须至少为:min kilobytes.',
        'string' => ':attribute必须至少为:min个字符.',
        'array' => ':attribute必须至少有:min项.',
    ],
    'multiple_of' => ':attribute 必须是 :value 的倍数。',
    'not_in' => '所选 :attribute 无效。',
    'not_regex' => ':attribute 格式无效。',
    'numeric' => ':attribute 必须是数字。',
    'password' => '密码不正确。',
    'present' => ':attribute 字段必须存在。',
    'prohibited' => ':attribute 字段是禁止的。',
    'prohibited_if' => '当 :other 是 :value 时，:attribute 字段是禁止的。',
    'prohibited_unless' => '除非 :other 在 :values 中，否则 :attribute 字段是禁止的。',
    'prohibits' => ':attribute 字段禁止 :other 存在。',
    'regex' => ':attribute 格式无效。',
    'required' => ':attribute 字段是必需的。',
    'required_array_keys' => ':attribute 字段必须包含条目: :values。',
    'required_if' => '当 :other 是 :value 时，:attribute 字段是必需的。',
    'required_unless' => '除非 :other 在 :values 中，否则 :attribute 字段是必需的。',
    'required_with' => '当 :values 存在时，:attribute 字段是必需的。',
    'required_with_all' => '当 :values 都存在时，:attribute 字段是必需的。',
    'required_without' => '当 :values 不存在时，:attribute 字段是必需的。',
    'required_without_all' => '当 :values 都不存在时，:attribute 字段是必需的。',
    'same' => ':attribute 和 :other 必须匹配。',
    'size' => [
        'numeric' => ':attribute 必须是 :size.',
        'file' => ':attribute 必须是 :size KB.',
        'string' => ':attribute 必须是 :size 个字符.',
        'array' => ':attribute 必须包含 :size 个项目.',
    ],
    'starts_with' => ':attribute 必须以下列之一开头: :values.',
    'string' => ':attribute 必须是一个字符串.',
    'timezone' => ':attribute 必须是一个有效的时区.',
    'unique' => ':attribute 已经被使用.',
    'uploaded' => ':attribute 上传失败.',
    'url' => ':attribute 必须是一个有效的URL.',
    'uuid' => ':attribute 必须是一个有效的UUID.',

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
