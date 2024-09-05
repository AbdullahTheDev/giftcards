<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="{{ asset('assets/auth_assets/style.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Wishify</title>
</head>

<body>
  <section class="">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <div class="user-main">
                <div class="user-prf">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                </div>
                <div class="user-details">
                    <h4>Swithin Lun</h4>
                    <p><i class="fa fa-calendar-o" aria-hidden="true"></i>Event Date:<b>30 April 2024</b></p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i>Event Location:<b> Princes Hwy & Verdun Drive, Narre Warren VIC 3805, Australia</b></p>
                    <p><i class="fa fa-star-o" aria-hidden="true"></i>Event Date:<b>30 April 2024</b></p>
                </div>
            </div>


            <div class="gift-amount-main">
                
                <form action="" class="form-group" id="send-gift-frm">
                    <h3>Your Gift</h3>
                    <label for=""><b>Enter your gift amount ( $ )</b></label>
                    <input type="text" placeholder="" class="form-control">
                    <h3 class="text-start">Message</h3>
                    <label for=""><i>Your special message for the host</i></label>
                    <textarea name="" id="" rows="3" class="form-control"></textarea>
                    <input type="submit" value="Send Gift" id="send-gift" class="form-control">

                </form>

                <div class="container form-container">
                    <h4 class="form-title">Your Details</h4>
                    <form>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First name *</label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last name *</label>
                                <input type="text" class="form-control" id="lastName" required>
                            </div>
                        </div>
                
                        <div class="mb-3">
                            <label for="country" class="form-label">Country/Region *</label>
                            <select id="country" class="form-select" required>
                                <option selected>Australia</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                
                        <div class="mb-3">
                            <label for="streetAddress" class="form-label">Street address *</label>
                            <input type="text" class="form-control" id="streetAddress" placeholder="House number and street name" required>
                        </div>
                
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="suburb" class="form-label">Suburb *</label>
                                <input type="text" class="form-control" id="suburb" required>
                            </div>
                            <div class="col-md-6">
                                <label for="state" class="form-label">State *</label>
                                <select id="state" class="form-select" required>
                                    <option selected>New South Wales</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                        </div>
                
                        <div class="mb-3">
                            <label for="postcode" class="form-label">Postcode *</label>
                            <input type="text" class="form-control" id="postcode" required>
                        </div>
                
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone *</label>
                            <input type="tel" class="form-control" id="phone" required>
                        </div>
                
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address *</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                
                        <div class="total-container">
                            <h4>Your Gift</h4>
                            <div class="d-flex justify-content-between">
                                <span>Gift amount</span>
                                <span>$999.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Credit card surcharge</span>
                                <span>$18.10</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total</span>
                                <span>$1,017.10</span>
                            </div>
                        </div>
                
                        <h4 class="form-title mt-4">Payment</h4>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" checked>
                                <label class="form-check-label" for="creditCard">
                                    Credit/Debit Cards
                                </label>
                            </div>
                        </div>
                
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label">Card number</label>
                            <input type="text" class="form-control" id="cardNumber" placeholder="1234 1234 1234 1234" required>
                        </div>
                
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="expDate" class="form-label">Expiration date</label>
                                <input type="text" class="form-control" id="expDate" placeholder="MM / YY" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cvc" class="form-label">Security code</label>
                                <input type="text" class="form-control" id="cvc" placeholder="CVC" required>
                            </div>
                        </div>
                
                        <button type="submit" class="btn btn-warning w-100">Send Gift</button>
                    </form>
                </div>
            </div>

        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>