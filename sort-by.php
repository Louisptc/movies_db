<?php
$genre_id = $_GET['genre'];
$sort_by = $_GET['sort_by'];

if ($sort_by == "title") {
    $sort_by = "title";
} else if ($sort_by == "year") {
    $sort_by = "year";
} else if ($sort_by == "director") {
    $sort_by = "director";
} else {
    $sort_by = "title";
}

$movies_list = "SELECT * FROM `movies_db_movies` as movies INNER JOIN `movie_to_genres_map` as genres_map  ON movies.id = genres_map.movie_id WHERE genre_id = $genre_id ORDER BY `$sort_by` ASC ;";
$result = mysqli_query($conn, $movies_list);
?>
<div class="uk-margin">
    <select class="uk-select" name="sort_by" id="selected-filter">
        <option value="title">Title</option>
        <option value="year">Year</option>
        <option value="director">Director</option>
        <script>
            let urlParams_sort = new URLSearchParams(window.location.search);
            let queryString_sort = urlParams_sort.get('sort_by');
            console.log(queryString_sort)
            document.getElementById('selected-filter').value = queryString_sort;
        </script>
    </select>
    <a href="details_movie.php?genre=<?php echo $genre_id; ?>">
        <button class="uk-button uk-button-primary">SORT</button>
    </a>
</div>
