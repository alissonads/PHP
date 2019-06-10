<?php
    function isImage(array $v) : bool {
        if ($v['type'] == 'image/gif' || $v['type'] == 'image/jpeg' ||
            $v['type'] == 'image/pjpeg' || $v['type'] == 'image/png') {
                return true;
        }
        return false;
    }


?>