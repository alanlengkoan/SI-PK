<?php foreach ($chat as $key => $row) { ?>
    <?php if ($row->id_users === $id_users) { ?>
        <div class="media w-50 ml-auto mb-3 m-2">
            <div class="media-body">
                <div class="bg-primary rounded py-2 px-3 mb-2">
                    <p class="text-small mb-0 text-white"><?= $row->pesan ?></p>
                </div>
                <p class="small text-muted"><?= $row->tgl_post ?> | <?= $row->jam_post ?> | You</p>
            </div>
        </div>
    <?php } else { ?>
        <div class="media w-50 mb-3 m-2"><img src="<?= assets_url() ?>admin/images/avatar-2.jpg" alt="user" width="50" class="rounded-circle">
            <div class="media-body ml-3">
                <div class="bg-light rounded py-2 px-3 mb-2">
                    <p class="text-small mb-0 text-muted"><?= $row->pesan ?></p>
                </div>
                <p class="small text-muted"><?= $row->tgl_post ?> | <?= $row->jam_post ?> | Admin</p>
            </div>
        </div>
    <?php } ?>
<?php } ?>