<script>
    $(function () {
        let availableTags = [
            <?php
            $movies_list = "SELECT * FROM `movies_db_movies` ORDER BY title ASC;";
            $result = mysqli_query($conn, $movies_list);
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if (count($result) > 0) {
                foreach ($result as $row) {
                    echo '"' . $row['title'] . '",';
                }
            }
            ?>
        ];
        $("#tags").autocomplete({
            source: availableTags,
            minLength: 2
        });
    });
</script>

<div class="uk-navbar-item">
    <form action="search.php" method="GET">
        <input class="uk-input uk-form-width-large" type="text"
               placeholder="Search a film, an actor, a year or a director" aria-label="Input"
               name="query" id="tags" autocomplete="off">
        <button class="uk-button uk-button-primary">SEARCH</button>
    </form>
</div>
