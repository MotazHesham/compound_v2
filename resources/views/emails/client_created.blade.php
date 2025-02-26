<!DOCTYPE html>
<html>
<head>
    <title>مرحبا بك معنا ({{ $user->name }})</title>
</head>
<body>
    <p>نفيدكم بان اسم المستخدم : {{ $user->username }}</p>
    <p>وكلمة المرور : {{ $password }}</p>
    <p>ورابط الدخول للنظام من الكمبيوتر : {{ route('login') }}</p>
</body>
</html>