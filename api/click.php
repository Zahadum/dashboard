<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../includes/class/DBConnection.php';
include_once '../objects/Click.php';
$passphrase = $_GET['sp'];
if($passphrase=='633'){
// instantiate database and product object
    $database = new DBConnection();


// initialize object
    $click = new Click($database);
// query products
    $rows = $click->read();




    $num = sizeof($rows);

// check if more than 0 record found
    if($num>0){

        // products array
        $click_arr=array();
        $click_arr["data"]=array();

        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop

        foreach($rows as $row) {
            extract($row);


            $click_item=array(
                "id" => $id,
                "andar_account_number" => $andar_account_number,
                "link_id" => $link_id,
                "issue_article" => $issue_article,
                "ip_address" => $ip_address,
                "created_at" => $created_at,
                "updated_at" => $updated_at
            );

            array_push($click_arr["data"], $click_item);
        }
        echo json_encode($click_arr);
        /*while ($row = $dataRows){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
            var_dump($row);

            $product_item=array(
                "id" => $id,
                "name" => $name,
                "description" => html_entity_decode($description),
                "price" => $price,
                "category_id" => $category_id,
                "category_name" => $category_name
            );

            array_push($products_arr["records"], $product_item);
        }

        ;echo json_encode($products_arr)*/
    }

    else{
        echo json_encode(
            array("message" => "Not found.")
        );
    }
} else{
    echo json_encode(
        array("message" => "Nothing here.")
    );
}



