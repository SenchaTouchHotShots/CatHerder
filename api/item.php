<?PHP


ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

include_once 'dbSetup.inc';

switch ($_SERVER['REQUEST_METHOD']) {
case "GET":
    doGet();
    break;
case "POST":
    doPost();
    break;
case "PUT":
    doPut();
    break;
case "DELETE":
    doDelete();
    break;
default:
    doGet();
}

function doGet() {
    /* When a get is performed, we are either getting one by ID in the url, or
       many by sending along variables in the request string. */
    $db = dbSetup();

    if (preg_match('/item\/(\d+)[\/]*$/', $_SERVER['REQUEST_URI'], $matches)) {
        /* We've got a single item to grab. */
        $itemID = array($matches[1]); // execute expects an array.
        $stmt = $db->prepare("select * from `items` where itemID = ?");
        if (is_object($stmt) && $stmt->execute($itemID)) {
            /* We only asked for one. */
            $row = $stmt->fetch();
            $row['category'] = getCategory($row['categoryID'], $db);
            doJson($row);
        } else {
            doJson(array(
                'success' => FALSE,
                'error' => $stmt->errorInfo()
            ));
        }
    } else {
        $data = array();
        $categories = array();
        $filters = json_decode($_GET['filter'], TRUE);
        $start = intval($_GET['start']);
        $limit = intval($_GET['limit']);
        /* For simplicity, just use one filter */
        $filterColumn = $filters[0]['property'];
        $filterValue = $filters[0]['value'];
        $sql = "select * from `items`";
        if (!is_null($filterValue) && $filterValue != 'null' && $filterValue != "") {
            $sql .= " where `$filterColumn` = '$filterValue'";
        }
        if ($limit > 0) {
            $sql .= " limit $start,$limit";
        }
        foreach ($db->query($sql) as $row) {
            /* Only fetch categories once. */
            if (!isset($categories[$row['categoryID']])) {
                $categories[$row['categoryID']] = getCategory($row['categoryID'], $db);
            }
            $row['category'] = $categories[$row['categoryID']];

            $data[] = $row;
        }
        
        doJson($data);
    }
}

function doPost() {

}

function doPut() {

}

function doDelete() {

}

function doJson($data) {
    
    echo json_encode($data);
    
}

function getCategory($id, $db) {
    static $categoryStmt = NULL;

    if (is_null($categoryStmt)) {
        $categoryStmt = $db->prepare("select * from `categories` where categoryID = ?");
    }

    $categoryID = array($id);
    $category = array();
    
    if (is_object($categoryStmt) && $categoryStmt->execute($categoryID)) {
        $category = $categoryStmt->fetch();
    }
    return $category;

}