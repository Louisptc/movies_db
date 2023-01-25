<?php
$conn = mysqli_connect("localhost", "root", "123", "movies_db");
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$search = $_GET['search'];
$genres_list = "SELECT id,label FROM `movies_db_genres` ORDER BY label ASC;";
$result_genres_list = mysqli_query($conn, $genres_list); // Get all genres
$result_genres_list = mysqli_fetch_all($result_genres_list, MYSQLI_ASSOC); // Convert to array
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movies database</title>

    <link rel="stylesheet" href="css/style.css">
    <script src="js/main.js"></script>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.21/dist/css/uikit.min.css"/>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.21/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.21/dist/js/uikit-icons.min.js"></script>

</head>
<body>
<form action="details_movie.php" method="GET">
    <div class="uk-container-expend uk-background-muted uk-margin-left uk-padding uk-flex uk-flex-column">
        <?php
        require_once "navigation.php";
        ?>
        <div class="uk-card uk-card-default">
            <div>
                <div class='uk-card-deck'>
                    <?php
                    $query = "SELECT * FROM `movies_db_movies` WHERE `title` LIKE '%" . $_GET['query'] . "%' OR `year` LIKE '%" . $_GET['query'] . "%' OR `director` LIKE '%" . $_GET['query'] . "%' OR  `actors` LIKE '%" . $_GET['query'] . "%' ORDER BY `year` ASC;";
                    echo "<h2>Results for " . $_GET['query'] . "</h2>";
                    $result = mysqli_query($conn, $query);
                    ?>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) { // Loop through all movies
                        $poster_img = $row['poster_url'];
                        ?>
                        <div class="uk-card uk-card-default">
                            <h3 class="uk-card-title uk-padding"><?php echo $row['title']; ?></h3>
                            <div class="uk-card-body uk-flex">
                                <img src="<?php echo $poster_img; ?>" alt="No cover for this film"
                                     style="height: 30vh; width: 20vh">
                                <div class="uk-card-body uk-margin-remove-left">
                                    <p>Release date : <?php echo $row['year']; ?></p>
                                    <p>Duration : <?php echo $row['runtime']; ?> minutes</p>
                                    <p>Director : <?php echo $row['director']; ?></p>
                                    <p>Actors : <?php echo $row['actors']; ?></p>
                                </div>
                                <p><?php echo $row['plot']; ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>

