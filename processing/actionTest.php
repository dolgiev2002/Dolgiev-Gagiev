<?php
session_start();
require_once(__DIR__ . '/../storage.php');

$userName           = htmlspecialchars($_POST['username']);
$lastName           = htmlspecialchars($_POST['lastname']);
$nameOrganization   = htmlspecialchars($_POST['nameOrganization']);
$viewOrganization   = htmlspecialchars($_POST['viewOrganization']);

$i      = 0;
$result = 0;
while ($i < 21){
    $result = $result + $_POST[$i];
    $i++;
}

// Итог
$resultNumber = $result * 1.5873;          // число
$resultPerc   = $resultNumber . "%" . "<br>"; // формат как в оригинале

// Результаты по блокам
$resultDigitalCulture   = (($_POST[0]+$_POST[1]+$_POST[2])*11.11);
$resultDigitalCultureW  = ($_POST[0]+$_POST[1]+$_POST[2]);

$resultPersoneller      = (($_POST[3]+$_POST[4]+$_POST[5])*11.11);
$resultPersonellerW     = ($_POST[3]+$_POST[4]+$_POST[5]);

$resultProcesses        = (($_POST[6]+$_POST[7]+$_POST[8])*11.11);
$resultProcessesW       = ($_POST[6]+$_POST[7]+$_POST[8]);

$resultDigitalProducts  = (($_POST[9]+$_POST[10]+$_POST[11])*11.11);
$resultDigitalProductsW = ($_POST[9]+$_POST[10]+$_POST[11]);

$resultModels           = (($_POST[12]+$_POST[13]+$_POST[14])*11.11);
$resultModelsW          = ($_POST[12]+$_POST[13]+$_POST[14]);

$resultDates            = (($_POST[15]+$_POST[16]+$_POST[17])*11.11);
$resultDatesW           = ($_POST[15]+$_POST[16]+$_POST[17]);

$resultInfTools         = (($_POST[18]+$_POST[19]+$_POST[20])*11.11);
$resultInfToolsW        = ($_POST[18]+$_POST[19]+$_POST[20]);

// Флаг: есть ли хотя бы один блок < 50 (для кнопки "Скачать рекомендации")
$connect = 0;

// Если блок < 50 — кладём 3 рекомендации в session и увеличиваем счётчик statics.json (id 1..7)
if ($resultDigitalCulture < 50){
    $_SESSION['connectRec0'] = get_recommendation(1);
    $_SESSION['connectRec1'] = get_recommendation(2);
    $_SESSION['connectRec2'] = get_recommendation(3);
    increment_static(1);
    $connect = 1;
}
$connect1 = ['staticNumber' => get_static_number(1)];

if ($resultPersoneller < 50) {
    $_SESSION['connectRec3'] = get_recommendation(4);
    $_SESSION['connectRec4'] = get_recommendation(5);
    $_SESSION['connectRec5'] = get_recommendation(6);
    increment_static(2);
    $connect = 1;
}
$connect2 = ['staticNumber' => get_static_number(2)];

if ($resultProcesses < 50){
    $_SESSION['connectRec6'] = get_recommendation(7);
    $_SESSION['connectRec7'] = get_recommendation(8);
    $_SESSION['connectRec8'] = get_recommendation(9);
    increment_static(3);
    $connect = 1;
}
$connect3 = ['staticNumber' => get_static_number(3)];

if ($resultDigitalProducts < 50){
    $_SESSION['connectRec9']  = get_recommendation(10);
    $_SESSION['connectRec10'] = get_recommendation(11);
    $_SESSION['connectRec11'] = get_recommendation(12);
    increment_static(4);
    $connect = 1;
}
$connect4 = ['staticNumber' => get_static_number(4)];

if ($resultModels < 50){
    $_SESSION['connectRec12'] = get_recommendation(13);
    $_SESSION['connectRec13'] = get_recommendation(14);
    $_SESSION['connectRec14'] = get_recommendation(15);
    increment_static(5);
    $connect = 1;
}
$connect5 = ['staticNumber' => get_static_number(5)];

if ($resultDates < 50){
    $_SESSION['connectRec15'] = get_recommendation(16);
    $_SESSION['connectRec16'] = get_recommendation(17);
    $_SESSION['connectRec17'] = get_recommendation(18);
    increment_static(6);
    $connect = 1;
}
$connect6 = ['staticNumber' => get_static_number(6)];

if ($resultInfTools < 50){
    $_SESSION['connectRec18'] = get_recommendation(19);
    $_SESSION['connectRec19'] = get_recommendation(20);
    $_SESSION['connectRec20'] = get_recommendation(21);
    increment_static(7);
    $connect = 1;
}
$connect7 = ['staticNumber' => get_static_number(7)];

// Логируем прохождение теста (users.json)
add_user_result($userName, $lastName, $nameOrganization, $resultNumber);

// Массив данных и цветов
$data = [
    "Цифровая Культура" => $resultDigitalCultureW,
    "Кадры" => $resultPersonellerW,
    "Процессы" => $resultProcessesW,
    "Цифровые продукты" => $resultDigitalProductsW,
    "Модели" => $resultModelsW,
    "Данные" => $resultDatesW,
    "Инфраструктура и инструменты" => $resultInfToolsW,
];


// Создаем изображение с альфа-каналом
$image = imagecreatetruecolor(400, 400);
imagesavealpha($image, true); // Включаем сохранение альфа-канала

// Задаем прозрачный цвет фона
$transparent = imagecolorallocatealpha($image, 0, 0, 0, 127);
imagefill($image, 0, 0, $transparent);

// Задаем цвета для сегментов
$colors = [
    "Цифровая Культура" => imagecolorallocate($image, 244, 67, 54), // Красный
    "Кадры" => imagecolorallocate($image, 233, 30, 99),             // Розовый
    "Процессы" => imagecolorallocate($image, 156, 39, 176),         // Фиолетовый
    "Цифровые продукты" => imagecolorallocate($image, 255,244,32),  // Жёлтый
    "Модели" => imagecolorallocate($image, 63, 81, 181),            // Синий
    "Данные" => imagecolorallocate($image, 33, 150, 243),           // Голубой
    "Инфраструктура и инструменты" => imagecolorallocate($image, 80,200,120), // Зеленый
];

// Вычисляем общее значение для всех сегментов
$total = array_sum($data);

// Угол начала для первого сегмента
$startAngle = 0;

// Рисуем каждый сегмент
foreach ($data as $label => $value) {
    // Вычисляем угол для текущего сегмента и округляем его до целого числа
    $angle = round(($value / $total) * 360);

    // Рисуем сегмент
    imagefilledarc($image, 200, 200, 300, 300, $startAngle, $startAngle + $angle, $colors[$label], IMG_ARC_PIE);

    // Обновляем начальный угол для следующего сегмента
    $startAngle += $angle;
}

// Сохраняем изображение как PNG с прозрачностью
imagepng($image, 'pie_chart.png');

// Освобождаем ресурсы
imagedestroy($image);

require("./header.php");
?>
<style>
    .custom-list .custom-item::after {
        content: '';
        display: inline-block;
        width: 20px; /* Ширина прямоугольника */
        height: 10px; /* Высота прямоугольника */
        background-color: black; /* Цвет прямоугольника */
        margin-left: 5px; /* Отступ между текстом и прямоугольником */
    }

    @media (max-width: 768px) {
        .col-sm-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .col-md-3 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .custom-list, .card {
            margin-bottom: 1rem;
        }

        .card-header h4, .card-header p {
            font-size: 1rem;
        }

        .card-body h1 {
            font-size: 1.5rem;
        }
    }
</style>

<div class='row row-cols-1 row-cols-md-3 mb-3 text-center container'>

    <div class='col-md-12'>
        <div class='card mb-4 rounded-3 shadow-sm'>
            <div class='card-header py-3'>
                <h4 class='my-0 fw-normal'>Общая оценка</h4>
            </div>
            <div class='card-body'>
                <h1 class='card-title pricing-card-title'><?php echo $result."/63";?><small class='text-body-secondary fw-light'></small></h1>
                <ul class='list-unstyled mt-3 mb-4'>
                    <li><p><?php echo $resultPerc."/100%";?></p></li>
                </ul>
            </div>
        </div>
    </div>

    <div class='col-md-3'>
        <div class='card mb-4 rounded-3 shadow-sm'>
            <div class='card-header py-3'>
                <h4 class='my-0 fw-normal'>Цифровая культура</h4>
            </div>
            <div class='card-body'>
                <h1 class='card-title pricing-card-title'><?php echo $resultDigitalCultureW;?>/9<small class='text-body-secondary fw-light'></small></h1>
            </div>
        </div>
    </div>

    <div class='col-md-3'>
        <div class='card mb-4 rounded-3 shadow-sm'>
            <div class='card-header py-3'>
                <h4 class='my-0 fw-normal'>Кадры</h4>
            </div>
            <div class='card-body'>
                <h1 class='card-title pricing-card-title'><?php echo $resultPersonellerW;?>/9<small class='text-body-secondary fw-light'></small></h1>
            </div>
        </div>
    </div>

    <div class='col-md-3'>
        <div class='card mb-4 rounded-3 shadow-sm'>
            <div class='card-header py-3'>
                <h4 class='my-0 fw-normal'>Процессы</h4>
            </div>
            <div class='card-body'>
                <h1 class='card-title pricing-card-title'><?php echo $resultProcessesW;?>/9<small class='text-body-secondary fw-light'></small></h1>
            </div>
        </div>
    </div>

    <div class='col-md-3'>
        <div class='card mb-4 rounded-3 shadow-sm'>
            <div class='card-header py-3'>
                <h4 class='my-0 fw-normal'>Цифровые продукты</h4>
            </div>
            <div class='card-body'>
                <h1 class='card-title pricing-card-title'><?php echo $resultDigitalProductsW;?>/9<small class='text-body-secondary fw-light'></small></h1>
            </div>
        </div>
    </div>

    <div class='col-md-3'>
        <div class='card mb-4 rounded-3 shadow-sm'>
            <div class='card-header py-3'>
                <h4 class='my-0 fw-normal'>Модели</h4>
            </div>
            <div class='card-body'>
                <h1 class='card-title pricing-card-title'><?php echo $resultModelsW;?>/9<small class='text-body-secondary fw-light'></small></h1>
            </div>
        </div>
    </div>

    <div class='col-md-3'>
        <div class='card mb-4 rounded-3 shadow-sm'>
            <div class='card-header py-3'>
                <h4 class='my-0 fw-normal'>Данные</h4>
            </div>
            <div class='card-body'>
                <h1 class='card-title pricing-card-title'><?php echo $resultDatesW;?>/9<small class='text-body-secondary fw-light'></small></h1>
            </div>
        </div>
    </div>

    <div class='col-md-3'>
        <div class='card mb-4 rounded-3 shadow-sm'>
            <div class='card-header py-3'>
                <p class='my-0 fw-normal' style="font-size: 18px;">Инфраструктура и инструменты</p>
            </div>
            <div class='card-body'>
                <h1 class='card-title pricing-card-title'><?php echo $resultInfToolsW;?>/9<small class='text-body-secondary fw-light'></small></h1>
            </div>
        </div>
    </div>

    <div class='col-md-6'>
        <div class='card mb-4 rounded-3 shadow-sm'>
            <div class='card-header py-3'>
                <h4 class='my-0 fw-normal'>Статистика низких показателей по каждому из разделов</h4>
            </div>
            <div class='card-body'>
                <ul class='list-unstyled mt-3 mb-4 text-start'>
                    <li><p>Цифровая культура:<?php echo $connect1['staticNumber'];?></p></li>
                    <li><p>Кадры:<?php echo $connect2['staticNumber'];?></p></li>
                    <li><p>Процессы:<?php echo $connect3['staticNumber'];?></p></li>
                    <li><p>Цифровые продукты:<?php echo $connect4['staticNumber'];?></p></li>
                    <li><p>Модели:<?php echo $connect5['staticNumber'];?></p></li>
                    <li><p>Данные:<?php echo $connect6['staticNumber'];?></p></li>
                    <li><p>Инфраструктура и инструменты:<?php echo $connect7['staticNumber'];?></p></li>
                </ul>
            </div>
        </div>
    </div>

    <div class='col-md-6'>
        <div class='card mb-4 rounded-3 shadow-sm'>
            <div class='card-header py-3'>
                <h4 class='my-0 fw-normal'>Диаграмма</h4>
            </div>
            <div class='card-body row'>
                <div class='col-sm-6'>
                    <ul class='list-unstyled mt-3 mb-4 custom-list text-start'>
                        <li><p><span class='color-square' style='display:inline-block; width: 10px; height: 10px; background-color: rgb(244, 67, 54); margin-right: 5px;'></span> Цифровая культура</p></li>
                        <li><p><span class='color-square' style='display:inline-block; width: 10px; height: 10px; background-color: rgb(233, 30, 99); margin-right: 5px;'></span> Кадры</p></li>
                        <li><p><span class='color-square' style='display:inline-block; width: 10px; height: 10px; background-color: rgb(156, 39, 176); margin-right: 5px;'></span> Процессы</p></li>
                        <li><p><span class='color-square' style='display:inline-block; width: 10px; height: 10px; background-color: rgb(255,244,32); margin-right: 5px;'></span> Цифровые продукты</p></li>
                        <li><p><span class='color-square' style='display:inline-block; width: 10px; height: 10px; background-color: rgb(63, 81, 181); margin-right: 5px;'></span> Модели</p></li>
                        <li><p><span class='color-square' style='display:inline-block; width: 10px; height: 10px; background-color: rgb(33, 150, 243); margin-right: 5px;'></span> Данные</p></li>
                        <li><p><span class='color-square' style='display:inline-block; width: 10px; height: 10px; background-color: rgb(80,200,120); margin-right: 5px;'></span> Инфраструктура и инструменты</p></li>
                    </ul>
                </div>
                <div class='col-sm-6'>
                    <img src='pie_chart.png' alt='Pie Chart' style='width: 100%;'>
                </div>
            </div>
        </div>
    </div>
    <div class='card-body'>
        <h1 class='card-title pricing-card-title text-center'><?php
            if (isset($connect) && $connect != 0) {
                echo '<a href="docx.php" class="btn btn-outline-danger">Скачать рекомендации</a>';
            }
            ?><small class='text-body-secondary fw-light'></small></h1>
    </div>
</div>

<script src='/docs/5.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz' crossorigin='anonymous'></script>
</body>
</html>
</main>

