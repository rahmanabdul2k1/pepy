<?php
$attr = db_connect()->query("SELECT attr_property.attr_id,attr_property.attr_property_id,attr_property.attr_property_value,attributes.attr_name FROM `attr_property` JOIN attributes ON attributes.attr_id = attr_property.attr_id WHERE attr_property.attr_id = '$attr_id'")->getResultArray();
?>
<div class="row mb-3">
    <div class="col-lg-3">
        <input type="text" id="testing" class="form-control" value="<?= $attr[0]['attr_name']; ?>" disabled>
    </div>
    <div class="col-lg-6">
        <select data-placeholder="Nothing Selected" id="<?= $attr[0]['attr_name']; ?>" multiple class="chosen_select <?= $attr[0]['attr_name']; ?>">
            <?php
            foreach ($attr as $key => $value) {
            ?>
                <option property_id="<?= $attr_id ?>" value="<?= $value['attr_property_id'] ?>"><?= ucfirst($value['attr_property_value']) ?></option>
            <?php } ?>
        </select>
    </div>
</div>