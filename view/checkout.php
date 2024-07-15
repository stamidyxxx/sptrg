<?php
session_start();

include_once "header.php";
include_once "../controler/narocilo.php";
include_once "../controler/narocilo_has_artikel.php";

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

if (isset($_POST['place_order']) && isset($_POST['firstName']) 
    && isset($_POST['lastName']) && isset($_POST['email']) 
    && isset($_POST['address']) && isset($_POST['country']) 
    && isset($_POST['zip']) && isset($_POST['cc-name']) 
    && isset($_POST['cc-number']) && isset($_POST['cc-expiration']) 
    && isset($_POST['cc-cvv']))
{
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $zip = $_POST['zip'];
    $ccName = $_POST['cc-name'];
    $ccNumber = $_POST['cc-number'];
    $ccExpiration = $_POST['cc-expiration'];
    $ccCvv = $_POST['cc-cvv'];
    $id = 10;

    if (isset($_SESSION['user']['id']))
        $id = $_SESSION['user']['id'];

    $narocilo = new narocilo($firstName, $lastName, $email, $address, $country, $zip, $ccName, $ccNumber, $ccExpiration, $ccCvv, $id);
    $narocilo->add_narocilo();
    $id_narocila = $narocilo->get_id();

    foreach ($_SESSION['cart'] as $id_artikel)
    {
        $narocilo_has_artikel = new narocilo_has_artikel($id_narocila[0][0], $id_artikel);
        $narocilo_has_artikel->add_narocilo_has_artikel();
        unset($narocilo_has_artikel);
    }

    unset($_SESSION['cart']);
}
?>

<div class="container">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
                        <div class="invalid-feedback"> Valid first name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required>
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                    <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                </div>
                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required>
                    <div class="invalid-feedback"> Please enter your shipping address. </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" id="country" name="country" required>
                            <option value="">Choose...</option>
                            <option>Slovenia</option>
                        </select>
                        <div class="invalid-feedback"> Please select a valid country. </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="" required>
                        <div class="invalid-feedback"> Zip code required. </div>
                    </div>
                </div>
                <hr class="mb-4">
                <h4 class="mb-3">Payment</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Name on card</label>
                        <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="" required>
                        <small class="text-muted">Full name as displayed on card</small>
                        <div class="invalid-feedback"> Name on card is required </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Credit card number</label>
                        <input type="text" class="form-control" id="cc-number" name="cc-number" placeholder="" required>
                        <div class="invalid-feedback"> Credit card number is required </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Expiration</label>
                        <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" placeholder="" required>
                        <div class="invalid-feedback"> Expiration date required </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-cvv">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="" required>
                        <div class="invalid-feedback"> Security code required </div>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="place_order">Place order</button>
            </form>
        </div>
    </div>
</div>