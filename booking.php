<?php $title = "Booking"; ?>
<?php include "./template/header.html"; ?>
<?php include "./add_booking.php"; ?>

<?php $flage = false; ?>


<?php
//  Errors massage
$Errors_massage = array('name' => '', 'phone' => '', 'check-in' => '', 'check-out' => '');
?>



<?php
//  Take the request the handle it
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //handle the error
    $data = booking_request($_POST);

    // display massage if the any error
    if ($data != true && $data['name'] == false) {
        $Errors_massage['name'] = 'Name input is not valid';
    }
    if ($data != true && $data['phone'] == false) {
        $Errors_massage['phone'] = 'Phone input is not valid';
    }
    if ($data != true && $data['check-in'] == false) {
        $Errors_massage['check-in'] = 'Check-in input is not valid';
    }
    if ($data != true && $data['check-out'] == false) {
        $Errors_massage['check-out'] = 'Check-out input is not valid';
    }
    if ($data == true) {
        $flage = true;
        $Errors_massage['name'] = $Errors_massage['phone'] = $Errors_massage['check-in'] = $Errors_massage['check-out'] = '';
    }
}
?>


<section id="contact-form" class="py-3">
    <div class="container">
        <?php if ($flage) { ?>
            <div class="alert-success" style="margin-bottom: 10px">
                <strong>Success!</strong> Your reservation is confirmed.
            </div>
        <?php } ?>
        <h1 class="l-heading">
            <span class="text-primary">Booking</span>
        </h1>
        <p>Please fill out the form below to Book</p>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
                <span class="dis_errors"><?php echo $Errors_massage['name']; ?></span>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" name="phone" id="phone" maxlength="9" minlength="9" placeholder="567893214" required>
                <span class="errors"><?php echo $Errors_massage['phone']; ?></span>
            </div>
            <div class="form-group">
                <label for="check-in">Check-in date</label>
                <input type="date" name="check-in" id="check-in" required>
                <span class="errors"><?php echo $Errors_massage['check-in']; ?></span>
            </div>

            <div class="form-group">
                <label for="check-out">Check-out date</label>
                <input type="date" name="check-out" id="check-out" required>
                <span class="errors"><?php echo $Errors_massage['check-out']; ?></span>
            </div>

            <button class="btn" type="submit">Submit</button>
        </form>
    </div>
</section>


<?php include "template/footer.html" ?>
