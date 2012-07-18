<?PHP

$test = array(
  array(
    'itemID' => 1,
    'name' => 'Test Item 1',
    'description' => 'Lorem Ipsum',
    'price' => 1.00,
    'photoURL' => 'http://placekitten.com/200/300',
    'categoryID' => 1,
    'category' => array(
      'categoryID' => 1, 'name' => 'Category 1', 'itemID' => 1
    )
  ),
  array(
    'itemID' => 2,
    'name' => 'Test Item 2',
    'description' => 'Lorem Ipsum',
    'price' => 2.00,
    'photoURL' => 'http://placekitten.com/400/300',
    'categoryID' => 2,
    'category' => array(
      'categoryID' => 2, 'name' => 'Category 2', 'itemID' => 2
    )
  ),
  array(
    'itemID' => 3,
    'name' => 'Test Item 3',
    'description' => 'Lorem Ipsum',
    'price' => 3.50,
    'photoURL' => 'http://placekitten.com/200/200',
    'categoryID' => 1,
    'category' => array(
      'categoryID' => 1, 'name' => 'Category 1', 'itemID' => 3
    )
  )
);

echo json_encode($test);
