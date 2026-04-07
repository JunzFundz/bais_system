   <?php

    function getCache($key, $seconds = 86400)
    {
        $dir = __DIR__ . "/cache/";
        $file = $dir . md5($key) . ".json";

        // Ensure file exists
        if (file_exists($file)) {
            $data = json_decode(file_get_contents($file), true);

            // Validate structure
            if (
                is_array($data) &&
                isset($data['time'], $data['value']) &&
                (time() - $data['time'] < $seconds)
            ) {
                return $data['value'];
            }
        }

        return false;
    }

    function setCache($key, $value)
    {
        $dir = __DIR__ . "/cache/";

        // Auto-create folder if missing
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        // Validate folder writable
        if (!is_writable($dir)) {
            die("Cache folder is not writable. Fix permissions on $dir");
        }

        // Only cache arrays
        if (!is_array($value)) {
            return;
        }

        $file = $dir . md5($key) . ".json";

        file_put_contents($file, json_encode([
            'time'  => time(),
            'value' => $value
        ]), LOCK_EX);
    }
