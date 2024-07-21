<?php

use CodeIgniter\Database\Config;

$db = Config::connect();
?>

<div class="form-group">
    <label for="phone"><?= get_phrase("Subject"); ?></label>
    <select name="subject_id" class="form-control" required>
        <?php

        $subjects = $db->table('subject')->getWhere(['class_id' => $class_id])->getResultArray();

        ?>
        <?php foreach ($subjects as $subject) : ?>
            <option value="<?= $subject['subject_id']; ?>"><?= $subject['name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label for="phone"><?= get_phrase("Section"); ?></label>
    <select name="section_id" class="form-control" required>
        <?php

        $sections = $db->table('section')->getWhere(['class_id' => $class_id])->getResultArray();

        ?>
        <?php foreach ($sections as $section) : ?>
            <option value="<?= $section['section_id']; ?>"><?= $section['name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>