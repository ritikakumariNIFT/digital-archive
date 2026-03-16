<?php
// Mock Database
$publications = [
    ["id" => 1, "title" => "Journal of United Service Institution of India", "cat" => "Journal", "date" => "Jan-Mar 2026", "author" => "USI Editorial Board", "img" => "https://via.placeholder.com/50x70?text=J"],
    ["id" => 2, "title" => "Strategic Year Book 2025: National Security", "cat" => "Year Book", "date" => "Jan 2026", "author" => "Maj Gen B.K. Sharma", "img" => "https://via.placeholder.com/50x70?text=YB"],
    ["id" => 3, "title" => "The Art of Hybrid Warfare in 2026", "cat" => "Monograph", "date" => "Dec 2025", "author" => "Lt Gen (Retd) P. Singh", "img" => "https://via.placeholder.com/50x70?text=M"],
    ["id" => 4, "title" => "Cyber Security Challenges in South Asia", "cat" => "Journal", "date" => "Oct-Dec 2025", "author" => "Dr. S. Kalyanaraman", "img" => "https://via.placeholder.com/50x70?text=J"],
];

$search = $_GET['q'] ?? '';
$filter = $_GET['cat'] ?? 'All';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institutional Archive | Mobile Responsive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --usi-blue: #002147; --usi-gold: #ffab00; }
        body { background-color: #f4f7f6; font-family: 'Georgia', serif; }

        /* Sidebar - Hidden on mobile, shown on md+ */
        .sidebar { background: var(--usi-blue); color: white; min-height: 100vh; padding: 30px 20px; }
        .sidebar a { color: #bdc3c7; text-decoration: none; display: block; padding: 12px; border-radius: 5px; margin-bottom: 5px; }
        .sidebar a.active { background: rgba(255,255,255,0.1); color: white; border-left: 4px solid var(--usi-gold); }

        /* Mobile Header - Shown only on small screens */
        .mobile-nav { background: var(--usi-blue); color: white; padding: 15px; display: none; }

        /* News Ticker */
        .ticker-wrap { background: #fff; border-bottom: 1px solid #ddd; padding: 8px; overflow: hidden; white-space: nowrap; font-size: 0.9rem; }
        .ticker { display: inline-block; animation: marquee 15s linear infinite; color: #d32f2f; font-weight: bold; }
        @keyframes marquee { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .mobile-nav { display: block; }
            .main-content { padding: 15px; }
            .doc-card { text-align: center; }
            .doc-card .row { flex-direction: column; }
            .doc-card img { margin-bottom: 15px; }
            .btn-view { width: 100%; margin-top: 10px; }
        }

        .doc-card { background: white; border: none; border-radius: 12px; margin-bottom: 15px; transition: 0.3s; }
        .doc-card:hover { box-shadow: 0 8px 15px rgba(0,0,0,0.1); }
        .btn-view { background: var(--usi-blue); color: white; border-radius: 25px; }
    </style>
</head>
<body>

<header class="mobile-nav shadow">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="m-0">USI Archive</h5>
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">Menu</button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="?cat=All">All</a></li>
                <li><a class="dropdown-item" href="?cat=Journal">Journals</a></li>
                <li><a class="dropdown-item" href="?cat=Year Book">Year Books</a></li>
            </ul>
        </div>
    </div>
</header>

<div class="container-fluid p-0">
    <div class="row g-0">
        <nav class="col-md-3 col-lg-2 sidebar">
            <h4 class="text-warning border-bottom pb-2 mb-4">Digital Portal</h4>
            <a href="?cat=All" class="<?= $filter == 'All' ? 'active' : '' ?>">All Publications</a>
            <a href="?cat=Journal" class="<?= $filter == 'Journal' ? 'active' : '' ?>">Quarterly Journals</a>
            <a href="?cat=Year Book" class="<?= $filter == 'Year Book' ? 'active' : '' ?>">Strategic Year Books</a>
            <hr>
            <button class="btn btn-warning w-100 btn-sm fw-bold">Login</button>
        </nav>

        <div class="col-md-9 col-lg-10">
            <div class="ticker-wrap">
                <div class="ticker">UPDATE: New research monographs on Arctic Strategy published today.</div>
            </div>

            <main class="main-content p-4">
                <div class="row mb-4 align-items-center">
                    <div class="col-12 col-md-6">
                        <h2 class="fw-bold m-0">Archives</h2>
                        <p class="text-muted small">Viewing: <?= $filter ?></p>
                    </div>
                    <div class="col-12 col-md-6 mt-3 mt-md-0">
                        <form class="d-flex" method="GET">
                            <input type="hidden" name="cat" value="<?= $filter ?>">
                            <input class="form-control rounded-pill me-2" type="search" name="q" placeholder="Search archive..." value="<?= htmlspecialchars($search) ?>">
                            <button class="btn btn-dark rounded-pill" type="submit">Search</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <?php foreach ($publications as $pub): 
                        if (($filter == 'All' || $pub['cat'] == $filter) && ($search == '' || stripos($pub['title'], $search) !== false)): ?>
                        <div class="col-12 mb-3">
                            <div class="card doc-card p-3 shadow-sm">
                                <div class="row align-items-center">
                                    <div class="col-md-auto text-center">
                                        <img src="<?= $pub['img'] ?>" width="60" class="rounded border">
                                    </div>
                                    <div class="col mt-2 mt-md-0">
                                        <span class="badge bg-light text-dark border small mb-1"><?= $pub['cat'] ?></span>
                                        <h6 class="fw-bold m-0"><?= $pub['title'] ?></h6>
                                        <p class="text-muted x-small m-0">Authored by <?= $pub['author'] ?></p>
                                    </div>
                                    <div class="col-md-auto mt-3 mt-md-0 text-center">
                                        <a href="#" class="btn btn-view btn-sm px-4">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; endforeach; ?>
                </div>
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

