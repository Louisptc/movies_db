<?php
$conn = mysqli_connect("localhost", "root", "123", "movies_db");
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$genres_list = "SELECT id,label FROM `movies_db_genres` ORDER BY label ASC;";
$result_genres_list = mysqli_query($conn, $genres_list);
$result_genres_list = mysqli_fetch_all($result_genres_list, MYSQLI_ASSOC);
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
<div id="add-movie">
    <?php
    require_once 'add-movie.php';
    ?>
</div>
<form action="details_movie.php" method="GET">

    <div class="uk-container-expend uk-background-muted uk-margin-left uk-padding uk-flex uk-flex-column">
        <?php
        require_once "navigation.php";
        ?>
        <div class="uk-card uk-card-default">
            <div>
                <div class="uk-card-deck">
                    <?php
                    $genre_id = $_GET['genre'];
                    $genres_list = "SELECT * FROM `movies_db_genres` as genres INNER JOIN `movie_to_genres_map` as genres_map  ON genres.id = genres_map.genre_id WHERE genre_id = $genre_id;";
                    $result2 = mysqli_query($conn, $genres_list);
                    ?>
                    <?php
                    $genres = mysqli_fetch_array($result2); ?>
                    <h1 class="uk-padding"> <?php echo $genres['label']; ?> Films </h1>
                    <?php
                    require_once "sort-by.php";
                    ?>

                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        $poster_img = $row['poster_url'];
                        ?>
                        <div class="uk-card uk-card-default">
                            <h3 class="uk-card-title uk-padding"><?php echo $row['title']; ?></h3>
                            <div class="uk-card-body uk-flex">
                                <div>
                                    <img src="<?php echo $poster_img; ?>" alt="poster of the film"
                                         style="height: 30vh; width: 20vh">
                                </div>
                                <div class="uk-margin-large-left">
                                    <p style="width: 100vh; height: 10vh;"><?php echo $row['plot']; ?></p>
                                </div>
                            </div>
                            <div class="uk-card-body uk-margin-remove-left">
                                <p>Release date : <?php echo $row['year']; ?></p>
                                <p>Duration : <?php echo $row['runtime']; ?> minutes</p>
                                <p>Director : <?php echo $row['director']; ?></p>
                                <p>Actors : <?php echo $row['actors']; ?></p>
                            </div>
                        </div>
                        <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
