<?PHP

$test = array(
  'itemID' => 1,
  'name' => 'Test Item 1',
  'description' => 'Lorem Ipsum',
  'price' => 1.00,
  'photoURL' => 'http://placekitten.com/200/300',
  'categoryID' => 2
);

echo json_encode($test);
