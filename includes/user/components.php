<!-- Toast -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast text-white bg-light" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-center">
            <p class="mb-0 fw-bold"></p>
        </div>
    </div>
</div>
<!-- Chat Support Button -->
<button type="button" class="btn btn-primary btn-chat-support animation-right" id="chatSupport">
    <i class="fa-solid fa-hand-holding-heart"></i>
</button>
<!-- Chat Message Box -->
<div id="chatBox" class="chat-box" style="display: none;">
    <div class="chat-header">
        <span>Washaholic Chat Support</span>
        <button id="closeChatBox" class="close-chat-box">&times;</button>
    </div>
    <div class="chat-body">
        <div class="message-container" id="chatContainer">
            <div class="chat left animation-left">
                <i class="fa-solid fa-user-tie fw-semibold me-2" style="color: var(--theme-color3);"></i>
                <div class="message">
                    <p>Hello <?php echo $first_name; ?>! How can we assist you today?</p>
                </div>
            </div>
        </div>
        <div class="faq-choices animation-upwards">
            <select id="faqSelect" class="form-select">
                <option value="" selected disabled>Frequently asked questions</option>
            </select>
        </div>
    </div>
    <div class="input-container">
        <input type="text" id="inputChat" placeholder="Enter your message here" class="form-control m-0"
            autocomplete="off">
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalBook" tabindex="-1" aria-labelledby="modalBookLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="modalBookLabel">Book a Laundry Slot - <span id="bookDate"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bookingForm">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="fullName"
                            value="<?php echo $user_data['user_name'] ?>" name="fullName" required>
                        <label for="fullName">Full Name</label>
                    </div>
                    <div class="row gap-0">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email"
                                    value="<?php echo $user_data['user_email'] ?>" name="email" required>
                                <label for="email">Email Address</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="phoneNumber"
                                    value="<?php echo $user_data['user_phone_number'] ?>" name="phoneNumber" required>
                                <label for="phoneNumber">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    <!-- Service Selection -->
                    <table class="table table-bordered mb-3">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Services</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input class="form-check-input" type="radio" name="serviceOption" id="washDry3to8"
                                        value="washDry3to8" checked>
                                </td>
                                <td>
                                    <label class="form-check-label" for="washDry3to8">
                                        Wash and Dry (3 to 8 kilos)
                                    </label>
                                </td>
                                <td>₱69.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-check-input" type="radio" name="serviceOption" id="washDry8to10"
                                        value="washDry8to10">
                                </td>
                                <td>
                                    <label class="form-check-label" for="washDry8to10">
                                        Wash and Dry (8 to 10 kilos)
                                    </label>
                                </td>
                                <td>₱89.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-check-input" type="radio" name="serviceOption"
                                        id="fullService3to8" value="fullService3to8">
                                </td>
                                <td>
                                    <label class="form-check-label" for="fullService3to8">
                                        Full Service (Wash, Dry, and Fold) (3 to 8 kilos)
                                    </label>
                                </td>
                                <td>₱164.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-check-input" type="radio" name="serviceOption"
                                        id="fullService8to10" value="fullService8to10">
                                </td>
                                <td>
                                    <label class="form-check-label" for="fullService8to10">
                                        Full Service (Wash, Dry, and Fold) (8 to 10 kilos)
                                    </label>
                                </td>
                                <td>₱204.00</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Additional Options -->
                    <table class="table table-bordered mb-3">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Additional Services</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="extraWash" id="extraWash"
                                        value="12">
                                </td>
                                <td>
                                    <label class="form-check-label" for="extraWash">
                                        Extra Wash
                                    </label>
                                </td>
                                <td>₱12.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="extraDry" id="extraDry"
                                        value="19">
                                </td>
                                <td>
                                    <label class="form-check-label" for="extraDry">
                                        Extra 10 mins Dry
                                    </label>
                                </td>
                                <td>₱19.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="extraRinse" id="extraRinse"
                                        value="19">
                                </td>
                                <td>
                                    <label class="form-check-label" for="extraRinse">
                                        Extra Rinse
                                    </label>
                                </td>
                                <td>₱19.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox" name="spinDry" id="spinDry"
                                        value="19">
                                </td>
                                <td>
                                    <label class="form-check-label" for="spinDry">
                                        Spin (Dry Only)
                                    </label>
                                </td>
                                <td>₱19.00</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Total Cost Display -->
                    <div class="alert custom-bg-color mb-3 text-center py-2 text-light" role="alert">
                        <p>Total Cost: <strong id="totalCost">₱0.00</strong></p>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" id="paymentMethod" name="paymentMethod">
                            <option selected>Please select payment method</option>
                            <option value="cash on pickup">Cash On Pickup</option>
                            <option value="gcash">GCash</option>
                        </select>
                    </div>
                    <div class="gcash-main-container mb-3 d-none">
                        <div class="gcash-qr mb-3 text-center">
                            <img src="../assets/images/gcash-qrcode.jpg" height="100%" width="300" alt="img"
                                class="text-center border rounded">
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="file" class="form-control" id="gcashReceipt" name="gcashReceipt"
                                        required>
                                    <label for="gcashReceipt">
                                        Screenshot of Receipt<span class="text-danger">*</span>
                                    </label>
                                </div>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="referenceNumber" name="referenceNumber"
                                        required>
                                    <label for="referenceNumber">Reference Number <span class="text-danger">*</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" id="comments" name="comments"
                            placeholder="Additional Comments"></textarea>
                        <label for="comments">Additional Comments</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-secondary py-0" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary py-0" id="submitBooking">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalProfile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content profile-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col">
                        <h4 class="custom-color text-center fw-bold">My Profile</h4>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col text-center">
                        <label for="fileToUpload">
                            <div class="profile-pic user-pic">
                                <span class="glyphicon glyphicon-camera"></span>
                                <span>Change Image</span>
                            </div>
                        </label>
                        <input type="File" name="fileToUpload" id="fileToUpload">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="userName" placeholder="Full Name"
                                value="<?php echo $user_data['user_name']; ?>">
                            <label for="userName">Full Name</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="userEmail" placeholder="Email"
                                value="<?php echo $user_data['user_email']; ?>">
                            <label for="userEmail">Email</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="userPhoneNumber" placeholder="PhoneNumber"
                                value="<?php echo $user_data['user_phone_number']; ?>">
                            <label for="userPhoneNumber">Phone Number</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="userStreetAddress" placeholder="StreetAddress"
                                value="<?php echo $user_data['user_street_address']; ?>">
                            <label for="userStreetAddress">Street Address</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="userTownCity" placeholder="TownCity"
                                value="<?php echo $user_data['user_town_city']; ?>">
                            <label for="userTownCity">Town/City</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="userZipCode" placeholder="ZipCode"
                                value="<?php echo $user_data['user_zip_code']; ?>">
                            <label for="userZipCode">Zip Code</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <button type="button" class="btn btn-primary update-profile py-0 w-50">Update Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>