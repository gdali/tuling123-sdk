<?php 
 
namespace Gdali\Tuling123SDK;

require __DIR__.'/vendor/autoload.php';

$selfInfo = [
    'location' => [
        'city' => '广州'
    ]
];

$data = new Tuling123('appID','appKey','userID',$selfInfo);

$result = $data->tuling('您好');

echo $result;

?>
