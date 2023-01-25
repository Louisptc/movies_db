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

        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    </head>
    <body>
    <nav class="uk-navbar-container uk-margin" uk-navbar>
        <div class="uk-navbar-center uk-flex uk-flex-wrap uk-margin uk-padding">
            <div>
                <a class="uk-navbar-toggle uk-navbar-toggle-animate" uk-navbar-toggle-icon href="#"></a>
                <div class="uk-navbar-dropdown ">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <?php
                        $result = mysqli_query($conn, $genres_list);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<li><a href='details_movie.php?genre=" . $row['id'] . "'>" . $row['label'] . "</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="uk-navbar-item">
                <h1>Movie Database</h1>
            </div>
            <?php
            require_once  'autocomplete.php';
            ?>
            <div class="uk-navbar-item">
                <a class="uk-button uk-button-default" href="#modal-center" uk-toggle>ADD A MOVIE </a>
            </div>
            <div>
                <div id="modal-center" class="uk-flex-top" uk-modal>
                    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                        <h2 class="uk-modal-title">Add a movie</h2>
                        <form action="insert.php" method="GET">
                            <fieldset class="uk-fieldset">
                                <div class="uk-margin">
                                    <input class="uk-input" type="text" placeholder="Title" name="title">
                                </div>
                                <div class="uk-margin">
                                    <input class="uk-input" type="text" placeholder="Year" name="year">
                                </div>
                                <div class="uk-margin">
                                    <input class="uk-input" type="text" placeholder="Runtime" name="runtime">
                                </div>
                                <div class="uk-margin">
                                    <input class="uk-input" type="text" placeholder="Director" name="director">
                                </div>
                                <div class="uk-margin">
                                    <input class="uk-input" type="text" placeholder="Actors" name="actors">
                                </div>
                                <div class="uk-margin">
                                    <input class="uk-input" type="text" placeholder="Plot" name="plot">
                                </div>
                                <div class="uk-margin">
                                    <input class="uk-input" type="text" placeholder="Poster URL" name="poster_url">
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-stacked-select">Genres</label>
                                    <div class="uk-form-controls">
                                        <select class="uk-select" id="form-stacked-select" multiple="multiple"
                                                name="label[]">
                                            <?php
                                            foreach ($result_genres_list as $genre) {
                                                echo "<option value='" . $genre['id'] . "'>" . $genre['label'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <button class="uk-button uk-button-primary">ADD</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div id="result"></div>
    <div class="uk-flex uk-flex-center uk-background-muted uk-padding">
        <div class="uk-background-muted uk-padding uk-flex uk-flex-column">
            <h1>Recently added</h1>
            <div class="uk-card uk-card-default">
                <div>
                    <div class="uk-card-deck">
                        <?php
                        $home_list_film = "SELECT title, plot, poster_url FROM `movies_db_movies` ORDER BY `movies_db_movies`.`id` DESC LIMIT 0, 4;";
                        $result = mysqli_query($conn, $home_list_film);
                        while ($row = mysqli_fetch_array($result)) {
                            $poster_img = $row['poster_url'];
                            ?>
                            <div class="uk-card uk-card-default">
                                <h3 class="uk-card-title uk-padding"><?php echo $row['title']; ?></h3>
                                <div class="uk-card-body uk-flex uk-margin">
                                    <img src="<?php echo $poster_img; ?>" alt="poster of the film"
                                         style="height: 30vh; width: 20vh">
                                    <p class="uk-margin-large-left"><?php echo $row['plot']; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </body>
    </html>

<?php

$home_list_film = "SELECT title FROM `movies_db_movies` ORDER BY `movies_db_movies`.`id` ASC LIMIT 0, 4;";

$result = mysqli_query($conn, $home_list_film);

?>
<?php
//
//$file_movies = "movies.json";
//
//$data_movies = file_get_contents($file_movies);
//
//$array_movies = json_decode($data_movies, true);
//
////echo "<pre>";
////print_r($array_movies);
////echo "</pre>";
//
//mysqli_query($conn, "TRUNCATE TABLE movies_db_movies");
//mysqli_query($conn, "TRUNCATE TABLE movie_to_genres_map");
//foreach ($array_movies as $value_movies) {
//    //echo '<br><pre>'; print_r($value_movies); echo '</pre>';
//
//    $query = "INSERT INTO `movies_db_movies` " .
//        " (`id`,`title`, `year`,`runtime`,`director`,`actors`,`plot`,`poster_url`) " .
//        " VALUES (" .
//        (int)$value_movies['id'] . ",'" .
//        mysqli_real_escape_string($conn, $value_movies['title']) . "', '" .
//        mysqli_real_escape_string($conn, $value_movies['year']) . "','" .
//        mysqli_real_escape_string($conn, $value_movies['runtime']) . "','" .
//        mysqli_real_escape_string($conn, $value_movies['director']) . "', '" .
//        mysqli_real_escape_string($conn, $value_movies['actors']) . "' , '" .
//        mysqli_real_escape_string($conn, $value_movies['plot']) . "', '" .
//        mysqli_real_escape_string($conn, $value_movies['posterUrl']) .
//        "')";  // print $query;  exit;
//
//    $result = mysqli_query($conn, $query);
////    if (!$result) die($query . '<br>' . mysqli_error($con) . " <br><br>... stoping execution");
//
//    foreach ($value_movies['genres'] as $genre) {
//        //echo '<br><pre>'; print_r($genre['id']); echo '</pre>'; exit;
//        $query_genres = "INSERT INTO `movie_to_genres_map`( `movie_id`, `genre_id`) VALUES ('" . $value_movies['id'] . "','" . $genre['id'] . "')";
//        //print $query_genres; exit;
//
//        $result = mysqli_query($conn, $query_genres);
//        if (!$result) die(mysqli_error($conn) . "<br><br> ... stoping execution");
//
//    }
//}
////echo "<br>Movies Imported Successfully";

//

