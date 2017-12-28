<?php

function is_404():bool{
    return false;
}

function is_search():bool {
    return false;
}
function is_home():bool {
    return false;
}
function is_single():bool {
    return false;
}
function is_page():bool {
    return false;
}
function is_singular():bool {
    return false;
}

function is_login():bool{
    return true;
}

function is_signup():bool {
    return false;
}


function get_404_template(){

}

function get_search_template() {
    require (TEMPLATE . 'search.php');
}

function get_home_template() {
    require(TEMPLATE . 'home.php');
}

function get_single_template() {

}

function get_page_template() {
    require(TEMPLATE . 'page.php');
}

function get_singular_template(){
    require(TEMPLATE . 'singular.php');

}

function getHeader(){
    require(TEMPLATE. 'header.php');
}

function getAdminHeader(){
    require(TEMPLATE. 'admin-header.php');
}

function getFooter(){
    require(TEMPLATE. 'footer.php');
}

function getNavbar(){
    require (TEMPLATE. 'navbar.php');
}

function getGraphbar(){
    require (TEMPLATE. 'graphbar.php');
}

function getContent(){
    require (TEMPLATE. 'content.php');
}

function getSearchContent(){
    require (TEMPLATE. 'search-content.php');
}

function get_login_template(){
    echo '<script type="text/javascript">
        window.location.href = "/login"
    </script>';
}

function get_signup_template(){
    require (TEMPLATE.'signup.php');
}



