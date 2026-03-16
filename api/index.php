<?php
// Mock Database: In a real app, this would come from MySQL
$publications = [
    ["id" => 1, "title" => "Strategic Review: Maritime Security", "cat" => "Journal", "date" => "Oct 2025", "author" => "Adm. R. Kumar"],
    ["id" => 2, "title" => "Indo-Pacific Geopolitics 2026", "cat" => "Year Book", "date" => "Jan 2026", "author" => "Gen. S. Singh"],
    ["id" => 3, "title" => "Cyber Warfare Tactics", "cat" => "Monograph", "date" => "Dec 2025", "author" => "Dr. A. Sharma"],
    ["id" => 4, "title" => "Border Management Policy", "cat" => "Journal", "date" => "Feb 2026", "author" => "Col. V. Tyagi"],
];

$search = $_GET['q'] ?? '';
$filter = $_GET['cat'] ?? 'All';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institutional Digital Archive | USI Style</title>
    <link rel="stylesheet" href="/public/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; font-family: 'Georgia', serif; }
        .sidebar { background: #1a237e; color: white; min-height: 100vh; padding: 20px; }
        .sidebar a { color: #cfd8dc; text-decoration: none; display: block; padding: 10px 0; border-bottom: 1px solid #303f9f; }
        .sidebar a:hover { color: white; }
        .main-content { padding: 40px; }
        .doc-card { background: white; border-left: 5px solid #1a237e; transition: 0.3s; margin-bottom: 15px; }
        .doc-card:hover { transform: translateY(-3px); shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .badge-journal { background: #e8eaf6; color: #1a237e; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 sidebar d-none d-md-block">
            <h4 class="mb-4">USI Archive</h4>
            <a href="?cat=All">All Publications</a>
            <a href="?cat=Journal">Quarterly Journals</a>
            <a href="?cat=Year Book">Strategic Year Books</a>
            <a href="?cat=Monograph">Monographs</a>
            <hr>
            <small class="text-muted">Digital Library v2.1</small>
        </nav>

        <main class="col-md-9 col-lg-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Digital Library & Archives</h2>
                <form class="d-flex" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search titles..." value="<?= htmlspecialchars($search) ?>">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>

            <div class="row">
                <?php 
                foreach ($publications as $pub): 
                    // Search Logic
                    $matchSearch = ($search == '' || stripos($pub['title'], $search) !== false);
                    $matchFilter = ($filter == 'All' || $pub['cat'] == $filter);

                    if ($matchSearch && $matchFilter): ?>
                    <div class="col-12">
                        <div class="card doc-card shadow-sm p-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <span class="badge badge-journal mb-2"><?= $pub['cat'] ?></span>
                                    h5 class="card-title"><?= $pub['title'] ?></h5>
                                    <p class="text-muted mb-0">By <?= $pub['author'] ?> | Published: <?= $pub['date'] ?></p>
                                </div>
                                <div class="align-self-center">
                                    <a href="#" class="btn btn-sm btn-dark">View PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        </main>
    </div>
</div>

</body>
</html>
