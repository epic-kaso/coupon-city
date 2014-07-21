<?= partial('partials/_header_nav', array('active' => 'error')); ?>
<!-- LOGIN REGISTER LINKS CONTENT -->
<?= partial('partials/account/_login', array()); ?>
<?= partial('partials/account/_create_user', array()); ?>
<?= partial('partials/account/_forgot_password', array()); ?>
<!-- SEARCH AREA -->
<?= partial('partials/_search', array('query' => @$search_query)); ?>
<!-- END SEARCH AREA -->
<!-- END PAGE TITLE -->

<div class="gap"></div>

<!-- //////////////////////////////////
//////////////END MAIN HEADER//////////
////////////////////////////////////-->


<!-- //////////////////////////////////
//////////////PAGE CONTENT/////////////
////////////////////////////////////-->

<div class="container">
    <h1 class="title-hero">

        404

    </h1>
    <h1>Sorry, the page you requested was not found.</h1>
    <div class="gap gap-small"></div><a href="<?= base_url(); ?>" class="btn btn-primary btn-mega">Back To Home</a>
    <div class="gap"></div>
</div>

<!-- //////////////////////////////////
//////////////END PAGE CONTENT/////////
////////////////////////////////////-->

<!-- //////////////////////////////////
//////////////MAIN FOOTER//////////////
////////////////////////////////////-->
<?= partial('partials/_footer_nav', array()); ?>
<!-- //////////////////////////////////
//////////////END MAIN  FOOTER/////////
////////////////////////////////////-->