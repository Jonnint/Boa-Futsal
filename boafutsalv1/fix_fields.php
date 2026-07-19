<?php
$fields = App\Models\Field::all();
$seen = [];
foreach($fields as $f) {
    if(in_array($f->name, $seen)) {
        $f->delete();
    } else {
        $seen[] = $f->name;
    }
}
echo "Cleaned duplicates.\n";
