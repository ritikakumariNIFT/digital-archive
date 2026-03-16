<?php
// Mock Database connection (To keep it serverless-friendly for now)
$journals = [
    ["title" => "Journal of Defence Studies Vol 15", "year" => "2023", "type" => "Quarterly"],
    ["title" => "USI Strategic Year Book 2022", "year" => "2022", "type" => "Annual"],
    ["title" => "National Security Review", "year" => "2024", "type" => "Monthly"]
];

$search = $_GET['q'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>USI Style Archive Manager</title>
    <style>
        body { font-family: sans-serif; padding: 40px; background: #f4f4f4; }
        .card { background: white; padding: 20px; margin-bottom: 10px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        input { padding: 10px; width: 300px; border-radius: 5px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <h1>Digital Archive Portal</h1>
    <form method="GET">
        <input type="text" name="q" placeholder="Search journals..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
    </form>

    <hr>

    <?php foreach ($journals as $item): ?>
        <?php if ($search == '' || stripos($item['title'], $search) !== false): ?>
            <div class="card">
                <h3><?php echo $item['title']; ?></h3>
                <p>Published: <?php echo $item['year']; ?> | Category: <?php echo $item['type']; ?></p>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</body>
</html>
