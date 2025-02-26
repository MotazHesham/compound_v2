<!DOCTYPE html>
<html>
<head>
    <title>تم أضافة عقد جديد في حسابك</title>
</head>
<body>
    <h3>بيانات العقد</h3> 
    <p>تاريخ بداية العقد : {{ $contract->start_date }}</p>
    <p>تاريخ نهاية العقد : {{ $contract->end_date }}</p>
    <p>يوم الزيارة : {{ $contract->chosen_day }}</p>
    <p>وقت الزيارة : {{ $contract->time }}</p>
</body>
</html>