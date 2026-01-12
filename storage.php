<?php
/**
 * Простое файловое хранилище на JSON для замены MySQL.
 * Папка data/ должна быть доступна на запись PHP.
 */

define('DATA_DIR', __DIR__ . '/data');

function ensure_data_dir() {
    if (!is_dir(DATA_DIR)) {
        mkdir(DATA_DIR, 0775, true);
    }
}

function read_json_file($filename, $default) {
    ensure_data_dir();
    $path = DATA_DIR . '/' . $filename;
    if (!file_exists($path)) {
        write_json_file($filename, $default);
        return $default;
    }
    $raw = file_get_contents($path);
    $data = json_decode($raw, true);
    return (json_last_error() === JSON_ERROR_NONE) ? $data : $default;
}

/**
 * Атомарная запись + блокировка (для локальной разработки достаточно).
 */
function write_json_file($filename, $data) {
    ensure_data_dir();
    $path = DATA_DIR . '/' . $filename;

    $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    $fp = fopen($path, 'c+');
    if ($fp === false) {
        throw new Exception("Не удалось открыть файл: " . $path);
    }

    if (!flock($fp, LOCK_EX)) {
        fclose($fp);
        throw new Exception("Не удалось заблокировать файл: " . $path);
    }

    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, $json);
    fflush($fp);

    flock($fp, LOCK_UN);
    fclose($fp);
}

/* --- Recommendations --- */
function get_recommendation($id) {
    $recs = read_json_file('recommendations.json', []);
    $key = strval($id);
    return isset($recs[$key]) ? $recs[$key] : '';
}

/* --- Statics (счётчики) --- */
function get_static_number($id) {
    $stats = read_json_file('statics.json', []);
    $key = strval($id);
    return isset($stats[$key]) ? intval($stats[$key]) : 0;
}

function increment_static($id) {
    $stats = read_json_file('statics.json', []);
    $key = strval($id);
    $stats[$key] = (isset($stats[$key]) ? intval($stats[$key]) : 0) + 1;
    write_json_file('statics.json', $stats);
}

/* --- Users log --- */
function add_user_result($username, $lastname, $orgName, $resultNumber) {
    $users = read_json_file('users.json', []);
    $users[] = [
        'username'  => $username,
        'lastname'  => $lastname,
        'orgName'   => $orgName,
        'result'    => floatval($resultNumber),
        'createdAt' => date('c')
    ];
    write_json_file('users.json', $users);
}
?>