<?php
include "./filtering_inputs.php";
include "./database.php";



// booking processing
function booking_request($request){

    // Handel only the post request
    $data = getting_input($request);

    // if any false value exists that mean some input wrong
    if (in_array(false,$data)){
         return $data;
    }

    // add to hry database.
    else{
        // connect to database
        $database_conn=get_database_connection();
        // start prepared statement.
        $stmt =$database_conn->prepare("INSERT INTO booking (name,phone,check_in,check_out) VALUES (?,?,?,?)");
        $name=$data['name'];
        $phone=$data['phone'];
        $check_in=$data['check-in'];
        $check_out=$data['check-out'];
        // bind and execute
        // s:string |  i:int
        $stmt->bind_param('siss',$name,$phone,$check_in,$check_out);
        $stmt->execute();
        $database_conn->close();
        return true;
    }

}

// take the inputs from the form
function getting_input($request){
    $data=array(
        'name'=>filtering_string($request['name']),
        'phone'=>filtering_phone($request['phone']),
        'check-in'=>filtering_date($request['check-in']),
        'check-out'=>filtering_date($request['check-out'])
    );

    // check if the check-in date older from check-out date.
    if ($data['check-in'] != false && $data['check-out']!= false){
        if ($data['check-in'] > $data['check-out']){
            $data['check-in'] = false;
        }
    }
    return $data;
}



