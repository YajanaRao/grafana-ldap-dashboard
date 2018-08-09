<!DOCTYPE html>
<html>
<head>
<style> 
textarea {
    width: 100%;
    height: 150px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
    margin: 8px 0;
}

input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 3px solid #ccc;
    -webkit-transition: 0.5s;
    transition: 0.5s;
    outline: none;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50;
}

input[type=text]:focus {
    border: 3px solid #555;
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<ul>
  <li><a href="admin_home.php">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li style="float:right"><a class="active" href="login.html">Login</a></li>
</ul>

<div class="container">
<?php 
session_start(); 
echo "<h2>".$_SESSION['username']."</h2>" ;?>

<form action='modify.php' method='POST' enctype="multipart/form-data">
<div class="form-group">
    <label for="dname">Display Name</label>
    <input type="text" class="form-control" id="dname" name="dname" value="">
</div>
<div class="form-group">
    <label for="company">Company</label>
    <input type="text" class="form-control" id="company" name="company" value="">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description">Some text...</textarea>
</div>
<div class="form-group">
    <label for="file">Upload profile picture</label>
    <input type="file" name="fileToUpload" id="fileToUpload">
</div>
<div class="form-group">
  <div class="row">
    <label for="country">Select Country</label>
    <div class="col-2">
      <select class="form-control" id="country" name="country">
        <option>India</option>
        <option>Bangladesh</option>
        <option>Pakistan</option>
        <option>Japan</option>
      </select>
  </div>
    <label for="state">Select State</label>
    <div class="col-2">
  <select class="form-control" id="state" name="state">
    <option>Karnataka</option>
    <option>Kerala</option>
    <option>Tamil nadu</option>
    <option>Andra Pradesh</option>
  </select>
</div>
</div>
</div>
    <?php echo "<button type='submit' class='btn btn-primary' name='entry' value='".$_SESSION['username']."'>Submit</button>"?>
</form>
</div>
</body>
</html>