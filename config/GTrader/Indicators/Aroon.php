<?php

return [
    'indicator' =>  [
        'input_high' => 'high',
        'input_low' => 'low',
        'period' => 25,
    ],
    'adjustable' => [
        'period' => [
            'name' => 'Period',
            'type' => 'int',
            'min' => 2,
            'step' => 1,
            'max' => 99,
        ],
    ],
    'display' => [
        'name' => 'Aroon',
        'description' => 'Aroon Indicator by Tushar Chande',
        'y_axis_pos' => 'right',
        'top_level' => false,
    ],
    'outputs' => ['Up', 'Down'],
    'fill_value' => 50,
    'normalize_type' => 'range',
    'range' =>  [
        'min' => 0,
        'max' => 100,
    ],
];