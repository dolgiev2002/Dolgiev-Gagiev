<?php
require '../vendor/autoload.php'; // Подключаем автозагрузчик Composer
session_start();
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;


// Создаем новый объект PhpWord
$phpWord = new PhpWord();

// Добавляем новый раздел (страницу)
$section = $phpWord->addSection();


$section->addText(
    'РЕКОМЕНДАЦИИ ПО УЛУЧШЕНИЮ ЦИФРОВОЙ ЗРЕЛОСТИ',
    array('name' => 'Times New Roman', 'size' => 20, 'bold' => true, 'align' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER)
);
// Добавляем текст в раздел
if (isset($_SESSION['connectRec0']) && $_SESSION['connectRec0'] != 0) {
    $section->addText(
        'ЦИФРОВАЯ КУЛЬТУРА',
        array('name' => 'Times New Roman', 'size' => 16)
    );
    $section->addText(
        htmlspecialchars('1.'.$_SESSION['connectRec0']),
        array('name' => 'Times New Roman', 'size' => 14)
    );
    $section->addText(
        htmlspecialchars('2.'.$_SESSION['connectRec1']),
        array('name' => 'Times New Roman', 'size' => 14, )
    );
    $section->addText(
        htmlspecialchars('3.'.$_SESSION['connectRec2']),
        array('name' => 'Times New Roman', 'size' => 14)
    );
}
if (isset($_SESSION['connectRec3']) && $_SESSION['connectRec3'] != 0) {
    $section->addText(
        'КАДРЫ',
        array('name' => 'Times New Roman', 'size' => 16)
    );
    $section->addText(
        htmlspecialchars('1.'.$_SESSION['connectRec3']),
        array('name' => 'Times New Roman', 'size' => 14)
    );
    $section->addText(
        htmlspecialchars('2.'.$_SESSION['connectRec4']),
        array('name' => 'Times New Roman', 'size' => 14)
    );
    $section->addText(
        htmlspecialchars('3.'.$_SESSION['connectRec5']),
        array('name' => 'Times New Roman', 'size' => 14)
    );
}
if (isset($_SESSION['connectRec6']) && $_SESSION['connectRec6'] != 0) {
    $section->addText(
        'ПРОЦЕССЫ',
        array('name' => 'Times New Roman', 'size' => 16)
    );
    $section->addText(
        htmlspecialchars('1.'.$_SESSION['connectRec6']),
        array('name' => 'Times New Roman', 'size' => 14)
    );
    $section->addText(
        htmlspecialchars('2.'.$_SESSION['connectRec7']),
        array('name' => 'Times New Roman', 'size' => 14)
    );
    $section->addText(
        htmlspecialchars('3.'.$_SESSION['connectRec8']),
        array('name' => 'Times New Roman', 'size' => 14)
    );
}
if (isset($_SESSION['connectRec9']) && $_SESSION['connectRec9'] != 0) {
    $section->addText(
        'ЦИФРОВЫЕ ПРОДУКТЫ',
        array('name' => 'Times New Roman', 'size' => 16)
    );
    $section->addText(
        '1.'.$_SESSION['connectRec9'],
        array('name' => 'Times New Roman', 'size' => 14)
    );
    $section->addText(
        '2.'.$_SESSION['connectRec10'],
        array('name' => 'Times New Roman', 'size' => 14)
    );
    $section->addText(
        '3.'.$_SESSION['connectRec11'],
        array('name' => 'Times New Roman', 'size' => 14)
    );
}
if (isset($_SESSION['connectRec12']) && $_SESSION['connectRec12'] != 0) {
    $section->addText(
        'МОДЕЛИ',
        array('name' => 'Times New Roman', 'size' => 16)
    );
    $section->addText(
        '1.'.$_SESSION['connectRec12'],
        array('name' => 'Times New Roman', 'size' => 14)
    );
    $section->addText(
        '2.'.$_SESSION['connectRec13'],
        array('name' => 'Times New Roman', 'size' => 14)
    );
    $section->addText(
        '3.'.$_SESSION['connectRec14'],
        array('name' => 'Times New Roman', 'size' => 14)
    );
}
if (isset($_SESSION['connectRec15']) && $_SESSION['connectRec15'] != 0) {
    $section->addText(
        'ДАННЫЕ',
        array('name' => 'Times New Roman', 'size' => 16)
    );
    $section->addText(
        '1.'.$_SESSION['connectRec15'],
        array('name' => 'Times New Roman', 'size' => 14)
    );
    $section->addText(
        '2.'.$_SESSION['connectRec16'],
        array('name' => 'Times New Roman', 'size' => 14)
    );
    $section->addText(
        '3.'.$_SESSION['connectRec17'],
        array('name' => 'Times New Roman', 'size' => 14)
    );
}
if (isset($_SESSION['connectRec18']) && $_SESSION['connectRec18'] != 0) {
    $section->addText(
        'ИНФРАСТРУКТУРА И ИНСТРУМЕНТЫ',
        array('name' => 'Times New Roman', 'size' => 16)
    );
    $section->addText(
        '1.'.htmlspecialchars($_SESSION['connectRec18']),
        array('name' => 'Times New Roman', 'size' => 14)
    );
    $section->addText(
        '2.'.htmlspecialchars($_SESSION['connectRec19']),
        array('name' => 'Times New Roman', 'size' => 14)
    );
    $section->addText(
        '3.'.htmlspecialchars($_SESSION['connectRec20']),
        array('name' => 'Times New Roman', 'size' => 14, 'bold' => true, )
    );
}




// Сохраняем документ во временный файл
$temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
$writer = IOFactory::createWriter($phpWord, 'Word2007');
$writer->save($temp_file);

// Заголовки для скачивания файла
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="рекомендации.docx"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($temp_file));

// Чтение файла и отправка в выходной поток
readfile($temp_file);

// Удаление временного файла
unlink($temp_file);


exit;

?>
