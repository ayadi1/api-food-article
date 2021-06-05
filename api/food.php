<?php
// get data from database
if ($method === "GET") {
    require_once './classes/db.php';
    if (!empty($url[3])) {

        $sql = 'SELECT * FROM food where id_food = :id limit 0,1';
        $data = db::select($sql, array('id' => $url[3]));
        if ($data != null) {
            echo json_encode($data);
        } else {
            echo json_encode(["message" => "id not found"]);
        }
    } else {
        $sql = 'SELECT * FROM food ';
        $data = db::select($sql);
        if ($data != null) {
            echo json_encode($data);
        } else {
            echo json_encode(["message" => "id not found", 'success' => false]);
        }
    }
    // add data to database
} elseif ($method === 'POST') {
    require_once './classes/db.php';

    if (isset($_POST) && empty($url[3])) {
        extract($_POST);
        $sql = 'INSERT INTO `food`( `image`, `description`, `auther`, `id_category`) VALUES (:img,:description,:auther,:id_category)';
        db::query($sql, array(':img' => $img, 'description' => $description, ':auther' => $auther, ':id_category' => $id_category));
        echo json_encode(['message' => 'food added to the database successfully.', 'success' => true]);
    } else {

        echo json_encode(['message' => 'error .', 'success' => false]);
    }
} elseif (!empty($url[3])) {

    require_once './classes/db.php';
    // check if food in database
    $sql = 'SELECT * FROM food where id_food = :id limit 0,1 ';
    $data = db::select($sql, array('id' => $url[3]));

    if ($data != null) {
        // update data from database
        if ($method === 'PUT') {

            extract(json_decode(file_get_contents('php://input'), true));
            $sql = 'UPDATE `food` SET `image`=:img, `description`=:description, `auther`=:auther, `id_category`=:id_category WHERE `id_food` = :id ';
            DB::query($sql,array('img'=>$img,'description'=>$description,'auther'=>$auther,'id_category'=>$id_category,'id' => $url[3]));
            echo json_encode(['message' => 'food updated  successfully.', 'success' => true]);
            // delete data from database
        } elseif ($method === 'DELETE') {

            $sql = 'DELETE FROM `food` WHERE `id_food` = :id';

            db::query($sql, array('id' => $url[3]));

            echo json_encode(['message' => 'food Deleted  successfully.', 'success' => true]);
        }
    } else {
        echo json_encode(["message" => "id not found", 'success' => false]);
    }
}
