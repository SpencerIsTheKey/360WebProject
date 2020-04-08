<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/homepage.css">
    <title>Talk About Turtles</title>
    <style>
 
        #fieldset {
            padding: 1em;
            color: black;
          }
          legend {
              text-align: center;
          }

          #forming {
            background:  #f5eaea;
            padding: 0.5em;
          }
    </style>
    <script>
        function validateForm() {
          var x = document.forms["myForm"]["articletitle"].value;
          if (x == "") {
            alert("There must be a title");
            return false;
          }
          var y = document.forms["myForm"]["content"].value;
          if (y == "") {
            alert("An article needs content");
            return false;
          }
        
        }
        </script>
</head>
<div id="navbar">
    <div id="logo">
        <a href="#"></a>
            <img src="../CSS/images/Turtle.png">
        </a>
    </div>
    <div id="title">
        <h1>Talk About Turtles</h1>
    </div>
    <div id="searchbar">
      <form action="./search.html">
        <input id="search" type="text" style="height: 1.5em; width: 30em;"/>
        <button type ="submit" style="background-color: #f5eaea;"><img src="../CSS/images/search.png" style="height: 1.25em; width: 1.25em;"></button>
    </form>
    </div>
    <div id="login">
        <a class="linkbutton" href="#">Login/Signup</a>
    </div>
</div>
<body>
    
<form id="forming" name="myForm" method="post" onsubmit="return validateForm()" action="http://www.randyconnolly.com/tests/process.php">
    <fieldset id="fieldset">
      <legend>Article Creation</legend>
      Article Title:
      <input type="text" name="articletitle" placeholder="Enter an article title" /> <br />
      <br />
      Enter the content of your article:<br>
      <textarea name = "content" rows ="50" cols = "60"></textarea>
     <br>
      <input type="submit" value = "Submit" /> <input type="reset" />
    </fieldset>
  </form>
</body>
</html>

</body>
</html>
