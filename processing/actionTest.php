<?php
session_start();
$userName           = htmlspecialchars($_POST['username']);
$lastName           = htmlspecialchars($_POST['lastname']);
$nameOrganization   = htmlspecialchars($_POST['nameOrganization']);
$viewOrganization   = htmlspecialchars($_POST['viewOrganization']);
$i                  = 0;
$result             = 0;
while ($i < 21){
    $result = $result + $_POST[$i];
    $i++;
}
//echo "----------------------------------------------------------------------";
$link       = mysqli_connect('localhost', 'root', 'root', 'diplom');
//$mysql      = $link->query("INSERT INTO `users` (`username`, `lastname`, `orgName`, `result`) VALUES ('$userName', '$lastName', '$nameOrganization')");
$resultPerc             = $result * 1.5873."%"."<br>";

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

if ($resultDigitalCulture < 50){
    $connect                 = $link->query("SELECT * FROM `static` WHERE `id`='1'")->fetch_assoc();
    $connectRec0             = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='1'")->fetch_assoc();
    $connectRec1             = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='2'")->fetch_assoc();
    $connectRec2             = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='3'")->fetch_assoc();
    $_SESSION['connectRec0'] = $connectRec0['recomendation'];
    $_SESSION['connectRec1'] = $connectRec1['recomendation'];
    $_SESSION['connectRec2'] = $connectRec2['recomendation'];
    $index                   = $connect['staticNumber'] + 1;
    $connect                 = $link->query("UPDATE `static` SET `staticNumber` = '$index' WHERE `id` = 1;");
}
$connect1       = $link->query("SELECT `staticNumber` FROM `static` WHERE `id`='1'")->fetch_assoc();
if ($resultPersoneller < 50) {
    $connect        = $link->query("SELECT * FROM `static` WHERE `id`='2'")->fetch_assoc();
    $connectRec4    = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='4'")->fetch_assoc();
    $connectRec5    = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='5'")->fetch_assoc();
    $connectRec6    = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='6'")->fetch_assoc();
    $_SESSION['connectRec3'] = $connectRec4['recomendation'];
    $_SESSION['connectRec4'] = $connectRec5['recomendation'];
    $_SESSION['connectRec5'] = $connectRec6['recomendation'];
    $index          = $connect['staticNumber'] + 1;
    $connect        = $link->query("UPDATE `static` SET `staticNumber` = '$index' WHERE `id` = 2;");
}
$connect2       = $link->query("SELECT `staticNumber` FROM `static` WHERE `id`='2'")->fetch_assoc();
if ($resultProcesses < 50){
    $connect        = $link->query("SELECT * FROM `static` WHERE `id`='3'")->fetch_assoc();
    $connectRec7    = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='7'")->fetch_assoc();
    $connectRec8    = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='8'")->fetch_assoc();
    $connectRec9    = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='9'")->fetch_assoc();
    $_SESSION['connectRec6'] = $connectRec7['recomendation'];
    $_SESSION['connectRec7'] = $connectRec8['recomendation'];
    $_SESSION['connectRec8'] = $connectRec9['recomendation'];
    $index          = $connect['staticNumber'] + 1;
    $connect        = $link->query("UPDATE `static` SET `staticNumber` = '$index' WHERE `id` = 3;");
}
$connect3       = $link->query("SELECT `staticNumber` FROM `static` WHERE `id`='3'")->fetch_assoc();
if ($resultDigitalProducts < 50){
    $connect        = $link->query("SELECT * FROM `static` WHERE `id`='4'")->fetch_assoc();
    $connectRec10   = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='10'")->fetch_assoc();
    $connectRec11   = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='11'")->fetch_assoc();
    $connectRec12   = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='12'")->fetch_assoc();
    $_SESSION['connectRec9'] = $connectRec10['recomendation'];
    $_SESSION['connectRec10'] = $connectRec11['recomendation'];
    $_SESSION['connectRec11'] = $connectRec12['recomendation'];
    $index          = $connect['staticNumber'] + 1;
    $connect        = $link->query("UPDATE `static` SET `staticNumber` = '$index' WHERE `id` = 4;");
}
$connect4       = $link->query("SELECT `staticNumber` FROM `static` WHERE `id`='4'")->fetch_assoc();
if ($resultModels < 50){
    $connect        = $link->query("SELECT * FROM `static` WHERE `id`='5'")->fetch_assoc();
    $connectRec13   = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='13'")->fetch_assoc();
    $connectRec14   = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='14'")->fetch_assoc();
    $connectRec15   = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='15'")->fetch_assoc();
    $_SESSION['connectRec12'] = $connectRec13['recomendation'];
    $_SESSION['connectRec13'] = $connectRec14['recomendation'];
    $_SESSION['connectRec14'] = $connectRec15['recomendation'];
    $index          = $connect['staticNumber'] + 1;
    $connect        = $link->query("UPDATE `static` SET `staticNumber` = '$index' WHERE `id` = 5;");
}
$connect5       = $link->query("SELECT `staticNumber` FROM `static` WHERE `id`='5'")->fetch_assoc();
if ($resultDates < 50) {
    $connect        = $link->query("SELECT * FROM `static` WHERE `id`='6'")->fetch_assoc();
    $connectRec16   = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='16'")->fetch_assoc();
    $connectRec17   = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='17'")->fetch_assoc();
    $connectRec18   = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='18'")->fetch_assoc();
    $_SESSION['connectRec15'] = $connectRec16['recomendation'];
    $_SESSION['connectRec16'] = $connectRec17['recomendation'];
    $_SESSION['connectRec17'] = $connectRec18['recomendation'];
    $index          = $connect['staticNumber'] + 1;
    $connect        = $link->query("UPDATE `static` SET `staticNumber` = '$index' WHERE `id` = 6;");
}
$connect6       = $link->query("SELECT `staticNumber` FROM `static` WHERE `id`='6'")->fetch_assoc();
if ($resultInfTools < 50) {
    $connect        = $link->query("SELECT * FROM `static` WHERE `id`='7'")->fetch_assoc();
    $connectRec19   = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='19'")->fetch_assoc();
    $connectRec20   = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='20'")->fetch_assoc();
    $connectRec21   = $link->query("SELECT `recomendation` FROM `recomendation` WHERE `id`='21'")->fetch_assoc();
    $_SESSION['connectRec18'] = $connectRec19['recomendation'];
    $_SESSION['connectRec19'] = $connectRec20['recomendation'];
    $_SESSION['connectRec20'] = $connectRec21['recomendation'];
    $index          = $connect['staticNumber'] + 1;
    $connect        = $link->query("UPDATE `static` SET `staticNumber` = '$index' WHERE `id` = 7;");
}
$connect7       = $link->query("SELECT `staticNumber` FROM `static` WHERE `id`='7'")->fetch_assoc();
//echo $resultPerc;
$connectUser = $link->query("INSERT INTO `users` (`username`, `lastname`, `orgName`, `result`) VALUES ('$userName', '$lastName', '$nameOrganization', '$resultPerc')");


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

require("../header.php");
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

