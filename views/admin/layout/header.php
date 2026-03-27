<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <style>
        body { font-family: Arial; margin: 0; }
        .header { background: #333; color: #fff; padding: 15px; }
        .container { display: flex; }
        .content { padding: 20px; width: 100%; }
        .sidebar { width: 200px; background: #f4f4f4; height: 100vh; }
        .sidebar a { display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover { background: #ddd; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: center; }
        .btn { padding: 5px 10px; text-decoration: none; }
        .btn-add { background: green; color: white; }
        .btn-edit { background: orange; color: white; }
        .btn-delete { background: red; color: white; }
    </style>
</head>
<body>

<div class="header">
    <h2>Admin Panel</h2>
</div>

<div class="container">
