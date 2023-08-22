<?php foreach ($chat as $key => $row) { ?>
    <?php if ($row->id_users === $id_users) { ?>
        <div class="media">
            <div class="media-body text-right">
                <p class="msg-reply bg-primary"><?= $row->pesan ?></p>
                <p>
                    <i class="icofont icofont-wall-clock f-12"></i>&nbsp;<?= $row->tgl_post ?> | <?= $row->jam_post ?> | You
                </p>
            </div>
            <div class="media-right friend-box">
                <a href="#">
                    <img class="media-object img-radius" src="<?= assets_url() ?>admin/images/avatar-2.jpg" alt="">
                </a>
            </div>
        </div>
    <?php } else { ?>
        <div class="media">
            <div class="media-left friend-box">
                <a href="#">
                    <img class="media-object img-radius" src="<?= assets_url() ?>admin/images/avatar-1.jpg" alt="">
                </a>
            </div>
            <div class="media-body">
                <p class="msg-send"><?= $row->pesan ?></p>
                <p>
                    <i class="icofont icofont-wall-clock f-12"></i>&nbsp;<?= $row->tgl_post ?> | <?= $row->jam_post ?> | Users
                </p>
            </div>
        </div>
    <?php } ?>
<?php } ?>