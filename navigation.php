<div class="uk-flex uk-flex-center">
    <h1>Movie Database</h1>
</div>
<nav class="uk-navbar-container uk-margin" uk-navbar>
    <div class="uk-navbar-center uk-flex uk-flex-wrap">
        <div class="uk-navbar-item">
            <a href="index.php" uk-icon="icon: home"></a>
        </div>
        <div class="uk-navbar-item">
            <form action="details_movie.php"
                  method="GET">
                <select class="uk-select" name="genre" id="selected-genre">
                    <?php
                    $genres_list = "SELECT label,id FROM `movies_db_genres` ORDER BY label ASC;";
                    $result = mysqli_query($conn, $genres_list);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id'] . "' >" . $row['label'] . "</option>";
                    }
                    ?>
                    <script>
                        let urlParams = new URLSearchParams(window.location.search);
                        let queryString = urlParams.get('genre');
                        console.log(queryString)
                        document.getElementById('selected-genre').value = queryString;
                    </script>
                </select>
                <button class="uk-button-small uk-button-primary">CHOOSE</button>
            </form>
        </div>
        <?php
        require 'autocomplete.php';
        ?>
        <div class="uk-navbar-item">
            <a class="uk-button uk-button-default" href="#modal-center" uk-toggle>ADD A MOVIE</a>
        </div>
    </div>
</nav>
