<!--title of the page -->
<?php $title="Verify Booking" ?>
<?php include "./template/header.html" ?>
<?php include "./filtering_inputs.php" ?>
<?php include "./database.php"; ?>

<?php $flage=false; ?>

<?php
//  Errors massage
$Errors_massage=array('phone'=>'','check-in'=>'');
?>




<section id="contact-form" class="py-3">
    <div class="container">
        <h1 class="l-heading">
            <span class="text-primary">Verify your Booking</span>
        </h1>
        <p>Please fill out the form below to check your booking</p>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="phone" name="phone" id="tel" maxlength="9" minlength="9" placeholder="567893214"  required>
                <span class="errors"><?php echo $Errors_massage['phone']; ?></span>
            </div>
            <div class="form-group">
                <label for="check-in">Check-in date</label>
                <input type="date" name="check-in" id="check-in" required>
                <span class="errors"><?php echo $Errors_massage['check-in']; ?></span>
            </div>
            <button class="btn" type="submit">Submit</button>
        </form>
    </div>
</section>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // getting the inputs and filter them.
    $data=array(
        'phone'=>filtering_phone($_POST['phone']),
        'check-in'=>filtering_date($_POST['check-in']),
    );

    // if any false value exists that mean some input wrong
    if (in_array(false,$data)){
        if ($data['phone'] == false){
            $Errors_massage['phone'] = 'The number phone is not correct.';
        }
        if ($data['check-in'] == false){
            $Errors_massage['check-in'] = 'There is no reservation at this date.';
        }
    }
    // get the input from the user
    $phone=$data['phone'];
    $check_in=$data['check-in'];

    // connect to database
    $database_conn=get_database_connection();
    // start prepared statement.
    $stmt =$database_conn->prepare("SELECT * FROM booking WHERE phone=? AND check_in= ?");
    // bind and execute
    $stmt->bind_param('is',$phone,$check_in);
    $stmt->execute();
    // getting the result.
    $query_result=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $database_conn->close();
}
?>

<!-- the result appeared here :) -->
<?php if (!empty($query_result)) { ?>
<div class="container">
    <h1 class="l-heading">
        <span class="text-primary">The result</span>
    </h1>
</div>
<div class="container-fluid">
    <div class="row">
    <?php
        foreach ($query_result as $result){
    ?>
       <div class="card container" style="width: 18rem; border: #f7c08a solid 6px">

                <img class="card-img-top" style="padding-left: 32%" src="./img/baseline_bed_black_36dp.png" alt="#">
                <div class="card-body">
                    <h5 class="card-title"><?php echo 'Mr/Ms: ' . $result['name'] . "<br>";?></h5>
                    <p class="card-text"><?php echo 'Phone: ' . $result['phone'] . "<br>"; ?>
                        <?php echo 'Your reservation is confirmed by a date ' .  $result['check_in'] . "<br>"; ?>
                        <?php echo 'And the end date  ' .  $result['check_out'] . "<br>"; ?>
                        <?php echo 'Room number: ' .  $result['room_id'] . "<br>"; ?></p>
                </div>
            </div>
            <br>
    <?php } ?>

    </div>
</div>
<?php } ?>




<?php include "template/footer.html" ?>

