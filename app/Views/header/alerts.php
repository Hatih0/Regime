<?php
/**
 * Alerts partial: displays flashdata and validation messages consistently
 */
$session = session();
$error = $session->getFlashdata('error');
$success = $session->getFlashdata('success');
$info = $session->getFlashdata('info');
?>
<div class="container-lg mt-3">
    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php if (is_array($error)) : ?>
                <ul class="mb-0">
                    <?php foreach ($error as $e) : ?>
                        <li><?= esc((string) $e) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <?= esc((string) $error) ?>
            <?php endif; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (!empty($success)) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php if (is_array($success)) : ?>
                <ul class="mb-0">
                    <?php foreach ($success as $s) : ?>
                        <li><?= esc((string) $s) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <?= esc((string) $success) ?>
            <?php endif; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (!empty($info)) : ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?php if (is_array($info)) : ?>
                <ul class="mb-0">
                    <?php foreach ($info as $i) : ?>
                        <li><?= esc((string) $i) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <?= esc((string) $info) ?>
            <?php endif; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($validation) && $validation->getErrors()) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                <?php foreach ($validation->getErrors() as $err) : ?>
                    <li><?= esc((string) $err) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>
