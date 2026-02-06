<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>GPB – Plateforme de Gestion</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
  /* Palette */
  --primary: #0068FE;
  --primary-light: #4D95FE;
  --primary-dark: #004EBF;
  --secondary: #FDC90A;
  --grey-100: #F8F9FA;
  --grey-200: #E9ECEF;
  --grey-300: #DEE2E6;
  --grey-500: #6C757D;
  --grey-600: #495057;
  --grey-700: #343A40;
  --grey-800: #212529;
  --dracula: #2d3436;
  --white: #FFFFFF;

  /* Shadows */
  --shadow: rgba(0,0,0,0.2);
  --shadow-dark: rgba(0,0,0,0.35);
}

/* RESET */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
}

html, body {
  min-height: 100vh;
}

/* BACKGROUND + OVERLAY */
body {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 20px;
  background: url("https://kostencheck.de/wp-content/uploads/2020/02/laermgutachten-kosten-2.jpg") center/cover no-repeat;
  position: relative;
}

body::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0, 104, 254, 0.5); /* transparent blue overlay */
  z-index: 0;
}

/* APPLICATION TEXT */
.app-text {
  position: relative;
  z-index: 1;
  text-align: center;
  color: var(--white);
  margin-bottom: 40px;
  max-width: 600px;
}

.app-text h1 {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 15px;
}

.app-text p {
  font-size: 1.1rem;
  line-height: 1.6;
  opacity: 0.95;
}

/* LOGIN CARD */
.login-card {
  position: relative;
  z-index: 1;
  width: 600px;
  background: rgba(255, 255, 255, 0.95);
  padding: 50px 40px;
  border-radius: 20px;
  box-shadow: 0 20px 50px var(--shadow-dark);
  display: flex;
  flex-direction: column;
  align-items: center;
  backdrop-filter: blur(8px);
  animation: fadeInUp 0.8s ease forwards;
}

@keyframes fadeInUp {
  0% { transform: translateY(50px); opacity: 0; }
  100% { transform: translateY(0); opacity: 1; }
}

/* LOGO */
.login-card img {
  display: block;
  width: 220px;
  margin-bottom: 30px;
}

/* TITLE */
.login-card h2 {
  font-size: 1.8rem;
  font-weight: 700;
  color: var(--primary-dark);
  margin-bottom: 10px;
  text-align: center;
}

.login-card p {
  text-align: center;
  font-size: 0.95rem;
  color: var(--grey-600);
  margin-bottom: 30px;
}

/* FORM */
.form-group {
  width: 100%;
  margin-bottom: 20px;
}

.form-group input {
  width: 100%;
  padding: 15px 18px;
  border-radius: 12px;
  border: 1px solid var(--grey-300);
  font-size: 0.95rem;
  background: rgba(255,255,255,0.85);
  backdrop-filter: blur(5px);
  transition: all 0.3s ease;
}

.form-group input:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 4px rgba(0,104,254,0.2);
}

/* OPTIONS */
.options {
  display: flex;
  justify-content: space-between;
  font-size: 0.85rem;
  margin-bottom: 25px;
}

.options a {
  color: var(--primary);
  text-decoration: none;
}

.options a:hover {
  text-decoration: underline;
}

.options label {
  font-weight: 500;
  display: flex;
  align-items: center;
}

.options input[type="checkbox"] {
  margin-right: 8px;
}

/* GRADIENT BUTTON */
.btn-login {
  width: 100%;
  padding: 16px;
  font-weight: 600;
  font-size: 1rem;
  color: var(--white);
  border: none;
  border-radius: 12px;
  cursor: pointer;
  background: linear-gradient(135deg, var(--primary), var(--primary-light));
  box-shadow: 0 8px 25px rgba(0,104,254,0.3);
  transition: all 0.4s ease;
}

.btn-login:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 30px rgba(0,104,254,0.45);
  background: linear-gradient(135deg, var(--primary-dark), var(--primary));
}

/* RESPONSIVE */
@media (max-height: 700px) {
  body {
    justify-content: flex-start;
    padding-top: 40px;
    padding-bottom: 40px;
  }
}

@media (max-width: 768px) {
  .login-card {
    width: 90%;
    padding: 35px 25px;
  }
  .app-text h1 {
    font-size: 2rem;
  }
  .app-text p {
    font-size: 1rem;
  }
}
</style>
</head>
<body>

<!-- APPLICATION TEXT -->
<div class="app-text" style="position:relative; z-index:1; text-align:center; color:#FFFFFF; margin-bottom:40px; max-width:600px;">
  
  <!-- Main platform title -->
  <h1 style="font-size:2.5rem; font-weight:700; margin-bottom:10px;">Plateforme GPB</h1>
  
  <!-- Department subtitle -->
  <p style="font-size:1rem; font-weight:500; opacity:0.9; margin-bottom:15px;">
    Direction des Infrastructures Postales et Bâtiment
  </p>

  <!-- Short description -->
  <p style="font-size:1.1rem; line-height:1.6; opacity:0.95;">
    Système centralisé de suivi et controle des projets de l'activité Batiments et Infrastructures Postales
   
  </p>
</div>


<!-- LOGIN CARD -->
<div class="login-card">
  <img src="{{ asset('img/LOGOAP.svg') }}" alt="Algérie Poste" style="width:140px; margin-bottom:20px;">

<!-- Small yellow separator -->
<div style="width:60px; height:4px; background-color:#FDC90A; margin:15px 0; border-radius:2px;"></div>

<h2 style="font-size:2rem; color:#004EBF; margin:10px 0 20px 0; text-align:center;">Connexion</h2>

  <p>Authentification des utilisateurs autorisés</p>
<form method="POST" style="width:100%; " action="{{ route('login') }}">
  <form method="POST" action="{{ route('login') }}">
            @csrf

              <div class="form-group has-feedback">
                  <input name="email" type="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                  @error('email')
                  <span class="invalid-feedback" role="alert" style="color: red"><strong>le nom d'utilisateur ou le mot de passe est incorrect</strong>
                  </span>
                  @enderror
              </div>
              <div class="form-group has-feedback">
                  <input name="password" type="password" class="form-control" placeholder="Password">
                  @error('password')
                  <span class="invalid-feedback" role="alert" style="color: red"><strong> le mot de passe est incorrect</strong>
                       </span>
                    @enderror
              </div>


          <div style="margin: 30px 0 15px 0;">
<button class="btn-login">Connexion</button>                          </div>
          </form>
</div>
<p style="font-size:0.85rem; color:#FFFFFF; text-align:center;">
  © 2026 – Tous les droits sont réservés à Algérie Poste
</p>

</body>
</html>
