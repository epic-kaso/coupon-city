<?php
if (!isset($query)) {
    $query = new stdClass();
    $query->query = '';
    $query->location = '';
}
?>
<div class="search-area">
    <div class="container">
        <div class="row-fluid">
            <form action="<?= base_url('search'); ?>">
                <div class="span8">
                    <label><i class="icon-search"></i>I am searching for</label>
                    <div class="search-area-division search-area-division-input">
                        <input name="q" class="span12" type="text" placeholder="Fashion" value="<?= (!empty($query->query)) ? $query->query : null ?>" />
                    </div>
                </div>
                <div class="span3">
                    <label><i class="icon-map-marker"></i>In</label>
                    <div class="search-area-division search-area-division-location">
                        <input name="l" class="span12" type="text" placeholder="Lekki" value="<?= (!empty($query->location)) ? $query->location : null ?>"/>
                    </div>
                </div>
                <div class="span1">
                    <button class="btn btn-block btn-white search-btn" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
