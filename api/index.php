<?php
// Mock Data - In a real app, count($archives) would come from a SQL query: SELECT COUNT(*) FROM docs
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
    <title>InsightArchive | Professional Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary-dark: #0f172a; --accent-green: #10b981; --border-color: #e2e8f0; }
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        
        /* Sidebar */
        .sidebar { background: var(--primary-dark); color: white; min-height: 100vh; padding: 2rem 1.5rem; }
        .sidebar .brand { font-weight: 800; color: var(--accent-green); font-size: 1.4rem; margin-bottom: 2.5rem; }
        .nav-link { color: #94a3b8; padding: 0.8rem; border-radius: 8px; margin-bottom: 5px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background: #1e293b; color: white; }

        /* Stats Cards */
        .stat-card { background: white; border: 1px solid var(--border-color); border-radius: 12px; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .stat-value { font-size: 1.8rem; font-weight: 800; color: var(--primary-dark); }
        .stat-label { font-size: 0.8rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }

        /* Document Items */
        .doc-card { background: white; border: 1px solid var(--border-color); border-radius: 12px; padding: 1.25rem; margin-bottom: 1rem; transition: 0.2s; }
        .doc-card:hover { border-color: var(--accent-green); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        
        .badge-cat { background: #f1f5f9; color: #475569; font-size: 0.75rem; padding: 0.3rem 0.7rem; border-radius: 6px; }

        @media (max-width: 768px) { .sidebar { display: none; } }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        <nav class="col-md-3 col-lg-2 sidebar">
            <div class="brand">INSIGHT<span class="text-white">ARCHIVE</span></div>
            <a href="?cat=All" class="nav-link <?= $filter == 'All' ? 'active' : '' ?>">Global Feed</a>
            <a href="?cat=Policy Paper" class="nav-link <?= $filter == 'Policy Paper' ? 'active' : '' ?>">Policy Vault</a>
            <a href="?cat=Analysis" class="nav-link <?= $filter == 'Analysis' ? 'active' : '' ?>">Strategic Analysis</a>
            <a href="?cat=Report" class="nav-link <?= $filter == 'Report' ? 'active' : '' ?>">Sector Reports</a>
            <div class="mt-auto pt-5">
                <div class="p-3 rounded bg-dark border border-secondary">
                    <small class="text-muted d-block mb-2">Build Version</small>
                    <code class="text-success">v4.2.0-stable</code>
                </div>
            </div>
        </nav>

        <main class="col-md-9 col-lg-10 p-4 p-md-5">
            <div class="row g-3 mb-5">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-value">12.4k</div>
                        <div class="stat-label">Total Assets</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-value">850</div>
                        <div class="stat-label">Contributors</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-value">24</div>
                        <div class="stat-label">Daily Updates</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-value">99.9%</div>
                        <div class="stat-label">Uptime</div>
                    </div>
                </div>
            </div>

            <div class="d-md-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold m-0">Repository Explorer</h3>
                <form class="mt-3 mt-md-0 d-flex" method="GET">
                    <input type="hidden" name="cat" value="<?= $filter ?>">
                    <input type="text" name="q" class="form-control rounded-pill px-4 me-2 border-0 shadow-sm" placeholder="Filter by keyword..." value="<?= htmlspecialchars($search) ?>">
                    <button class="btn btn-success rounded-pill px-4">Find</button>
                </form>
            </div>

            <div class="row">
                <?php 
                foreach ($archives as $item): 
                    if (($filter == 'All' || $item['cat'] == $filter) && ($search == '' || stripos($item['title'], $search) !== false)): ?>
                    <div class="col-12">
                        <div class="doc-card d-md-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="<?= $item['img'] ?>" class="rounded me-3 d-none d-sm-block" width="48">
                                <div>
                                    <div class="mb-1">
                                        <span class="badge-cat"><?= $item['cat'] ?></span>
                                        <span class="text-success fw-bold ms-2" style="font-size: 0.7rem;">● SECURE</span>
                                    </div>
                                    <h6 class="fw-bold mb-0 text-dark"><?= $item['title'] ?></h6>
                                    <small class="text-muted">ID: #00<?= $item['id'] ?> | Finalized: <?= $item['date'] ?></small>
                                </div>
                            </div>
                            <div class="mt-3 mt-md-0">
                                <button class="btn btn-sm btn-outline-dark px-4 rounded-pill">View Insight</button>
                            </div>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
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

