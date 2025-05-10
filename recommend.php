<?php require_once 'init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Recommend Us!</title>
  <style>
    body {
      background-color: #fffdf8;
      text-align: center;
      padding: 50px;
    }

    h1 {
      color: #5a3921;
    }

    p {
      font-size: 18px;
    }

    .share-buttons {
      margin-top: 30px;
    }

    .btn {
      padding: 15px 30px;
      margin: 10px;
      font-size: 16px;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .facebook {
      background-color: #4267B2;
    }

    .facebook:hover {
      background-color: #365899;
    }

    .instagram {
      background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
    }

    .instagram:hover {
      opacity: 0.9;
    }

    .btn a {
      color: white;
      text-decoration: none;
    }
  </style>
</head>
<body>

  <h1>💬 Recommend Starlight Sip!</h1>
  <p>Share your favorite experience from Starlight Sip with your friends!</p>

  <div class="share-buttons">
    <!-- Facebook Share -->
    <button class="btn facebook">
      <a href="https://www.facebook.com/sharer/sharer.php?u=http://localhost/Starlight_Sip_f/index.php&quote=I loved my coffee experience at Starlight Sip! Highly recommended!" target="_blank">
        Share on Facebook
      </a>
    </button>

    <!-- Instagram Instructions -->
    <button class="btn instagram">
      <a href="https://www.instagram.com/" target="_blank">
        Share on Instagram
      </a>
    </button>
  </div>

  <p style="margin-top: 30px; font-size: 14px; color: #555;">
    * Instagram does not allow direct post sharing via websites. You'll be redirected to Instagram and can create your post manually.
  </p>

</body>
</html>