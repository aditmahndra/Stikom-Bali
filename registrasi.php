<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - ITB STIKOM Bali</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body class="bg-register">

    <?php include 'header.php'; ?>
    <!-- REGISTER -->
    <section class="register-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 form-container">
                    <div class="form-box">
                        <div class="form-logo">
                            <img src="img/logo-stikom.png">
                            <h2>Register</h2>
                        </div>

                        <form action="proses_register.php" method="POST">

                            <div class="mb-4">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control form-input"
                                    placeholder="Masukkan Nama Lengkap" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Email / No Ponsel</label>
                                <input type="text" name="email" class="form-control form-input"
                                    placeholder="Masukkan Email / No Ponsel" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control form-input"
                                    placeholder="Masukkan Password" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn-submit">
                                    Register
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

</body>

</html>