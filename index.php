<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema MPHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 40px;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card-header {
            background-color: #4e73df;
            color: white;
            font-weight: bold;
            padding: 1.5rem;
            border-bottom: 0;
        }
        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }
        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
        }
        .btn-success {
            background-color: #1cc88a;
            border-color: #1cc88a;
        }
        .btn-success:hover {
            background-color: #17a673;
            border-color: #17a673;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }
        .logo-text {
            font-size: 2rem;
            font-weight: bold;
            color: #4e73df;
        }
        .system-icon {
            font-size: 3.5rem;
            color: #4e73df;
            margin-bottom: 1rem;
        }
        .footer {
            text-align: center;
            margin-top: 2rem;
            color: #6c757d;
            font-size: 0.9rem;
        }
        .card-body {
            padding: 2rem;
        }
        .welcome-text {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #5a5c69;
        }
        .btn-lg {
            padding: 1rem 1.5rem;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="logo-container">
                    <div class="system-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="logo-text">
                        Sistema MPHP
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="mb-0">Bem-vindo</h2>
                        <p class="mb-0">Sistema de Gerenciamento de Clientes</p>
                    </div>
                    <div class="card-body text-center">
                        <div class="welcome-text">
                            <p>Acesse o sistema para gerenciar seus clientes de forma simples e eficiente.</p>
                        </div>
                        <div class="d-grid gap-3">
                            <a href="login.php" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Entrar no Sistema
                            </a>
                            <a href="cadastro.php" class="btn btn-success btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Novo Cadastro
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="footer">
                    &copy; <?php echo date('Y'); ?> Sistema MPHP - Todos os direitos reservados
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
