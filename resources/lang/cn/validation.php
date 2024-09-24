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

    'accepted'             => '必须接受特征。',
    'active_url'           => '特征不是有效的URL。',
    'after'                => '特征必须是日期之后的日期。',
    'after_or_equal'       => '特征必须是日期或等于日期：日期。',
    'alpha'                => '特征可能只包含字母。',
    'alpha_dash'           => '特征只能包含字母、数字和破折号。',
    'alpha_num'            => '特征只能包含字母和数字。',
    'array'                => '特征必须是数组。',
    'before'               => '特征必须是日期之前：日期。',
    'before_or_equal'      => '特征必须是日期或等于日期：日期。',
    'between'              => [
        'numeric' => '特征必须在：最小和最大之间。',
        'file'    => '特征必须在：最小和最大之间千字节。',
        'string'  => '特征必须在：最小和最大之间字符。',
        'array'   => '特征必须在：最小和最大之间项目。',
    ],
    'boolean'              => '特征字段必须为真或假。',
    'confirmed'            => '特征确认不匹配。',
    'date'                 => '特征不是有效的日期。',
    'date_format'          => '特征不匹配格式：格式。',
    'different'            => '特征：和其他必须不同。',
    'digits'               => '特征必须是：数字数字。',
    'digits_between'       => '特征必须在：最小和最大位数之间。',
    'dimensions'           => '特征具有无效的图像尺寸。',
    'distinct'             => '特征字段有一个重复的值。',
    'email'                => '特征必须是一个有效的电子邮件地址。',
    'exists'               => '选定的特征无效。',
    'file'                 => '特征必须是一个文件。',
    'filled'               => '特征字段必须有一个值。',
    'image'                => '特征必须是一个图像。',
    'in'                   => '选定的特征无效。',
    'in_array'             => '特征字段不存在：其他。',
    'integer'              => '特征必须是整数。',
    'ip'                   => '特征必须是一个有效的IP地址。',
    'ipv4'                 => '特征必须是一个有效的IPv4地址。',
    'ipv6'                 => '特征必须是一个有效的IPv6地址。',
    'json'                 => '特征必须是有效的JSON字符串。',
    'max'                  => [
        'numeric' => '特征可能不大于：最大。',
        'file'    => '特征可能不大于：最大千字节。',
        'string'  => '特征可能不大于：最大字符。',
        'array'   => '特征可能不超过：最大项。',
    ],
    'mimes'                => '特征必须是类型：：值的文件。',
    'mimetypes'            => '特征必须是类型：：值的文件。',
    'min'                  => [
        'numeric' => '特征至少必须是：最小.',
        'file'    => '特征至少必须是：最小千字节。',
        'string'  => '特征至少必须是：最小字符。',
        'array'   => '特征至少必须有：最小项。',
    ],
    'not_in'               => '选定的特征无效。',
    'numeric'              => '特征必须是一个数字。',
    'present'              => '特征字段必须存在。',
    'regex'                => '特征格式无效。',
    'required'             => '特征字段是必需的。',
    'required_if'          => '特征字段是需要的：其他值是：值。',
    'required_unless'      => '特征字段是必需的，除非其他字段是：值。',
    'required_with'        => '当存在值时，需要特征字段。',
    'required_with_all'    => '当存在值时，需要特征字段。',
    'required_without'     => '当值不存在时，需要特征字段。',
    'required_without_all' => '当没有值时，特征字段是必需的。',
    'same'                 => '特征：和：其他必须匹配。',
    'size'                 => [
        'numeric' => '特征必须是：大小。',
        'file'    => '特征必须是：大小千兆字节。',
        'string'  => '特征必须是：大小字符。',
        'array'   => '特征必须包含：大小项。',
    ],
    'string'               => '特征必须是字符串。',
    'timezone'             => '特征必须是有效的区域。',
    'unique'               => '特征已被采用。',
    'uploaded'             => '特征上传失败。',
    'url'                  => '特征格式无效。',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
