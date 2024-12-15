<link rel="stylesheet" href="css/editProfile.css">
<link rel="stylesheet" href="js/editProfile.js">
<div class="container-edit-profile">
    <h1>Edit profile</h1>
    <div class="profile-image">
        <h5>Edit personal information</h5>
        <img src="https://via.placeholder.com/80" alt="Profile Image">
        <p>Upload your new profile image</p>
        <button>CHANGE</button>
    </div>
    <form>
        <div class="form-container-profile">
            <div class="form">
                <div class="form-group">
                    <label>Full name</label>
                    <input type="text" name="fullName">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <div class="form-group-select">
                        <select name="province" id="province">
                            <option value="" disabled selected>Province</option>
                        </select>
                        <select name="district" id="district">
                            <option value="" disabled selected>District</option>
                        </select>
                        <input type="text" name="detailed_address" placeholder="Detail address">
                    </div>
                </div>
                <div class="form-group">
                    <label>User name</label>
                    <input type="text" name="username">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email">
                </div>
                <div class="form-group">
                    <label>Phone number</label>
                    <input type="text" name="phone">
                    <span>You want to change password?</span> <span id="click-change-password">Click here</span>
                </div>
            </div>
            <div class="submit-btn">
                <button type="submit">SAVE CHANGE</button>
            </div>
        </div>
    </form>
</div>
