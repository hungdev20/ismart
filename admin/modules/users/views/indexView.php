<?php get_header(); ?>

<div id="main-content-wp" class="list-post-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Danh sách nhóm quản trị</h3>
        </div>
    </div>

    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="publish"><a href="?mod=users&controller=team&status=active">Đã tạo<span class="count">(<?php echo $active ?>)</span></a> |</li>
                            <li class="trash"><a href="?mod=users&controller=team&status=trash">Thùng rác <span class="count">(<?php echo $trash ?>)</span></a></li>
                        </ul>
                        <form method="GET" action="#" class="form-s fl-right">
                            <input type="hidden" name="mod" value="users">
                            <input type="hidden" name="controller" value="team">
                            <?php
                            if (!empty($status)) {
                            ?>
                                <input type="hidden" name="status" value="<?php echo $status ?>">
                            <?php
                            }
                            ?>
                            <input type="text" name="s" id="s" value="<?php echo $s ?>">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <?php
                    if (!empty($_SESSION['status'])) {
                    ?>
                        <p style="margin-bottom: 5px; color: green"><?php echo $_SESSION['status'] ?></p>
                    <?php
                    }
                    ?>
                    <div class="actions">
                        <form method="POST" action="?mod=users&controller=team&action=action" class="form-actions">
                            <select name="actions">
                                <option value="">Chọn</option>
                                <?php
                                foreach ($acts as $key => $value) {
                                ?>
                                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                <?php
                                }

                                ?>
                            </select>
                            <input type="submit" name="sm_action" onclick="return confirm('Bạn có chắc chắn muốn thực hiện thao tác này?')" value="Áp dụng">
                            <?php
                            if (!empty($list_users)) {
                            ?>
                                <div class="table-responsive">
                                    <table class="table list-table-wp">
                                        <thead>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">STT</span></td>
                                                <td><span class="thead-text">Họ và tên</span></td>
                                                <td><span class="thead-text">Tên đăng nhập</span></td>
                                                <td><span class="thead-text">Email</span></td>
                                                <td><span class="thead-text">Số điện thoại</span></td>
                                                <td><span class="thead-text">Địa chỉ</span></td>
                                                <td><span class="thead-text">Thời gian</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $order = 0;
                                            foreach ($list_users as $user) {
                                                $order++;
                                            ?>
                                                <tr>
                                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $user['user_id'] ?>"></td>
                                                    <td><span class="tbody-text"><?php echo $order ?></h3></span>
                                                    <td class="clearfix">
                                                        <div class="tb-title fl-left">
                                                            <a href="" title=""><?php echo $user['fullname'] ?></a>
                                                        </div>
                                                        <ul class="list-operation fl-right">
                                                            <li><a href="?mod=users&action=update&id=<?php echo $user['user_id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                            <?php
                                                            if ($user['user_id'] != $user_id && $status != 'trash') {
                                                            ?>
                                                                <li><a href="?mod=users&action=delete&id=<?php echo $user['user_id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </td>
                                                    <td><span class="tbody-text"><?php echo $user['username'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $user['email'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $user['phone_number'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $user['address'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $user['created_at'] ?></span></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="section" id="paging-wp">
                                        <div class="section-detail clearfix">
                                            <ul id="list-paging" class="fl-right">
                                                <li>
                                                    <a href="" title="">
                                                        << /a>
                                                </li>
                                                <li>
                                                    <a href="" title="">1</a>
                                                </li>
                                                <li>
                                                    <a href="" title="">2</a>
                                                </li>
                                                <li>
                                                    <a href="" title="">3</a>
                                                </li>
                                                <li>
                                                    <a href="" title="">></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <p style="font-size:26px; font-weight:700; margin-top:30px">Không có bản ghi</p>
                            <?php
                            }
                            ?>

                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<?php get_footer(); ?>