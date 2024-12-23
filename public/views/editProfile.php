<?php 
    $data = $_SESSION['user'];
    $avatar = $data['avatar_link']?? 'images/avatarDefault.png';
?>
<link rel="stylesheet" href="css/editProfile.css">
<link rel="stylesheet" href="js/editProfile.js">
<div class="editProfile">
    <div class="container-edit-profile">
        <h1>Edit profile</h1>
        <div class="container-edit-profile-content">
            <form action="/user/edit" method="POST" enctype="multipart/form-data">
                <div class="profile-image">
                    <h5>Edit personal information</h5>
                    <img id="profile-image" src="<?php echo $avatar ?>" alt="Profile Image" width="150px" height="150px" class="edit-profile-input" readonly>
                    <p>Upload your new profile image</p>
                    <button type="button" id="change-image-button" style="display: none">CHANGE</button>
                    <button type="submit" id="submit-image-button" style="display: none">SAVE</button>
                    <input type="file" id="image-upload" accept="image/*" style="display: none;" name="file_uploaded">
                </div>
            </form>
            <form action="/user/edit" method="POST">
                <div class="form-container-profile">
                    <div class="form">
                        <div class="form-group">
                            <label>Full name</label>
                            <input type="text" name="fullName" class="edit-profile-input" required value="<?php echo $data['fullName'] ?? '' ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <div class="form-group-select">
                                <select name="province" id="province" class="edit-profile-input" readonly>
                                    <option value="<?php echo $data['province'] ?? '' ?>"><?php echo $data['province'] ?? '' ?></option>
                                </select>
                                <select name="district" id="district" readonly>
                                    <option value="<?php echo $data['district'] ?? '' ?>"><?php echo $data['district'] ?? '' ?></option>
                                </select>
                                <input type="text" name="detailed_address" placeholder="Detail address" class="edit-profile-input" value="<?php echo $data['detailed_address'] ?? '' ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>User name</label>
                            <input type="text" name="username" class="edit-profile-input" value="<?php echo $data['username'] ?? '' ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="<?php echo $data['email'] ?? '' ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Phone number</label>
                            <input type="text" name="phone" class="edit-profile-input" minlength="10" maxlength="10" value="<?php echo $data['phone'] ?? '' ?>" readonly>
                            <span>You want to change password?</span><span id="click-change-password">Click here</span>
                        </div>
                    </div>
                    <div class="submit-btn">
                        <button type="button" id="edit-profile-button">EDIT PROFILE</button>
                        <button type="submit" style="display: none" id="edit-profile-submit">SAVE CHANGE</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Create new password -->
        <div id="container-edit-password" style="display: none">
            <h5 style="text-align: center;">Edit password</h5>
            <form id="change-new-password-form">
                <div class="form-container-password">
                    <div class="form">
                        <div class="form-group" id="current-password-group">
                            <label>Current password</label>
                            <input type="password" name="currentPassword" id="currentPassword" class="edit-password-input" minlength="6" required>
                        </div>
                        <div class="form-group">
                            <label>New password</label>
                            <input type="password" name="newPassword" id="newPassword" class="edit-password-input" minlength="6" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm new password</label>
                            <input type="password" name="confirmNewPassword" id="confirmNewPassword" class="edit-password-input" minlength="6" required>
                            <span>You want to change your personal information ?</span> <span id="click-change-personalInfor">Click here</span>
                        </div>
                    </div>
                    <div class="submit-btn">
                        <button type="button" id="edit-password-input">SAVE CHANGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="module" src="js/editProfile.js"></script>
