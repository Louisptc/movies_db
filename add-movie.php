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

