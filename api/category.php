<?php

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

    if (preg_match('/category\/(\d+)[\/]*$/', $_SERVER['REQUEST_URI'], $matches)) {
        /* We've got a single item to grab. */
        $categoryID = array($matches[1]); // execute expects an array.
        $stmt = $db->prepare("select * from `categories` where categoryID = ?");
        if (is_object($stmt) && $stmt->execute($itemID)) {
            /* We only asked for one. */
            $row = $stmt->fetch();
            $row['items'] = getItems($row['categoryID'], $db);
            doJson($row);
        } else {
            doJson(array(), false, $stmt->errorInfo());
        }
    } else {
        $data = array();
        $items = array();
        $filters = json_decode($_GET['filter'], TRUE);
        $start = intval($_GET['start']);
        $limit = intval($_GET['limit']);
        /* For simplicity, just use one filter */
        $filterColumn = $filters[0]['property'];
        $filterValue = $filters[0]['value'];
        $sql = "select * from `categories`";
        if (!is_null($filterValue) && $filterValue != 'null' && $filterValue != "") {
            $sql .= " where `$filterColumn` = '$filterValue'";
        }
        if ($limit > 0) {
            $sql .= " limit $start,$limit";
        }
        foreach ($db->query($sql) as $row) {
            /* Only fetch categories once. */
            if (!isset($items[$row['categoryID']])) {
                $items[$row['categoryID']] = getItems($row['categoryID'], $db);
            }
            $row['items'] = $items[$row['categoryID']];

            $data[] = $row;
        }

        echo json_encode($data);
        exit;
    }
}

function doPost() {
    /* We are editing an existing item */
    doJson(array());
}

function doPut() {
    /* We are adding a new item */
    /* Our variables are sent as a raw http post, not as a post var */
    $data = getJsonPayload();
    if ($data['categoryID'] == 0) {
        unset($data['categoryID']);
        $inserting = TRUE;
        $sql = "insert into `categories` (`categoryID`, `name`) values (NULL, :name)";
    } else {
        $inserting = FALSE;
        $sql = "update `categories` set `categoryID` = :categoryID, `name` = :name where `categoryID` = :categoryID";
    }
    $db = dbSetup();


    /* Prepare our data. Here is where you should add filtering, etc. */
    $insert = array();
    foreach ($data as $key => $val) {
        $insert[':'.$key] = $val;
    }

    $stmt = $db->prepare($sql);
    $stmt->execute($insert);
    if ($inserting) {
        $data['categoryID'] = $db->lastInsertId();
    }
    $data['items'] = getItems($data['categoryID'],$db);
    doJson($data);
}

function doDelete() {
    $db = dbSetup();
    $data = getJsonPayload();
    $categoryID = array($data['categoryID']);
    $sql = 'delete from categories where categoryID = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute($categoryID);
    echo json_encode($data);
}

function doJson($data, $success = true, $message = '') {
    $output = array('success' => $success, 'data' => $data);
    if ($message != '') {
        $output['message'] = $message;
    }
    echo json_encode($output);

}

function getItems($id, $db) {
    static $itemStmt = NULL;

    if (is_null($categoryStmt)) {
        $itemStmt = $db->prepare("select * from `items` where categoryID = ?");
    }

    $categoryID = array($id);
    $items = array();

    if (is_object($itemStmt) && $itemStmt->execute($categoryID)) {
        while($item = $itemStmt->fetch()) {
            $items[] = $item;
        }
    }
    return $items;

}

function getJsonPayload() {
    return json_decode(file_get_contents('php://input'), true);
}