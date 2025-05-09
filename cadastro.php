<?php
session_start();
include('conexao.php');
// Verifica se o usuário já está logado
if(isset($_SESSION['id_usuario'])) {
    header("Location: painel.php");
    exit;
}
$erro = "";
$sucesso = "";
// Verifica se o formulário foi enviado
if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['confirmar_senha'])) {
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    
    // Validação básica
    if(strlen($nome) < 3) {
        $erro = "O nome deve ter pelo menos 3 caracteres";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Email inválido";
    } elseif(strlen($senha) < 6) {
        $erro = "A senha deve ter pelo menos 6 caracteres";
    } elseif($senha != $confirmar_senha) {
        $erro = "As senhas não coincidem";
    } else {
        // Verifica se o email já está cadastrado
        $sql = "SELECT id FROM usuarios WHERE email = '$email'";
        $result = mysqli_query($mysqli, $sql);
        
        if(mysqli_num_rows($result) > 0) {
            $erro = "Este email já está cadastrado";
        } else {
            // Hash da senha
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            
            // Insere o novo usuário
            $sql = "INSERT INTO usuarios (nome, email, senha, data_cadastro) VALUES ('$nome', '$email', '$senha_hash', NOW())";
            
            if(mysqli_query($mysqli, $sql)) {
                $sucesso = "Cadastro realizado com sucesso! Você já pode fazer login.";
            } else {
                $erro = "Erro ao cadastrar: " . mysqli_error($mysqli);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema de Gerenciamento</title>
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
            padding: 1rem;
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
        .form-group {
            margin-bottom: 1rem;
        }
        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }
        .logo-text {
            font-size: 1.75rem;
            font-weight: bold;
            color: #4e73df;
        }
        .cadastro-link {
            text-align: center;
            margin-top: 1rem;
        }
        .alert {
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="logo-container">
                    <div class="logo-text">
                        <i class="fas fa-user-plus me-2"></i>Sistema de Gerenciamento
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="mb-0">Cadastro de Usuário</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php if($erro != ""): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i><?php echo $erro; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if($sucesso != ""): ?>
                            <div class="alert alert-success" role="alert">
                                <i class="fas fa-check-circle me-2"></i><?php echo $sucesso; ?>
                                <div class="mt-2">
                                    <a href="login.php" class="btn btn-success btn-sm">Fazer Login</a>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="nome"><i class="fas fa-user me-2"></i>Nome Completo</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="senha"><i class="fas fa-lock me-2"></i>Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                                <small class="form-text text-muted">A senha deve ter no mínimo 6 caracteres.</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="confirmar_senha"><i class="fas fa-lock me-2"></i>Confirmar Senha</label>
                                <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
                            </div>
                            
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="termos" required>
                                    <label class="form-check-label" for="termos">
                                        Concordo com os termos e condições
                                    </label>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-user-plus me-2"></i>Cadastrar
                                </button>
                            </div>
                        </form>
                        
                        <div class="cadastro-link mt-3 text-center">
                            Já tem uma conta? <a href="login.php">Fazer Login</a>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-3 text-muted">
                    <small>&copy; <?php echo date('Y'); ?> Sistema de Gerenciamento - Todos os direitos reservados</small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>





