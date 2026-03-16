<?php
// Mock Database: mimicking the USI Publication architecture
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
    <title>Institutional Digital Archive | Akash Kumar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Institutional Styling */
        :root {
            --usi-blue: #002147;
            --usi-gold: #ffab00;
            --light-bg: #f4f7f6;
        }

        body { background-color: var(--light-bg); font-family: 'Georgia', serif; color: #333; }
        
        /* Sidebar */
        .sidebar { background: var(--usi-blue); color: white; min-height: 100vh; padding: 30px 20px; position: sticky; top: 0; }
        .sidebar h4 { font-size: 1.1rem; border-bottom: 2px solid var(--usi-gold); padding-bottom: 10px; margin-bottom: 25px; text-transform: uppercase; }
        .sidebar a { color: #bdc3c7; text-decoration: none; display: block; padding: 12px; border-radius: 5px; transition: 0.3s; margin-bottom: 5px; }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.1); color: white; }

        /* News Ticker (Very common on Institutional sites) */
        .ticker-wrap { background: #fff; border-bottom: 1px solid #ddd; padding: 10px; overflow: hidden; white-space: nowrap; }
        .ticker { display: inline-block; animation: marquee 20s linear infinite; color: #d32f2f; font-weight: bold; }
        @keyframes marquee { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }

        /* Document Cards */
        .main-content { padding: 30px; }
        .doc-card { 
            background: white; border: none; border-left: 5px solid var(--usi-blue); 
            border-radius: 8px; margin-bottom: 20px; transition: 0.3s; 
        }
        .doc-card:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .btn-view { background: var(--usi-blue); color: white; border-radius: 20px; padding: 5px 20px; }
        .btn-view:hover { background: #003366; color: white; }

        .search-bar { border-radius: 25px; padding-left: 20px; border: 1px solid #ddd; }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        <nav class="col-md-3 col-lg-2 sidebar">
            <h4>Archive Portal</h4>
            <a href="?cat=All" class="<?= $filter == 'All' ? 'active' : '' ?>">📂 All Publications</a>
            <a href="?cat=Journal" class="<?= $filter == 'Journal' ? 'active' : '' ?>">📖 Quarterly Journals</a>
            <a href="?cat=Year Book" class="<?= $filter == 'Year Book' ? 'active' : '' ?>">📚 Strategic Year Books</a>
            <a href="?cat=Monograph" class="<?= $filter == 'Monograph' ? 'active' : '' ?>">📄 Monographs</a>
            <hr>
            <div class="mt-4">
                <button class="btn btn-outline-warning w-100 btn-sm">Member Login</button>
            </div>
        </nav>

        <div class="col-md-9 col-lg-10">
            <div class="ticker-wrap">
                <div class="ticker">
                    LATEST NEWS: Call for Papers for July-Sept 2026 Journal is now open! | USI National Security Seminar begins next week.
                </div>
            </div>

            <main class="main-content">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h2 class="fw-bold">Digital Library & Archives</h2>
                        <p class="text-muted">Filtering: <strong><?= $filter ?></strong></p>
                    </div>
                    <form class="d-flex" method="GET">
                        <input type="hidden" name="cat" value="<?= $filter ?>">
                        <input class="form-control search-bar me-2" type="search" name="q" placeholder="Search by title or author..." value="<?= htmlspecialchars($search) ?>">
                        <button class="btn btn-dark rounded-pill px-4" type="submit">Search</button>
                    </form>
                </div>

                <div class="row">
                    <?php 
                    $found = false;
                    foreach ($publications as $pub): 
                        $matchSearch = ($search == '' || stripos($pub['title'], $search) !== false || stripos($pub['author'], $search) !== false);
                        $matchFilter = ($filter == 'All' || $pub['cat'] == $filter);

                        if ($matchSearch && $matchFilter): 
                            $found = true; ?>
                            <div class="col-12">
                                <div class="card doc-card p-3 shadow-sm">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="<?= $pub['img'] ?>" alt="Cover" class="rounded border">
                                        </div>
                                        <div class="col">
                                            <span class="badge bg-light text-dark border mb-1"><?= $pub['cat'] ?></span>
                                            <h5 class="card-title fw-bold mb-1"><?= $pub['title'] ?></h5>
                                            <p class="text-muted small mb-0">Author: <?= $pub['author'] ?> | Issued: <?= $pub['date'] ?></p>
                                        </div>
                                        <div class="col-auto text-end">
                                            <a href="#" class="btn btn-view">Download PDF</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; 
                    endforeach; 

                    if (!$found): ?>
                        <div class="col-12 text-center py-5">
                            <h4 class="text-muted">No documents found matching your criteria.</h4>
                            <a href="?cat=All" class="btn btn-link">Clear all filters</a>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
</div>

</body>
</html>
