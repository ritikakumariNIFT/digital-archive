<?php
// Your Professional Portfolio Data
$archives = [
    ["id" => 1, "title" => "2026 Global AI Governance Framework", "cat" => "Policy Paper", "date" => "March 2026", "tag" => "Technology", "img" => "https://ui-avatars.com/api/?name=AI&background=0D6EFD&color=fff"],
    ["id" => 2, "title" => "Renewable Energy Transition in Emerging Markets", "cat" => "Analysis", "date" => "Feb 2026", "tag" => "Sustainability", "img" => "https://ui-avatars.com/api/?name=EN&background=198754&color=fff"],
    ["id" => 3, "title" => "The Future of Decentralized Finance", "cat" => "Report", "date" => "Jan 2026", "tag" => "Finance", "img" => "https://ui-avatars.com/api/?name=DF&background=6610f2&color=fff"],
    ["id" => 4, "title" => "Cybersecurity Protocols for Smart Cities", "cat" => "Policy Paper", "date" => "Dec 2025", "tag" => "Infrastructure", "img" => "https://ui-avatars.com/api/?name=CS&background=dc3545&color=fff"],
];

$search = $_GET['q'] ?? '';
$filter = $_GET['cat'] ?? 'All';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InsightArchive | Strategic Intelligence Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary-dark: #1e293b; --accent-color: #10b981; --bg-soft: #f8fafc; }
        body { background-color: var(--bg-soft); font-family: 'Inter', system-ui, sans-serif; color: #334155; }

        /* Sidebar Customization */
        .sidebar { background: var(--primary-dark); color: white; min-height: 100vh; padding: 2rem 1.5rem; }
        .sidebar .brand { font-weight: 800; font-size: 1.25rem; letter-spacing: -0.5px; color: var(--accent-color); margin-bottom: 2rem; }
        .nav-link { color: #94a3b8; padding: 0.75rem 1rem; border-radius: 8px; transition: 0.2s; margin-bottom: 0.5rem; }
        .nav-link:hover, .nav-link.active { background: rgba(255,255,255,0.05); color: white; }

        /* Mobile Header */
        .mobile-header { background: var(--primary-dark); padding: 1rem; display: none; }

        /* Modern Document Card */
        .doc-card { 
            background: white; border: 1px solid #e2e8f0; border-radius: 12px; 
            padding: 1.5rem; margin-bottom: 1rem; transition: all 0.3s ease; 
        }
        .doc-card:hover { border-color: var(--accent-color); transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        
        .tag-badge { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; padding: 0.25rem 0.6rem; border-radius: 20px; background: #ecfdf5; color: #059669; }
        
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .mobile-header { display: flex; justify-content: space-between; align-items: center; }
            .main-content { padding: 1.5rem !important; }
        }
    </style>
</head>
<body>

<header class="mobile-header">
    <div class="brand" style="color:var(--accent-color); font-weight:800;">INSIGHT ARCHIVE</div>
    <button class="btn btn-sm btn-outline-light" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">Menu</button>
</header>

<div class="container-fluid p-0">
    <div class="row g-0">
        <nav class="col-md-3 col-lg-2 sidebar">
            <div class="brand">INSIGHT<span style="color:white">ARCHIVE</span></div>
            <div class="small text-uppercase fw-bold text-muted mb-2" style="font-size: 0.65rem;">Resource Categories</div>
            <a href="?cat=All" class="nav-link <?= $filter == 'All' ? 'active' : '' ?>">Explore All</a>
            <a href="?cat=Policy Paper" class="nav-link <?= $filter == 'Policy Paper' ? 'active' : '' ?>">Policy Papers</a>
            <a href="?cat=Analysis" class="nav-link <?= $filter == 'Analysis' ? 'active' : '' ?>">Expert Analysis</a>
            <a href="?cat=Report" class="nav-link <?= $filter == 'Report' ? 'active' : '' ?>">Intelligence Reports</a>
            
            <div class="mt-5 p-3 rounded" style="background: rgba(16, 185, 129, 0.1);">
                <small class="d-block text-white mb-2">Member Portal</small>
                <button class="btn btn-sm btn-success w-100 shadow-sm">Sign In</button>
            </div>
        </nav>

        <div class="col-md-9 col-lg-10">
            <main class="main-content p-5">
                <div class="row mb-5 align-items-end">
                    <div class="col-md-7">
                        <h1 class="fw-bold text-dark mb-1">Strategic Library</h1>
                        <p class="text-muted">Access curated intelligence on global policy and emerging trends.</p>
                    </div>
                    <div class="col-md-5">
                        <form method="GET">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control border-0 shadow-sm" placeholder="Search insights..." value="<?= htmlspecialchars($search) ?>" style="border-radius: 10px 0 0 10px;">
                                <button class="btn btn-success px-4" type="submit" style="border-radius: 0 10px 10px 0;">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <?php 
                    foreach ($archives as $item): 
                        if (($filter == 'All' || $item['cat'] == $filter) && ($search == '' || stripos($item['title'], $search) !== false)): 
                    ?>
                        <div class="col-12">
                            <div class="doc-card">
                                <div class="row align-items-center">
                                    <div class="col-auto d-none d-sm-block">
                                        <img src="<?= $item['img'] ?>" class="rounded shadow-sm" style="width: 50px; height: 50px;">
                                    </div>
                                    <div class="col">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="tag-badge"><?= $item['tag'] ?></span>
                                            <small class="text-muted"><?= $item['cat'] ?></small>
                                        </div>
                                        <h5 class="fw-bold mb-1"><?= $item['title'] ?></h5>
                                        <small class="text-muted">Published: <?= $item['date'] ?></small>
                                    </div>
                                    <div class="col-md-auto text-end mt-3 mt-md-0">
                                        <button class="btn btn-outline-dark btn-sm rounded-pill px-4">Access Data</button>
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

<div class="offcanvas offcanvas-start bg-dark text-white" id="mobileMenu">
    <div class="offcanvas-header"><h5 class="offcanvas-title">Menu</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button></div>
    <div class="offcanvas-body">
        <a href="?cat=All" class="nav-link">Explore All</a>
        <a href="?cat=Policy Paper" class="nav-link">Policy Papers</a>
        <a href="?cat=Analysis" class="nav-link">Expert Analysis</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
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

