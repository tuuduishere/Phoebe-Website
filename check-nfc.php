<?php
$file = 'temp_uid.txt';
if (file_exists($file)) {
    $uid = trim(file_get_contents($file));
    if (!empty($uid)) {
        echo $uid;
        // Xóa sạch nội dung file ngay lập tức
        file_put_contents($file, ""); 
        exit();
    }
}
echo "EMPTY";
?>