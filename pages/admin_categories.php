<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Categories</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
        <link rel="stylesheet" type="text/css" href="../css/table.css">
        <link rel="icon" type="image/x-icon" href="../images/SSW/favicon.ico">
    </head>
    <body>
        <header>
            <a id="logo-header" class="logo"><img src="../images/SSW/logo.png" alt="logo" class="logo-img"></a>
            <nav>
                <a href="admin.php" class="nav-link">Users</a>
                <a href="admin_paths.php" class="nav-link">Paths</a>
                <a href="admin_serie.php" class="nav-link">Series</a>
                <a href="admin_movie.php" class="nav-link">Movies</a>
                <a href="admin_stand_up.php" class="nav-link">Stand Up</a>
                <a href="admin_categories.php" class="nav-link">Categories</a>
                <a href="admin_genders.php" class="nav-link">Genders</a>
                <i class='fas fa-angle-left'></i></i><a href="../php/destroy.php" class="nav-link">Log Out</a>
            </nav>
        </header>
        <div id="login">
            <div id="login-header">
                <h1>Add Category</h1>
            </div>
            <form action="admin_categories.php" method="post">
                <div id="login-form">
                    <h3>Category:</h3>
                    <input name="category" type="text" placeholder="Category" required>
                    <input type="submit" name="Add" value="Add">
                </div>
            </form>
        </div>
        <p>To see the Categories, click <b><a href='consult_table.php?categories=yes' class='nav-link'>here</a></b></p>
        <div id="login">
            <div id="login-header">
                <h1>Delete Category</h1>
            </div>
            <form action="admin_categories.php" method="post">
                <div id="login-form">
                    <datalist id="list">
                        <?php
                            require_once "../php/connect.php";
                            $select_query = "SELECT * FROM categories;";
                            $result = $connection->query($select_query);
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                echo "<option>{$row['name']}</option>";
                            }
                        ?>
                    </datalist>
                    <h3>Category:</h3>
                    <input name="category" type="text" placeholder="Category" required>
                    <input type="submit" name="Delete" value="Delete">
                </div>
            </form>
        </div>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </body>
</html>
<?php
    if (isset($_POST['Add'])) {
        if ($_POST['category'] != " ") {
            require_once "../php/connect.php";
            $name = $_POST['category'];
            $verify_query = "SELECT * FROM categories WHERE name = '$name';";
            if ($connection != NULL)  {
                $result = $connection->query($verify_query);
                if ($result->num_rows == 0) {
                    $category_query = "INSERT INTO categories (name) VALUES ('$name');";
                    mysqli_query($connection, $category_query);
                    echo "<script language='javascript'>alert('The Category $name was added successfully')</script>";
                }
                else {
                    echo "<script language='javascript'>alert('The Category $name already exists')</script>";
                }
                mysqli_close($connection);
            }
            else {
                echo "<script language='javascript'>alert('Nada que hacer aca bro')</script>";
            }
        }
        else {
            echo "<script language='javascript'>alert('Can not insert a Blank Category');</script>";
        }
    }
    if (isset($_POST['Delete'])) {
        if ($_POST['category'] != " ") {
            require_once "../php/connect.php";
            $name = $_POST['category'];
            $verify_query = "SELECT * FROM categories WHERE name = '$name';";
            $result = $connection->query($verify_query);
            if ($result->num_rows == 1) {
                $verify_query = "SELECT * FROM movies WHERE category = '$name';";
                $result = $connection->query($verify_query);
                if ($result->num_rows == 0) {
                    $category_query = "DELETE FROM categories WHERE name = '$name';";
                    mysqli_query($connection, $category_query);
                    echo "<script language='javascript'>alert('The Category $name was deleted Sucessfully')</script>";
                }
                else {
                    echo "<script language='javascript'>alert('Some Movies have this Category, so, it can not be deleted')</script>";
                }
            }
            else {
                echo "<script language='javascript'>alert('The Category $name is not in the System')</script>";
            }
            mysqli_close($connection);
        }
        else {
            echo "<script language='javascript'>alert('Can not delete a Blank Category');</script>";
        }
    }
?>