<?php
$conn = mysqli_connect("localhost", "root", "123", "movies_db");
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$title = mysqli_real_escape_string($conn, $_GET['title']);
$year = mysqli_real_escape_string($conn, $_GET['year']);
$runtime = mysqli_real_escape_string($conn, $_GET['runtime']);
$director = mysqli_real_escape_string($conn, $_GET['director']);
$actors = mysqli_real_escape_string($conn, $_GET['actors']);
$plot = mysqli_real_escape_string($conn, $_GET['plot']);
$genres = $_GET['label'];
print_r($genres);

print "<pre>";
print_r($genres);
print "</pre>";
$poster_url = mysqli_real_escape_string($conn, $_GET['poster_url']);


$query_movies = "INSERT INTO movies_db_movies (title, `year`, runtime, director, actors, plot, poster_url) VALUES ('$title', '$year', '$runtime', '$director', '$actors', '$plot', '$poster_url')";

if (mysqli_query($conn, $query_movies)) {
    $last_id = mysqli_insert_id($conn);
    echo "New record created successfully. Last inserted ID is: " . $last_id;
} else {
    echo "ERROR: Could not able to execute $query_movies. " . mysqli_error($conn);
}

foreach ($genres as $genre) {
    $last_id = mysqli_insert_id($conn);
    $query_genres = "INSERT INTO movie_to_genres_map (movie_id, genre_id) VALUES ( (SELECT id FROM movies_db_movies WHERE title LIKE '$title'), '$genre')";
    if (mysqli_query($conn, $query_genres)) {
        echo "New record created successfully.";
    } else {
        echo "ERROR: Could not able to execute $query_genres. " . mysqli_error($conn);
    }
}

?>

<script>
    window.location.href = "index.php";
</script>




