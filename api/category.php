<?PHP

$test = array(
  array(
    'categoryID' => 1,
    'name' => 'Category 1',
    'items' => array(
      array(
	'itemID' => 2,
	'name' => 'Test Item 2',
	'description' => 'Lorem Ipsum',
	'price' => 2.00,
	'photoURL' => 'http://placekitten.com/400/300',
	'categoryID' => 1	
      )
    )
  ),
  array(
    'categoryID' => 2,
    'name' => 'Category 2',
    'items' => array(
      array(
	'itemID' => 1,
	'name' => 'Test Item 1',
	'description' => 'Lorem Ipsum',
	'price' => 1.00,
	'photoURL' => 'http://placekitten.com/200/300',
	'categoryID' => 2
      ),
      array(
	'itemID' => 3,
	'name' => 'Test Item 3',
	'description' => 'Lorem Ipsum',
	'price' => 3.50,
	'photoURL' => 'http://placekitten.com/200/200',
	'categoryID' => 2
      )
    )
  ) 
);


echo json_encode($test);
