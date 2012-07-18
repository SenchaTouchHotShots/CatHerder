<?PHP

$test = array(
  'itemID' => 1,
  'name' => 'Test Item 1',
  'description' => 'Lorem Ipsum',
  'price' => 1.00,
  'photoURL' => 'http://placekitten.com/200/300',
  'categoryID' => 2,
  'category' => array(
    'categoryID' => 2, 'name' => 'Category 2', 'itemID' => 1
  )
);

echo json_encode($test);
