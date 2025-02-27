<!DOCTYPE html>
<html>
<head>
    <title>عزيزي العميل،</title>
</head>
<body>
    <h1>نشكر لكم انضمامكم لدى شركة ثقة الأولى، نسعد بخدمتكم طوال العام.</h1>
    <h3>بيانات العقد</h3> 
    <p>تاريخ بداية العقد : {{ $contract->start_date }}</p>
    <p>تاريخ نهاية العقد : {{ $contract->end_date }}</p>
    <p><span>يوم الزيارة : {{ $contract->chosen_day }}</span> <span>من كل شهر</span></p>
    <p>وقت الزيارة : {{ $contract->time }}</p>
</body>
</html>  