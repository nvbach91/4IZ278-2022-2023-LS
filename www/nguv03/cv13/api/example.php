<?php 


    $data = 
    [                               // [
        [                           //   {
            'name' => 'dave',       //     "name": "dave",
            'age' => 42,            //     "age": 42,
        ],                          //   },
        [                           //   {
            'name' => 'jane',       //     "name": "jane",
            'age' => 22,            //     "age": 22,
        ],                           //   }
        [                           //   {
            'name' => 'job',       //     "name": "jane",
            'age' => 22,            //     "age": 22,
        ]                           //   }
    ];                              // ]

    echo json_encode($data);

?>