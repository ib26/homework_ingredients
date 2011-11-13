<?php
//this lists distinct categories of items

//get information to build the URL link
$server_host = $_SERVER['HTTP_HOST'];
$script_name = $_SERVER['SCRIPT_NAME'];

//get rid of index.php because we are using different url's for the functions, but a more sophisticated program could easily use a single file and not need this step
$url = 'http://' . $server_host . rtrim($script_name,'directory.php') . 'category.php?title=';
echo $url;

$username = 'kwilliams';
$password = 'mongo1234';
$connection = new Mongo("mongodb://${username}:${password}@localhost/test",array("persist" => "x"));
//Selection of Datbase and Collection
$db = $connection->recipe;
$collection = $db->stuff;

//find one
//$cursor = $collection->findOne(array('_id' => new MongoId($_GET['_id'])));

//Find all:
//$cursor = $collection->find();

//Find a pattern set of records
//$cursor = $collection->find(array("Shrt_Desc.title" => "CHEESE"));

//find distinct groups
$cursor = $db->command(array("distinct" => "stuff", "key" => "Shrt_Desc.title"));

foreach($cursor as $record) {

foreach($record as $key => $value) {
echo '<a href="' . $url . $value . '">' . $value . '</a></br>' . "\r\n";

}
}

echo 'done';
?>
