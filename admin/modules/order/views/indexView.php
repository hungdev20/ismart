<?php
get_header();
?>
<style>
form *{
    display: block;
    margin-bottom: 10px;
}
</style>
<div id="content">
    <h1>So luong don hang</h1>
    <form action="" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <label for="fullname">fullname</label>
        <input type="text" name="fullname" id="fullname">
    </form>
    <button id="add_member">Add Member</button>
    <p>Username: <span id="username_add"></span></p>
    <p>Fullname: <span id="fullname_add"></span></p>
    <!-- <button id="check_ajax" data_id='1000'>Check Ajax</button>
    <p>Id don hang la: <span class="id_product"></span></p> -->
</div>
<?php
get_header();
?>