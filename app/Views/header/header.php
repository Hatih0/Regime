<?php
	$pageTitle = $pageTitle ?? 'S4+ Regime';
	$pageSubtitle = $pageSubtitle ?? 'Application de selection de regime alimentaire';
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= esc($pageTitle) ?></title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="app-shell">
	<nav class="navbar navbar-expand-lg navbar-dark app-navbar sticky-top">
		<div class="container-fluid">
			<div class="container-lg d-flex align-items-center justify-content-between px-0">
				<a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('/') ?>">
					<span class="brand-mark"><i class="bi bi-activity"></i></span>
					<span>
						S4+
						<small class="d-block brand-subtitle"><?= esc($pageSubtitle) ?></small>
					</span>
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="#mainNavbar" aria-expanded="false" aria-label="Basculer la navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="mainNavbar">
					<ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
						<?php
						$uri = service('uri');
						$current = trim($uri->getPath(), '/');
						$session = session();
						$isUserLogged = (bool) $session->get('is_logged');
						$isAdminLogged = (bool) $session->get('is_logged_in');
						$guestLinks = [
							'/' => ['label' => 'Accueil', 'icon' => 'house-door'],
							'signin' => ['label' => 'Inscription', 'icon' => 'person-plus'],
							'login' => ['label' => 'Connexion', 'icon' => 'box-arrow-in-right'],
							'adminAuth' => ['label' => 'Admin', 'icon' => 'shield-lock'],
						];
						$userLinks = [
							'wallet' => ['label' => 'Portefeuille', 'icon' => 'wallet2'],
							'gold' => ['label' => 'Gold', 'icon' => 'gem'],
							'choix-regime' => ['label' => 'Regime', 'icon' => 'clipboard2-pulse'],
							'dashboard' => ['label' => 'Dashboard', 'icon' => 'speedometer2'],
						];
						$adminLinks = [
							'only-admin' => ['label' => 'Tableau de bord', 'icon' => 'speedometer2'],
							'regimes' => ['label' => 'Regimes', 'icon' => 'clipboard2-pulse'],
							'exercices' => ['label' => 'Exercices', 'icon' => 'bicycle'],
							'admin/codes' => ['label' => 'Codes', 'icon' => 'qr-code'],
						];

						$links = $guestLinks;
						if ($isAdminLogged) {
							$links = $adminLinks;
						} elseif ($isUserLogged) {
							$links = $userLinks;
						}

						foreach ($links as $path => $info) {
							$href = $path === '/' ? site_url('/') : site_url($path);
							$isActive = ($path === '/' && $current === '') || ($current !== '' && strpos($current, $path) === 0);
							$activeClass = $isActive ? ' active' : '';
							echo "<li class=\"nav-item\"><a class=\"nav-link{$activeClass}\" href=\"{$href}\"><i class=\"bi bi-{$info['icon']} me-1\"></i>" . esc($info['label']) . "</a></li>";
						}

						if ($isUserLogged) {
							$userName = esc($session->get('nom') ?? $session->get('username') ?? 'Utilisateur');
							echo "<li class=\"nav-item dropdown\">";
							echo "<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"userMenu\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">";
							echo "<i class=\"bi bi-person-circle me-1\"></i> {$userName}</a>";
							echo "<ul class=\"dropdown-menu dropdown-menu-end\" aria-labelledby=\"userMenu\">";
							echo "<li><a class=\"dropdown-item\" href=\"" . site_url('/user-profile') . "\">Profil</a></li>";
							echo "<li><a class=\"dropdown-item\" href=\"" . site_url('/wallet') . "\">Portefeuille</a></li>";
							echo "<li><a class=\"dropdown-item\" href=\"" . site_url('/gold') . "\">Gold</a></li>";
							echo "<li><a class=\"dropdown-item\" href=\"" . site_url('/choix-regime') . "\">Regime</a></li>";
							echo "<li><a class=\"dropdown-item\" href=\"" . site_url('/logout') . "\">Déconnexion</a></li>";
							echo "</ul></li>";
						} elseif ($isAdminLogged) {
							$adminName = esc($session->get('nom') ?? $session->get('username') ?? 'Administrateur');
							echo "<li class=\"nav-item dropdown\">";
							echo "<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"adminMenu\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">";
							echo "<i class=\"bi bi-shield-lock me-1\"></i> {$adminName}</a>";
							echo "<ul class=\"dropdown-menu dropdown-menu-end\" aria-labelledby=\"adminMenu\">";
							echo "<li><a class=\"dropdown-item\" href=\"" . site_url('/only-admin') . "\">Tableau de bord</a></li>";
							echo "<li><a class=\"dropdown-item\" href=\"" . site_url('/regimes') . "\">Gestion des régimes</a></li>";
							echo "<li><a class=\"dropdown-item\" href=\"" . site_url('/exercices') . "\">Gestion des exercices</a></li>";
							echo "<li><a class=\"dropdown-item\" href=\"" . site_url('/admin/codes') . "\">Gestion des codes</a></li>";
							echo "<li><a class=\"dropdown-item\" href=\"" . site_url('/admin/logout') . "\">Déconnexion</a></li>";
							echo "</ul></li>";
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<main class="app-main">
		<?= $this->include('header/alerts') ?>
