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
$childrenLinks=[];//id взрослых аккаунтов которые будут занесены в childrenLinks
$adultLinks=[];//id аккаунтов детей которые будут занесены в links

//ищем дистанцию маршрута от начальной точки до конечной
$query="SELECT * FROM Routes WHERE startPos = ? AND stopPos = ?";
$stmt = $link->prepare($query);
$stmt->bind_param("ss",$from,$to);
$stmt->execute();
$res = mysqli_stmt_get_result($stmt);
$rout = mysqli_fetch_assoc($res);
if (empty($rout)) {//если не нашли маршрут, то меняем начальную позицию и конечную
    $query="SELECT * FROM Routes WHERE startPos = ? AND stopPos = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("ss",$to,$from);
    $stmt->execute();
    $res = mysqli_stmt_get_result($stmt);
    $rout = mysqli_fetch_assoc($res);
    $distance=$rout['distance'];
}
else {
    $distance=$rout['distance'];//в $distance записано целочисленное значение в километрах
}

//за каждые 10километра с перемены $distance добавляет 1 минуту в $departure_date, и записывает это значение в $landingTime
$speed = 10;  // Скорость (10 км/минуту)
$arrival_time_minutes = intval($distance / $speed);
$arrival_time = date("Y.m.d H:i", strtotime($departure_date) + $arrival_time_minutes * 60);
// Запись значения в переменную
$landingTime = $arrival_time;

$isHaveLink=0;//является ли взрослый родителем

//записываем в $addultLinks id всех детей у которых есть логин из списка $childrenLogin
foreach ($childrenLogin as $i => $login) {
    $query = "SELECT * FROM Users WHERE login = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $login);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($res);
    $adultLinks[]=$user['id'];
}


//билеты для взрослых
foreach ($adultsLogin as $i => $login) {
    $query = "SELECT * FROM Users WHERE login = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $login);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($res);
    $adultId=$user['id'];//id аккаунта взрослого
    //проверка на то есть ли взрослый в списке родителей
    if (in_array($i,$isHaveLinks)) {
        $isHaveLink=1;
        $childrenLinks[]=$adultId;
    }
    else {
        $isHaveLink=0; 
    }
    
    //ищем у отеля $hotel цену за ночь
    $query = "SELECT * FROM Hotels WHERE name = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $hotel);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $res = mysqli_fetch_assoc($res);
    $costPerNight=$res['costPerNight'];
    //сначала сложим цену за проживание ночу и днём(за день надо платить на 25% больше), потом это значенние  сложим с ценой за перелёт
    $cost=($costPerNight*$nights+$costPerNight*$days*1.25)+intdiv($distance,100);


    $query="INSERT INTO `Tickets` (`id`, `airport`, `hotel`, `userId`, `cost`, `days`, `nights`, `departureTime`, `landingTime`, `isAdult`, `isHaveLinks`, `links`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, '?', '?', ?)";
    $stmt = $link->prepare($query);
    $stmt->bind_param("issiiiissiis",NULL,$from,$to.": ".$hotel,$adultId,$cost,$days,$nights,$departure_date,$landingTime,1,$isHaveLink,$adultLinks);
    $stmt->execute();
    $stmt->close();
}
?>