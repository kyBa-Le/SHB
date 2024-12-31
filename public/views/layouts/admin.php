<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
          integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<link rel="stylesheet" href="css/admin/admin-dashboard.css">
<div class="header">
    <img src="images/logo.png" alt="logo" style="width:5vw">
    <h1>Admin</h1>
    <div class="logout">
        <h5>Logout</h5>
    </div>
</div>
<div class="container-dashboard">
    <div class="sidebar">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Orders</a></li>
        </ul>    
    </div>
    <div style="overflow: scroll;">
        {{content}}
    </div>     
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
</html>