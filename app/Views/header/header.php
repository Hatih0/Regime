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
		<div class="container">
			<a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('/') ?>">
				<span class="brand-mark"><i class="bi bi-activity"></i></span>
				<span>
					S4+
					<small class="d-block brand-subtitle"><?= esc($pageSubtitle) ?></small>
				</span>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Basculer la navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="mainNavbar">
				<ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
					<li class="nav-item"><a class="nav-link" href="<?= site_url('/') ?>"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
					<li class="nav-item"><a class="nav-link" href="<?= site_url('/signin') ?>"><i class="bi bi-person-plus me-1"></i>Inscription</a></li>
					<li class="nav-item"><a class="nav-link" href="<?= site_url('/userAuth') ?>"><i class="bi bi-box-arrow-in-right me-1"></i>Connexion</a></li>
					<li class="nav-item"><a class="nav-link" href="<?= site_url('/user-profile') ?>"><i class="bi bi-person-badge me-1"></i>Profil</a></li>
					<li class="nav-item"><a class="nav-link" href="<?= site_url('/wallet') ?>"><i class="bi bi-wallet2 me-1"></i>Portefeuille</a></li>
					<li class="nav-item"><a class="nav-link" href="<?= site_url('/gold') ?>"><i class="bi bi-gem me-1"></i>Gold</a></li>
					<li class="nav-item"><a class="nav-link" href="<?= site_url('/choix-regime') ?>"><i class="bi bi-clipboard2-pulse me-1"></i>Regime</a></li>
					<li class="nav-item"><a class="nav-link" href="<?= site_url('/dashboard') ?>"><i class="bi bi-speedometer2 me-1"></i>Dashboard</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<main class="app-main">
