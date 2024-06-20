<?php
$host = 'localhost'; // имя хоста
$db_name = 'Trevel_Vista'; // имя базы данных
$user = 'root'; // имя пользователя
$db_password = ''; // пароль

// создание подключения к базе   
$link = mysqli_connect($host, $user, $db_password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");


//данные с формы
$from=$_POST['from'];
$to=$_POST['to'];
$departure_date=$_POST['departure-date'];
$hotel=$_POST['hotel'];
$days=$_POST['days'];
$nights=$_POST['nights'];
$adultsLogin=$_POST['adultsLogin'];
$isHaveLinks=$_POST['isHaveLinks'];
$childrenLogin=$_POST['childrenLogin'];


//переменые для сравнение и вычисление
$childrenLinks="";//id взрослых аккаунтов которые будут занесены в childrenLinks
$adultLinks="";//id аккаунтов детей которые будут занесены в links

//ищем дистанцию маршрута от начальной точки до конечной
$query="SELECT * FROM Routes WHERE startPos = '$from' AND stopPos = '$to'";
$res = mysqli_query($link, $query);
$rout = mysqli_fetch_assoc($res);
if (empty($rout)) {//если не нашли маршрут, то меняем начальную позицию и конечную
    $query="SELECT * FROM Routes WHERE startPos = '$to' AND stopPos = '$from'";
    $res = mysqli_query($link, $query);
    $rout = mysqli_fetch_assoc($res);
    $distance=$rout['distance'];
}
else {
    $distance=$rout['distance'];//в $distance записано целочисленное значение в километрах
}

//за каждые 20километра с перемены $distance добавляет 1 минуту в $departure_date, и записывает это значение в $landingTime
$speed = 20; // Скорость (20 км/минуту)
$arrival_time_minutes = intval($distance / $speed);
$arrival_time = date("Y.m.d H:i", strtotime($departure_date) + $arrival_time_minutes * 60);
// Запись значения в переменную
$landingTime = $arrival_time;

$isHaveLink=0;//является ли взрослый родителем

//ищем у отеля $hotel цену за ночь
$query = "SELECT * FROM Hotels WHERE name = '$hotel'";
$res = mysqli_query($link, $query);
$res = mysqli_fetch_assoc($res);
$costPerNight=$res['costPerNight'];


if (!empty($childrenLogin)) {
    //записываем в $addultLinks id всех детей у которых есть логин из списка $childrenLogin
    foreach ($childrenLogin as $i => $login) {
        $query = "SELECT * FROM Users WHERE login = '$login'";
        $res = mysqli_query($link, $query);
        $user = mysqli_fetch_assoc($res);
        // $u=$user['id'];
        
        
        // //проверка на то может ли человек физически успеть вылетит
        // $query = "SELECT landingTime FROM Tickets WHERE userId=$u ORDER BY id DESC";
        // $res = mysqli_query($link, $query);
        // $userTicket = mysqli_fetch_assoc($res);
        // if ($userTicket>$from) {
        //     if (!isset($_COOKIE['error'])) { // если куки нет
        //         setcookie('error', 'нельзя вылетит в другую страну, когда уже летишь');
        //         $_COOKIE['error'] = 'нельзя вылетит в другую страну, когда уже летишь';
        //     } else echo "нельзя вылетит в другую страну, когда уже летишь";
        //     continue;
        // }

        $adultLinks.=$user['id'].",";
    }
    $adultLinks = substr($adultLinks,0,-1);
}



//билеты для взрослых
foreach ($adultsLogin as $i => $login) {
    $query = "SELECT * FROM Users WHERE login = '$login'";
    $res = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($res);
    // $u=$user['id'];

    // //проверка на то может ли человек физически успеть вылетит
    // $query = "SELECT * FROM Tickets WHERE userId=$u ORDER BY id DESC";
    // $res = mysqli_query($link, $query);
    // $userTicket = mysqli_fetch_assoc($res);
    // if ($userTicket['landingTime']>$from) {
    //     if (!isset($_COOKIE['error'])) { // если куки нет
    //         setcookie('error', 'нельзя вылетит в другую страну, когда уже летишь');
    //         $_COOKIE['error'] = 'нельзя вылетит в другую страну, когда уже летишь';
    //     } else echo "нельзя вылетит в другую страну, когда уже летишь";
    //     continue;
    // }

    $adultId=$user['id'];//id аккаунта взрослого
    //проверка на то есть ли взрослый в списке родителей
    if (!empty($isHaveLinks)){
    if (in_array($i,$isHaveLinks)) {
        $isHaveLink=1;
        $childrenLinks.=$adultId.",";
    }
    else {
        $isHaveLink=0; 
    }
    }


    //сначала сложим цену за проживание ночу и днём(за день надо платить на 25% больше), потом это значенние  сложим с ценой за перелёт
    $cost=($costPerNight*$nights+$costPerNight*$days*1.25)+$distance*10;


    $query="INSERT INTO `Tickets` (`id`, `airport`, `country`, `hotel`, `userId`, `cost`, `days`, `nights`, `departureTime`, `landingTime`, `isAdult`, `isHaveLinks`, `links`) VALUES (NULL, '$from', '$to', '$hotel', $adultId, $cost, $days, $nights, '$departure_date', '$landingTime', 1, $isHaveLink, '$adultLinks')";
    mysqli_real_escape_string($link,$query); //экранирует специальные символы
    $res = mysqli_query($link, $query);
    // $stmt = $link->prepare($query);
    // $stmt->bind_param(0, '', 0, 0);
    // $stmt->bind_param("issiiiissiis",0,$from,$to.": ".$hotel,$adultId,$cost,$days,$nights,$departure_date,$landingTime,1,$isHaveLink,$adultLinks);
    // $stmt->execute();
    // $stmt->close();
}
if (!empty($childrenLinks)) $childrenLinks = substr($childrenLinks,0,-1);



//билеты для детей
foreach ($childrenLogin as $i => $login) {
    $query = "SELECT * FROM Users WHERE login = '$login'";
    $res = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($res);
    // $u=$user['id'];

    // //проверка на то может ли человек физически успеть вылетит
    // $query = "SELECT * FROM Tickets WHERE userId=$u ORDER BY id DESC";
    // $res = mysqli_query($link, $query);
    // $userTicket = mysqli_fetch_assoc($res);
    // if (strtotime($userTicket['landingTime'])>strtotime($from)) {
    //     if (!isset($_COOKIE['error'])) { // если куки нет
    //         setcookie('error', 'нельзя вылетит в другую страну, когда уже летишь');
    //         $_COOKIE['error'] = 'нельзя вылетит в другую страну, когда уже летишь';
    //     } else echo "нельзя вылетит в другую страну, когда уже летишь";
    //     continue;
    // }

    $childrenId=$user['id'];//id аккаунта дитя

    //дети получают скидку в 25% за нахождевние в отелей, и 50% за перелёт 
    $cost=($costPerNight*$nights+$costPerNight*$days*1.25)*0.75+$distance*5;


    $query="INSERT INTO `Tickets` (`id`, `airport`, `country`, `hotel`, `userId`, `cost`, `days`, `nights`, `departureTime`, `landingTime`, `isAdult`, `isHaveLinks`, `links`) VALUES (NULL, '$from', '$to', '$hotel', $childrenId, $cost, $days, $nights, '$departure_date', '$landingTime', 0, 1, '$childrenLinks')";
    mysqli_real_escape_string($link,$query); //экранирует специальные символы
    $res = mysqli_query($link, $query);
}
header("Location: index.html"); exit();
?>