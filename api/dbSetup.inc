<?PHP


function dbSetup() {
    static $db = NULL;
    $dbuser = 'genericUser';
    $dbpass = 'anand1st';
    $dbname = 'test';
    $dbhost = '127.0.0.1';
    
    if (is_null($db)) {
        try {
            $db = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpass);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    return $db;
}

?>